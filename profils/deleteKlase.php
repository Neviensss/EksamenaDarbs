<?php
session_start();
require("../connect.php");

if (!isset($_SESSION['Lietotajvards'])) {
    header("location:../loginReg/login.php");
    exit;
}

if (!isset($_GET['class_id']) || empty($_GET['class_id'])) {
    die("Klases ID nav norādīts.");
}

$class_id = $_GET['class_id'];

$query = "SELECT * FROM klases WHERE id = '$class_id'";
$result = mysqli_query($savienojums, $query);
$class = mysqli_fetch_assoc($result);

$delete_query = "DELETE FROM klases WHERE id='$class_id'";
mysqli_query($savienojums, $delete_query);

header("Location: editkurss.php?kurss_id=" . $class['kurss_id']);
exit;
?>
