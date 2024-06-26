<?php
    session_start();
    require("connect.php");
?>

<!DOCTYPE html>
<html lang="lv">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mācies ar mums | Sākums</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" defer></script>
    <script src="script.js" defer></script>
    <script src="adminScript.js" defer></script>
</head>
<body>
<?php
    include("navigation.php");

    if(isset($_SESSION['Lietotajvards'])){
        $lietotajvards = $_SESSION["Lietotajvards"];
        $loma_atrasana_SQL = "SELECT loma FROM users WHERE lietotajvards = '$lietotajvards'";
        $atrasanas_rezultats = mysqli_query($savienojums, $loma_atrasana_SQL);
        $ieraksts = mysqli_fetch_assoc($atrasanas_rezultats);

        if($ieraksts["loma"] == "Veidotajs" || $ieraksts["loma"] == "Administrators"){
        ?>
        <section id="create">
        <h2>Izveido jaunu kursu jau tagat!</h2>
        <a href="profils/create.php"><button type="submit" class="btn">Izveidot kursu</button></a>
        </section>
        <?php
        }
    }
        ?>
    <section id="popular">
        <h2>Kategorijas:</h2>
        <div class="box-container">
        <?php
        $kat_sql = "SELECT kategorija FROM apmacibas LIMIT 3";
        $kat_res = mysqli_query($savienojums, $kat_sql);

        while ($row = mysqli_fetch_assoc($kat_res)) {
            ?>
            <div class="boxcat">
                <?php
                    echo "<a href='kursi.php?category=".$row['kategorija']."'>". "<h2>". $row['kategorija'] ."</h2>" ."</a>";
                ?>
            </div>
            <?php
            }
            ?>
        
        </div>
    </section>
    <section id="new-kursi">
    <h2>Jaunākie kursi:</h2>
    <div class="box-container">
        <?php
        $kurss_sql = "SELECT * FROM apmacibas WHERE Statuss = 'Apstiprinats' ORDER BY ID DESC LIMIT 4";
        $kurss_res = mysqli_query($savienojums, $kurss_sql);

        while ($row = mysqli_fetch_assoc($kurss_res)) {
            ?>
            <div class="box">
                <img src="<?php echo 'profils/' . $row['Attels']; ?>" alt="<?php echo $row['Nosaukums']; ?>">
                <h2><?php echo $row['Nosaukums']; ?></h2>
                <?php
                if (isset($_SESSION['Lietotajvards'])) {
                    ?>
                    <form action="maksajums/checkout.php" method="post">
                        <input type="hidden" name="kurss_id" value="<?php echo $row['ID']; ?>">
                        <button type="submit" class="buyButton">Iegādāties</button>
                    </form>
                    <?php
                } else {
                    ?>
                    <form action="loginReg/login.php" method="post">
                        <button type="submit" class="buyButton">Iegādāties</button>
                    </form>
                    <?php
                }
                ?>
                <button class="checkButton"
                        data-kurss-id="<?php echo $row['ID']; ?>"
                        data-kurss-nosaukums="<?php echo $row['Nosaukums']; ?>"
                        data-kurss-attels="<?php echo 'profils/' . $row['Attels']; ?>"
                        data-kurss-apraksts="<?php echo $row['Apraksts']; ?>">Apskatīt</button>
            </div>
            <?php
            }
            ?>
        </div>
    </section>

    <div class="modalCourse">
        <div class="apply">
            <div class="close_modalCourse"><i class="fas fa-times"></i></div>
            <h2 id="modalNosaukums">Nosaukums</h2>
            <p id="modalApraksts">Apraksts</p>
            <img id="modalAttels" src="" alt="Course Image">
            <?php
                if (isset($_SESSION['Lietotajvards'])) {
                    ?>
                <form id="modalForm" action="maksajums/checkout.php" method="post">
                    <input type="hidden" name="kurss_id" id="modalKurssID">
                    <button type="submit" class="buyButton">Iegādāties</button>
                </form>
                <?php
                } else {
                    ?>
                    <form id="modalForm" action="loginReg/login.php" method="post">
                        <input type="hidden" name="kurss_id" id="modalKurssID">
                        <button type="submit" class="buyButton">Iegādāties</button>
                    </form>
                    <?php
                }
                ?>
        </div>
    </div>
    <?php
    include("footer.php");
    ?>
</body>
</html>