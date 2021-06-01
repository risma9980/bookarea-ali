<?php

session_start();

if (isset($_SESSION["login"])){
    header("Location:admin.php");
    exit;
}

require "admin_function.php";

    if(isset($_POST["login"])){
        $username = $_POST["username"];
        $password = $_POST["password"];

    $result = mysqli_query($conn, "SELECT * FROM tambahuser WHERE username='$username' ");

    //cek username
    if(mysqli_num_rows($result) === 1){

        //cek password
        $row = mysqli_fetch_assoc($result);
        if (password_verify($password, $row["password"])){
            //set session
            $_SESSION["login"] = true;
            header("location: admin.php");
            exit;
        }
    }
    $error = true;
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="login.css">
    <title>Login</title>
</head>
<body>
    
<main class="main-doc" >
    <form action="" method="post">

    <h3>LOGIN</h3>

    <label for="username">Username</label>
    <input type="username" name="username">

    <label for="password">Password</label>
    <input type="password" name="password">

    <?php
        if(isset($error)) :
    ?>
        <p style="color:red;"><em>Username / password salah!</em></p>

    <?php
        endif;
    ?>

    <button name="login">Login!</button>
    <a href="index.html">Halaman Utama</a>

    </form>
</main>

</body>
</html>