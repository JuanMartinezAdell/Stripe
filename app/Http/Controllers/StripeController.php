<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class StripeController extends Controller
{
    //Necesitamos crear una sesion en el dado de laravel y luego publicar el pase en unaidentificacion de sesion


    public function getSession()
    {

        $stripe = new \Stripe\StripeClient(env('STRIPE_API_KEY'));

        $checkout = $stripe->checkout->sessions->create([
            'success_url' => 'http://localhost/success',
            'cancel_url' => 'http://localhost/cancel',
            'line_items' => [
                [
                    'price_data' => [
                        'currency' => 'eur',
                        'unit_amount' => 2000,
                        'product_data' => [
                            'name' => "Medalla Hermandad"
                        ],
                    ],
                    'quantity' => 1,
                ],
            ],
            'mode' => 'payment',
        ]);

        return $checkout;

        /*$stripe = new \Stripe\StripeClient(env('STRIPE_API_KEY'));

        $checkout = $stripe->checkout->sessions->create([
            'success_url' => 'http://localhost/success',
            'cancel_url' => 'http://localhost/cancel',
            'line_items' => [
                [
                    'price_data' => [
                        'currency' => 'eur',
                        'unit_amount' => 2000,
                    ],
                    'product_data' => [
                        'name' => "Medalla Hermandad"
                    ],
                    'quantity' => 1,
                ],
            ],
            'mode' => 'payment',
        ]);

        return $checkout;*/
    }
}
