<?php

declare(strict_types=1);

require_once 'vendor/autoload.php';
use Icecave\Chrono\Clock\SystemClock;
use App\CoinApi;

$api = 'https://api.coindesk.com/v1/bpi/currentprice.json';
$apiData = new CoinApi($api);
$collection = $apiData->search();

$clock = new SystemClock;
$now = $clock->localDateTime();
$string = $now->format('Y-m-d H:i:s');

if (empty($collection->getCurrencies())) {
    exit("No records found. \n");
}

foreach ($collection->getCurrencies() as $currency) {
    echo 'Bitcoin to ' . $currency->getCode() . PHP_EOL;
    echo 'Time of data collection: ' .  $string . PHP_EOL;
    echo 'Rate: ' . $currency->getRate() . PHP_EOL;
    echo '------------------------------------------------------------------------' . PHP_EOL;
}

