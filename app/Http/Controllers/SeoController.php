<?php

namespace App\Http\Controllers;

use App\Models\Seo;
use Illuminate\Http\Request;

class SeoController extends Controller
{
    public function index(){
        $seo = Seo::get()->first();
        return view('layouts.newsDashboard.setting.seo.index', [
            'seo' => $seo
        ]);
    }

    public function update(Request $request, $id){

        $data = [
            'meta_author' => $request->meta_author,
            'meta_title' => $request->meta_title,
            'meta_keyword' => $request->meta_keyword,
            'meta_description' => $request->meta_description,
            'google_analytics' => $request->google_analytics,
            'goolge_verificatoins' => $request->goolge_verificatoins,
            'alexa_analytics' => $request->alexa_analytics,
        ];

        Seo::find($id)->update($data);

        return back()->with('seo_update', 'Seo Updated Successfully');
    }
}