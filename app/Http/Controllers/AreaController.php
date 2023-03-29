<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AreaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
{
    if(request()->ajax()){
        return $this->indexDataTable();
    
} 
    $areas = Area::all();
    return view('areas.index');
}

public function create()
{
    return view('areas.create');
}

public function store(Request $request)
{
    $area = new Area;
    $area->name = $request->name;
    $area->save();
    return redirect()->route('areas.index');
}

public function edit(Area $area)
    {
        return view('areas.edit', [
            'areas' => $area
        ]);
    }

public function update(Request $request, Area $area)
{
    $area->name = $request->name;
    $area->save();
    return redirect()->route('areas.index');
}

public function destroy(Area $area)
{
    $area->delete();
    return redirect()->route('areas.index');
}}