<?php
session_start();
require("../connect.php");
?>

<!DOCTYPE html>
<html lang="lv">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mācies ar mums | Profils | Pirkumu vēsture</title>
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
            
            $pirkums_SQL = "SELECT p.PirkumsID, ap.Nosaukums, p.cena, p.pirkuma_datums
            FROM pirkumi p
            JOIN apmacibas ap ON p.kurss_id = ap.ID
            WHERE p.pirceja_id = $lietotajs";

            $rezultats = mysqli_query($savienojums, $pirkums_SQL);
    ?>
    <div class="container">
        <h2 class="prof">Mani Pirkumi</h2>
        <table>
            <tr>
                <th>Maksājuma ID</th>
                <th>Nosaukums</th>
                <th>Cena</th>
                <th>Datums</th>
            </tr>
            <?php
            if (mysqli_num_rows($rezultats) > 0) {
                while($row = mysqli_fetch_assoc($rezultats)) {
                    echo "<tr>";
                    echo "<td>" . $row['PirkumsID'] . "</td>";
                    echo "<td>" . $row['Nosaukums'] . "</td>";
                    echo "<td>" . $row['cena'] . "€</td>";
                    echo "<td>" . $row['pirkuma_datums'] . "</td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='3'>Nav veikti pirkumi.</td></tr>";
            }
            ?>
        </table>
    </div>
<?php
}else{
    header("location:../loginReg/login.php");
}
    include("../footer.php");
?>
</body>
</html>