<header>
        <a href="#" class="logo">LOGO</a>
        <nav class="navbar">
            <ul>
                <li><a href="index.php">Sākums</a></li>
                <div class="dropdown">
                    <li><a href="kursi.php">Kursi</a></li>
                    <div class="dropdown-content">
                        <a href="kursi.php?category=Dizains">Dizains</a>
                        <a href="kursi.php?category=Programmēšana">Programmēšana</a>
                        <a href="kursi.php?category=Attīstība">Attīstība</a>
                        <a href="kursi.php?category=Valodas">Valodas</a>
                        <a href="kursi.php?category=Māksla">Māksla un radošums</a>
                        <a href="kursi.php?category=Fotografija">Fotogrāfija</a>
                        <a href="kursi.php?category=Muzika">Mūzika</a>
                    </div>
                </div>
                <li><a href="joinAsMaster.php">Māci ar mums</a></li>
                <?php
                    if (!isset($_SESSION['Lietotajvards'])){
                        echo "<li><a class='auth' href='loginReg/login.php'>Ielogoties</a></li>";
                        echo "<li><a class='auth' href='loginReg/register.php'>Reģistrēties</a></li>";
                    } else {
                        $lietotajvards = $_SESSION['Lietotajvards'];
                        $profile_img_sql = "SELECT attels FROM users WHERE lietotajvards = '$lietotajvards'";
                        $profile_img_res = mysqli_query($savienojums, $profile_img_sql);
    
                        if ($profile_img_res && mysqli_num_rows($profile_img_res) > 0) {
                            $row = mysqli_fetch_assoc($profile_img_res);
                            $profile_image = $row['attels'] ? $row['attels'] : 'uploads/profile-circle-icon-2048x2048-cqe5466q.png';
                        } else {
                            $profile_image = $row['attels'] ? $row['attels'] : 'uploads/profile-circle-icon-2048x2048-cqe5466q.png';
                        }
    
                        echo "<div class='dropdown'>";
                        echo "<li><a><img src='profils/$profile_image' class='profileImg'></a></li>";
                        echo "<div class='dropdown-content'>";
                        echo "<a href='profils/profilePriv.php'>Profils</a>";
                        echo "<a href='loginReg/logout.php'>Izlogoties</a>";
                        echo "</div>";
                        echo "</div>";
                    }
                        ?>
                    </div>
                </div>
            </ul>
        </nav>
    </header>