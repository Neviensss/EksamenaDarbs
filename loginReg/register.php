<!DOCTYPE html>
<html lang="lv">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mācies ar mums | Reģistrācija</title>
    <link rel="shortcut icon" href="../images/icon.png" type="image/x-icon">
    <link rel="stylesheet" href="logStyle.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" defer></script>
</head>
<body>
<?php
    require("../connect.php");
?>

<div class="container">
    <div class="panel">
        <h1>Reģistrēties sistēmā:</h1>
            <form method="POST">
                <label>Lietotājvārds:</label>
                <input type="text" placeholder="Ievadi savu lietotājvārdu" name="lietotajvards" required>
                <label>E-pasts:</label>
                <input type="text" placeholder="Ievadi savu E-pasta adresi" name="epasts" required>
                <label>Vārds:</label>
                <input type="text" placeholder="Ievadi savu vārdu" name="vards" required>
                <label>Uzvārds:</label>
                <input type="text" placeholder="Ievadi savu uzvārdu" name="uzvards" required>
                <label>Parole:</label>
                <input type="password" placeholder="Ievadi savu paroli" name="parole" minlength="8" required>
                <label>Parole:</label>
                <input type="password" placeholder="Ievadi savu paroli atkārtoti" name="parole2" minlength="8" required>
                <button type="submit" name="register">Reģistrēties</button>
                <p>Vai tev jau pastāv konts? <a href="login.php"><b>Ielogoties!</b></a></p>
                <p><a href="../index.php"><b>Sākums!</b></a></p>
                <?php
                    if(isset($_POST["register"])){
                        $l_lietotajvards = $_POST['lietotajvards'];
                        $l_epasts = $_POST['epasts'];
                        $l_vards = $_POST['vards'];
                        $l_uzvards = $_POST['uzvards'];
                        $l_parole = $_POST['parole'];
                        $l_parole2 = $_POST['parole2'];
                        $l_realPass = password_hash($l_parole, PASSWORD_DEFAULT);
                        //Daudz pārbaudes ar ievades datiem
                        //Ievadītās paroles garums, izmantotie simboli etc. 
                        if($l_parole == $l_parole2){
                        $lietotaja_atrasana_SQL = "SELECT * FROM users WHERE lietotajvards = '$l_lietotajvards'";
                        $atrasanas_rezultats = mysqli_query($savienojums, $lietotaja_atrasana_SQL);
                            if(mysqli_num_rows($atrasanas_rezultats) > 0){
                                echo "<p class='error'><b>Izvēlētais lietotājvārds nav pieejams!</b></p>";
                            }else{
                                $register_SQL = "INSERT INTO users(lietotajvards, epasts, vards, uzvards, parole, loma) VALUES('$l_lietotajvards', '$l_epasts', '$l_vards', '$l_uzvards', '$l_realPass', 'Lietotajs')";
                                $register_result = mysqli_query($savienojums, $register_SQL);
                                echo "<p><b>Konts veiksmīgi izveidots!</b></p>";
                                header("Refresh:5 url=login.php");
                                exit;
                            }
                        }else{
                            echo "<p class='error'><b>Ievadītās paroles nesakrīt!</b></p>";
                        }
                    }
                ?>
            </form>
    </div>
</div>
</body>
</html>