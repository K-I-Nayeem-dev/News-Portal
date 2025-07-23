<?php

namespace App\Http\Controllers;

use App\Models\Social;
use Illuminate\Http\Request;

class SocailController extends Controller
{
    public function index(){
        $social = Social::get()->first();
        return view('layouts.newsDashboard.setting.social.index', [
            'social' => $social
        ]);
    }

    public function update(Request $request, $id){
        
        $data = [
            'facebook' => $request->facebook,
            'instagram' => $request->instagram,
            'youtube' => $request->youtube,
            'twitter' => $request->twitter,
            'linkedin' => $request->linkedin,
        ];

        Social::find($id)->update($data);

        return back()->with('social_update', 'Social Links Updated Successfully');
    }

}
