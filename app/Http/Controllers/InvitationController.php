<?php

namespace App\Http\Controllers;

use App\Models\invitation;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class InvitationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::latest()->paginate(15);
        return view('layouts.newsDashboard.invite.index',[
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
        $validator = Validator::make($request->all(), [
            'name' => 'required|min:3',
            'email' => 'required|unique:users,email,',
        ],[
            'name' => 'Name field is required.',
        ]
        );

        if ($validator->passes()) {

            // User::create([
            //     'name' => $request->name,
            //     'email' => $request->email,
            //     'invited_user' => 0,
            //     'created_at' => now(),
            //     'updated_at' => null
            // ]);

            // invitation::create([
            //     'invited_by' => Auth::id(),
            //     'name' => $request->name,
            //     'email' => $request->email,
            //     'status' => 0,
            //     'created_at' => now(),
            //     'updated_at' => null
            // ]);

            return back()->with('invite_send', 'Invite Request Send To ' . $request->name . ' ');

        } else {
            return back()->withInput()->withErrors($validator);
        }

    }

    /**
     * Display the specified resource.
     */
    public function show(invitation $invitation)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(invitation $invitation)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, invitation $invitation)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(invitation $invitation)
    {
        //
    }
}
