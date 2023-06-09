<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../CSS/style.css">
    <title>Sign-Up | Blends</title>
</head>
<body>
    <div class="container user-container">
        <img class="login-patterns" src="../Resources/Back-Pattern-Login.png" alt="pattern">
        <div class="signup-head-div">
            <h2 class="signup-head-text">UNLOCK THE DOOR</h2>
            <h2 class="signup-head-text signup-head-text2">TO YOUR WINE COLLECTION</h2>
        </div>
        <form class="login-entries-container" action="../PHP/Login/create-acc.php" method="post">
            <?php if (isset($_GET['error'])) { ?>
                <p class="error error-signup"><?php echo $_GET['error']; ?></p>
            <?php } ?>
            <div class="login-entries-set">
                <label for="email">Email</label>
                <input class="login-text-box" type="email" name="emailid" required>
            </div> 
            <div class="login-entries-set">
                <label for="username">Username</label>
                <input class="login-text-box" type="text" name="uname" required>
            </div> 
            <div class="login-entries-set">
                <label for="password">Password</label>
                <input class="login-text-box" type="password" name="pass" required>
            </div>    
            <div class="login-entries-set">
                <label for="re-password">Re enter Password</label>
                <input class="login-text-box" type="password" name="cnfpass" required>
            </div> 
            <div class="login-entries-set">
                <input class="submit-btn-login" type="submit" value="Sign-Up" href="#">
            </div>
            <a class="user-type-btn" href="sign-in.php">Existing user ?</a>
        </form>
    </div>
</body>
</html>
