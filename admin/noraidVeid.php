<?php
    session_start();
    
    require('../connect.php');

    if(isset($_POST['id'])){
        $id = $_POST['id'];
        $delete_pieteikums_SQL = "DELETE FROM lietot_piet WHERE id = $id";
        $delete_pieteikums_result = mysqli_query($savienojums, $delete_pieteikums_SQL);
    }
?>