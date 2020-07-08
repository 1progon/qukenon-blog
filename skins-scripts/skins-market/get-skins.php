<?php

session_start();

require_once __DIR__ . '/vendor/autoload.php';
defined('ABS_PATH') or die('У Вас нет доступа');

use App\Classes\Cache;
use App\Classes\Currency;
use App\Classes\GetSkins;
use GuzzleHttp\Client;

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    exit('У Вас нет доступа к файлу');
};

if (!isset($_POST['category']) || empty($_POST['category'])) {
    exit('Не указана категория');
}

if (!isset($_POST['page'])) {
    exit('Неизвестный номер страницы');
}


$category = htmlspecialchars($_POST['category']);
$skinPageNum = htmlspecialchars($_POST['page']);

if ($skinPageNum < 1) {
    $skinPageNum = 1;
}


if ($category) {
    $category = strtolower($category);
    $skinsCacheFilename = preg_replace('/[- +]/i', '_', $category);;
    $category = preg_replace('/[-_]/i', ' ', $category);

    $hasStickers = $_POST['hasStickers'] ?? 0;
    $statTrak = $_POST['statTrak'] ?? 0;
    $souvenir = $_POST['souvenir'] ?? 0;

    $skinsCacheFilename .= '_page_' . $skinPageNum;
    $cache = new Cache();

    $data = $cache->getCache($skinsCacheFilename);

    if ($data) {
        $data['cacheInfo'][] = 'Skins Data from cache success';
    } else {
        $data['cacheInfo'][] = 'Loading new Json Skins Data from remote';
        $skins = new GetSkins(new Client());
        $minPrice = 0;
        $maxPrice = 2;
        if ($category === 'knife' || $category === 'gloves' || $category === 'music kit') {
            $maxPrice = 250;
        }
        $data = $skins->getSkins($category, $skinPageNum, $minPrice, $maxPrice, $hasStickers);

        if ($data['length'] === 0) {
            $data['cacheError'][] = 'Больше нет товаров в этой категории';
            $isCached = false;
        } else {
            $isCached = $cache->setCache($skinsCacheFilename, $data);
        }


        if (!$isCached) {
            $data['cacheError'][] = 'Skins Saving cache error';
        } else {
            $data['cacheInfo'][] = 'Skins Cache saved success';
        }
    }

    $currencyFilename = 'currencies';
    $data['currencies'] = $cache->getCache($currencyFilename);

    if ($data['currencies']) {
        $data['cacheInfo'][] = 'Currencies from Cache success';
    } else {
        $data['cacheInfo'][] = 'Loading new Json Currencies Data from remote';
        $currency = new Currency(new Client());

        $data['currencies'] = $currency->getCurrencies(['USD', 'EUR', 'AUD']);

        $isCached = $cache->setCache($currencyFilename, $data['currencies']);

        if (!$isCached) {
            $data['cacheError'][] = 'Currencies Cache saving error';
        } else {
            $data['cacheInfo'][] = 'Currencies Cache saving success';
        }
    }

    $data['pageNum'] = intval($skinPageNum);
    $data['formToken'] = bin2hex(random_bytes(16));
    $_SESSION['formToken'] = $data['formToken'];
    echo json_encode($data);
    exit();
}
exit;