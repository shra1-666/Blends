<?php

if (empty($_POST["uname"])) {
    header("Location: ../../HTML/sign-up.php?error=Name is required");
}

if ( ! filter_var($_POST["emailid"], FILTER_VALIDATE_EMAIL)) {
    header("Location: ../../HTML/sign-up.php?error=Valid email is required");
}

if (strlen($_POST["pass"]) < 5) {
    header("Location: ../../HTML/sign-up.php?error=Password must be at least 5 characters");
}

if ( ! preg_match("/[a-z]/i", $_POST["pass"])) {
    header("Location: ../../HTML/sign-up.php?error=Password must contain at least one letter");
}

if ( ! preg_match("/[0-9]/", $_POST["pass"])) {
    header("Location: ../../HTML/sign-up.php?error=Password must contain at least one number");
}

if ($_POST["pass"] !== $_POST["cnfpass"]) {
    header("Location: ../../HTML/sign-up.php?error=Passwords must match");
}
$timestamp = date('Y-m-d H:i:s');
$uname = $_POST["uname"];

$mysqli = require "../DataBase/dbConnect.php";

$sql = "INSERT INTO users (userid, password, email, createdDate)
        VALUES (?, ?, ?,?)";
        
$stmt = $mysqli->stmt_init();

if ( ! $stmt->prepare($sql)) {
    die("SQL error: " . $mysqli->error);
}

$stmt->bind_param("ssss",
                  $_POST["uname"],
                  $_POST["pass"],
                  $_POST["emailid"],
                  $timestamp);

try{
if ($stmt->execute()) {

    header("Location: ../../HTML/sign-in.php");
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

