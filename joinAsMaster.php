<!DOCTYPE html>
<html lang="lv">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mācies ar mums | Sākums</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" defer></script>
</head>
<body>
<?php include("navigation.php") ?>
    <section id="reasons">
        <div class="container">
            <div class="box">
                <img src="https://s.udemycdn.com/teaching/value-prop-teach-v3.jpg">
                <h3>Dalies ar zināšanām</h3>
                <p>Publish the course you want, in the way you want, and always have control of your own content.</p>
            </div>
            <div class="box">
                <img src="https://s.udemycdn.com/teaching/value-prop-inspire-v3.jpg">
                <h3>Iedvesmo mācīties</h3>
                <p>Teach what you know and help learners explore their interests, gain new skills, and advance their careers.</p>
            </div>
            <div class="box">
                <img src="https://s.udemycdn.com/teaching/value-prop-get-rewarded-v3.jpg">
                <h3>Tiec atalgots</h3>
                <p>Expand your professional network, build your expertise, and earn money on each paid enrollment.</p>
            </div>
        </div>
    </section>
    <section id="begin">

    </section>

    <section id="apply">
         <h1>Pievienojies kā pasniedzējs jau šodien</h1>
         <p>...</p>
         <a><button class="btn" name="atvertPiet">Pievienoties</button></a>
    </section>
    <?php
    include("footer.php");
    ?>

    <div class="modal">
    <div class="apply">
        <div class="close_modal"><i class="fas fa-times"></i></div>
        <h2>Pasniedzēja pieteikums</h2>
        <form id="pasniedzForma">
            <div class="formElements">
                <label>Nosaukums <span>*</span>:</label>
                <input type="text" id="nosaukums" required>
                <label>Apraksts <span>*</span>:</label>
                <input type="text" id="apraksts" required>
                <input type="hidden" id="pasID">
            </div>
            <input type="submit" name="pieteiktPasniedz" value="Iesniegt" class="btn">
        </form>
    </div>
</div>
</body>
</html>