<?php
session_start();
if (isset($_SESSION["Lietotajvards"]))
{
    unset($_SESSION["Lietotajvards"]);
    session_destroy();
}
header("location:../index.php");
?>