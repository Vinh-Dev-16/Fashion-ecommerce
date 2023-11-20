<?php

namespace App\Helpers;

class ColorNameHelper
{
    public static function ChangeName($color): string
    {
        $colorNames = [
            'black' => 'Đen',
            'white' => 'Trắng',
            'red' => 'Đỏ',
            'blue' => 'Xanh',
            'green' => 'Xanh lá',
            'yellow' => 'Vàng',
            'pink' => 'Hồng',
            'orange' => 'Cam',
            'purple' => 'Tím',
            'brown' => 'Nâu',
            'gray' => 'Xám',
            'silver' => 'Bạc'
        ];
        return $colorNames[$color] ?? '';
    }

    public static function ChangeColorStyle($color)
    {
        $colorStyles = [
            'black' => 'background-color: #000000',
            'white' => 'background-color: #ffffff',
            'red' => 'background-color: #ff0000',
            'blue' => 'background-color: #0000ff',
            'green' => 'background-color: #00ff00',
            'yellow' => 'background-color: #ffff00',
            'pink' => 'background-color: #ff00ff',
            'orange' => 'background-color: #ffa500',
            'purple' => 'background-color: #800080',
            'brown' => 'background-color: #a52a2a',
            'gray' => 'background-color: #808080',
            'silver' => 'background-color: #c0c0c0'
        ];
        return $colorStyles[$color] ?? '';
    }

    public static function changeNameAttribute($value): string
    {
        $valueNames = [
          'Size' => 'Kích cỡ',
          'Color' => 'Màu sắc',
        ];
        return $valueNames[$value] ?? '';
    }
}
