<?php
session_start();

if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] == true) {
    header("Location: /Recipie/");
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    include '../db/dbconnect.php';
    $loginUsername =  $_POST['loginUsername'];
    $loginPass =  $_POST['loginPassword'];

    $sql = "SELECT * FROM `users` WHERE `username` = '$loginUsername'";
    $result = mysqli_query($conn, $sql);
    $numRows = mysqli_num_rows($result);
    $current_path = "/CourierBD/auth/signin.php";
    if ($numRows == 1) {
        while ($row = mysqli_fetch_assoc($result)) {
            // $user_type = $row['user_type'];
            $UserID  = $row['UserID'];
            $user_type = $row['user_type'];
            $user_pass_hash = $row['user_pass'];
            if (password_verify($loginPass, $user_pass_hash)) {
                session_start();
                $_SESSION["loggedin"] = true;
                $_SESSION["UserID"] =   $UserID;
                $_SESSION["user_type"] =   $user_type;
                header("Location: /Recipie/");
            } else {
                $showError = "Passwords do not match";
                header("Location: $current_path?error=$showError");
            }
        }
    } else {
        $showError = "User not found";
        header("Location: $current_path?error=$showError");
    }
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <title>Login</title>
</head>
<body>
    <style><?php include '../assets/css/style.css' ?></style>
    <section class="login__section">
        <div class="container">
            <h3>
                Login!
            </h3>
        <form action="" method="post">
            <div class="form__content">
                <label for="">Username: </label>
                <input type="text" minlength="5" class="form__control" id="loginEmail" name="loginUsername" aria-describedby="emailHelp" required>
            </div>

            <div class="form__content">
                <label for="">Password: </label>
                <input type="password" minlength="8" class="form-control" id="password" name="loginPassword" required>
            </div>

            <button class="btn login__button">Login</button>
        </form>

        <div class="no__account">
            <small>No Account? <a href="">Registration</a></small>
        </div>
        </div>
    </section>
</body>
</html>