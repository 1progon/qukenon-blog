<?php

namespace App\Classes;

defined('ABS_PATH') or die('У Вас нет доступа');

use GuzzleHttp\Client;


class Currency
{

    private string $api = 'https://www.cbr-xml-daily.ru/daily_json.js';
    private Client $client;
    private ?array $currencies;
    private ?array $currencyBlock;


    public function __construct(Client $client)
    {
        $this->client = $client;
        $this->getJsonData();
    }

    public function getJsonData()
    {
        $jsonCurrencies = $this->client->get($this->api);

        return $this->currencies = json_decode($jsonCurrencies->getBody()->getContents(), true)['Valute'];
    }


    public function getCurrencies(array $currencies = ['USD']): ?array
    {
        foreach ($currencies as $currency) {
            $this->currencyBlock[$currency] = $this->currencies[$currency];
        }

        return $this->currencyBlock;
    }

}