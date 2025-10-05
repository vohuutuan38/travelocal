<?php

namespace App\Http\Controllers\admins;

use App\Models\City;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CityController extends Controller
{
     /**
     * Lấy danh sách cities theo vùng miền
     */
    public function getCitiesByDomain(Request $request)
    {
        $domain = $request->query('domain');
        
        $query = City::active()->orderBy('name');
        
        if ($domain && in_array($domain, ['b', 't', 'n'])) {
            $query->where('domain', $domain);
        }
        
        $cities = $query->get(['cityId', 'name', 'domain']);
        
        return response()->json([
            'success' => true,
            'data' => $cities
        ]);
    }

    /**
     * Lấy thông tin chi tiết 1 city
     */
    public function show($id)
    {
        $city = City::with('tours')->find($id);
        
        if (!$city) {
            return response()->json([
                'success' => false,
                'message' => 'Không tìm thấy thành phố'
            ], 404);
        }
        
        return response()->json([
            'success' => true,
            'data' => $city
        ]);
    }
}
