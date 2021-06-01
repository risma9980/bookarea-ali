<?php

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
    <link rel="stylesheet" href="listbuku.css">
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
    <title>Panel Admin</title>
</head>

<body>

    <div class="navigasi">

      <div>
        <h1>Bookarea-Ali</h1>
      </div>
   
        <ul>
          <li><a href="index.html">Beranda</a></li>
          <li><a href="index.html#four-why">Kenapa membaca?</a></li>
          <li><a href="listbuku.php">Cari Buku</a></li>
          <li><a href="login.php">Login</a></li>
        </ul>
     
    </div>
    
    <main id="main-doc">

        <div class="third-doc">

          <div class="div-form">
            <form action="" method="post" class="fcari">
            <input type="text" name="keyword" size="45" autofocus placeholder="Cari buku...." autocomplete="off">
            <button type="submit" name="cari" >CARI</button>
            </form>
          </div>
        
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
            </tr>
          <?php $i= 1;?>
        
          <?php 
          //mengembalikan array assosiativ
          foreach ($buku as $buk) :?>
            <tr>
                <td><?php echo $i; ?></td>
                <td><img src="img/<?php echo $buk["gambar"]; ?>" alt="" class="td-img" style="width:100px;"></td>
                <td><?php echo $buk["isbn"]; ?></td>
                <td><?php echo $buk["judul"]; ?></td>
                <td><?php echo $buk["pengarang"]; ?></td>
                <td><?php echo $buk["penerbit"]; ?></td>
                <td><?php echo $buk["thn_terbit"]; ?></td>
            </tr>
            <?php $i++ ?>
           <?php endforeach; ?>
          </table>
        </div>
    
    </main>

</body>
</html>