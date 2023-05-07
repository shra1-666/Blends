<?php
session_start();
$uname=$_SESSION['userid'];
$mysqli = require "../PHP/DataBase/dbConnect.php";
$count=0;
$listid = $_GET['listid'];
//Code for selecting total no of bottles

$sql = sprintf("SELECT * FROM wines w
                    WHERE w.userid='$uname' AND w.wine_id NOT IN(
                    SELECT c.wine_id FROM collections c WHERE c.list_id=$listid)");
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
                <div class="dash-wines-content-container dash-add-wines-container">
                    
                    <form class="dash-add-wine-entry-container dash-add-wine-entry-container-add-wine-coll" action="../PHP/Login/add-wine-to-coll.php" method="post">
                        <div class="dash-add-wines-content-div1 add-wines-coll-sec">
                            <div class="add-wines-sec">
                                <label for="region">Select wine</label>
                                <select name="wine_id" id="region">
                                
                                <?php
                                while ($row = mysqli_fetch_assoc($result))
                                {
                                ?>

                                <option value="<?php echo $row["wine_id"];?>"><?php echo $row["wine_name"]; ?></option>

                                <?php
                                }
                                ?>
                                </select>
                            </div>

                        </div>
                        <input type="hidden" name="list_id" value="<?php echo $listid; ?>">
                        <input class="add-wine-sub-btn" type="submit" value="Submit">
                    </form>

                </div>
            </div>
        </div>
    </div>
</body>
</html>