<?php  

session_start();

if (!isset ($_SESSION["login"])){
    header("location: login.php");
    exit;
}
    
    require "admin_function.php";

    //cek tombol tambahkan sudah di pencet atau blm
    
    if ( isset($_POST["submit"]) ){

        //cek apakah data berhasil ditambahkan atau tidak
        if (tambahdata($_POST) > 0){
            echo "
            <script>
                alert ('sukses ditambahkan');
                document.location.href = 'admin.php';
            </script>
            ";
        } else {
            echo "
            <script>
                alert ('gagal ditambahkan');
                document.location.href = 'admin.php';
            </script>
            ";
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
    <title>Panel Admin</title>
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

        <a href="tambahbuku.php" class="nav-link"  style="color: lightblue;">
        <i class="fas fa-plus"></i> 
        Tambah Buku
        </a>

        <a href="tambahuser.php" class="nav-link">
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
            TAMBAH BUKU
        </h3>

        <div class="border"></div>

         <form action="" method="post" enctype="multipart/form-data">

             <ul>
                <li>
                <label for="isbn">ISBN</label>
                <input type="number" name="isbn" id="isbn">
                </li>

                <li>
                <label for="judul">Judul*</label>
                <input type="text" name="judul" id="judul" required>
                </li>

                <li>
                <label for="pengarang">Pengarang*</label>
                <input type="text" name="pengarang" id="pengarang" required>
                </li>

                <li>
                <label for="penerbit">Penerbit*</label>
                <input type="text" name="penerbit" id="penerbit" required>
                </li>

                <li>
                <label for="thn_terbit">Tahun Terbit</label>
                <input type="number" name="thn_terbit" id="thn_terbit">
                </li>

                <li>
                <label for="gambar">Gambar </label>
                <input type="file" name="gambar" id="gambar">
                </li>

                <li>
                <button type="submit" name="submit">TAMBAH!</button>
                </li>
            </ul>

        </form>
    </div>
</main>

</body>

</html>