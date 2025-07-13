<?php

namespace App\Http\Controllers;

use App\Models\District;
use App\Models\SubDistrict;
use Illuminate\Http\Request;

class SubDistrictController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $districts = District::orderBy('district_en', 'ASC')->get();
        $subdistricts = SubDistrict::orderBy('sub_district_en', 'ASC')->get();
        return view('layouts.newsDashboard.subdistrict.index', [
            'subdistricts' => $subdistricts,
            'districts' => $districts
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
        $request->validate([
            'subdistrict_en' => 'required|min:3',
            'subdistrict_bn' => 'required|min:3',
            'district' => 'required',
            'status' => 'required',
        ], [
            'subdistrict_en' => 'The Sub district english field is required.',
            'subdistrict_bn' => 'The Sub district bangla field is required.',
        ]);

        $data = [
            'sub_district_en' => $request->subdistrict_en,
            'sub_district_bn' => $request->subdistrict_bn,
            'district_id' => $request->district,
            'status' => $request->status,
        ];

        SubDistrict::insert($data);

        return back()->with('subdistrict_create', 'Sub District Created Successfully');
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
    public function edit(SubDistrict $subdistrict)
    {

        $districts = District::all();
        return view('layouts.newsDashboard.subdistrict.edit', [
            'subdistrict' => $subdistrict,
            'districts' => $districts
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, SubDistrict $subdistrict)
    {
        $request->validate([
            'subdistrict_en' => 'required|min:3',
            'subdistrict_bn' => 'required|min:3',
            'district' => 'required',
            'status' => 'required',
        ], [
            'subdistrict_en' => 'The Sub district english field is required.',
            'subdistrict_bn' => 'The Sub district bangla field is required.',
        ]);

        $subdistrict->sub_district_en = $request->subdistrict_en;
        $subdistrict->sub_district_bn = $request->subdistrict_bn;
        $subdistrict->district_id = $request->district;
        $subdistrict->status = $request->status;
        $subdistrict->save();

        return back()->with('subdistrict_update', 'Sub District Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(SubDistrict $subdistrict)
    {
        $subdistrict->delete();
        return back()->with('subdistrict_delete', 'Sub District Deleted');
    }
}