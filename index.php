<?php

declare(strict_types=1);

require_once 'vendor/autoload.php';

use App\CoinApi;

$api = 'https://api.coindesk.com/v1/bpi/currentprice.json';
$apiData = new CoinApi($api);
$collection = $apiData->search();

if (empty($collection->getCurrencies())) {
    exit("No records found. \n");
}

foreach ($collection->getCurrencies() as $currency) {
    echo 'Bitcoin to ' . $currency->getCode() . PHP_EOL;
    echo 'Time: ' . $currency->getTime() . PHP_EOL;
    echo 'Rate: ' . $currency->getRate() . PHP_EOL;
    echo '------------------------------------------------------------------------' . PHP_EOL;
}

