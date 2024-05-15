<?php
    require_once '../stripe-php/init.php';
    require_once 'config.php';

    $checkout_session = \Stripe\Checkout\Session::create([
        "mode" => "payment", 
        "success_url" => "http://localhost/EksamenaDarbs/maksajums/success.php?session_id={CHECKOUT_SESSION_ID}",
        "cancel_url" => "http://localhost/EksamenaDarbs",
        "locale" => "auto",
        "line_items" => [
            [
                "quantity" => 1,
                "price_data" => [
                    "currency" => "eur",
                    "unit_amount" => 12000,
                    "product_data" => [
                        "name" => "Pieeja kursam"
                    ]
                    ]
            ]
        ]
    ]);

    header("Location: ".$checkout_session->url);
?>