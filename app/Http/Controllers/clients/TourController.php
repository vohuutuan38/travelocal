<?php

namespace App\Http\Controllers\clients;

use App\Models\Tour;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TourController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
          $title = "Tour";
          $tours = Tour::with(['images','thumbnail'])->get();
        return view('clients.tour',compact('title','tours'));
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
        $tour = Tour::with(['images','thumbnail', 'timelines'])->where('tourId', $id)->first();
          $title = $tour->title;
        //   dd($tour->timelines);
        return view('clients.tour-detail',compact('title','tour'));
    }
    // public function show(string $id)
    // {
    //     //
    // }

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
