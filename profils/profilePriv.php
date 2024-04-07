<?php

    require("../connect.php");
    if (!isset($_SESSION['Lietotajvards'])){
        session_start();
    }
    $lietotajvards = $_SESSION['Lietotajvards'];

    if (isset($_POST['mainitEpastu'])) {
        $newEmail = $_POST['epasts'];

        $update_sql = "UPDATE users SET epasts = '$newEmail' WHERE lietotajvards = '$lietotajvards'";
        if (mysqli_query($savienojums, $update_sql) === TRUE) {
            echo "Epasts veiksmīgi nomainīts.";
        } else {
            echo "Kļūda mainot epastu!";
        }
    }

        if (isset($_POST['mainitParoli'])) {
            $oldPass = $_POST['pagaidPass'];
            $newPass = $_POST['newPass'];
            $newPass2 = $_POST['newPass2'];
            
            $sql = "SELECT parole FROM users WHERE lietotajvards = '$lietotajvards'";
            $result = mysqli_query($savienojums, $sql);
            
            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
                $pagaidPass = $row['parole'];
                if (password_verify($oldPass, $pagaidPass)) {
                    if ($newPass === $newPass2) {
                        $hashPass = password_hash($newPass, PASSWORD_DEFAULT);
                        
                        $update_sql = "UPDATE users SET parole = '$hashPass' WHERE lietotajvards = '$lietotajvards'";
                        if ($savienojums->query($update_sql) === TRUE) {
                            echo "Parole veiksmīgi nomainīta.";
                        } else {
                            echo "Kļūda mainot paroli!";
                        }
                    } else {
                        echo "Ievadītās jaunās paroles nav vienādas.";
                    }
                } else {
                    echo "Nepareiza pašreizējā parole.";
                }
            }
        }
?>

<!DOCTYPE html>
<html lang="lv">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mācies ar mums | Profils</title>
    <link rel="stylesheet" href="../style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" defer></script>
</head>
<body>
<?php
    include("profile.php");

    $epasts_sql = "SELECT epasts FROM users WHERE lietotajvards = '$lietotajvards'";
    $epasts_res = mysqli_query($savienojums, $epasts_sql);
    if (mysqli_num_rows($epasts_res) > 0) {
        $row = mysqli_fetch_assoc($epasts_res);
        $epasts = $row['epasts'];
    }
?>
<div class="profileContainer">
    <div class="ievade">
        <form method="post">
            <label>Epasts:</label>
            <input type="email" placeholder="<?php echo $epasts; ?>" name="epasts" required>
            <input type="submit" name="mainitEpastu" value="Mainīt epastu" class="btn">
        </form>
    </div>
    <div class="ievade">
        <form method="post">
            <label>Pašreizējā parole:</label>
            <input type="password" name="pagaidPass" placeholder="Ievadi pašreizējo paroli" minlength="8" maxlength="32" required>
            <label>Jaunā parole:</label>
            <input type="password" name="newPass" placeholder="Ievadi jauno paroli" minlength="8" maxlength="32" required>
            <label>Jaunā parole atkārtoti:</label>
            <input type="password" name="newPass2" placeholder="Ievadi jauno paroli atkārtoti" minlength="8" maxlength="32" required>
            <input type="submit" name="mainitParoli" value="Mainīt paroli" class="btn">
        </form>
    </div>
</div>
<?php
    include("../footer.php");
?>
</body>
</html>