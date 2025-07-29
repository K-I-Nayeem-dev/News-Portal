<?php

namespace App\Http\Controllers;

use App\Models\District;
use App\Models\Division;
use App\Models\SubDistrict;
use Illuminate\Http\Request;

class DistrictController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $districts = District::orderBy('district_en', 'ASC')->get();
        $divisions = Division::orderBy('division_en', 'ASC')->get();
        return view('layouts.newsDashboard.district.index', [
            'districts' => $districts,
            'divisions' => $divisions
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
            'district_en' => 'required|min:3',
            'district_bn' => 'required|min:3',
            'division_id' => 'required',
            'status' => 'required',
        ], [
            'district_en' => 'The district english field is required.',
            'district_bn' => 'The district bangla field is required.',
        ]);

        $data = [
            'district_en' => $request->district_en,
            'district_bn' => $request->district_bn,
            'division_id' => $request->division_id,
            'status' => $request->status,
        ];

        District::insert($data);

        return back()->with('district_create', 'District Created Successfully');
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
    public function edit(District $district)
    {

        $divisions = Division::orderBy('division_en', 'ASC')->get();
        return view('layouts.newsDashboard.district.edit', [
            'district' => $district,
            'divisions' => $divisions
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, District $district)
    {

        $request->validate([
            'district_en' => 'required|min:3',
            'district_bn' => 'required|min:3',
            'division_id' => 'required',
            'status' => 'required',
        ], [
            'district_en' => 'The district english field is required.',
            'district_bn' => 'The district bangla field is required.',
        ]);

        $district->district_en = $request->district_en;
        $district->district_bn = $request->district_bn;
        $district->division_id = $request->division_id;
        $district->status = $request->status;
        $district->save();

        return back()->with('district_update', 'District Update Successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(District $district)
    {
        $district->delete();
        return redirect()->route('district.index')->with('district_delete', 'District Deleted');
    }

    public function getSubdist($id){

        $getSubdist = SubDistrict::where('district_id', $id)->get();

        return response()->json($getSubdist);

    }

}