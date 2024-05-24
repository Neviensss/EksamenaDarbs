<!DOCTYPE html>
<html lang="lv">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mācies ar mums | Apmaksa</title>
    <link rel="stylesheet" href="../style.css">
    <link rel="shortcut icon" href="https://cdn.icon-icons.com/icons2/2699/PNG/512/stripe_logo_icon_167962.png" type="image/x-icon">
</head>
    <?php
    session_start();
        require_once '../stripe-php/init.php';
        require_once 'config.php';
        require_once '../connect.php';

        if(isset($_SESSION['Lietotajvards'])){

        if (!empty($_GET['session_id']) && !empty($_GET['kurss_id']) && !empty($_GET['user_id'])) {
            $session_id = $_GET['session_id'];
            $kurss_id = $_GET['kurss_id'];
            $user_id = $_GET['user_id'];

            try {
                $checkout_session = \Stripe\Checkout\Session::retrieve($session_id);
            } catch (Exception $e) {
                $api_error = $e->getMessage();
            }

            if (empty($api_error) && $checkout_session) {
                if (isset($checkout_session->payment_intent)) {
                    try {
                        $paymentIntent = \Stripe\PaymentIntent::retrieve($checkout_session->payment_intent);
                    } catch (\Stripe\Exception\ApiErrorException $e) {
                        $api_error = $e->getMessage();
                    }

                    if (empty($api_error) && $paymentIntent && $paymentIntent->status == "succeeded") {
                        $transactionID = $paymentIntent->id;

                        $select_kurss = "SELECT Nosaukums, Cena FROM apmacibas WHERE ID = $kurss_id";
                        $result = mysqli_query($savienojums, $select_kurss);

                        if ($result && mysqli_num_rows($result) > 0) {
                            $kurss = mysqli_fetch_assoc($result);

                            $insert_purchase = "INSERT INTO pirkumi (PirkumsID, kurss_id, cena, pirceja_id, pirkuma_datums)
                                                VALUES ('$transactionID', $kurss_id, {$kurss['Cena']}, $user_id, NOW())";

                            if (mysqli_query($savienojums, $insert_purchase)) {
                                $statusMsg = "Maksājums veiksmīgi apstrādāts!";
                                $dataMsg = "
                                    <p>Veiksmīgi veikts maksājums par kursu:</p>
                                    <h2>{$kurss['Nosaukums']}</h2>
                                    <p>Cena: " . number_format($kurss['Cena'], 2) . " EUR</p>
                                    <p>Lai dotos uz kursu, spiediet zemāk esošo pogu:</p>
                                    <a class='btn' href='../index.php'>Doties uz kursu</a>
                                ";
                            } else {
                                $statusMsg = "Kļūda!";
                                $dataMsg = "";
                            }
                        } else {
                            $statusMsg = "Kursa informācija nav pieejama.";
                            $dataMsg = "";
                        }
                    } else {
                        $statusMsg = "Maksājuma informāciju nevar atrast vai maksājums nav veikts!";
                        $dataMsg = "";
                    }
                } else {
                    $statusMsg = "Maksājuma informāciju nevar atrast vai maksājums nav veikts!";
                    $dataMsg = "";
                }
            } else {
                $statusMsg = "Neeksistējošs maksājums vai kļūda sazinoties ar Stripe.";
                $dataMsg = "";
            }
        } else {
            $statusMsg = "Kļūda!";
            $dataMsg = "";
        }
        }
    ?>
<body>
    <div class="container">
        <div class="panel">
            <h1><?php echo $statusMsg; ?></h1>
            <?php echo $dataMsg; ?>
        </div>
    </div>
</body>
</html>
