<!DOCTYPE html>
<html lang="lv">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mācies ar mums | Lietotāju pieteikumi</title>
    <link rel="shortcut icon" href="../images/icon.png" type="image/x-icon">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" defer></script>
    <script src="../adminScript.js" defer></script>
</head>
<body>
    <?php
    include("adminNav.php");
    require("../connect.php");
    ?>

<div class="container">
    <table>
        <tr>
            <th>ID</th>
            <th>Lietotājvārds</th>
            <th>Vārds</th>
            <th>Uzvārds</th>
            <th>Loma</th>
            <th></th>
            <th></th>
        </tr>
        <tbody id="lietotajPieteikumi"></tbody>
    </table>
</div>
</body>
</html>