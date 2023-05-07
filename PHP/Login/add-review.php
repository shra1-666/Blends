<?php
session_start();
$mysqli = require "../DataBase/dbConnect.php";

$sql = "INSERT INTO reviews (userid,wine_id,review_text)
        VALUES (?, ?, ?)";
        
$stmt = $mysqli->stmt_init();

if ( ! $stmt->prepare($sql)) {
    die("SQL error: " . $mysqli->error);
}

$stmt->bind_param("sss",
                  $_SESSION["userid"],
                  $_POST["wine_id"],
                  $_POST["review_text"]);

try{
if ($stmt->execute()) {

    header("Location: ../../HTML/dash-reviews.php");
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