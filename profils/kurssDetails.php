<?php
session_start();
require("../connect.php");

if (!isset($_SESSION['Lietotajvards'])) {
    header("location:../loginReg/login.php");
    exit;
}


$kurss_id = $_GET['kurss_id'];

$query = "SELECT * FROM apmacibas WHERE ID = '$kurss_id'";
$result = mysqli_query($savienojums, $query);

$kurss = mysqli_fetch_assoc($result);

$class_query = "SELECT * FROM klases WHERE kurss_id = '$kurss_id'";
$class_result = mysqli_query($savienojums, $class_query);

?>

<!DOCTYPE html>
<html lang="lv">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mācies ar mums | <?php echo htmlspecialchars($kurss['Nosaukums']); ?></title>
    <link rel="stylesheet" href="coursesstyle.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" defer></script>
</head>
<body>
    <?php include("profileNav.php"); ?>
    <div class="container">
        <h2><?php echo htmlspecialchars($kurss['Nosaukums']); ?></h2>
        <p><?php echo htmlspecialchars($kurss['Apraksts']); ?></p>
        <p><strong>Cena:</strong> €<?php echo htmlspecialchars($kurss['Cena']); ?></p>

        <h3>Klases</h3>
        <ul class="class-list">
        <?php while ($class = mysqli_fetch_assoc($class_result)): ?>
            <li>
                <a href="viewKurss.php?class_id=<?php echo $class['id']; ?>"><?php echo htmlspecialchars($class['nosaukums']); ?></a>
            </li>
        <?php endwhile; ?>
        </ul>
    </div>
    <?php include("../footer.php"); ?>
</body>
</html>
