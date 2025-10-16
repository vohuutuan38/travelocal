<?php

namespace App\Http\Controllers\clients;

use App\Models\City;
use App\Models\Tour;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\clients\Tour as ClientsTour;

class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tours = Tour::with(['images','thumbnail', 'timelines','city'])->get();
        $popularDestinations = City::active() // Chỉ lấy các thành phố đang hoạt động
            ->withCount(['bookings', 'tours']) // Đếm số booking và số tour
            ->orderByDesc('bookings_count') // Sắp xếp theo số booking giảm dần
            ->take(6) // Lấy 6 thành phố
            ->get();
        
        return view('clients.home',compact('tours','popularDestinations'));
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
}
