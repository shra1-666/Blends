<?php

$is_invalid = false;

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    
    $mysqli = require __DIR__ . "../PHP/DataBase/dbConnect.php";
    
    $sql = sprintf("SELECT * FROM users
                    WHERE userid = '%s'",
                   $mysqli->real_escape_string($_POST["uname"]));
    
    $result = $mysqli->query($sql);
    
    $user = $result->fetch_assoc();
    
    if ($user) {
        
        if (password_verify($_POST["pass"], $user["password_hash"])) {
            
            session_start();
            
            session_regenerate_id();
            
            $_SESSION["user_id"] = $user["id"];
            
            header("Location: index.php");
            exit;
        }
    }
    
    $is_invalid = true;
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../CSS/style.css">
    <title>Sign-In | Blends</title>
</head>
<body>
    <div class="container user-container">
        <img class="login-patterns" src="../Resources/Back-Pattern-Login.png" alt="pattern">
        <div class="signup-head-div">
            <h2 class="signup-head-text">UNLOCK THE DOOR</h2>
            <h2 class="signup-head-text signup-head-text2">TO YOUR WINE COLLECTION</h2>
        </div>
        <form class="login-entries-container sign-in-container" action="../PHP/Login/login.php" method="post">
            <?php if (isset($_GET['error'])) { ?>
                <p class="error"><?php echo $_GET['error']; ?></p>
            <?php } ?>
            <div class="login-entries-set">
                <label for="username">Username</label>
                <input class="login-text-box" type="text" name="uname" required>
            </div> 
            <div class="login-entries-set">
                <label for="password">Password</label>
                <input class="login-text-box" type="password" name="password" required>
            </div>    
            <div class="login-entries-set">
                <input class="submit-btn-login" type="submit" value="Sign-In" href="#">
            </div>
            <a class="user-type-btn" href="sign-up.php">New user ?</a>
        </form>
    </div>
</body>
</html>
