<!DOCTYPE html>
<html lang="lv">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mācies ar mums | Autorizācija</title>
    <link rel="shortcut icon" href="../images/icon.png" type="image/x-icon">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" defer></script>
</head>
<body>
<?php
    require("connect.php");
?>

<div class="container">
    <div class="panel">
        <h1>Ielogoties sistēmā:</h1>
            <form action="" method="POST">
                <label>Lietotājvārds:</label>
                <input type="text" placeholder="Ievadi savu lietotājvārdu" name="lietotajvards">
                <label>Parole:</label>
                <input type="password" placeholder="Ievadi savu paroli" name="parole">
                <button type="submit" name="autorizeties">Ielogoties</button>
                <?php
                require("connect.php");
                    if(isset($_POST["autorizeties"])){
                        session_start();
                        $lietotajvards = mysqli_real_escape_string($savienojums, $_POST["lietotajvards"]);
                        $Parole = mysqli_real_escape_string($savienojums, $_POST["parole"]);
                
                        $lietotaja_atrasana_SQL = "SELECT * FROM testuser WHERE lietotajvards = '$lietotajvards'";
                        $atrasanas_rezultats = mysqli_query($savienojums, $lietotaja_atrasana_SQL);
                
                        if(mysqli_num_rows($atrasanas_rezultats) > 0){
                            while($ieraksts = mysqli_fetch_assoc($atrasanas_rezultats)){
                                if(password_verify($Parole, $ieraksts["parole"])){
                                    $_SESSION["Lietotajvards"] = $ieraksts["lietotajvards"];
                                    header("location:./");
                                }else{
                                    echo "Nepareizs lietotājvārds vai parole!";
                                }
                            }
                        }else{
                            echo "Nepareizs lietotājvārds vai parole!";
                        }
                    }
                ?>
            </form>
            <p>Vel nav izveidots konts? <a href="register.php"><b>Reģistrēties</b></a></p>
    </div>
</div>
</body>
</html>