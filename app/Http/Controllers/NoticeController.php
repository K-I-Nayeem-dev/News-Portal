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
            'notice_en' => $request->notice_en,
            'notice_bn' => $request->notice_bn,
        ];

        Notice::find($id)->update($data);

        return back()->with('notice_update', 'Notice Updated Successfully');
    }

    // Active live tv
    public function activenotice($id)
    {
        Notice::find($id)->update([
            'status' => 1
        ]);
        return back()->with('notice_active', 'Notice Activated');
    }

    // Deactive Live tv
    public function deactivenotice($id)
    {
        Notice::find($id)->update([
            'status' => 0
        ]);
        return back()->with('notice_deactive', 'Notice Deactived');
    }
}
