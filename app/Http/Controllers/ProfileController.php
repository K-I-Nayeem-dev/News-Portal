<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use App\Models\User;
use App\Models\News;
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
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class ProfileController extends Controller
{

    public function index()
    {
        $publishedNews = News::where('user_id', Auth::id())
            ->with(['category', 'subcategory'])
            ->select(['id', 'title_bn', 'thumbnail', 'category_id', 'sub_cate_id', 'created_at', 'user_id']) // Only needed columns
            ->latest()
            ->paginate(40);

        return view('layouts.newsDashboard.profile.index', compact('publishedNews'));
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

        $Image = new ImageManager(new Driver());
        $new_name = Str::random(5) . time() . '.' . $request->photo->getClientOriginalExtension();

        // Delete old profile picture if exists
        if (Auth::user()->profile_picture != null) {
            $filePath = public_path('uploads/profile_pictures/') . Auth::user()->profile_picture;

            if (file_exists($filePath)) {
                unlink($filePath);
            }
        }

        // Upload new profile picture
        $image = $Image->read($request->photo)->resize(120, 120);
        $image->save(public_path('uploads/profile_pictures/' . $new_name), quality: 30);

        // Update database
        DB::table('users')->where('id', Auth::id())->update([
            'profile_picture' => $new_name,
        ]);

        flash()
            ->addSuccess('Profile Picture Changed Successfully', [
                'position' => 'bottom-center', // 👈 correct way
            ]);
        return back();
    }

    public function updatePassword(Request $request)
    {
        // Validate the request
        $request->validate([
            'current_password' => ['required'],
            'password' => ['required', 'confirmed', Password::min(8)],
        ]);

        $user = Auth::user();

        // Check if current password matches
        if (!Hash::check($request->current_password, $user->password)) {
            return back()->withErrors([
                'current_password' => 'The current password is incorrect.'
            ])->withInput();
        }

        // Update using DB query
        DB::table('users')
            ->where('id', $user->id)
            ->update([
                'password' => Hash::make($request->password)
            ]);

        flash()
            ->addSuccess('Password updated successfully!', [
                'position' => 'bottom-center', // 👈 correct way
            ]);
        return back();
    }
}
