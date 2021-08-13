<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\User;
use Illuminate\Http\Request;
use App\Services\MercadoPagoGateway;
use MercadoPago;

class PaymentController extends Controller
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

    public function createPayment(Request $request)
    {
        $mp = new MercadoPagoGateway(env('MP_CLIENT_ID'), env('MP_CLIENT_SECRET'));
        $paymentLink = $mp->create(Order::find($request->input('product_id')), User::find(1));

        redirect()->to($paymentLink)->send();
    }
}
