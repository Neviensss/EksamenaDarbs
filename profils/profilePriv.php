<?php
session_start();
require("../connect.php");
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
if (isset($_SESSION['Lietotajvards'])) {
    include("profileNav.php");

    $lietotajvards = $_SESSION['Lietotajvards'];

    $user_sql = "SELECT epasts, attels FROM users WHERE lietotajvards = '$lietotajvards'";
    $user_res = mysqli_query($savienojums, $user_sql);
    if (mysqli_num_rows($user_res) > 0) {
        $row = mysqli_fetch_assoc($user_res);
        $epasts = $row['epasts'];
        $profile_image = $row['attels'] ? $row['attels'] : 'uploads/profile-circle-icon-2048x2048-cqe5466q.png';
    }

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

    if (isset($_POST['mainitAttelu'])) {
        $target_dir = "uploads/";
        $target_file = $target_dir . basename($_FILES["profileImage"]["name"]);
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

        if (isset($_FILES["profileImage"])) {
            $check = getimagesize($_FILES["profileImage"]["tmp_name"]);
            if ($check !== false) {
                $uploadOk = 1;
            } else {
                echo "Fails nav attēls.";
                $uploadOk = 0;
            }

            if (file_exists($target_file)) {
                echo "Attēls jau eksistē.";
                $uploadOk = 0;
            }

            if ($_FILES["profileImage"]["size"] > 500000) {
                echo "Izvēlētais fails ir par lielu.";
                $uploadOk = 0;
            }

            if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
                echo "Atļauti tikai JPG, JPEG, PNG & GIF faili.";
                $uploadOk = 0;
            }

            if ($uploadOk == 0) {
                echo "Attēls netika augšupielādēts.";
            } else {
                if (move_uploaded_file($_FILES["profileImage"]["tmp_name"], $target_file)) {
                    $update_sql = "UPDATE users SET attels = '$target_file' WHERE lietotajvards = '$lietotajvards'";
                    if (mysqli_query($savienojums, $update_sql) === TRUE) {
                        echo "Profila attēls veiksmīgi nomainīts.";
                        $profile_image = $target_file;
                    } else {
                        echo "Kļūda mainot profila attēlu!";
                    }
                } else {
                    echo "Radās kļūda augšupielādējot attēlu.";
                }
            }
        } else {
            echo "Nav augšupielādēts neviens attēls.";
        }
    }
?>
<h2 class="prof">Mans profils</h2>
<div class="profileContainer">
    <div class="ievade">
        <form method="post" enctype="multipart/form-data">
            <label>Pašreizējais profila attēls:</label><br>
            <img src="<?php echo $profile_image; ?>" alt="Profila attēls" width="150"><br><br>
            <label>Jaunais profila attēls:</label>
            <input type="file" name="profileImage" required>
            <input type="submit" name="mainitAttelu" value="Mainīt profila attēlu" class="btn">
        </form>
    </div>
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
} else {
    header("Location: ../loginReg/login.php");
    exit();
}
include("../footer.php");
?>
</body>
</html>
