<?php

declare(strict_types=1);

namespace App;

class CurrencyCollection
{

    private array $currencies = [];

    public function __construct(array $currencies = [])
    {
        foreach ($currencies as $currency)
        $this->add($currency);
    }

    public function add(Currency $currency)
    {
        $this->currencies[] = $currency;
    }

    public function getCurrencies(): array
    {
        return $this->currencies;
    }
}