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
        $tours = Tour::with(['images', 'thumbnail'])->paginate(9);
        return view('clients.tour', compact('title', 'tours'));
    }

    public function search()
    {
        $title = "TÌm kiếm";
        return view('clients.search', compact('title'));
    }
    public function filter(Request $request)
    {
        $title = "Tour";

        $query = Tour::with(['images', 'thumbnail']);

        // Lọc theo giá
        if ($request->min_price && $request->max_price) {
            $query->whereBetween('priceAdult', [$request->min_price, $request->max_price]);
        }

        // Lọc theo điểm đến (b, t, n)
       // Lọc theo domain
if ($request->domain) {
    $query->where('domain', $request->domain);
}


        // Lọc theo sao (review >= x)
        if ($request->star) {
            $query->where('review', '>=', $request->star);
        }

        // Lọc theo thời gian (ví dụ: 3n2d, 4n3d, …)
        if ($request->time) {
            $query->where('time', $request->time);
        }

        $tours = $query->paginate(9);

        return view('clients.tour', compact('title', 'tours'));
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
        $tour = Tour::with(['images', 'thumbnail', 'timelines'])->where('tourId', $id)->first();
        $title = $tour->title;
        //   dd($tour->timelines);
        return view('clients.tour-detail', compact('title', 'tour'));
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
