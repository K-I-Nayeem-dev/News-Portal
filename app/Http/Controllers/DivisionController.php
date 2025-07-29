<?php

namespace App\Http\Controllers;

use App\Models\Division;
use Illuminate\Http\Request;

class DivisionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $divisions = Division::orderBy('division_en', 'ASC')->get();
        return view('layouts.newsDashboard.division.index', [
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
            'division_en' => 'required|min:3',
            'division_bn' => 'required|min:3',
            'status' => 'required',
        ], [
            'division_en' => 'The Division english field is required.',
            'division_bn' => 'The Division bangla field is required.',
        ]);



        $data = [
            'division_en' => $request->division_en,
            'division_bn' => $request->division_bn,
            'status' => $request->status,
        ];

        Division::insert($data);

        return back()->with('division_create', 'Division Created Successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Division $division)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Division $division)
    {
        return view('layouts.newsDashboard.division.edit', [
            'division' => $division
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Division $division)
    {
        $request->validate([
            'division_en' => 'required|min:3',
            'division_bn' => 'required|min:3',
            'status' => 'required',
        ], [
            'division_en' => 'The Division english field is required.',
            'division_bn' => 'The Division bangla field is required.',
        ]);

        $division->division_en = $request->division_en;
        $division->division_bn = $request->division_bn;
        $division->status = $request->status;
        $division->save();

        return back()->with('division_update', 'Division Update Successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Division $division)
    {
        //
    }
}
