<?php
    require('../connect.php');

    $apm_SQL = "SELECT * FROM lietot_piet ORDER BY id";
    $apm_result = mysqli_query($savienojums, $apm_SQL);

    while($row = mysqli_fetch_array($apm_result)){
        $json[] = array(
            'lietotajvards' => $row['lietotajvards'],
            'vards' => $row['vards'],
            'uzvards' => $row['uzvards'],
            'loma' => $row['loma'],
            'id' => $row['id']
        );
    }

    $jsonstring = json_encode($json);
    echo $jsonstring;
?>