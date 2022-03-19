<?php

namespace App\Http\Controllers;

use App\Services\InternetServiceProvider\Mpt;
use App\Services\InternetServiceProvider\Ooredoo;
use Illuminate\Http\Request;

class InternetServiceProviderController extends Controller
{
    public function getMptInvoiceAmount(Request $request, Mpt $mpt)
    {
        $amount = $mpt->calculateTotalAmount($request->get('month') ?: 1);
    
        return response()->json([
            'data' => $amount
        ]);
    }
    
    public function getOoredooInvoiceAmount(Request $request)
    {
        $ooredoo = new Ooredoo();
        $ooredoo->setMonth($request->get('month') ?: 1);
        $amount = $ooredoo->calculateTotalAmount();
        
        return response()->json([
            'data' => $amount
        ]);
    }
}
