<!DOCTYPE html>
<html lang="lv">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mācies ar mums | Administrēšana</title>
    <link rel="stylesheet" href="../style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" defer></script>
    <script src="../adminScript.js" defer></script>
</head>
<body>
<header>
    <a href="#" class="logo">LOGO</a>
    <nav id="admin" class="navbar">
        <ul>
            <li><a href=".././index.php">Sākums</a></li>
            <li><a href="#">Lietotāju pieteikumi</a></li>
            <li><a href="apmacibas.php">Apmācības</a></li>
            <li><a href="#">Apmācību pieteikumi</a></li>
            <li><a><button id="new" class="btn">Pievienot</button></a></li>
        </ul>
    </nav>
</header>
<?php 
    require("../connect.php");

    $liet_SQL = "SELECT COUNT(*) as liet_sk FROM testuser";
    $liet_rez = mysqli_query($savienojums, $liet_SQL);
    $liet_skaits = mysqli_fetch_assoc($liet_rez);

    $akt_apm_SQL = "SELECT COUNT(*) as akt_apm_sk FROM apmacibas WHERE Statuss = 'Apstiprināts'";
    $akt_apm_rez = mysqli_query($savienojums, $akt_apm_SQL);
    $akt_apm_skaits = mysqli_fetch_assoc($akt_apm_rez);

    $neapst_apm_SQL = "SELECT COUNT(*) as neapst_apm_sk FROM apmacibas WHERE Statuss = 'Iesniegts' or Statuss = 'Atvērts'";
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
<div class="modal">
    <div class="apply">
        <div class="close_modal"><i class="fas fa-times"></i></div>
        <h2>Apmācība</h2>
        <form id="apmacForma">
            <div class="formElements">
                <label>Nosaukums <span>*</span>:</label>
                <input type="text" id="nosaukums" required>
                <label>Apraksts <span>*</span>:</label>
                <input type="text" id="apraksts" required>
                <label>Attēls <span>*</span>:</label>
                <input type="text" id="attels" name="attels" required>
                <label>Statuss:</label>
                <select id="statuss">
                    <option value="Iesniegts">Iesniegts</option>
                    <option value="Atverts">Atvērts</option>
                    <option value="Apstiprinats">Apstiprināts</option>
                    <option value="Noraidits">Noraidīts</option>
                    <option value="Slepts">Slēpts</option>
                </select>

                <input type="hidden" id="apmID">
            </div>
            <input type="submit" name="pievienotKursu" value="Saglabāt" class="btn">
        </form>
    </div>
</div>
</body>