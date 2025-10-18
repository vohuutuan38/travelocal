<?php

namespace App\Http\Controllers\clients;

use App\Models\City;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Tour;

class DestinationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
public function index(Request $request)
    {
        // Bắt đầu câu truy vấn
        $query = City::active()->withCount('tours');

        // Lấy domain hiện tại từ URL (ví dụ: ?domain=b)
        $currentDomain = $request->query('domain');

        // Nếu có domain được chọn, thêm điều kiện lọc
        if ($currentDomain && in_array($currentDomain, ['b', 't', 'n'])) {
            $query->where('domain', $currentDomain);
        }

        // Sắp xếp và phân trang
        $cities = $query->orderByDesc('tours_count')->paginate(16); // Ví dụ: 12 thành phố mỗi trang

        // Trả về view với dữ liệu đã được lọc và phân trang


        $tours = Tour::with(['images', 'thumbnail'])->orderByDesc('created_at')->limit(3)->get();
        return view('clients.destination', [
            'cities' => $cities,
            'currentDomain' => $currentDomain,
            'tours' => $tours
        ]);
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
    public function show()
    {
        return view('clients.destination-detail');
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
