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

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $title = $_POST['Nosaukums'];
    $description = $_POST['Apraksts'];
    $video_url = $_POST['video_url'];

    $update_query = "UPDATE klases SET nosaukums='$title', apraksts='$description', video_url='$video_url' WHERE id='$class_id'";
    mysqli_query($savienojums, $update_query);

    header("Location: editkurss.php?kurss_id=" . $class['kurss_id']);
    exit;
}
?>

<!DOCTYPE html>
<html lang="lv">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mācies ar mums | <?php echo htmlspecialchars($class['nosaukums']); ?></title>
    <link rel="stylesheet" href="../style.css">
</head>
<body>
    <?php include("profileNav.php"); ?>

    <div class="ievade">
        <h2>Rediģēt klasi</h2>
        <form action="editKlase.php?class_id=<?php echo $class_id; ?>" method="POST">
            <label for="Nosaukums">Nosaukums:</label>
            <input type="text" id="Nosaukums" name="Nosaukums" value="<?php echo htmlspecialchars($class['nosaukums']); ?>" required><br>
            
            <label for="Apraksts">Apraksts:</label>
            <textarea id="Apraksts" name="Apraksts" required><?php echo htmlspecialchars($class['apraksts']); ?></textarea>
            
            <label for="video_url">Video URL:</label>
            <input type="text" id="video_url" name="video_url" value="<?php echo htmlspecialchars($class['video_url']); ?>"><br>
            
            <button class="btn" type="submit">Saglabāt izmaiņas</button>
        </form>
        <a href="../profils/maniKursi.php"><button class="btn">Atpakaļ</button></a>
    </div>

    <?php include("../footer.php"); ?>
</body>
</html>
