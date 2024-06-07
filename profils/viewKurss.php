<?php
session_start();
require("../connect.php");

if (!isset($_SESSION['Lietotajvards'])) {
    header("location:../loginReg/login.php");
    exit;
}

$class_id = $_GET['class_id'];

$query = "SELECT * FROM klases WHERE id = '$class_id'";
$result = mysqli_query($savienojums, $query);

$class = mysqli_fetch_assoc($result);

$kurss_id = $class['kurss_id'];
$kurss_query = "SELECT Nosaukums FROM apmacibas WHERE ID = '$kurss_id'";
$kurss_result = mysqli_query($savienojums, $kurss_query);

$kurss = mysqli_fetch_assoc($kurss_result);
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
        <section class="course-details">
            <h1><?php echo htmlspecialchars($kurss['Nosaukums']); ?> - <?php echo htmlspecialchars($class['nosaukums']); ?></h1>
            <p><?php echo htmlspecialchars($class['apraksts']); ?></p>
            <?php if (!empty($class['video_url'])): ?>
                    <div class="video-container">
                        <iframe width="560" height="315" src="<?php echo htmlspecialchars($class['video_url']); ?>" frameborder="0" allowfullscreen></iframe>
                    </div>
                <?php endif; ?>
        </section>
    </div>

    <?php include("../footer.php"); ?>

</body>
</html>
