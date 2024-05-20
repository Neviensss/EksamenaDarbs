<?php
    session_start();
    require("../connect.php");
?>

<!DOCTYPE html>
<html lang="lv">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mācies ar mums | Kursa veidošana</title>
    <link rel="stylesheet" href="../style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" defer></script>
    <script src="../script.js" defer></script>
    <script src="../adminScript.js" defer></script>
</head>
<body>
    <?php
        if(isset($_SESSION['Lietotajvards'])){
            include("../profils/profileNav.php");

            if(isset($_POST["addCourse"])){
                $l_nosaukums = $_POST['Nosaukums'];
                $l_apraksts = $_POST['Apraksts'];
                $l_attels = $_POST['Attels'];
                $l_cena = $_POST['Cena'];
                $lietotajvards = $_SESSION['Lietotajvards'];
                $select_lietot_id = "SELECT ID FROM users WHERE lietotajvards = '$lietotajvards'";
                $lietotID_result = mysqli_query($savienojums, $select_lietot_id);
                $lietotID = mysqli_fetch_assoc($lietotID_result);
                $l_veidotajs = $lietotID['ID'];
        
            
                $add_course_SQL = "INSERT INTO apmacibas (Nosaukums, Apraksts, Attels, Statuss, Veidotajs, Cena) VALUES ('$l_nosaukums', '$l_apraksts', '$l_attels', 'Iesniegts', '$l_veidotajs', '$l_cena')";
                $add_result = mysqli_query($savienojums, $add_course_SQL);
                if($add_result){
                    echo "Kurss veiksmīgi izveidots!";
                }
            }
        ?>
        <div class="ievade">
            <h2>Pievienot kursu</h2>
            <form method="post">
                <label for="Nosaukums">Kursa nosaukums:</label>
                <input type="text" id="Nosaukums" name="Nosaukums" required>
                
                <label for="Apraksts">Apraksts:</label>
                <input type="text" id="Apraksts" name="Apraksts" required>
                
                <label for="Attels">Attēls:</label>
                <input type="text" id="Attels" name="Attels" required>

                <label for="Cena">Cena:</label>
                <input type="number" id="Cena" name="Cena" step="0.01" required>
                
                <button type="submit" class="btn" name="addCourse">Pievienot</button>
            </form>
        </div>

    <?php
        }else{
            header("location:../loginReg/login.php");
        }
            include("../footer.php");
    ?>
</body>
</html>