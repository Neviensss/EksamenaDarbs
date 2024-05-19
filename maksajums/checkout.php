<?php
    session_start();
    require_once '../stripe-php/init.php';
    require_once 'config.php';
    require_once '../connect.php';

    if(isset($_SESSION['Lietotajvards'])){

        $kurss_id = $_POST['kurss_id'];
        $lietotajvards = $_SESSION['Lietotajvards'];

        $select_kurss = "SELECT Nosaukums, Cena FROM apmacibas WHERE ID = $kurss_id";
        $result = mysqli_query($savienojums, $select_kurss);
        $kurss = mysqli_fetch_assoc($result);

        $select_user_id = "SELECT ID FROM users WHERE lietotajvards = '$lietotajvards'";
        $user_result = mysqli_query($savienojums, $select_user_id);
        $user = mysqli_fetch_assoc($user_result);

        $user_id = $user['ID'];

        $checkout_session = \Stripe\Checkout\Session::create([
            "mode" => "payment",
            "success_url" => "http://localhost/EksamenaDarbs/maksajums/success.php?session_id={CHECKOUT_SESSION_ID}&kurss_id=$kurss_id&user_id=$user_id",
            "cancel_url" => "http://localhost/EksamenaDarbs",
            "locale" => "auto",
            "line_items" => [
                [
                    "quantity" => 1,
                    "price_data" => [
                        "currency" => "eur",
                        "unit_amount" => $kurss['Cena'] * 100,
                        "product_data" => [
                            "name" => $kurss['Nosaukums'],
                        ],
                    ],
                ],
            ],
        ]);

        header("Location: ".$checkout_session->url);
    }
?>
