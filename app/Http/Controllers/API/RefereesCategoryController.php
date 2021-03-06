<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\RefereesCategory;
use Illuminate\Http\Request;

class RefereesCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $refrees_categories = RefereesCategory::all();
        return response()->json(['data' => $refrees_categories], 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $refrees_category = RefereesCategory::create($request->all());
        return response()->json(['data' => $refrees_category], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\RefereesCategory  $category
     * @return \Illuminate\Http\Response
     */
    public function show(RefereesCategory $refrees_category)
    {
        return response()->json(['data' => $refrees_category], 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\RefereesCategory  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, RefereesCategory $refrees_category)
    {
        $refrees_category->update($request->all());
        return response()->json(['data' => $refrees_category], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\RefereesCategory  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(RefereesCategory $refrees_category)
    {
        $refrees_category->delete();
        return response()->json(['data' => $refrees_category], 204);
    }
}
