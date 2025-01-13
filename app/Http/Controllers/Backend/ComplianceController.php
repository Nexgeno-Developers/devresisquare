<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Models\ComplianceType;

class ComplianceController
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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

    public function getComplianceForm($complianceTypeId)
    {
        // Fetch the compliance type by ID
        $complianceType = ComplianceType::findOrFail($complianceTypeId);

        // Dynamically load the form partial for the selected compliance type using the alias
        $content = view('backend.compliance.' . $complianceType->alias . '._form', compact('complianceType'))->render();

        return response()->json(['content' => $content]);
    }

}
