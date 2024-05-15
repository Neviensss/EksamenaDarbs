<?php 
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
</head>
<body>
<?php
    include("navigation.php");
?>
    
    <section id="popular">
        <h2>Populārākās tēmas:</h2>
        <div class="box-container">
        <div class="box">
        </div>
        <div class="box">
        </div>
        <div class="box">
        </div>
        <div class="box">
        </div>
        
        </div>
    </section>
    <section id="new-kursi">
        <h2>Jaunākie kursi:</h2>
        <div class="box-container">
            <?php
            $kurss_sql = "SELECT * FROM apmacibas WHERE Statuss = 'Apstiprinats' ORDER BY ID desc LIMIT 5";
            $kurss_res = mysqli_query($savienojums, $kurss_sql);
            while ($row = mysqli_fetch_assoc($kurss_res)) {
                ?>
                <div class="box">
                    <img src="<?php echo $row['Attels']; ?>">
                    <h2><?php echo $row['Nosaukums']; ?></h2>
                    <form action="maksajums/checkout.php" method="post">
                        <button class="buyButton">Iegādāties</button>
                    </form>
                    <button class="checkButton">Apskatīt</button>
                </div>
                <?php
            }
            ?>
        </div>
    </section>
    <?php
    include("footer.php");
    ?>
</body>
</html>