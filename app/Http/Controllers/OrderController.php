<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\MercadoPagoGateway;

class OrderController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function callback(Request $request) 
    {
        if ($request->input('status') == "null") {
            redirect()->to('/')->send();
        }
    }
}
