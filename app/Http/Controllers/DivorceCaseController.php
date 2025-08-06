<?php

namespace App\Http\Controllers;

use App\Models\DivorceCase;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;

class DivorceCaseController extends Controller
{
    use AuthorizesRequests;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $this->authorize('viewAny', DivorceCase::class);

        $divorceCases = DivorceCase::paginate(10);

        return view('divorce-cases.index', compact('divorceCases'));
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
    }

    /**
     * Display the specified resource.
     */
    public function show(DivorceCase $divorceCase)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(DivorceCase $divorceCase)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, DivorceCase $divorceCase)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(DivorceCase $divorceCase)
    {
        //
    }
}
