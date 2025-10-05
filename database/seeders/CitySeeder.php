<?php

namespace Database\Seeders;

use App\Models\City;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
         $cities = [
            // MIỀN BẮC
            ['name' => 'Hà Nội', 'domain' => 'b'],
            ['name' => 'Hải Phòng', 'domain' => 'b'],
            ['name' => 'Quảng Ninh', 'domain' => 'b'],
            ['name' => 'Hạ Long', 'domain' => 'b'],
            ['name' => 'Sapa', 'domain' => 'b'],
            ['name' => 'Hà Giang', 'domain' => 'b'],
            ['name' => 'Ninh Bình', 'domain' => 'b'],
            ['name' => 'Cao Bằng', 'domain' => 'b'],
            ['name' => 'Lào Cai', 'domain' => 'b'],
            ['name' => 'Điện Biên', 'domain' => 'b'],
            ['name' => 'Lai Châu', 'domain' => 'b'],
            ['name' => 'Sơn La', 'domain' => 'b'],
            ['name' => 'Yên Bái', 'domain' => 'b'],
            ['name' => 'Tuyên Quang', 'domain' => 'b'],
            ['name' => 'Lạng Sơn', 'domain' => 'b'],
            ['name' => 'Thái Nguyên', 'domain' => 'b'],
            ['name' => 'Bắc Kạn', 'domain' => 'b'],
            ['name' => 'Phú Thọ', 'domain' => 'b'],
            ['name' => 'Vĩnh Phúc', 'domain' => 'b'],
            ['name' => 'Bắc Ninh', 'domain' => 'b'],
            ['name' => 'Bắc Giang', 'domain' => 'b'],
            ['name' => 'Hải Dương', 'domain' => 'b'],
            ['name' => 'Hưng Yên', 'domain' => 'b'],
            ['name' => 'Hòa Bình', 'domain' => 'b'],
            ['name' => 'Thái Bình', 'domain' => 'b'],
            ['name' => 'Hà Nam', 'domain' => 'b'],
            ['name' => 'Nam Định', 'domain' => 'b'],
            
            // MIỀN TRUNG
            ['name' => 'Thanh Hóa', 'domain' => 't'],
            ['name' => 'Nghệ An', 'domain' => 't'],
            ['name' => 'Hà Tĩnh', 'domain' => 't'],
            ['name' => 'Quảng Bình', 'domain' => 't'],
            ['name' => 'Quảng Trị', 'domain' => 't'],
            ['name' => 'Huế', 'domain' => 't'],
            ['name' => 'Đà Nẵng', 'domain' => 't'],
            ['name' => 'Quảng Nam', 'domain' => 't'],
            ['name' => 'Hội An', 'domain' => 't'],
            ['name' => 'Quảng Ngãi', 'domain' => 't'],
            ['name' => 'Bình Định', 'domain' => 't'],
            ['name' => 'Quy Nhơn', 'domain' => 't'],
            ['name' => 'Phú Yên', 'domain' => 't'],
            ['name' => 'Khánh Hòa', 'domain' => 't'],
            ['name' => 'Nha Trang', 'domain' => 't'],
            ['name' => 'Ninh Thuận', 'domain' => 't'],
            ['name' => 'Bình Thuận', 'domain' => 't'],
            ['name' => 'Phan Thiết', 'domain' => 't'],
            ['name' => 'Mũi Né', 'domain' => 't'],
            ['name' => 'Kon Tum', 'domain' => 't'],
            ['name' => 'Gia Lai', 'domain' => 't'],
            ['name' => 'Đắk Lắk', 'domain' => 't'],
            ['name' => 'Đắk Nông', 'domain' => 't'],
            ['name' => 'Lâm Đồng', 'domain' => 't'],
            ['name' => 'Đà Lạt', 'domain' => 't'],
            
            // MIỀN NAM
            ['name' => 'Hồ Chí Minh', 'domain' => 'n'],
            ['name' => 'Bình Phước', 'domain' => 'n'],
            ['name' => 'Bình Dương', 'domain' => 'n'],
            ['name' => 'Đồng Nai', 'domain' => 'n'],
            ['name' => 'Tây Ninh', 'domain' => 'n'],
            ['name' => 'Bà Rịa - Vũng Tàu', 'domain' => 'n'],
            ['name' => 'Vũng Tàu', 'domain' => 'n'],
            ['name' => 'Long An', 'domain' => 'n'],
            ['name' => 'Tiền Giang', 'domain' => 'n'],
            ['name' => 'Bến Tre', 'domain' => 'n'],
            ['name' => 'Trà Vinh', 'domain' => 'n'],
            ['name' => 'Vĩnh Long', 'domain' => 'n'],
            ['name' => 'Đồng Tháp', 'domain' => 'n'],
            ['name' => 'An Giang', 'domain' => 'n'],
            ['name' => 'Kiên Giang', 'domain' => 'n'],
            ['name' => 'Phú Quốc', 'domain' => 'n'],
            ['name' => 'Cần Thơ', 'domain' => 'n'],
            ['name' => 'Hậu Giang', 'domain' => 'n'],
            ['name' => 'Sóc Trăng', 'domain' => 'n'],
            ['name' => 'Bạc Liêu', 'domain' => 'n'],
            ['name' => 'Cà Mau', 'domain' => 'n'],
        ];

        foreach ($cities as $city) {
            City::create([
                'name' => $city['name'],
                'slug' => Str::slug($city['name']),
                'domain' => $city['domain'],
                'is_active' => true,
            ]);
        }
    }
}
