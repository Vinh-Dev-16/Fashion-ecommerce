<?php

namespace App\Helpers;

use Illuminate\Support\Str;

class SubStringAddress
{
    public static function subStringProvince($province)
    {
        return Str::contains($province, ['Thành phố', 'Tỉnh']) ? Str::replace(['Thành phố', 'Tỉnh'], '', $province) : $province;
    }

    public static function subStringDistrict($district)
    {
        return Str::contains($district, ['Quận', 'Huyện', 'Thị xã']) ? Str::replace(['Quận', 'Huyện', 'Thị xã'], '', $district) : $district;
    }

}
