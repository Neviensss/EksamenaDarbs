<?php
session_start();
require("../connect.php");
?>

<!DOCTYPE html>
<html lang="lv">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mācies ar mums | Profils | Iegādātie kursi</title>
    <link rel="stylesheet" href="../style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" defer></script>
</head>
<body>
    <?php
        if(isset($_SESSION['Lietotajvards'])){
            include("profileNav.php");
        $lietotajvards = $_SESSION['Lietotajvards'];

        $query = "SELECT ap.ID, ap.Nosaukums, ap.Attels 
                FROM pirkumi p
                JOIN apmacibas ap ON p.kurss_id = ap.ID
                JOIN users u ON p.pirceja_id = u.ID
                WHERE u.Lietotajvards = '$lietotajvards'";

        $result = mysqli_query($savienojums, $query);

        ?>
        <h2 class="prof">Iegādātie kursi</h2>
        <div class="box-container">
        <?php
        while ($row = mysqli_fetch_assoc($result)) {
            ?>
            <div class="box">
                <img src="<?php echo $row['Attels']; ?>" alt="Course Image">
                <h2><?php echo $row['Nosaukums']; ?></h2>
                <button type="submit" class="openButton">Skatīt</button>
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