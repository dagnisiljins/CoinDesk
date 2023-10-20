<?php

declare(strict_types=1);

namespace App;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;

class CoinApi
{

    private string $api;

    public function __construct(string $api)
    {
        $this->api = $api;
        $cafile = 'C:/CA certificates/cacert.pem';
        $this->httpClient = new Client([
            'verify' => $cafile,
        ]);
    }

    public function search(): ?CurrencyCollection
    {
        $url = $this->api;

        try {
            $response = $this->httpClient->get($url);
        } catch (GuzzleException $e) {
            echo "Failed to fetch data from the API: " . $e->getMessage() . "\n";
            return null;
        }

        $body = $response->getBody()->__toString();
        $data = json_decode($body, true);

        //var_dump($data);die();

        if ($data === false || !isset($data['bpi'])) {
            echo "Failed to fetch data from the API or missing 'bpi' data.\n";
            return null;
        }

        $bpi = $data['bpi'];
        $collection = new CurrencyCollection();

        foreach ($bpi as $code => $currencyData) {
            $rate = $currencyData['rate'] ?? null;

            if ($rate !== null) {
                $collection->add(new Currency($data['time']['updated'], $code, $rate));
            }
        }

        return $collection;
    }
}