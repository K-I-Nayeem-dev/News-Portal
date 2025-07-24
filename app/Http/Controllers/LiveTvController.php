<?php

namespace App\Http\Controllers;

use App\Models\LiveTv;
use Illuminate\Http\Request;

class LiveTvController extends Controller
{
    public function index()
    {
        $liveTv = LiveTv::get()->first();
        return view('layouts.newsDashboard.setting.livetv.index', [
            'liveTv' => $liveTv
        ]);
    }

    // UPdate live tv
    public function update(Request $request, $id){

        $data = [
            'embed_code' => $request->embed_code,
        ];

        LiveTv::find($id)->update($data);

        return back()->with('liveTV_update', 'Live TV Updated Successfully');
    }

    // Active live tv
    public function activeLiveTv($id){
        LiveTv::find($id)->update([
            'status' => 1
        ]);
        return back()->with('liveTV_active', 'Live TV Streaming Successfully');
    }

    // Deactive Live tv
    public function deactiveLiveTv($id){
        LiveTv::find($id)->update([
            'status' => 0
        ]);
        return back()->with('liveTV_deactive', 'Live TV Streaming Off');
    }


}