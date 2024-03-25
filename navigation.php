<?php
    if (!isset($_SESSION['Lietotajvards'])){
        session_start();
    }
?>

<header>
        <a href="#" class="logo">LOGO</a>
        <nav class="navbar">
            <ul>
                <li><a href="index.php">Sākums</a></li>
                <li><a href="#">Kategorijas</a></li>
                <li><a href="joinAsMaster.php">Māci ar mums</a></li>
                <li><a href="about.php">Par mums</a></li>
                <?php
                    if (!isset($_SESSION['Lietotajvards'])){
                        echo "<li><a href='loginReg/login.php'>Ielogoties</a></li>";
                        echo "<li><a class='regButton' href='loginReg/register.php'>Reģistrēties</a></li>"; 
                    }
                ?>
                <div class="dropdown">
                <li><a><img src="https://static-00.iconduck.com/assets.00/profile-circle-icon-2048x2048-cqe5466q.png" class="profileImg"></a></li>
                    <div class="dropdown-content">
                        <a href="profils/profile.php">Profils</a>
                        <a href="#">Iestatījumi</a>
                        <a href="#">Palīdzība</a>
                        <?php
                            if (isset($_SESSION['Lietotajvards'])){
                                echo "<a href='loginReg/logout.php'>Izlogoties</a>";      
                            }
                        ?>
                    </div>
                </div>
            </ul>
        </nav>
    </header>