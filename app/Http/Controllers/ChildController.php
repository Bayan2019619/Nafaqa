<?php

namespace App\Http\Controllers;

use App\Models\Child;
use Illuminate\Http\Request;

class ChildController extends Controller
{
    public function index()
    {
        return Child::all();
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'case_id' => 'required|exists:divorce_cases,id',
            'full_name' => 'required|string|max:255',
            'nationality_no' => 'required|string|unique:children,nationality_no',
            'date_of_birth' => 'required|date',
            'gender' => 'required|in:0,1',
            'status' => 'nullable|in:0,1',
        ]);

        return Child::create($validated);
    }

    public function show(Child $child)
    {
        return $child;
    }

    public function update(Request $request, Child $child)
    {
        $validated = $request->validate([
            'full_name' => 'sometimes|string|max:255',
            'nationality_no' => 'sometimes|string|unique:children,nationality_no,' . $child->id,
            'date_of_birth' => 'sometimes|date',
            'gender' => 'sometimes|in:0,1',
            'status' => 'sometimes|in:0,1',
        ]);

        $child->update($validated);
        return $child;
    }

    public function destroy(Child $child)
    {
        $child->delete();
        return response()->noContent();
    }
}
