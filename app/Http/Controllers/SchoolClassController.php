<?php

namespace App\Http\Controllers;


use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\StoreSchoolClassRequest;
use App\Models\SchoolClass;

class SchoolClassController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $classes = SchoolClass::with(['classTeacher', 'sections'])->get();
        return response()->json($classes);
    }

    public function store(StoreSchoolClassRequest $request)
    {
        try {
            $validated = $request->validated();
            
            $class = SchoolClass::create($validated);
            
            return response()->json([
                'message' => 'Class created successfully',
                'class' => $class
            ], 201);
            
        } catch (\Exception $e) {
            \Log::error('Error creating class: ' . $e->getMessage());
            
            return response()->json([
                'message' => 'Error creating class',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
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
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
