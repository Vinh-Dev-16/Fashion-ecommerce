<?php

namespace App\Helpers;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;

class GetShip extends Client
{
    protected string $api;
    public function __construct()
    {
        parent::__construct([
            'timeout' => 2.0,
            'headers' => [
                'Accept' => 'application/json',
                'Authorization' => 'Bearer' . ' ' . env('TOKEN_SHIP'),
            ],
        ]);
    }

    /**
     * @throws GuzzleException
     */
    public static function getShip($province, $district, $weight, $value)
    {
        $url = 'https://api.mysupership.vn/v1/partner/orders/price?sender_province=Hà Nội&sender_district=Gia Lâm&receiver_province=' .$province. '&receiver_district=' .$district. '&weight=' .$weight. '&value=' .$value;
        $response = (new GetShip)->get($url);
        return json_decode($response->getBody()->getContents(), true);
    }

}
