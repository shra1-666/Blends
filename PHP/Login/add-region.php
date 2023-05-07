<?php
session_start();
$mysqli = require "../DataBase/dbConnect.php";

$sql = "INSERT INTO wine_regions (userid,region_name,country,climate,soil)
        VALUES (?, ?, ?, ?, ?)";
        
$stmt = $mysqli->stmt_init();

if ( ! $stmt->prepare($sql)) {
    die("SQL error: " . $mysqli->error);
}

$stmt->bind_param("sssss",
                  $_SESSION["userid"],
                  $_POST["region_name"],
                  $_POST["country"],
                  $_POST["climate"],
                  $_POST["soil"]);

try{
if ($stmt->execute()) {

    header("Location: ../../HTML/dash-regions.php");
    exit;
    
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