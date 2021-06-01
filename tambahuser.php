<?php

session_start();

if (!isset ($_SESSION["login"])){
    header("Location: login.php");
    exit;
}

    require 'admin_function.php';

    if (isset($_POST["register"])) {
        if (tambahuser($_POST) > 0){
            echo "
                <script>
                    alert('akun berhasil dibuat');
                </script>
            ";
        } else {
            echo mysqli_error($conn);
        }
    }


?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="tambah_ubah_buku.css">
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
    <title>Tambah User</title>
</head>
<body>

<nav id="navbar">
      <header>
            <h2>
            <i class="fas fa-book"></i>
             BUKU ALI 
            </h2>
        </header>

        <a href="admin.php" class="nav-link">
        <i class="fas fa-home"></i>    
        Beranda
        </a>

        <a href="tambahbuku.php" class="nav-link">
        <i class="fas fa-plus"></i> 
        Tambah Buku
        </a>

        <a href="tambahuser.php" class="nav-link" style="color: lightblue;">
        <i class="fas fa-user"></i> 
        Tambah User
        </a>

</nav>

<main id="main-doc">

    <div class="second-doc">
        <a href="">Logout</a>
    </div>

    <div class="third-doc">
        <h3>
            TAMBAH USER
        </h3>

        <div class="border"></div>

    <form action="" method="post">
    
        <ul>
            <li>
                <label for="username">Username*</label>
                <input type="username" name="username" required>
            </li>

            <li>
                <label for="password">Password*</label>
                <input type="password" name="password" required>
            </li>

            <li>
                <label for="password2">Ulangi Password*</label>
                <input type="password" name="password2" reuqired>
            </li>

            <li>
                <button name="register">Buat Akun</button>
            </li>
        
        </ul>

    </form>

    </div>
    
</main>
</body>
</html>