<?php
session_start();
include "../DataBase/dbConnect.php";
if(isset($_POST['uname']) && isset($_POST['password'])) {
    function validate($data){
       $data = trim($data);
       $data = stripslashes($data);
       $data = htmlspecialchars($data);
       return $data;
    }
    $uname = validate($_POST['uname']);
    $pass = validate($_POST['password']);
    if (empty($uname)) {
        header("Location: sign-in.php?error=User Name is required");
        exit();
    }else if(empty($pass)){
        header("Location: sign-in.php?error=Password is required");
        exit();
    }else{
        $sql = "SELECT * FROM users WHERE userid='$uname' AND password='$pass'";
        $result = mysqli_query($conn, $sql);
        if (mysqli_num_rows($result) === 1) {
            $row = mysqli_fetch_assoc($result);
            if ($row['userid'] === $uname && $row['password'] === $pass) {
                echo "Logged in!";
                $_SESSION['userid'] = $row['userid'];
                $_SESSION['name'] = $row['name'];
                $_SESSION['id'] = $row['id'];
                header("Location: ../../HTML/dashboard.php");
                exit();
            }else{
                header("Location: ../../HTML/sign-in.php?error=Incorect User name or password");
                //echo '<script>alert("Incorrect username or password")</script>';
                exit();
            }
        }else{
            header("Location: ../../HTML/sign-in.php?error=Incorect User name or password");
            //echo '<script>alert("Incorrect username or password")</script>';
            exit();
        }
    }
}else{
    header("Location: ../../HTML/sign-up.html");    
    exit();
}
