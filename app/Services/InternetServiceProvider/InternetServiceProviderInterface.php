<?php

namespace App\Services\InternetServiceProvider;

interface InternetServiceProviderInterface {
     public function setMonth(int $month): void;

     public function calculateTotalAmount(): int;
}