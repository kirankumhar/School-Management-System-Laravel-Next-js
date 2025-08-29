<?php

namespace App\Http\Controllers;


use App\Models\Student;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\StoreStudentRequest;
use App\Http\Requests\UpdateStudentRequest;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $students = Student::latest()->paginate(10);
        return response()->json($students);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreStudentRequest  $request)
    {
        $data = $request->validated();

        // Handle profile image upload
        if ($request->hasFile('profile_image')) {
            $data['profile_image'] = $request->file('profile_image')->store('students', 'public');
        }

        $student = Student::create($data);

        return response()->json([
            'message' => 'Student created successfully',
            'student' => $student
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Student $student)
    {
        return response()->json($student);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name'        => 'required|string|max:255',
            'email'       => 'required|email|unique:students,email,' . $student->id,
            'phone'       => 'nullable|string|max:20',
            'roll_number' => 'required|string|unique:students,roll_number,' . $student->id,
            'class'       => 'nullable|string|max:50',
            'section'     => 'nullable|string|max:10',
            'profile_image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $data = $request->all();

        // If new image uploaded → replace old one
        if ($request->hasFile('profile_image')) {
            if ($student->profile_image && Storage::disk('public')->exists($student->profile_image)) {
                Storage::disk('public')->delete($student->profile_image);
            }
            $path = $request->file('profile_image')->store('students', 'public');
            $data['profile_image'] = $path;
        }

        $student->update($data);

        return response()->json($student);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        if ($student->profile_image && Storage::disk('public')->exists($student->profile_image)) {
            Storage::disk('public')->delete($student->profile_image);
        }

        $student->delete();

        return response()->json(['message' => 'Student deleted successfully']);
    }
}
