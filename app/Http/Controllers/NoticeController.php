<?php

namespace App\Http\Controllers;

use App\Models\Notice;
use Illuminate\Http\Request;

class NoticeController extends Controller
{
    public function index()
    {
        $notice = Notice::get()->first();
        return view('layouts.newsDashboard.setting.notice.index', [
            'notice' => $notice
        ]);
    }

    // UPdate live tv
    public function update(Request $request, $id)
    {

        $data = [
            'notice' => $request->notice,
        ];

        Notice::find($id)->update($data);

        return back()->with('notice_update', 'Live TV Updated Successfully');
    }

    // Active live tv
    public function activenotice($id)
    {
        Notice::find($id)->update([
            'status' => 1
        ]);
        return back()->with('notice_active', 'Live TV Streaming Successfully');
    }

    // Deactive Live tv
    public function deactivenotice($id)
    {
        Notice::find($id)->update([
            'status' => 0
        ]);
        return back()->with('notice_deactive', 'Live TV Streaming Off');
    }
}