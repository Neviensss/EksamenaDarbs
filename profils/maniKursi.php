<?php
session_start();
require("../connect.php");
?>

<!DOCTYPE html>
<html lang="lv">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mācies ar mums | Profils | Mani kursi</title>
    <link rel="stylesheet" href="../style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" defer></script>
</head>
<body>
<?php
        if(isset($_SESSION['Lietotajvards'])){
            include("profileNav.php");
            $lietotajvards = $_SESSION['Lietotajvards'];

        $select_user_id = "SELECT ID FROM users WHERE lietotajvards = '$lietotajvards'";
            $user_result = mysqli_query($savienojums, $select_user_id);
            $user = mysqli_fetch_assoc($user_result);
            $lietotajs = $user['ID'];

        $query = "SELECT Nosaukums, Attels from apmacibas WHERE Veidotajs='$lietotajs'";

        $result = mysqli_query($savienojums, $query);

        ?>
        <h2 class="prof">Mani kursi</h2>
        <div class="box-container">
        <?php
        while ($row = mysqli_fetch_assoc($result)) {
            ?>
            <div class="box">
                <img src="<?php echo $row['Attels']; ?>" alt="Course Image">
                <h2><?php echo $row['Nosaukums']; ?></h2>
                <button type="submit" class="editButton">Rediģēt</button>
            </div>
            <?php
        }
    ?>
        </div>
    <?php
    }else{
        header("location:../loginReg/login.php");
    }
        include("../footer.php");
    ?>

</body>
</html>