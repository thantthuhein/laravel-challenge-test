<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\InternetServiceProvider\Mpt;
use App\Services\InternetServiceProvider\Ooredoo;
use App\Http\Requests\InternetServiceProviderRequest;

class InternetServiceProviderController extends Controller
{
    public function getMptInvoiceAmount(InternetServiceProviderRequest $request, Mpt $mpt)
    {
        $amount = $this->calculateProviderInvoiceAmount($mpt);

        return response()->json([
            'data' => $amount
        ]);
    }

    public function getOoredooInvoiceAmount(InternetServiceProviderRequest $request, Ooredoo $ooredoo)
    {
        $amount = $this->calculateProviderInvoiceAmount($ooredoo);

        return response()->json([
            'data' => $amount
        ]);
    }

    private function calculateProviderInvoiceAmount($provider)
    {
        $provider->setMonth(request()->get('month') ?: 1);

        return $provider->calculateTotalAmount();
    }
}
