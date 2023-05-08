<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;

class SubscriptionsController extends Controller
{
    //
    public function getSessionMensual()
    {
        $stripe = new \Stripe\StripeClient(env('STRIPE_API_KEY'));

        $checkout = $stripe->checkout->sessions->create([
            'success_url' => 'http://localhost/succes/mensual',
            'cancel_url' => 'http://localhost/cancel/mensual',
            'line_items' => [
                [
                    'price' => 'price_1N3Fb1K1P0dJ1e9ffHLfs6bl',
                    'quantity' => 1,
                ],
            ],
            'mode' => 'subscription',
        ]);

        return $checkout;
    }

    public function getSessionAnual()
    {
        $stripe = new \Stripe\StripeClient(env('STRIPE_API_KEY'));

        $checkout = $stripe->checkout->sessions->create([
            'success_url' => 'http://localhost/succes/anual',
            'cancel_url' => 'http://localhost/cancel/anual',
            'line_items' => [
                [
                    'price' => 'price_1N3Fb1K1P0dJ1e9fPxcZs3Hl',
                    'quantity' => 1,
                ],
            ],
            'mode' => 'subscription',
        ]);

        return $checkout;
    }

    public function getSessionSemestral()
    {
        $stripe = new \Stripe\StripeClient(env('STRIPE_API_KEY'));

        $checkout = $stripe->checkout->sessions->create([
            'success_url' => 'http://localhost/succes/semestral',
            'cancel_url' => 'http://localhost/cancel/semestral',
            'line_items' => [
                [
                    'price' => 'price_1N3Fb1K1P0dJ1e9fMTtjhQnI',
                    'quantity' => 1,
                ],
            ],
            'mode' => 'subscription',
        ]);

        return $checkout;
    }

    public function webhook(Request $request)
    {
        \Log::info("webhook");

        $endpoint_secret = env('STRIPE_API_KEY');

        $sig_header = $_SERVER['HTTP_STRIPE_SIGNATURE'];
        $payload = @file_get_contents('php://input');


        try {
            $event = \Stripe\Webhook::constructEvent(
                $payload,
                $sig_header,
                $endpoint_secret
            );
        } catch (\Stripe\Exception\SignatureVerificationException $e) {
            // Invalid signature
            echo '⚠️  Webhook error while validating signature.';
            http_response_code(400);
            exit();
        }

        if ($request->type == 'checkout.session.completed') {
            //validar la compra
            \Log::info("its all done!");
        }

        return response()->json(["status" => 'success']);
    }
}
