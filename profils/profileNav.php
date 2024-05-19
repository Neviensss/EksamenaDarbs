<header>
        <a href="#" class="logo">LOGO</a>
        <nav class="navbar">
            <ul>
                <li><a href="../index.php">Sākums</a></li>
                <li><a href="profilePriv.php">Profils</a></li>
                <li><a href="publicProfile.php">Publiskais profils</a></li>
                <li><a href="transactionHistory.php">Pirkumu vēsture</a></li>
                <li><a href="maniKursi.php">Mani kursi</a></li>
                <?php
                    if (!isset($_SESSION['Lietotajvards'])){
                    }
                    if (isset($_SESSION['Lietotajvards'])){
                        echo "<div class='dropdown'>";
                        echo "<li><a><img src='https://static-00.iconduck.com/assets.00/profile-circle-icon-2048x2048-cqe5466q.png' class='profileImg'></a></li>";
                        echo "<div class='dropdown-content'>";
                        echo "<a href='profilePriv.php'>Profils</a>";
                        echo "<a href='settings.php'>Iestatījumi</a>";
                        echo "<a href='#'>Palīdzība</a>";
                                echo "<a href='../loginReg/logout.php'>Izlogoties</a>";     
                            }
                        ?>
                    </div>
                </div>
            </ul>
        </nav>
    </header>