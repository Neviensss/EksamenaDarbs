<?php
session_start();
require("../connect.php");

if (!isset($_SESSION['Lietotajvards'])) {
    header("location:../loginReg/login.php");
    exit;
}
include("profileNav.php");

$kurss_id = $_GET['kurss_id'];
$query = "SELECT * FROM apmacibas WHERE ID = '$kurss_id'";
$result = mysqli_query($savienojums, $query);
$kurss = mysqli_fetch_assoc($result);

if (isset($_POST['update_course'])) {
    $title = $_POST['Nosaukums'];
    $description = $_POST['Apraksts'];
    $price = $_POST['Cena'];

    $update_query = "UPDATE apmacibas SET Nosaukums='$title', Apraksts='$description', Cena='$price' WHERE ID='$kurss_id'";
    mysqli_query($savienojums, $update_query);

    header("Location: editKurss.php?kurss_id=$kurss_id");
    exit;
}

if (isset($_POST['add_class'])) {
    $class_title = $_POST['class_title'];
    $class_description = $_POST['class_description'];
    $class_video_url = $_POST['class_video_url'];

    $class_query = "INSERT INTO klases (kurss_id, nosaukums, apraksts, video_url) VALUES ('$kurss_id', '$class_title', '$class_description', '$class_video_url')";
    mysqli_query($savienojums, $class_query);

    header("Location: editKurss.php?kurss_id=$kurss_id");
    exit;
}

$class_query = "SELECT * FROM klases WHERE kurss_id = '$kurss_id'";
$class_result = mysqli_query($savienojums, $class_query);
?>

<!DOCTYPE html>
<html lang="lv">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mācies ar mums | <?php echo htmlspecialchars($kurss['Nosaukums']); ?></title>
    <link rel="stylesheet" href="../style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" defer></script>
</head>
<body>
    <div class="ievade">
        <h2>Rediģēt kursu</h2>
        <form action="editKurss.php?kurss_id=<?php echo $kurss_id; ?>" method="POST">
            <label for="Nosaukums">Nosaukums:</label>
            <input type="text" id="Nosaukums" name="Nosaukums" value="<?php echo htmlspecialchars($kurss['Nosaukums']); ?>" required><br>
            
            <label for="Apraksts">Apraksts:</label>
            <textarea id="Apraksts" name="Apraksts" required><?php echo htmlspecialchars($kurss['Apraksts']); ?></textarea>
            
            <label for="Cena">Cena:</label>
            <input type="number" step="0.01" id="Cena" name="Cena" min="0.50" value="<?php echo htmlspecialchars($kurss['Cena']); ?>" required><br>
            
            <button class="btn" type="submit" name="update_course">Saglabāt izmaiņas</button>
        </form>

        <h3>Pievienot klasi</h3>
        <form action="editKurss.php?kurss_id=<?php echo $kurss_id; ?>" method="POST">
            <label for="class_title">Klases nosaukums:</label>
            <input type="text" id="class_title" name="class_title">
            
            <label for="class_description">Klases apraksts:</label>
            <textarea id="class_description" name="class_description"></textarea>
            
            <label for="class_video_url">Video URL:</label>
            <input type="text" id="class_video_url" name="class_video_url">
            
            <button class="btn" type="submit" name="add_class">Pievienot klasi</button>
        </form>
        
        <h3>Esošās klases:</h3>
        <?php while ($class = mysqli_fetch_assoc($class_result)): ?>
            <div class="class">
                <h4><?php echo htmlspecialchars($class['nosaukums']); ?></h4>
                <p><?php echo htmlspecialchars($class['apraksts']); ?></p>
                <a href="<?php echo htmlspecialchars($class['video_url']); ?>"><?php echo htmlspecialchars($class['video_url']); ?></a>
                <div>
                    <a class="btn" href="editKlase.php?class_id=<?php echo $class['id']; ?>">Rediģēt</a> |
                    <a class="btn" href="deleteKlase.php?class_id=<?php echo $class['id']; ?>" onclick="return confirm('Vai esat pārliecināts?')">Dzēst</a>
                </div>
            </div>
        <?php endwhile; ?>
    </div>

    <?php include("../footer.php"); ?>
</body>
</html>
