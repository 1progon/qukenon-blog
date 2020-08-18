<?php

namespace App\Classes;

defined('ABS_PATH') or die('У Вас нет доступа');

use GuzzleHttp\Client;
use OTPHP\TOTP;


class GetSkins
{
    private string $qrCode = 'TAJNQPYLIVMT7NCH';
    private string $code;

    private string $api = 'd9d1e6e3-0ee2-4a5e-963c-a6375f03d2ee';
    private string $uri = 'https://bitskins.com/api/v1/';

    private Client $client;

    private int $per_page = 30; // 30 или 480

    public function __construct(Client $client)
    {
        $this->client = $client;

        $otp = TOTP::create($this->qrCode);
        $this->code = $otp->now();
    }

    function getSkins(
        $skinsCategory = null,
        $pageIndex = 1,
        $minPrice = null,
        $maxPrice = null,
        $hasStickers = 0,
        $statTrak = 0,
        $souvenir = 0
    ) {
        $response = $this->client->post(
            $this->uri . 'get_inventory_on_sale/',
            [
                'query' => [
                    'api_key' => $this->api,
                    'code' => $this->code,
                    'page' => $pageIndex,
                    'per_page' => $this->per_page,
                    'min_price' => $minPrice,
                    'max_price' => $maxPrice,
                    'has_stickers' => $hasStickers,
                    'is_stattrak' => $statTrak,
                    'is_souvenir' => $souvenir,
                    'item_type' => $skinsCategory
                ]
            ]
        );

        $data = json_decode($response->getBody()->getContents(), true);
        $data['data']['length'] = count($data['data']['items']);

        return $data['data'];
    }

}
