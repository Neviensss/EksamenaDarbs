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
    $category = $_GET['category'] ?? 'all';
        if(htmlspecialchars($category) == 'all'){
            $kurss_sql = "SELECT * FROM apmacibas WHERE Statuss = 'Apstiprinats' ORDER BY ID DESC";
        }else{
            $kurss_sql = "SELECT * FROM apmacibas WHERE Statuss = 'Apstiprinats' AND kategorija = '$category' ORDER BY ID DESC";
        }
        ?>
    </section>
    <section id="new-kursi">
    <h2>Pieejamie kursi:</h2>
    <div class="box-container">
        <?php
        $kurss_res = mysqli_query($savienojums, $kurss_sql);

        while ($row = mysqli_fetch_assoc($kurss_res)) {
            ?>
            <div class="box">
                <img src="<?php echo $row['Attels']; ?>" alt="<?php echo $row['Nosaukums']; ?>">
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
                        data-kurss-attels="<?php echo $row['Attels']; ?>"
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