<?php
session_start();
$mysqli = require "../DataBase/dbConnect.php";

$sql = "INSERT INTO wine_list (userid,list_name,description)
        VALUES (?, ?, ?)";
        
$stmt = $mysqli->stmt_init();

if ( ! $stmt->prepare($sql)) {
    die("SQL error: " . $mysqli->error);
}

$stmt->bind_param("sss",
                  $_SESSION["userid"],
                  $_POST["list_name"],
                  $_POST["description"]);

try{
if ($stmt->execute()) {

    //$sql2 = sprintf("SELECT list_id FROM wine_list
                    //WHERE list_name='$_POST["list_name"]'");
                    $sql2 = sprintf("SELECT list_id FROM wine_list
                 WHERE list_name='%s'", $_POST["list_name"]);

    $result = $mysqli->query($sql2);
    if ($row = mysqli_fetch_assoc($result)){
        $redir_url='../../HTML/dash-coll-add-wine.php?listid=' . urlencode($row["list_id"]);
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