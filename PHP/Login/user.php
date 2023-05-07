<?php

$mysqli = require "../DataBase/dbConnect.php";
$mysqli = require "../Login/create-acc.php";
$sql = sprintf("SELECT count(*) FROM wines
                    WHERE userid='$uname'");
$result = $mysqli->query($sql);
echo $result;
header("Location: ../../HTML/sign-up.php?error=$result");
?>