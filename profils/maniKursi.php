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

        if (!isset($_SESSION['Lietotajvards'])) {
            header("Location: ../loginReg/login.php");
            exit();
        }
        $lietotajvards = $_SESSION['Lietotajvards'];

        $query = "SELECT ap.ID, ap.Nosaukums, ap.Attels 
                FROM pirkumi p
                JOIN apmacibas ap ON p.kurss_id = ap.ID
                JOIN users u ON p.pirceja_id = u.ID
                WHERE u.Lietotajvards = '$lietotajvards'";

        $result = mysqli_query($savienojums, $query);

        ?>
        <div class="box-container">
        <?php
        while ($row = mysqli_fetch_assoc($result)) {
            ?>
            <div class="box">
                <img src="<?php echo $row['Attels']; ?>" alt="Course Image">
                <h2><?php echo $row['Nosaukums']; ?></h2>
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