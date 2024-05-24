<?php
session_start();
require("../connect.php");
?>

<!DOCTYPE html>
<html lang="lv">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mācies ar mums | Apmācības</title>
    <link rel="shortcut icon" href="../images/icon.png" type="image/x-icon">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" defer></script>
    <script src="../adminScript.js" defer></script>
</head>
<body>
    <?php
    if(isset($_SESSION['Lietotajvards'])){
        $lietotajvards = $_SESSION["Lietotajvards"];
        $loma_atrasana_SQL = "SELECT loma FROM users WHERE lietotajvards = '$lietotajvards'";
        $atrasanas_rezultats = mysqli_query($savienojums, $loma_atrasana_SQL);
        $ieraksts = mysqli_fetch_assoc($atrasanas_rezultats);

        if($ieraksts["loma"] == "Administrators"){

        include("adminNav.php");
    ?>

<div class="content">
        <h1>Apmācības</h1>
        <div class="container">
            <table>
                <tr>
                    <th>ID</th>
                    <th>Nosaukums</th>
                    <th>Apraksts</th>
                    <th>Attēls</th>
                    <th>Statuss</th>
                    <th>Veidotājs</th>
                    <th>Cena</th>
                    <th></th>
                </tr>
                <tbody id="apmacibas"></tbody>
            </table>
        </div>
    </div>
    <?php
        }else{
            header("location:../index.php");
        }
    }else{
        header("location:../loginReg/login.php");
    }
    ?>
</body>
</html>