<?php
session_start();
$mysqli = require "../DataBase/dbConnect.php";

$sql = "INSERT INTO grape_varieties (userid,variety_name,color,percentage)
        VALUES (?, ?, ?, ?)";
        
$stmt = $mysqli->stmt_init();

if ( ! $stmt->prepare($sql)) {
    die("SQL error: " . $mysqli->error);
}

$stmt->bind_param("sssi",
                  $_SESSION["userid"],
                  $_POST["variety_name"],
                  $_POST["color"],
                  $_POST["percentage"]);

try{
if ($stmt->execute()) {

    //$sql2 = sprintf("SELECT list_id FROM wine_list
                    //WHERE list_name='$_POST["list_name"]'");
                    $sql2 = sprintf("SELECT variety_id FROM grape_varieties
                 WHERE variety_name='%s'", $_POST["variety_name"]);

    $result = $mysqli->query($sql2);
    if ($row = mysqli_fetch_assoc($result)){
        $redir_url='../../HTML/dash-variety-add-wine.php?variety_id=' . urlencode($row["variety_id"]);
        header("Location: $redir_url");
        exit;
    }
    
    
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