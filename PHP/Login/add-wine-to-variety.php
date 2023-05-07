<?php
session_start();
$mysqli = require "../DataBase/dbConnect.php";

$sql = "INSERT INTO varieties (variety_id,userid, wine_id)
        VALUES (?, ?, ?)";
        
$stmt = $mysqli->stmt_init();

if ( ! $stmt->prepare($sql)) {
    die("SQL error: " . $mysqli->error);
}

$stmt->bind_param("isi",
                  $_POST["variety_id"],
                  $_SESSION["userid"],
                  $_POST["wine_id"]);
    
try{
if ($stmt->execute()) {

    header("Location: ../../HTML/dash-varieties.php");
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
    echo "error";
    //header("Location: ../../HTML/sign-up.php?error=Already taken");
}

?>