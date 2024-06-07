<?php
    require('../connect.php');

    

    $apm_SQL = "SELECT * FROM apmacibas WHERE statuss='Iesniegts' or statuss = 'Atverts' ORDER BY ID";
    $apm_result = mysqli_query($savienojums, $apm_SQL);

    while($row = mysqli_fetch_array($apm_result)){
        $veid_SQL = "SELECT Lietotajvards FROM users WHERE ID = " . $row['Veidotajs'] . "";
        $veid_result = mysqli_query($savienojums, $veid_SQL);
        $veidotajs = mysqli_fetch_assoc($veid_result);
        $json[] = array(
            'nosaukums' => $row['Nosaukums'],
            'apraksts' => $row['Apraksts'],
            'attels' => "../profils/" . $row['Attels'],
            'statuss' => $row['Statuss'],
            'veidotajs' => $veidotajs['Lietotajvards'],
            'cena' => $row['Cena'],
            'id' => $row['ID']
        );
    }

    $jsonstring = json_encode($json);
    echo $jsonstring;
?>
