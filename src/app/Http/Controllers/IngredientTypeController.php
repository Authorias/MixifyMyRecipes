<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\IngredientType;

class IngredientTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $types = IngredientType::all();

        return view('ingredienttypes.index', compact('types'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('ingredienttypes.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate(['name' => 'required']);

        IngredientType::create($request->all());
        
        return redirect()->route('ingredienttypes.index');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(IngredientType $ingredientType)
    {
        return view('ingredienttypes.edit', compact('ingredientType'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, IngredientType $ingredientType)
    {
        $request->validate(['name' => 'required']);

        $ingredientType->update($request->all());

        return redirect()->route('ingredienttypes.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(IngredientType $ingredientType)
    {
        if ($ingredientType->ingredients()->exists()) {
            return back()->with('error', 'You cannot delete this type because it is still used by a ingredient');
        }

        $ingredientType->delete();

        return back();        
    }
}