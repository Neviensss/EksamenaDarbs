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
    <script src="adminScript.js" defer></script>
</head>
<body>
<?php
    include("navigation.php");
        if(isset($_SESSION['Lietotajvards'])){
        ?>
        <section id="create">
        <h2>Izveido jaunu kursu jau tagat!</h2>
        <a><button type="submit" class="btn" name="">Izveidot kursu</button></a>
        </section>
        <?php
        }
        ?>
    <section id="popular">
        <h2>Populārākās tēmas:</h2>
        <div class="box-container">
        <div class="box">
            <h2>Tēma1</h2>
        </div>
        <div class="box">
            <h2>Tēma2</h2>
        </div>
        <div class="box">
            <h2>Tēma3</h2>
        </div>
        <div class="box">
            <h2>Tēma4</h2>
        </div>
        
        </div>
    </section>
    <section id="new-kursi">
    <h2>Jaunākie kursi:</h2>
    <div class="box-container">
        <?php
        $kurss_sql = "SELECT * FROM apmacibas WHERE Statuss = 'Apstiprinats' ORDER BY ID DESC LIMIT 5";
        $kurss_res = mysqli_query($savienojums, $kurss_sql);

        while ($row = mysqli_fetch_assoc($kurss_res)) {
            ?>
            <div class="box">
                <img src="<?php echo $row['Attels']; ?>"> 
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
                <button id="openCourse" class="checkButton">Apskatīt</button>
            </div>
            <?php
        }
        ?>
        </div>
    </section>
    <div class="modalCourse">
        <div class="apply">
            <div class="close_modalCourse"><i class="fas fa-times"></i></div>
            <h2>Nosaukums</h2>
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Commodi maiores ullam sequi eveniet quo similique quasi, ex itaque unde eos ea suscipit nihil nostrum repellendus natus delectus at maxime! Omnis labore illum animi quisquam ea maiores unde nostrum asperiores aliquam. </p>
                <img src="https://img.freepik.com/free-photo/abstract-autumn-beauty-multi-colored-leaf-vein-pattern-generated-by-ai_188544-9871.jpg?size=626&ext=jpg&ga=GA1.1.2082370165.1715904000&semt=ais_user">
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
            </div>
        </div>
    </div>
    <?php
    include("footer.php");
    ?>
</body>
</html>