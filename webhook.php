<?php 

require 'vendor/autoload.php';

$cart = new Cart;
$psr17Factory = new \Nyholm\Psr7\Factory\Psr17Factory();

$creator = new \Nyholm\Psr7Server\ServerRequestCreator(
    $psr17Factory,
    $psr17Factory,
    $psr17Factory,
    $psr17Factory
);

$request = $creator->fromGlobals();
$payment = new StripePayment(STRIPE_SECRET, STRIPE_WEBHOOK);
$payment->handle($request);