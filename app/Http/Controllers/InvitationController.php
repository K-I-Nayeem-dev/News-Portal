<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Invitation;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class InvitationController extends Controller
{
    // Show password setup form
    public function accept($token)
    {
        $invitation = Invitation::where('token', $token)->first();

        // Invalid token
        if (!$invitation) {
            flash()->addError('Invalid invitation token.', ['position' => 'bottom-center']);
            return redirect('/invitation-invalid');
        }

        // Already used
        if ($invitation->status == 1) {
            flash()->addError('This invitation has already been used.', ['position' => 'bottom-center']);
            return redirect('/invitation-invalid');
        }

        // Expired
        if ($invitation->expires_at && now()->greaterThan($invitation->expires_at)) {
            flash()->addError('This invitation has expired.', ['position' => 'bottom-center']);
            return redirect('/invitation-invalid');
        }

        // Show password setup page
        return view('layouts.inviteUserMail.invite-set-password', [
            'token' => $token
        ]);
    }

    // Complete registration (set password)
    public function complete(Request $request)
    {
        $request->validate([
            'token' => 'required|exists:invitations,token',
            'password' => 'required|confirmed|min:8', // stronger minimum
        ]);

        $invitation = Invitation::where('token', $request->token)->firstOrFail();
        $user = User::where('email', $invitation->email)->firstOrFail();

        // Update user password
        $user->password = Hash::make($request->password);
        $user->invited_user = null;
        $user->save();

        // Assign role if exists
        if ($invitation->role) {
            $roles = json_decode($invitation->role, true);
            $user->syncRoles($roles);
        }

        // Mark invitation as used
        $invitation->update([
            'status' => 1,
            'used_at' => now(),
            'token' => null,
        ]);

        // Log in the user and regenerate session
        Auth::login($user);
        $request->session()->regenerate();

        // Flash success message
        flash()->addSuccess('Your account is ready! 🚀', [
            'position' => 'bottom-center',
        ]);

        // Redirect to dashboard
        return redirect()->route('dashboard');
    }
}
