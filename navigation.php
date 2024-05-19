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
                        echo "<li><a class='auth' href='loginReg/login.php'>Ielogoties</a></li>";
                        echo "<li><a class='auth' href='loginReg/register.php'>Reģistrēties</a></li>";
                    }
                    if (isset($_SESSION['Lietotajvards'])){
                        echo "<div class='dropdown'>";
                        echo "<li><a><img src='https://static-00.iconduck.com/assets.00/profile-circle-icon-2048x2048-cqe5466q.png' class='profileImg'></a></li>";
                        echo "<div class='dropdown-content'>";
                        echo "<a href='profils/profilePriv.php'>Profils</a>";
                        echo "<a href='profils/settings.php'>Iestatījumi</a>";
                        echo "<a href='#'>Palīdzība</a>";
                                echo "<a href='loginReg/logout.php'>Izlogoties</a>";      
                            }
                        ?>
                    </div>
                </div>
            </ul>
        </nav>
    </header>