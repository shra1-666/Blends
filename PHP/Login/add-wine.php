<?php
session_start();
$mysqli = require "../DataBase/dbConnect.php";

$sql = "INSERT INTO wines (userid, wine_name, winery_id, region_id, vintage_year, price, alcohol_content, description)
        VALUES (?, ?, ?, ?, ?, ?, ?, ?)";

$stmt = $mysqli->stmt_init();
if ( ! $stmt->prepare($sql)) {
    die("SQL error: " . $mysqli->error);
}

$stmt->bind_param("ssiiidds",
                  $_SESSION["userid"],
                  $_POST["wine_name"],
                  $_POST["winery_id"],
                  $_POST["region_id"],
                  $_POST["vintage_year"],
                  $_POST["price"],
                  $_POST["alcohol_content"],
                  $_POST["description"]);
try{
if ($stmt->execute()) {

    header("Location: ../../HTML/dash-wines.php");
    
} else {
    
    if ($mysqli->errno === 1062) {
        die("email already taken");
    } else {
        die($mysqli->error . " " . $mysqli->errno);
    }
}
}

catch (Exception $e) {
    echo "Error: " . $e->getMessage();
    header("Location: ../../HTML/sign-up.php?error=Already taken");
}
?>