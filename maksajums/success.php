<!DOCTYPE html>
<html lang="lv">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Stripe apmaksa</title>
    <link rel="stylesheet" href="../style.css">
    <link rel="shortcut icon" href="https://cdn.icon-icons.com/icons2/2699/PNG/512/stripe_logo_icon_167962.png" type="image/x-icon">
</head>
<body>

    <?php
        if(!empty($_GET['session_id'])){
            $session_id = $_GET['session_id'];
            require_once '../stripe-php/init.php';
            require_once 'config.php';
            require_once '../connect.php';

            try{
                $checkout_session = \Stripe\Checkout\Session::retrieve($session_id);
            }catch(Exception $e){
                $api_error = $e->getMessage();
            }

            if(empty($api_error) && $checkout_session){
                $customer_email = $checkout_session->customer_details->email;

                try{
                    $paymentIntent = \Stripe\PaymentIntent::retrieve($checkout_session->payment_intent);
                }catch(\Stripe\Exception\ApiErrorException $e){
                    $api_error = $e->getMessage();
                }

                if(empty($api_error) && $paymentIntent){
                    if(!empty($paymentIntent) && $paymentIntent->status == "succeeded"){
                        $transactionID = $paymentIntent->id;
                        $pirk_SQL = "SELECT * FROM pirkumi WHERE PirkumsID = '$transactionID'";
                        $atrasanas_rezultats = mysqli_query($savienojums, $pirk_SQL);
                            if(mysqli_num_rows($atrasanas_rezultats) > 0){
                                $statusMsg = "Maksājums veiksmīgi apstrādāts!";
                                $dataMsg = "
                                    <p>Veiksmīgi veikts maksājums, lai dotos uz kursu, spied zemāk esošo pogu!</p>
                                    <a class='btn' href='../index.php'>Doties uz kursu</a>
                                ";
                            }else{
                                $statusMsg = "Maksājums veiksmīgi apstrādāts!";
                                $dataMsg = "
                                    <p>Veiksmīgi veikts maksājums, lai dotos uz kursu, spied zemāk esošo pogu!</p>
                                    <a class='btn' href='../index.php'>Doties uz kursu</a>
                                ";        
                                }
                            }
                }else{
                    $statusMsg = "Nav iespējams iegūt maksājuma informāciju!";
                }
            }else{
                $statusMsg = "Neeksistējošs maksājums!";
            }
        }else{
            $statusMsg = "";
        }
    ?>
    <div class="container">
        <div class="panel">
            <h1><?php echo $statusMsg; ?></h1>
                <?php echo $dataMsg; ?>
        </div>
    </div>
</body>
</html>