<?php  

    session_start();

    if (!isset ($_SESSION["login"])){
    header("location: login.php");
    exit;
    
    }
    
    require "admin_function.php";

    //ambil data di url
    $id =$_GET["id"];

    //query data mahasiswa berdasarkan id
    $buku = query("SELECT * FROM buku WHERE id=$id")[0];

    //cek tombol tubah sudah di pencet atau blm
    if ( isset($_POST["submit"]) ){

        //cek apakah data berhasil diubah atau tidak
        if (ubahdata($_POST) > 0){
            echo "
            <script>
                alert ('sukses diubah');
                document.location.href = 'admin.php';
            </script>
            ";
        } else{
            echo "
            <script>
                alert ('gagal diubah');
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

        <a href="tambahbuku.php" class="nav-link">
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

        <div class="div-logout">
        <a  class="logout" href="">Logout</a>
        </div>

    </div>

    <div class="third-doc">
        
        <h3>UBAH DATA BUKU</h3>

        <div class="border"></div>
    
        <form action="" method="post" enctype="multipart/form-data">
        <input type="hidden" name="id" value="<?php echo $buku["id"]; ?>">
        <input type="hidden" name="gambarLama" value="<?php echo $buku["gambar"]; ?>">
            
            <ul>

                <li>
                <label for="isbn">ISBN</label>
                <input type="text" name="isbn" id="isbn" value="<?php echo $buku["isbn"]; ?>">
                </li>

                <li>
                <label for="judul">Judul*</label>
                <input type="text" name="judul" id="judul" value="<?php echo $buku["judul"]; ?>" required>
                </li>

                <li>
                <label for="pengarang">Pengarang*</label>
                <input type="text" name="pengarang" id="pengarang" value="<?php echo $buku["pengarang"]; ?>" required>
                </li>

                <li>
                <label for="penerbit">Penerbit*</label>
                <input type="text" name="penerbit" id="penerbit" value="<?php echo $buku["penerbit"]; ?>" required>
                </li>

                <li>
                <label for="thn_terbit">Tahun Terbit</label>
                <input type="text" name="thn_terbit" id="thn_terbit" value="<?php echo $buku["thn_terbit"]; ?>">
                </li>

                <li>
                <label for="gambar">Gambar</label>
                <img src="img/<?php echo$buku['gambar']; ?>" alt="" style="width: 100px;">
                <input type="file" name="gambar" id="gambar" value="<?php echo $buku["gambar"]; ?>" required>
                </li>

                <li>
                <button type="submit" name="submit">Ubah!</button>
                </li>
            </ul>

        </form>
</div>

</main>

</body>

</html>