<?php

declare(strict_types=1);

namespace App;

class Currency
{

    private string $time;
    private string $code;
    private string $rate;

    public function __construct(string $time, string $code, string $rate)
    {
        $this->time = $time;
        $this->code = $code;
        $this->rate = $rate;
    }

    public function getTime(): string
    {
        return $this->time;
    }

    public function getCode(): string
    {
        return $this->code;
    }

    public function getRate(): string
    {
        return $this->rate;
    }
}