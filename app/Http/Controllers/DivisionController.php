<?php

namespace App\Http\Controllers;

use App\Models\District;
use App\Models\Division;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;

class DivisionController extends Controller implements HasMiddleware
{

    public static function middleware(): array
    {
        return [
            new Middleware('permission:view divisions', only: ['index']),
            new Middleware('permission:edit divisions', only: ['edit']),
            new Middleware('permission:create divisions', only: ['create']),
            new Middleware('permission:delete divisions', only: ['destroy']),
        ];
    }

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
        // $division->delete();
        return back()->with('division_delete', 'Delete Division');
    }

    // for  dynamic dropDown to get divisions district
    public function getDist($id)
    {

        $getdist = District::where('division_id', $id)->get();
        return response()->json($getdist);
    }
}
