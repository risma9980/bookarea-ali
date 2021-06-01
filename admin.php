<?php

session_start();

if (!isset ($_SESSION["login"])){
    header("location: login.php");
    exit;
}

require "admin_function.php";

//mengambil array dari database
$buku = query ("SELECT * FROM buku");

if (isset($_POST["cari"])){
    $buku = caridata($_POST["keyword"]);
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="admin.css">
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

        <a href="#beranda" class="nav-link"  style="color: lightblue;"> 
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

        <div class="div-form">
        <form action="" method="post" class="fcari">

        <input type="text" name="keyword" size="45" autofocus placeholder="Cari buku...." autocomplete="off">
        
        <button type="submit" name="cari" >CARI</button>

        </form>
        </div>

        <div class="div-logout">
        <a class="logout" href="logout.php">Logout</a>
        
        </div>

        </div>

        <div class="third-doc">

        <h3> DATABASE BUKU</h3>
        

        <div class="border"></div>

        <div class="div-table">
        <table border=1 cellpadding= 10 cellspacing= 0>
    
            <tr>
                <th>No.</th>
                <th>Gambar</th>
                <th>ISBN</th>
                <th>Judul</th>
                <th>Pengarang</th>
                <th>Penerbit</th>
                <th>Tahun Terbit</th>
                <th>Edit</th>
                <th>Hapus</th>
            </tr>

          <?php $i= 1;?>
        
        <?php 
        
        //mengembalikan array assosiativ
        foreach ($buku as $buk) :?>
        <tr>
            
            <td><?php echo $i; ?></td>
            
            <td><img src="img/<?php echo $buk["gambar"]; ?>" alt="" class="td-img" style="width:100px;" ></td>
            <td><?php echo $buk["isbn"]; ?></td>
            <td><?php echo $buk["judul"]; ?></td>
            <td><?php echo $buk["pengarang"]; ?></td>
            <td><?php echo $buk["penerbit"]; ?></td>
            <td><?php echo $buk["thn_terbit"]; ?></td>

            <td>
                <a href="ubahbuku.php?id=<?php echo $buk["id"];?>">
                <button class="td-btn-edit">
                EDIT
                </button>
                </a>
            </td>

            <td>
                <a href="hapusbuku.php?id=<?php echo $buk["id"];?>" onclick='return confirm("km yakin?");'>
                <button class="td-btn-del">
                HAPUS
                </button>
                </a>
            </td>
       
        </tr>

     <?php $i++ ?>

    <?php endforeach; ?>

    </table>
    </div>
        </div>
    
    </main>

</body>
</html>