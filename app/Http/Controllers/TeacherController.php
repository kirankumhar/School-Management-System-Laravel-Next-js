<?php

namespace App\Http\Controllers;

use App\Models\Teacher;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TeacherController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Teacher::query();

        if ($request->has('search')) {
            $search = $request->search;
            $query->where('name', 'like', "%{$search}%")
                ->orWhere('email', 'like', "%{$search}%")
                ->orWhere('subject', 'like', "%{$search}%")
                ->orWhere('phone', 'like', "%{$search}%");
        }

        $teachers = $query->paginate(5); // 5 per page
        return response()->json($teachers);
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
        //
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:teachers',
            'subject' => 'nullable|string',
            'phone' => 'nullable|string',
        ]);

        $teacher = Teacher::create($request->all());

        return response()->json($teacher, 201);
    }


    // Get single teacher
    public function show($id)
    {
        return Teacher::findOrFail($id);
    }

    // Update teacher
    public function update(Request $request, $id)
    {
        $teacher = Teacher::findOrFail($id);
        $teacher->update($request->all());

        return response()->json($teacher, 200);
    }

    // Delete teacher
    public function destroy($id)
    {
        $teacher = Teacher::findOrFail($id);
        $teacher->delete();

        return response()->json(null, 204);
    }
}
