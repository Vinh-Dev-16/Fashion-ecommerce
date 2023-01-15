<?php

namespace Database\Seeders;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('products')->insert([
            'name'  => 'Áo thun thêu NOCTURAL',
            'price' =>'175000',
            'thumbnail' => '1',
            'discount' => '10',
            'description' => 'NOCTURNAL Mini Icons Tee
            Mặt sau trơn có đính mác cao su trong siêu đẹp
            Xem từng ảnh để thấy những chi tiết thú vị nhé!
            Được chăm chút từ chất liệu, form dáng, đường may, hình in cho đến khâu đóng gói và hậu mãi, chiếc áo xinh xẻo này sẽ làm hài lòng cả những vị khách khó tính nhất'
        ]);
        DB::table('products')->insert([
            'name'  => 'Áo Khoác Nam 2 Lớp Lót Lông Phong Cách Hiện Đại Thời Trang VICERO',
            'price' =>'540000',
            'thumbnail' => '1',
            'discount' => '10',
            'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit'
        ]);
        DB::table('products')->insert([
            'name'  => 'Áo thun thêu NOCTURAL',
            'price' =>'175000',
            'thumbnail' => '1',
            'discount' => '10',
            'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit'
        ]);
        DB::table('products')->insert([
            'name'  => 'Áo thun thêu NOCTURAL',
            'price' =>'175000',
            'thumbnail' => '1',
            'discount' => '10',
            'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit'
        ]);
        DB::table('products')->insert([
            'name'  => 'Áo thun thêu NOCTURAL',
            'price' =>'175000',
            'thumbnail' => '1',
            'discount' => '10',
            'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit'
        ]);
        DB::table('products')->insert([
            'name'  => 'Áo thun thêu NOCTURAL',
            'price' =>'175000',
            'thumbnail' => '1',
            'discount' => '10',
            'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit'
        ]);
        DB::table('products')->insert([
            'name'  => 'Áo thun thêu NOCTURAL',
            'price' =>'175000',
            'thumbnail' => '1',
            'discount' => '10',
            'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit'
        ]);
        DB::table('products')->insert([
            'name'  => 'Áo thun thêu NOCTURAL',
            'price' =>'175000',
            'thumbnail' => '1',
            'discount' => '10',
            'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit'
        ]);
        DB::table('categories')->insert([
            'name'  => 'Áo khoác nam',
        ]);
        DB::table('categories')->insert([
            'name'  => 'Áo thun nam',
        ]);
        DB::table('categories')->insert([
            'name'  => 'Kính nam',
        ]);
        DB::table('categories')->insert([
            'name'  => 'Kính nữ',
        ]);
        DB::table('categories')->insert([
            'name'  => 'Áo khoác nữ',
        ]);
        DB::table('categories')->insert([
            'name'  => 'Áo thun nữ',
        ]);
}
}