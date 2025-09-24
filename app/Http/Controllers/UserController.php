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
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
use Spatie\Permission\Models\Role;

class UserController extends Controller  implements HasMiddleware
{

    public static function middleware(): array
    {
        return [
            new Middleware('permission:view members', only: ['index']),
            new Middleware('permission:invite members', only: ['create']),
            new Middleware('permission:edit members', only: ['edit']),
            new Middleware('permission:remove member', only: ['destroy']),
        ];
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::orderBy('name', 'ASC')->latest()->paginate(15);
        $roles = Role::orderBy('name', 'ASC')->get();
        return view('layouts.newsDashboard.users.index', [
            'users' => $users,
            'roles' => $roles
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
        // Validate request
        $validator = Validator::make(
            $request->all(),
            [
                'name' => 'required|min:3',
                'email' => 'required|email|unique:users,email',
                'role' => 'nullable|array',       // The role input can be an array or null
                'role.*' => 'exists:roles,name', // Each item in the array must exist in roles table

            ],
            [
                'name.required' => 'Name field is required.',
            ]
        );

        if ($validator->fails()) {
            return back()->withInput()->withErrors($validator);
        }

        // // Generate random password for invited user
        // $password = Str::random(5) . rand(0, 999) . Str::random(5) . rand(0, 999);

        // Create the user
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make(Str::random(10)), // temporary random password
            'invited_user' => 1,
            'created_at' => now(),
            'updated_at' => null
        ]);

        // Assign role if provided
        if ($request->filled('role')) {
            $user->syncRoles($request->role);
        }


        // Convert roles array to JSON for storage
        $expirationMinutes = 60 * 24; // 24 hours
        $invitation = Invitation::create([
            'invited_by' => Auth::id(),
            'name'       => $request->name,
            'email'      => $request->email,
            'role'       => $request->role ? json_encode($request->role) : null,
            'token'      => Str::random(64),
            'status'     => 0,
            'used_at'    => null,
            'expires_at' => now()->addMinutes($expirationMinutes),
            'created_at' => now(),
            'updated_at' => null
        ]);




        // Prepare mail data
        $maildata = [
            'id'        => $user->id,
            'name'      => $user->name,
            'email'     => $user->email,
            'token'     => $invitation->token,
            'role'      => $request->role ? implode(', ', $request->role) : 'No Role', // convert array to string for email
            'expires_at' => $invitation->expires_at, // Add this line to show expiry in email
        ];


        // Send invitation email
        Mail::to($request->email)->send(new InviteUser($maildata));

        return back()->with('invite_send', 'Invite Request Sent To ' . $request->name);
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
        $roles = Role::orderBy('name', 'ASC')->get();
        $hasRoles = $user->roles->pluck('id');
        return view('layouts.newsDashboard.users.edit', [
            'user' => $user,
            'roles' => $roles,
            'hasRoles' => $hasRoles
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $user = User::findOrFail($id);

        $request->validate([
            'name' => 'required',
            'email' => 'required|unique:users,email,' . $id . ',id',

        ]);


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
            $user->syncRoles($request->role);
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

        flash()
            ->addSuccess('User Deleted', [
                'position' => 'bottom-center', // 👈 correct way
            ]);

        return back();
    }
}