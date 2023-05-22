<?php

use Stripe\Checkout\Session;
use Stripe\Stripe;
use Stripe\Webhook;

require 'vendor/autoload.php';

class StripePayment
{
    private $clientSecret;
    private $webhookSecret;
    public function __construct( string $clientSecret,  string $webhookSecret = '')
    {
            $this->clientSecret = $clientSecret;
            $this->webhookSecret = $webhookSecret;
        Stripe::setApiKey($this->clientSecret);
    }

    public function startPayment()
    {
        $cart = new Cart;
        $session = Session::create([
            'line_items' => [
                array_map(fn (array $product) => [
                    'quantity' => 1,
                    'price_data' => [
                        'currency' => 'EUR',
                        'product_data' => [
                            'name' => $product['name']
                        ],
                        'unit_amount' => $product['price']
                    ]
                ],$cart->getProducts())
            ],
            'mode' => 'payment',
            'success_url' => 'http://localhost:8000/index.php?controller=index&task=success',
            'cancel_url' => 'http://localhost:8000/index.php?controller=index&task=cancel',
            'billing_address_collection' => 'required',
            'metadata' => [
                'box_id' => 1
            ]
        ]);
        header("HTTP/1.1 303 See Other");
        header("Location: " . $session->url);
    }

    public function handle(\Psr\Http\Message\ServerRequestInterface $request)
    {
        $signature = $request->getHeaderLine('stripe-signature');
        $body = (string) $request->getBody();
        $event = Webhook::constructEvent(
            $body,
            $signature,
            $this->webhookSecret
        );
         
    }
}
