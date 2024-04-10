<?php
    if (!isset($_SESSION['Lietotajvards'])){
        session_start();
    }
    require('../connect.php');

    if(isset($_POST['id'])){
        $id = $_POST['id'];

        $select_vards = "SELECT lietotajvards FROM lietot_piet WHERE id = $id";
        $select_vards_result = mysqli_query($savienojums, $select_vards);
        $lietotajvards = mysqli_fetch_assoc($savienojums, $select_vards_result);

        $update_lietotajs_SQL = "UPDATE users SET
        loma = 'Veidotajs' WHERE lietotajvards = $lietotajvards";
        $update_lietotajs_result = mysqli_query($savienojums, $update_lietotajs_SQL);

        if(!$update_lietotajs_result){
            die("Kļūda!".mysqli_error($savienojums));
        }

        //$delete_pieteikums_SQL = "DELETE FROM lietot_piet WHERE id = $id";
        //$delete_pieteikums_result = mysqli_query($savienojums, $delete_pieteikums_SQL);
    }
?>