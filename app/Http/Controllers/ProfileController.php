<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use App\Models\User;
use App\Models\Verification;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Imagick\Driver;
use Illuminate\Support\Str;

class ProfileController extends Controller
{

    public function index()
    {

        return view('layouts.newsDashboard.profile.index');
    }

    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {

        // dd($request->user());


        $otp_send = DB::table('verifications')->where('user_id', Auth::id())->first();

        return view('profile.edit', [
            'user' => $request->user(),
            'otp_send' => $otp_send,
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

    public function phone_add(Request $request)
    {

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

    public function send_otp()
    {

        //Random OTP Number Send TO User to Verify Phone Number
        $otp = rand(100000, 999999);

        // Create OTP Data
        $data = [
            'user_id' => Auth::id(),
            'phone_number' => Auth::user()->phone_number,
            'status' => 0,
            'code' => $otp,
            'created_at' => now(),
            'updated_at' => null,
        ];


        // input OTP Data
        Verification::create($data);

        // OTP Send Status change 0 to 1
        DB::table('users')->where('id', Auth::id())->update([
            'otp_send' => 1
        ]);


        return back()->with('otp_send', 'OTP Send Successfully');
    }


    // Verify Phone Number
    public function verify_number(Request $request)
    {

        $request->validate([
            'otp' => 'required|max:6',
        ]);

        $otp = DB::table('verifications')->where('user_id', Auth::id())->first();

        if ($otp->code == $request->otp) {

            // Update OTP Status table
            DB::table('verifications')->where('user_id', Auth::id())->update([
                'status' => 1,
                'updated_at' => now()
            ]);

            // Update Users Table
            DB::table('users')->where('id', Auth::id())->update([
                'phone_verify' => 1
            ]);


            return back()->with('verify_number', 'Phone Number Verify Successfully');
        } else {

            return back()->with('wrong_otp', 'Entered Wrong OTP');
        }
    }

    public function update_number()
    {

        DB::table('users')->where('id', Auth::id())->update([
            'phone_update' => 1
        ]);

        return back()->with('update_request', 'Phone Number Update Request Send to Admin');
    }

    public function photo_upload(Request $request)
    {

        $request->validate([
            'photo' => 'required|file|image|mimes:jpeg,png,jpg,gif|max:800',
        ]);

        if (Auth::user()->profile_picture == null) {

            $Image = new ImageManager(new Driver());
            $new_name = Str::random(5) . time() . '.' . $request->photo->getClientOriginalExtension();
            $image = $Image->read($request->photo)->resize(120, 120);
            $image->save('uploads/profile_pictures/' . $new_name, quality: 30);
        } else {

            $imagePath = DB::table('users')->select('profile_picture')->where('id', Auth::id())->first();
            $filePath = public_path('uploads/profile_pictures/') . $imagePath->profile_picture;

            if (file_exists($filePath)) {

                unlink($filePath);
                $Image = new ImageManager(new Driver());
                $new_name = Str::random(5) . time() . '.' . $request->photo->getClientOriginalExtension();
                $image = $Image->read($request->photo)->resize(120, 120);
                $image->save('uploads/profile_pictures/' . $new_name, quality: 30);

                DB::table('users')->where('id', Auth::id())->update([
                    'profile_picture' => $new_name,
                ]);
            }
        }

        return back()->with('photo_upload', 'Profile Picture Change');
    }
}
