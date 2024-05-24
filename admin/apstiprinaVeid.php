<?php
    session_start();
    require('../connect.php');

    if(isset($_POST['id'])){
        $id = $_POST['id'];

        $select_vards = "SELECT lietotajvards FROM lietot_piet WHERE id = $id";
        $select_vards_result = mysqli_query($savienojums, $select_vards);

        if($select_vards_result){
            $row = mysqli_fetch_assoc($select_vards_result);
            $lietotajvards = $row['lietotajvards'];

            $update_lietotajs_SQL = "UPDATE users SET loma = 'Veidotajs' WHERE lietotajvards = '$lietotajvards'";
            $update_lietotajs_result = mysqli_query($savienojums, $update_lietotajs_SQL);
        }
        $delete_pieteikums_SQL = "DELETE FROM lietot_piet WHERE id = $id";
        $delete_pieteikums_result = mysqli_query($savienojums, $delete_pieteikums_SQL);
    }
?>