<?php

namespace App\Http\Controllers\admins;

use App\Models\City;
use App\Models\Tour;
use App\Models\Guide;
use App\Models\Image;
use Illuminate\Support\Str;
use App\Models\TourActivity;
use Illuminate\Http\Request;
use App\Models\TourLocationMap;
use App\Models\TourIncludeExclude;
use Illuminate\Support\Facades\DB;
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
        $cities = City::active()->orderBy('name')->get();
        return view('admins.tour.add', compact('guides', 'cities'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
    dd($request->all());
         DB::beginTransaction();
        try {
            // Tạo tour mới
            $tour = Tour::create([
                'title' => $request->title,
                'cityId' => $request->cityId,
                'startDate' => $request->startDate,
                'endDate' => $request->endDate,
                'quantity' => $request->quantity,
                'priceAdult' => $request->priceAdult,
                'priceChild' => $request->priceChild,
                'description' => $request->description,
                'availability' => true, // Mặc định tour có sẵn
            ]);

            // Xử lý upload ảnh
            if ($request->hasFile('images')) {
                foreach ($request->file('images') as $image) {
                    if ($image) {
                        $imageName = time() . '_' . Str::random(10) . '.' . $image->extension();
                        $image->move(public_path('uploads/tours'), $imageName);
                        
                        Image::create([
                            'tourId' => $tour->tourId,
                            'url' => 'uploads/tours/' . $imageName,
                        ]);
                    }
                }
            }

            // Lưu Google Map iframe
            if ($request->map_link) {
                TourLocationMap::create([
                    'tourId' => $tour->tourId,
                    'iframe_code' => $request->map_link,
                ]);
            }

            // Lưu danh sách "Bao gồm"
            if ($request->includes && !empty($request->includes[0])) {
                $includeItems = explode("\n", $request->includes[0]);
                foreach ($includeItems as $item) {
                    $item = trim($item);
                    if (!empty($item)) {
                        TourIncludeExclude::create([
                            'tourId' => $tour->tourId,
                            'type' => 'include',
                            'content' => $item,
                        ]);
                    }
                }
            }

            // Lưu danh sách "Loại trừ"
            if ($request->excludes && !empty($request->excludes[0])) {
                $excludeItems = explode("\n", $request->excludes[0]);
                foreach ($excludeItems as $item) {
                    $item = trim($item);
                    if (!empty($item)) {
                        TourIncludeExclude::create([
                            'tourId' => $tour->tourId,
                            'type' => 'exclude',
                            'content' => $item,
                        ]);
                    }
                }
            }

            // Lưu các hoạt động
            if ($request->activities) {
                foreach ($request->activities as $activity) {
                    if (!empty($activity['name'])) {
                        TourActivity::create([
                            'tourId' => $tour->tourId,
                            'name' => $activity['name'],
                            'icon' => $activity['icon'] ?? null,
                        ]);
                    }
                }
            }

            // Gán hướng dẫn viên cho tour
            if ($request->guides) {
                $tour->guides()->attach($request->guides);
            }

            DB::commit();
            return redirect()->route('admin.tours.index')
                ->with('success', 'Tour đã được tạo thành công!');

        } catch (\Exception $e) {
            DB::rollBack();
            return back()
                ->withErrors(['error' => 'Có lỗi xảy ra: ' . $e->getMessage()])
                ->withInput();
        }
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
