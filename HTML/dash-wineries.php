<?php
session_start();
$uname=$_SESSION['userid'];
$mysqli = require "../PHP/DataBase/dbConnect.php";
$count=0;
//Code for selecting total no of bottles

$sql = sprintf("SELECT wineries.*,count(*) as bottle_count FROM wineries,wines
                    WHERE wines.userid='$uname' and wineries.userid='$uname' and wineries.winery_id=wines.winery_id group by wineries.winery_id");
$result = $mysqli->query($sql);

// $sql2 = sprintf("SELECT wineries.winery_name FROM wineries, wines
//                     WHERE userid='$uname' and wineries.winery_id=wines.$row["winery_id"]");
// $result2 = $mysqli->query($sql2);
//if (mysqli_num_rows($result) > 0) {
    //$row = mysqli_fetch_assoc($result);
    //$count = mysqli_num_rows($result);
//}
//else{
    //$count=0;
//}

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
                        <img class="dashboard-current-color" src="../Resources/Dash3.svg" alt="">
                    </div>
                    <div class="dash-nav-main-text">
                        <a href="dash-wineries.php"><h3>Wineries</h3></a>
                    </div>
                </div>

                <div class="dash-nav-main-entry dash-nav-main-entry-dummy">
                    <div class="dash-nav-main-logo">
                        <img src="../Resources/Dash4.svg" alt="">
                    </div>
                    <div class="dash-nav-main-text dash-nav-main-text-dummy">
                        <a href="dash-collections.php"><h3>Collection</h3></a>
                    </div>
                </div>

                <div class="dash-nav-main-entry dash-nav-main-entry-dummy">
                    <div class="dash-nav-main-logo">
                        <img src="../Resources/Dash5.svg" alt="">
                    </div>
                    <div class="dash-nav-main-text dash-nav-main-text-dummy">
                        <a href=""><h3>Review</h3></a>
                    </div>
                </div>

                <div class="dash-nav-main-entry dash-nav-main-entry-dummy">
                    <div class="dash-nav-main-logo">
                        <img src="../Resources/Dash6.svg" alt="">
                    </div>
                    <div class="dash-nav-main-text dash-nav-main-text-dummy">
                        <a href=""><h3>Inventory</h3></a>
                    </div>
                </div>

            </div>
            <hr class="dash-hr">
            <div class="dash-contents-div">
                <div class="dash-wines-content-container">
                    <div class="dash-wines-add-wine-div">
                        <a href="dash-addWineries.php">Add winery</a>
                    </div>
                    <div class="dash-wines-list-container">
                        <div class="dash-wines-list-head">
                            <div class="dash-wines-slno">
                                <h1 class="dash-wines-text">Sl. No</h1>
                            </div>
                            <div class="dash-wines-name">
                                <h1 class="dash-wines-text">Winery name</h1>
                            </div>
                            <div class="dash-wines-winery">
                                <h1 class="dash-wines-text">Country</h1>
                            </div>
                            <div class="dash-wines-region">
                                <h1 class="dash-wines-text">No of Bottles</h1>
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
                                <h1 class="dash-wines-text dash-wines-text-black"><?php echo $row["winery_name"]; ?></h1>
                            </div>
                            <div class="dash-wines-winery">
                                <h1 class="dash-wines-text dash-wines-text-black"><?php echo $row["country"]; ?></h1>
                            </div>
                            <div class="dash-wines-region">
                                <h1 class="dash-wines-text dash-wines-text-black"><?php echo $row["bottle_count"]; ?></h1>
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