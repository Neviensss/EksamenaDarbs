<?php
session_start();
require("../connect.php");
?>

<!DOCTYPE html>
<html lang="lv">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mācies ar mums | Administrēšana</title>
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
        require("../connect.php");

    $liet_SQL = "SELECT COUNT(*) as liet_sk FROM users";
    $liet_rez = mysqli_query($savienojums, $liet_SQL);
    $liet_skaits = mysqli_fetch_assoc($liet_rez);

    $akt_apm_SQL = "SELECT COUNT(*) as akt_apm_sk FROM apmacibas WHERE Statuss = 'Apstiprinats'";
    $akt_apm_rez = mysqli_query($savienojums, $akt_apm_SQL);
    $akt_apm_skaits = mysqli_fetch_assoc($akt_apm_rez);

    $neapst_apm_SQL = "SELECT COUNT(*) as neapst_apm_sk FROM apmacibas WHERE Statuss = 'Iesniegts' or Statuss = 'Atverts'";
    $neapst_apm_rez = mysqli_query($savienojums, $neapst_apm_SQL);
    $neapst_apm_skaits = mysqli_fetch_assoc($neapst_apm_rez);
?>
<section id="adminPanel">
    <div class="info-container-admin">
        <div class="box">
            <div class="info">
                <p>Reģistrēti lietotāji:</p>
                <h3><?php echo $liet_skaits['liet_sk']; ?></h3>
            </div>
        </div>
        <div class="box">
            <div class="info">
                <p>Neapstiprināti lietotāji:</p>
                <h3>3</h3>
            </div>
        </div>
        <div class="box">
            <div class="info">
                <p>Apstriprināti lietotāji:</p>
                <h3>3</h3>
            </div>
        </div>
        <div class="box">
            <div class="info">
                <p>Aktīvas apmācības:</p>
                <h3><?php echo $akt_apm_skaits['akt_apm_sk']; ?></h3>
            </div>
        </div>
        <div class="box">
            <div class="info">
                <p>Neapstiprinātas apmācības:</p>
                <h3><?php echo $neapst_apm_skaits['neapst_apm_sk']; ?></h3>
            </div>
        </div>
    </div>
</section>
    <?php
        }else{
            header("location:../index.php");
        }
    }else{
        header("location:../loginReg/login.php");
    }
    ?>
</body>