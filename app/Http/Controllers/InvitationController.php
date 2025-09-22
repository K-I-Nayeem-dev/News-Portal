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
        // Find the invitation by token
        $invitation = Invitation::where('token', $token)->first();

        // If the token does not exist
        if (!$invitation) {
            flash()->addError('Invalid invitation token.', ['position' => 'bottom-center']);
            return redirect('/invitation-invalid'); // triggers fallback page
        }

        // If the invitation has already been used
        if ($invitation->status == 1) {
            flash()->addError('This invitation has already been used.', ['position' => 'bottom-center']);
            return redirect('/invitation-invalid'); // triggers fallback page
        }

        // If the invitation has expired
        if ($invitation->expires_at && now()->greaterThan($invitation->expires_at)) {
            flash()->addError('This invitation has expired.', ['position' => 'bottom-center']);
            return redirect('/invitation-invalid'); // triggers fallback page
        }

        // If all checks pass, show the set password page
        return view('layouts.inviteUserMail.invite-set-password', [
            'token' => $token
        ]);
    }





    // Complete registration (set password)
    public function complete(Request $request)
    {
        $request->validate([
            'token' => 'required|exists:invitations,token',
            'password' => 'required|confirmed|min:6',
        ]);

        $invitation = Invitation::where('token', $request->token)->firstOrFail();
        $user = User::where('email', $invitation->email)->firstOrFail();

        // Set user password
        $user->password = Hash::make($request->password);
        $user->invited_user = null; // instead of 0
        $user->save();


        // Assign roles correctly
        if ($invitation->role) {
            $roles = json_decode($invitation->role, true); // decode JSON
            $user->syncRoles($roles);
        }

        // Mark invitation as used
        $invitation->update([
            'status' => 1,
            'used_at' => now(),
            'token' => null,
        ]);

        // Log in user
        Auth::login($user);

        // Flash success message with flasher
        flash()
            ->addSuccess('Your account is ready!', [
                'position' => 'bottom-center', // 👈 correct way
            ]);

        return redirect()->route('dashboard');
    }
}
