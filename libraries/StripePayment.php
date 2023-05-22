<?php

use Stripe\Checkout\Session;
use Stripe\Stripe;
use Stripe\Webhook;

require 'vendor/autoload.php';

class StripePayment
{
    private $clientSecret;
    private $webhookSecret;
    public function __construct(string $clientSecret,  string $webhookSecret = '')
    {
        $this->clientSecret = $clientSecret;
        $this->webhookSecret = $webhookSecret;
        Stripe::setApiKey($this->clientSecret);
    }

    public function startPayment()
    {
        isset($_SESSION['cart']) ? $cart = $_SESSION['cart'] : $cart = NULL;

        $result = array();

        foreach ($cart as $item) {
            $result[] = array(
                'quantity' => $item['articles_number'],
                'price_data' => array(
                    'currency' => 'EUR',
                    'product_data' => array(
                        'name' => $item['box_title']
                    ),
                    'unit_amount' => intval(floatval($item['box_price'] * 100))
                )
            );
        }
        $session = Session::create([
            'line_items' => $result,
            'mode' => 'payment',
            'success_url' => 'http://localhost/projet-web-dynamique-3g/index.php?controller=index&task=success',
            'cancel_url' => 'http://localhost/projet-web-dynamique-3g/index.php?controller=index&task=cancel',
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
