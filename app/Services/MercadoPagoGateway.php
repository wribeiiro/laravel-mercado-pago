<?php

namespace App\Services;

use \MercadoPago;

class MercadoPagoGateway
{

    private string $clientId;
    private string $clientSecret;
    private $mp;

    public function __construct(string $clientId, string $clientSecret)
    {
        $this->clientId = $clientId;
        $this->clientSecret = $clientSecret;

        MercadoPago\SDK::setAccessToken($this->getClientSecret());
    }

    public function getClientId()
    {
        return $this->clientId;
    }

    public function getClientSecret()
    {
        return $this->clientSecret;
    }

    public function create(object $order, object $product) 
    {

        $preference = new MercadoPago\Preference();

        $item = new MercadoPago\Item();
        $item->id = $product->id;
        $item->title = $product->name;
        $item->currency_id = "BRL";
        $item->picture_url = $product->cover_image;
        $item->description = $product->name;
        $item->quantity = 1;
        $item->unit_price = (double) number_format($order->price, 2);

        $preference->items = [$item];
        $preference->external_reference = $order->reference;
        $preference->back_urls = [
            "success" => route('callback'),
            "failure" => route('callback'),
            "pending" => route('callback')
        ];

        $preference->notification_url = route('notification');
        $preference->save();

        $link = $preference->sandbox_init_point ?? null;

        if ($link !== null) {
            return $link;
        }

        return false;
    }
}
