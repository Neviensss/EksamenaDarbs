<?php
    session_start();
    require("../connect.php"); #Veic savienojumu ar datubāzi
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
if (isset($_SESSION['Lietotajvards'])) { #Pārbauda vai lietotājs ir ielogojies
    include("profileNav.php");

    if (isset($_POST["addCourse"])) { #Pārbauda vai nospiesta pievienošanas poga, atlasot ievadīto informāciju
        $l_nosaukums = $_POST['Nosaukums'];
        $l_apraksts = $_POST['Apraksts'];
        $l_cena = $_POST['Cena'];
        $l_cat = $_POST['kategorija'];
        $lietotajvards = $_SESSION['Lietotajvards'];

        $select_lietot_id = "SELECT ID FROM users WHERE lietotajvards = '$lietotajvards'"; #Atlasa lietotāju
        $lietotID_result = mysqli_query($savienojums, $select_lietot_id);
        $lietotID = mysqli_fetch_assoc($lietotID_result);
        $l_veidotajs = $lietotID['ID'];

        $target_dir = "uploads/"; #Faila augšupielādes ceļš
        $target_file = $target_dir . basename($_FILES["Attels"]["name"]);
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

        $check = getimagesize($_FILES["Attels"]["tmp_name"]); #Tiek pārbaudīts attēls
        if ($check !== false) {
            $uploadOk = 1;
        } else {
            echo "Fails nav attēls.";
            $uploadOk = 0;
        }

        if (file_exists($target_file)) { #Pārbauda vai attēls jau neeksistē
            echo "Attēls jau eksistē.";
            $uploadOk = 0;
        }

        if ($_FILES["Attels"]["size"] > 500000) { #Pārbauda faila izmēru
            echo "Izvēlētais fails ir par lielu.";
            $uploadOk = 0;
        }
        if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") { #Pārbauda vai fails ir attēla tipa
            echo "Atļauti tikai JPG, JPEG, PNG & GIF faili.";
            $uploadOk = 0;
        }
        if ($uploadOk == 0) {
            echo "Attēls netika augšupielādēts.";
        } else {
            if (move_uploaded_file($_FILES["Attels"]["tmp_name"], $target_file)) { #Attēls tiek augšupielādēts un tiek pievienots datubāzē kā klases attēls
                $l_attels = $target_file;
                $add_course_SQL = "INSERT INTO apmacibas (Nosaukums, Apraksts, Attels, Statuss, Veidotajs, Cena, Kategorija) VALUES ('$l_nosaukums', '$l_apraksts', '$l_attels', 'Iesniegts', '$l_veidotajs', '$l_cena', '$l_cat')";
                $add_result = mysqli_query($savienojums, $add_course_SQL);
                if ($add_result) {
                    echo "Kursa izveides pieteikums veiksmīgi izveidots!";
                } else {
                    echo "Kļūda";
                }
            } else {
                echo "Radās kļūda augšupielādējot attēlu.";
            }
        }
    }
?>
        <div class="ievade">
            <h2>Pievienot kursu</h2>
            <form method="post" enctype="multipart/form-data">
                <label for="Nosaukums">Kursa nosaukums:</label>
                <input type="text" id="Nosaukums" name="Nosaukums" required>
                
                <label for="Apraksts">Apraksts:</label>
                <textarea id="Apraksts" name="Apraksts" required></textarea><br>

                <label for="Cena">Cena:</label>
                <input type="number" id="Cena" name="Cena" step="0.01" min="0.50" required>

                <label for="kategorija">Kategorija:</label><br>
                <select id="kategorija" name="kategorija" required>
                    <option value="Dizains">Dizains</option>
                    <option value="Programmesana">Programmēšana</option>
                    <option value="Personiga">Personīgā attīstība</option>
                    <option value="Valodas">Valodas</option>
                    <option value="Maksla">Māksla un radošums</option>
                    <option value="Fotografija">Fotogrāfija</option>
                    <option value="Muzika">Mūzika</option>
                </select><br>

                <label for="Attels">Attēls:</label>
                <input type="file" id="Attels" name="Attels" required>
                
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