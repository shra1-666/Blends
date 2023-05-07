<?php
session_start();
$uname=$_SESSION['userid'];
$mysqli = require "../PHP/DataBase/dbConnect.php";
$count=0;
    
$sql = sprintf("SELECT wine_list.*,DATE(creation_date),COUNT(collections.wine_id) as num_wines FROM wine_list  LEFT JOIN collections ON wine_list.list_id = collections.list_id
                    WHERE collections.userid='$uname' and wine_list.list_id=collections.list_id group by wine_list.list_id, wine_list.list_name");
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
                        <img class="dashboard-current-color" src="../Resources/Dash4.svg" alt="">
                    </div>
                    <div class="dash-nav-main-text">
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
                <div class="dash-wines-content-container">
                    <div class="dash-wines-add-wine-div">
                        <a href="dash-create-coll.php">Create Collection</a>
                    </div>
                    <div class="dash-wines-list-container">
                        <div class="dash-wines-list-head">
                            <div class="dash-wines-slno coll-1">
                                <h1 class="dash-wines-text">Sl. No</h1>
                            </div>
                            <div class="dash-wines-name coll-2">
                                <h1 class="dash-wines-text">Collection name</h1>
                            </div>
                            <div class="dash-wines-winery coll-3">
                                <h1 class="dash-wines-text">No of items</h1>
                            </div>
                            <div class="dash-wines-region coll-4">
                                <h1 class="dash-wines-text">Created date</h1>
                            </div>
                            <div class="coll-5">
                                <h1 class="dash-wines-text"></h1>
                            </div>
                        </div>

                        <?php
                            while ($row = mysqli_fetch_assoc($result))
                            {
                                $count=$count+1;
                                $redir_url='dash-coll-detailed.php?listid=' . urlencode($row["list_id"]);
                        ?>

                        <a class="dash-wine-collection-detailed dash-wine-collection-detailed-2" href="<?php echo $redir_url; ?>">
                        <div class="dash-wines-list-head dash-wines-list-head-value">
                            <div class="dash-wines-slno coll-1">
                                <h1 class="dash-wines-text dash-wines-text-black"><?php echo $count; ?></h1>
                            </div>
                            <div class="dash-wines-name coll-2">
                                <h1 class="dash-wines-text dash-wines-text-black"><?php echo $row["list_name"]; ?></h1>
                            </div>
                            <div class="dash-wines-winery coll-3">
                                <h1 class="dash-wines-text dash-wines-text-black"><?php echo $row["num_wines"]; ?></h1>
                            </div>
                            <div class="dash-wines-region coll-4">
                                <h1 class="dash-wines-text dash-wines-text-black"><?php echo $row["DATE(creation_date)"]; ?></h1>
                            </div>
                            <div class="coll-5">
                                <?php
                                    $redir_url2='dash-coll-rename.php?list_id=' . urlencode($row["list_id"]);
                                ?>
                                <a href="<?php echo $redir_url2; ?>" class="dash-wines-text">Rename </a>
                            </div>
                        </div>
                        </a>

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