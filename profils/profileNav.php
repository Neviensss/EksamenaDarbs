<?php
                    if (!isset($_SESSION['Lietotajvards'])){
                        echo "<h1>Jums nav piekļuve šai lapai!</h1>";
                    }
                    if (isset($_SESSION['Lietotajvards'])){
                        ?>
<header>
        <a href="#" class="logo">LOGO</a>
        <nav class="navbar">
            <ul>
                <li><a href="../index.php">Sākums</a></li>
                <li><a href="publicProfile.php">Apskatīt publisko profilu</a></li>
                <li><a href="profilePriv.php">Profils</a></li>
                <li><a href="transactionHistory.php">Pirkumu vēsture</a></li>
                <li><a href="paymentMethods.php">Maksāšanas veidi</a></li>
                <li><a href="privacy.php">Privātums</a></li>
                <?php
                    if (!isset($_SESSION['Lietotajvards'])){
                    }
                    if (isset($_SESSION['Lietotajvards'])){
                        echo "<div class='dropdown'>";
                        echo "<li><a><img src='https://static-00.iconduck.com/assets.00/profile-circle-icon-2048x2048-cqe5466q.png' class='profileImg'></a></li>";
                        echo "<div class='dropdown-content'>";
                        echo "<a href='profile.php'>Profils</a>";
                        echo "<a href='#'>Iestatījumi</a>";
                        echo "<a href='#'>Palīdzība</a>";
                                echo "<a href='../loginReg/logout.php'>Izlogoties</a>";     
                            }
                        ?>
                    </div>
                </div>
            </ul>
        </nav>
    </header>
<?php
}
?>