<header>
        <a href="#" class="logo">LOGO</a>
        <nav class="navbar">
            <ul>
                <li><a href="../index.php">Sākums</a></li>
                <li><a href="profilePriv.php">Profils</a></li>
                <li><a href="publicProfile.php">Publiskais profils</a></li>
                <li><a href="transactionHistory.php">Pirkumu vēsture</a></li>
                <li><a href="iegadatieKursi.php">Iegādātie kursi</a></li>
                <li><a href="maniKursi.php">Mani kursi</a></li>
                <?php
                    if (isset($_SESSION['Lietotajvards'])){
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
                        echo "<li><a><img src='$profile_image' class='profileImg'></a></li>";
                        echo "<div class='dropdown-content'>";
                        echo "<a href='profilePriv.php'>Profils</a>";
                                echo "<a href='../loginReg/logout.php'>Izlogoties</a>";     
                            }
                        ?>
                    </div>
                </div>
            </ul>
        </nav>
    </header>