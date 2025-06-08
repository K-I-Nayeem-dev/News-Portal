<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TestController extends Controller
{
    public function test(){

        $all = User::find(1);

        return view ('welcome', [
            'all' => $all
        ]);
    }
}