<?php

require_once dirname(__DIR__) . '/vendor/autoload.php';

use GuzzleHttp\Client;

$host = 'https://money.yandex.ru';

$clientId = 'E0D5EAB6A4C31344C0CDDDF385AA18AA2BD4C364336EBF51FF58BDE4CB14E298';
$clientSecret = '3D1273E566606D83A1FF83F782090B4414B7804D04F196112723CAAF267D9C128D98B589CE0101B6FE8956A0AAEE2ED9AC790D3685E8713A684E4905B968A3E8';

$redirectUti = 'https://qukenon.ru/old-blog/skins-market/yandex-pay/oauth.php';

$client = new Client(['base_uri' => $host]);