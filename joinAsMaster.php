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
    <script src="script.js" defer></script>
</head>
<body>
<?php include("navigation.php") ?>
    <section id="reasons">
        <div class="container">
            <div class="box">
                <img src="https://s.udemycdn.com/teaching/value-prop-teach-v3.jpg">
                <h3>Dalies ar zināšanām</h3>
                <p>Publicējiet izveidoto kursu vēlamajā veidā un vienmēr kontrolējiet savu saturu.</p>
            </div>
            <div class="box">
                <img src="https://s.udemycdn.com/teaching/value-prop-inspire-v3.jpg">
                <h3>Iedvesmo mācīties</h3>
                <p>Māciet to, ko zināt, un palīdziet lietotājiem izpētīt viņu intereses, iegūt jaunas prasmes un attīstīs karjeru.</p>
            </div>
            <div class="box">
                <img src="https://s.udemycdn.com/teaching/value-prop-get-rewarded-v3.jpg">
                <h3>Tiec atalgots</h3>
                <p>Paplašiniet savu profesionālo loku, pilnveidojiet savas zināšanas un nopelniet naudu par katru apmaksātu pieteikumu.</p>
            </div>
        </div>
    </section>
    <section id="begin">

    </section>

    <section id="apply">
        <form method="post">
            <h1>Pievienojies kā pasniedzējs jau šodien</h1>
            <p></p>
            <a><button type="submit" class="btn" name="atvertPiet" onclick="pieteikties()">Pievienoties</button></a>
         </form>
    </section>
    <?php
    if (isset($_POST['atvertPiet'])){
        if($_SESSION["Lietotajvards"]){
            $lietotajvards = $_SESSION["Lietotajvards"];
            $select_SQL = "SELECT vards, uzvards, loma FROM users WHERE lietotajvards = '$lietotajvards'";
            $select_result = mysqli_query($savienojums, $select_SQL);
            if(mysqli_num_rows($select_result) > 0){
                while($ieraksts = mysqli_fetch_assoc($select_result)){
                    $p_vards = $ieraksts['vards'];
                    $p_uzvards = $ieraksts['uzvards'];
                    $p_loma = $ieraksts['loma'];
                }
            }
        $pieteikt_SQL = "INSERT INTO lietot_piet(lietotajvards, vards, uzvards, loma) VALUES('$lietotajvards', '$p_vards', '$p_uzvards', '$p_loma')";
        $pieteikt_result = mysqli_query($savienojums, $pieteikt_SQL);
        }else
        header("location:loginReg/login.php");
    }

    include("footer.php");
    ?>
</div>
</body>
</html>