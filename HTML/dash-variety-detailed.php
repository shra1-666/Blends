<?php
session_start();
$uname=$_SESSION['userid'];
$mysqli = require "../PHP/DataBase/dbConnect.php";
$count=0;
$variety_id = $_GET['variety_id'];
    
$sql = sprintf("SELECT wines.* FROM varieties INNER JOIN wines ON varieties.wine_id = wines.wine_id
                    WHERE varieties.variety_id='$variety_id' and varieties.userid='$uname' and wines.userid='$uname'");
$result = $mysqli->query($sql);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../CSS/style.css">
    <title>Wines | Blends</title>
</head>
<body>
    <div class="dash-container">
        <div class="dash-nav-container">
            <img class="dash-nav-design" src="../Resources/Dashboard Nav.svg" alt="">
            <a class="nav-entries-logo" href="dashboard.php"><img class="nav-logo" src="../Resources/Logo.svg" alt="logo"></a>
            <a class="logout-dash-btn" href="../PHP/Login/logout.php">Log Out</a>
        </div>
        <div class="dash-content-div">
            <div class="dash-main-nav-div">
                <div class="dash-nav-main-entry">
                    <div class="dash-nav-main-logo">
                        <img src="../Resources/Dash1.svg" alt="">
                    </div>
                    <div class="dash-nav-main-text dash-nav-main-text-dummy">
                        <a href="dashboard.php"><h3>Dashboard</h3></a>
                    </div>
            </div>

                <div class="dash-nav-main-entry dash-nav-main-entry-dummy">
                    <div class="dash-nav-main-logo">
                        <img src="../Resources/Dash2.svg" alt="">
                    </div>
                    <div class="dash-nav-main-text dash-nav-main-text-dummy">
                        <a href="dash-wines.php"><h3>Wines</h3></a>
                    </div>
                </div>

                <div class="dash-nav-main-entry dash-nav-main-entry-dummy">
                    <div class="dash-nav-main-logo">
                        <img src="../Resources/Dash3.svg" alt="">
                    </div>
                    <div class="dash-nav-main-text dash-nav-main-text-dummy">
                        <a href="dash-wineries.php"><h3>Wineries</h3></a>
                    </div>
                </div>

                <div class="dash-nav-main-entry dash-nav-main-entry-dummy">
                    <div class="dash-nav-main-logo">
                        <img src="../Resources/Dash4.svg" alt="">
                    </div>
                    <div class="dash-nav-main-text dash-nav-main-text-dummy">
                        <a href=""><h3>Collection</h3></a>
                    </div>
                </div>

                <div class="dash-nav-main-entry dash-nav-main-entry-dummy">
                    <div class="dash-nav-main-logo">
                        <img src="../Resources/Dash5.svg" alt="">
                    </div>
                    <div class="dash-nav-main-text dash-nav-main-text-dummy">
                        <a href=""><h3>Notes</h3></a>
                    </div>
                </div>

                <div class="dash-nav-main-entry dash-nav-main-entry-dummy">
                    <div class="dash-nav-main-logo">
                        <img src="../Resources/Dash6.svg" alt="">
                    </div>
                    <div class="dash-nav-main-text dash-nav-main-text-dummy">
                        <a href=""><h3>Regions</h3></a>
                    </div>
                </div>
                <div class="dash-nav-main-entry dash-nav-main-entry-dummy">
                    <div class="dash-nav-main-logo">
                        <img class="dashboard-current-color" src="../Resources/Dash7.svg" alt="">
                    </div>
                    <div class="dash-nav-main-text">
                        <a href=""><h3>Varieties</h3></a>
                    </div>
                </div>

            </div>
            <hr class="dash-hr">
            <div class="dash-contents-div">
                <div class="dash-wines-content-container">
                    <div class="dash-wines-add-wine-div">
                        <?php
                            $redir_url='dash-variety-add-wine.php?variety_id=' . urlencode($variety_id);
                        ?>
                        <a href="<?php echo $redir_url; ?>">Add to collection</a>
                    </div>
                    <div class="dash-wines-list-container">
                        <div class="dash-wines-list-head">
                            <div class="dash-wines-slno">
                                <h1 class="dash-wines-text">Sl. No</h1>
                            </div>
                            <div class="dash-wines-name">
                                <h1 class="dash-wines-text">Wine name</h1>
                            </div>
                            <div class="dash-wines-winery">
                                <h1 class="dash-wines-text">Vintage year</h1>
                            </div>
                            <div class="dash-wines-region">
                                <h1 class="dash-wines-text">Alcohol content(%)</h1>
                            </div>
                        </div>

                        <?php
                            while ($row = mysqli_fetch_assoc($result))
                            {
                                $count=$count+1;
                        ?>

                        <div class="dash-wines-list-head dash-wines-list-head-value">
                            <div class="dash-wines-slno">
                                <h1 class="dash-wines-text dash-wines-text-black"><?php echo $count; ?></h1>
                            </div>
                            <div class="dash-wines-name">
                                <h1 class="dash-wines-text dash-wines-text-black"><?php echo $row["wine_name"]; ?></h1>
                            </div>
                            <div class="dash-wines-winery">
                                <h1 class="dash-wines-text dash-wines-text-black"><?php echo $row["vintage_year"]; ?></h1>
                            </div>
                            <div class="dash-wines-region">
                                <h1 class="dash-wines-text dash-wines-text-black"><?php echo $row["alcohol_content"]; ?></h1>
                            </div>
                        </div>

                        <?php
                            }
                        ?>

                    </div>

                </div>
            </div>
        </div>
    </div>
</body>
</html>