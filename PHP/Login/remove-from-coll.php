<?php
session_start();
$mysqli = require "../DataBase/dbConnect.php";
$wine_id = $_GET['wine_id'];
$uname=$_SESSION['userid'];

//$sql = "INSERT INTO wineries (userid, winery_name, country, region, website)
       // VALUES (?, ?, ?, ?, ?)";
$sql = "DELETE FROM collections WHERE wine_id = ? and collections.userid=?";
$stmt = $mysqli->prepare($sql);        
//$stmt = $mysqli->stmt_init();

if ( ! $mysqli->prepare($sql)) {
    die("SQL error: " . $mysqli->error);
    
}

$stmt->bind_param("is",
                   $wine_id,
                   $uname);
//$stmt->bindParam(':wine_id', $wine_id);


// $stmt->bind_param("sssss",
//                   $_SESSION["userid"],
//                   $_POST["winery_name"],
//                   $_POST["country"],
//                   $_POST["region"],
//                   $_POST["website"]);

try{
if ($stmt->execute()) {

    header("Location: ../../HTML/dash-collections.php");
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