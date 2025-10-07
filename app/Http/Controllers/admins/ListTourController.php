<?php

namespace App\Http\Controllers\admins;

use App\Models\City;
use App\Models\Tour;
use App\Models\Guide;
use App\Models\Image;
use App\Models\TimeLine;
use Illuminate\Support\Str;
use App\Models\TourActivity;
use Illuminate\Http\Request;
use App\Models\TourLocationMap;
use App\Models\TourIncludeExclude;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\ActivityIcon;

class ListTourController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tours = Tour::with(['images', 'thumbnail'])->paginate(9);
        return view('admins.tour.index', compact('tours'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $guides = Guide::all();
        $cities = City::active()->orderBy('name')->get();
        $activityIcons = ActivityIcon::all();
        return view('admins.tour.add', compact('guides', 'cities', 'activityIcons'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        DB::beginTransaction();
        // dd($request->all());
        try {
            // Tạo tour mới
            $tour = Tour::create([
                'title' => $request->title,
                'time' => $request->time,
                'description' => $request->description,
                'quantity' => $request->quantity,
                'cityId' => $request->cityId,
                'priceAdult' => $request->priceAdult,
                'priceChild' => $request->priceChild,
                'availability' => '0', // Mặc định tour có sẵn
                'startDate' => $request->startDate,
                'endDate' => $request->endDate,
            ]);

            // Xử lý upload ảnh
            if ($request->hasFile('images')) {
                foreach ($request->file('images') as $image) {
                    if ($image) {
                        $originalName = pathinfo($image->getClientOriginalName(), PATHINFO_FILENAME); // tên file gốc (không kèm .jpg)
                        $extension = $image->getClientOriginalExtension();
                        $imageName = $originalName . '.' . $extension;
                        $image->move(public_path('clients/images/gallery-tours'), $imageName);

                        Image::create([
                            'tourId' => $tour->tourId,
                            'imageURL' => $imageName,
                            'description' => $request->title,
                        ]);
                    }
                }
            }
            // Lưu timeline
            if ($request->timelines) {
                foreach ($request->timelines as $timeline) {
                    if (!empty($timeline['title'])) {
                        TimeLine::create([
                            'tourId' => $tour->tourId,
                            'title' => $timeline['title'],
                            'description' => $timeline['description'] ?? '',
                        ]);
                    }
                }
            }

            // Lưu Google Map iframe
            if ($request->map_link) {
                TourLocationMap::create([
                    'tourId' => $tour->tourId,
                    'map_link' => $request->map_link,
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
            if ($request->activity_icons) {
                $tour->activities()->sync($request->activity_icons);
            }


            // Gán hướng dẫn viên cho tour
            if ($request->guides) {
                $tour->guides()->attach($request->guides);
            }

            DB::commit();
            return redirect()->route('admin.listTour')
                ->with('success', 'Tour đã được tạo thành công!');
        } catch (\Exception $e) {
            DB::rollBack();
            return dd($e->getMessage());
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
    public function edit($id)
    {
        $tour = Tour::with([
            'city',
            'images',
            'timelines',
            'includes',
            'excludes',
            'activities',
            'guides',
            'locationMap'
        ])->findOrFail($id);

        $cities = City::all();
        $activityIcons = ActivityIcon::all();
        $guides = Guide::all();

        return view('admins.tour.edit', compact('tour', 'cities', 'activityIcons', 'guides'));
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        DB::beginTransaction();

        try {
            // Lấy tour cần cập nhật
            $tour = Tour::findOrFail($id);

            // Cập nhật thông tin cơ bản
            $tour->update([
                'title' => $request->title,
                'time' => $request->time,
                'description' => $request->description,
                'quantity' => $request->quantity,
                'cityId' => $request->cityId,
                'priceAdult' => $request->priceAdult,
                'priceChild' => $request->priceChild,
                'startDate' => $request->startDate,
                'endDate' => $request->endDate,
            ]);

            /* ------------------ CẬP NHẬT ẢNH ------------------ */
            if ($request->hasFile('images')) {
                // Xóa ảnh cũ
                foreach ($tour->images as $img) {
                    $filePath = public_path('clients/images/gallery-tours/' . $img->imageURL);
                    if (file_exists($filePath)) unlink($filePath);
                    $img->delete();
                }

                // Upload ảnh mới
                foreach ($request->file('images') as $image) {
                    if ($image) {
                        $originalName = pathinfo($image->getClientOriginalName(), PATHINFO_FILENAME);
                        $extension = $image->getClientOriginalExtension();
                        $imageName = $originalName . '.' . $extension;
                        $image->move(public_path('clients/images/gallery-tours'), $imageName);

                        Image::create([
                            'tourId' => $tour->tourId,
                            'imageURL' => $imageName,
                            'description' => $request->title,
                        ]);
                    }
                }
            }

            /* ------------------ CẬP NHẬT TIMELINE ------------------ */
            TimeLine::where('tourId', $tour->tourId)->delete();
            if ($request->timelines) {
                foreach ($request->timelines as $timeline) {
                    if (!empty($timeline['title'])) {
                        TimeLine::create([
                            'tourId' => $tour->tourId,
                            'title' => $timeline['title'],
                            'description' => $timeline['description'] ?? '',
                        ]);
                    }
                }
            }

            /* ------------------ CẬP NHẬT GOOGLE MAP ------------------ */
            $tour->locationMap()->updateOrCreate(
                ['tourId' => $tour->tourId],
                ['map_link' => $request->map_link]
            );

            /* ------------------ CẬP NHẬT BAO GỒM / LOẠI TRỪ ------------------ */
            TourIncludeExclude::where('tourId', $tour->tourId)->delete();

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

            /* ------------------ CẬP NHẬT HOẠT ĐỘNG ------------------ */
            $tour->activities()->sync($request->activity_icons ?? []);

            /* ------------------ CẬP NHẬT HƯỚNG DẪN VIÊN ------------------ */
            $tour->guides()->sync($request->guides ?? []);

            DB::commit();

            return redirect()->route('admin.listTour')->with('success', 'Cập nhật tour thành công!');
        } catch (\Exception $e) {
            DB::rollBack();
            return dd($e->getMessage());
        }
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
