<?php
    session_start();
    require('../connect.php');

    if(isset($_POST['id'])){
        $id = $_POST['id'];
        $apst_piet_SQL = "UPDATE apmacibas SET Statuss = 'Apstiprinats' WHERE ID = '$id'";
        $apst_piet_result = mysqli_query($savienojums, $apst_piet_SQL);
    }
?>