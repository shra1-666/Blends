<?php
session_start();
$uname=$_SESSION['userid'];
$mysqli = require "../PHP/DataBase/dbConnect.php";
//include "../PHP/Login/login.php";
//Code for selecting total no of bottles

$sql = sprintf("SELECT * FROM wines
                    WHERE userid='$uname'");
$result = $mysqli->query($sql);
if (mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);
    $count = mysqli_num_rows($result);
}
else{
    $count=0;
}

//code for selecting total grape varieties
$sql2 = sprintf("SELECT * FROM grape_varieties
                    WHERE userid='$uname'");
$result2 = $mysqli->query($sql2);
if (mysqli_num_rows($result2) > 0) {
    $row = mysqli_fetch_assoc($result2);
    $count2 = mysqli_num_rows($result2);
}
else{
    $count2=0;
}

//code for total no of wineries
$sql3 = sprintf("SELECT * FROM wineries
                    WHERE userid='$uname'");
$result3 = $mysqli->query($sql3);
if (mysqli_num_rows($result3) > 0) {
    $row = mysqli_fetch_assoc($result3);
    $count3 = mysqli_num_rows($result3);
}
else{
    $count3=0;
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../CSS/style.css">
    <title>Dashboard | Blends</title>
</head>
<body>
    <div class="dash-container">
        <div class="dash-nav-container">
            <img class="dash-nav-design" src="../Resources/Dashboard Nav.svg" alt="">
            <a class="nav-entries-logo" href="dashboard.html"><img class="nav-logo" src="../Resources/Logo.svg" alt="logo"></a>
            <a class="logout-dash-btn" href="../PHP/Login/logout.php">Log Out</a>
        </div>
        <div class="dash-content-div">
            <div class="dash-main-nav-div">
                <div class="dash-nav-main-entry">
                    <div class="dash-nav-main-logo">
                        <img src="../Resources/Dash1.svg" alt="">
                    </div>
                    <div class="dash-nav-main-text">
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
                <div class="dash-content-container">
                    <div class="dash-content-box">
                        <h4>No of Bottles</h4>
                        <h2><?php echo $count; ?></h2>
                    </div>

                    <div class="dash-content-box dash-content-box2">
                        <h4>Grape Variety</h4>
                        <h2><?php echo $count2; ?></h2>
                    </div>

                    <div class="dash-content-box">
                        <h4>No of Wineries</h4>
                        <h2><?php echo $count3; ?></h2>
                    </div>

                </div>
                <hr class="dash-content-hr">
            </div>
        </div>
    </div>
</body>
</html>