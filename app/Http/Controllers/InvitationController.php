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
        // Find the invitation by the token
        $invitation = Invitation::where('token', $token)->first();

        // If the token does not exist, redirect to login with an error
        if (!$invitation) {
            return redirect()->route('login')->with('error', 'Invalid token.');
        }

        // If the invitation has already been used, prevent access
        if ($invitation->status == 1) {
            return redirect()->route('login')->with('error', 'This invitation has already been used.');
        }

        // If the invitation has an expiration date and it has passed, prevent access
        if ($invitation->expires_at && now()->greaterThan($invitation->expires_at)) {
            return redirect()->route('login')->with('error', 'This invitation has expired.');
        }

        // If all checks pass, show the set password view
        return view('layouts.inviteUserMail.invite-set-password', ['token' => $token]);
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

        // Set the user password
        $user->password = Hash::make($request->password);
        $user->save();

        // Assign role if invitation has one
        if ($invitation->role) {
            $user->syncRoles($invitation->role);
        }

        // Mark invitation as used
        $invitation->update([
            'status' => 1,
            'used_at' => now(),
            'token' => null,
        ]);


        // Log in the user
        Auth::login($user);

        return redirect()->route('dashboard')->with('success', 'Your account is ready!');
    }
}
