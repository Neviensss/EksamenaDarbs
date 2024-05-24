<?php
    require('../connect.php');

    

    $apm_SQL = "SELECT * FROM apmacibas WHERE statuss='Iesniegts' or statuss = 'Atverts' ORDER BY ID";
    $apm_result = mysqli_query($savienojums, $apm_SQL);

    while($row = mysqli_fetch_array($apm_result)){
        $json[] = array(
            'nosaukums' => $row['Nosaukums'],
            'apraksts' => $row['Apraksts'],
            'attels' => $row['Attels'],
            'statuss' => $row['Statuss'],
            'veidotajs' => $row['Veidotajs'],
            'cena' => $row['Cena'],
            'id' => $row['ID']
        );
    }

    $jsonstring = json_encode($json);
    echo $jsonstring;
?>