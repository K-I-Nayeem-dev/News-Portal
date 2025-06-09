<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class ProfileController extends Controller
{

    public function index(){
        return view('layouts.newsDashboard.profile.index');
    }

    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $request->user()->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $request->user()->save();

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }

    public function phone_add(Request $request){

        $request->validate([
            'phone_number' => 'required|min:11',
        ]);


        User::find(Auth::id())->update(
            [
                'phone_number' => $request->phone_number,
            ]
        );

        return back()->with('phone_add', 'Phone Number Successfully Added');
    }

    public function send_otp(){

        //Random OTP Number Send TO User to Verify Phone Number
        $otp = rand(1000, 9999);


        // Create OTP Data
        $data = [
            'user_id' => Auth::id(),
            'phone_number' => Auth::user()->phone_number,
            'status' => 0,
            'code' => $otp,
            'created_at' => now(),
            'updated_at' => null
        ];

        // input OTP Data
        DB::table('users')->create($data);


        return back()->with('otp_send', 'OTP Send Successfully');
    }

}
