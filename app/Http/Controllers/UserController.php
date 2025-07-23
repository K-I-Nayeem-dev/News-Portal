<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Mail\InviteUser;
use App\Models\invitation;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $users = User::orderBy('name', 'ASC')->latest()->paginate(15);
        return view('layouts.newsDashboard.users.index', [
            'users' => $users,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'name' => 'required|min:3',
                'email' => 'required|unique:users,email,',
            ],
            [
                'name' => 'Name field is required.',
            ]
        );

        // password genarated for invited User
        $password = Str::random(5) . rand(0, 999) . Str::random(5) . rand(0, 999);


        if ($validator->passes()) {

            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'invited_user' => 0,
                'password' => Hash::make($password),
                'created_at' => now(),
                'updated_at' => null
            ]);

            invitation::create([
                'invited_by' => Auth::id(),
                'name' => $request->name,
                'email' => $request->email,
                'status' => 0,
                'created_at' => now(),
                'updated_at' => null
            ]);


            $maildata = [
                'id' => $user->id,
                'name' => $request->name,
                'email' => $request->email,
                'password' => $password
            ];

            // dd($maildata);
            Mail::to($request->email)->send(new InviteUser($maildata));

            return back()->with('invite_send', 'Invite Request Send To ' . $request->name . ' ');
        } else {
            return back()->withInput()->withErrors($validator);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $user = User::findOrFail($id);
        return view('layouts.newsDashboard.users.edit', [
            'user' => $user
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|unique:users,email,' . $id . ',id',

        ]);

        $user = User::findOrFail($id);

        if ($request->has('reset_phone')) {

            $user->phone_number = null;
            $user->save();
            // return 'reset phone number';
            return back()->with('success', 'Phone Number Reset Successfully');
        } elseif ($request->has('add_phone_number')) {

            $user->phone_number = $request->phone_number;
            $user->save();
            // return 'Add phone number';
            return back()->with('success', 'Phone Number Add Successfully');
        } else {

            $user->name = $request->name;
            $user->email = $request->email;
            $user->role = $request->role;
            $user->save();

            return back()->with('user_update', 'User Update Successfully');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        return back()->with('user_delete', 'User Deleted');
    }
}
