<?php

namespace App\Http\Controllers\admins;

use App\Models\Tour;
use App\Models\Guide;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ListTourController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tours = Tour::with(['images', 'thumbnail'])->paginate(6);
        return view('admins.tour.index',compact('tours'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
          $guides = Guide::all();
        return view('admins.tour.add', compact('guides'));
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
         $tour = Tour::with(['images', 'thumbnail', 'timelines','includes', 'excludes','activities','locationMap'])->where('tourId', $id)->first();
        return view('admins.tour.edit',compact('tour'));
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
