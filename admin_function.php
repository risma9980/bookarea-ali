<?php 

// menghubungkan ke database
$conn = mysqli_connect("localhost", "root", "", "perpusonline");

function query ($query) {
    global $conn;
    $result = mysqli_query($conn, $query);
    //menyiapkan wadah kosong
    $rows =[];
    //mengambil data dg cara looping
    while ($row = mysqli_fetch_assoc($result)){
        $rows[] = $row;
    }
    return $rows;
}

function tambahdata($data){

    global $conn;

    //ambil data dari tiap elemen dalam form
    $isbn = htmlspecialchars ($data["isbn"]);
    $judul = htmlspecialchars($data["judul"]);
    $pengarang = htmlspecialchars($data["pengarang"]);
    $penerbit = htmlspecialchars($data["penerbit"]);
    $thn_terbit = htmlspecialchars($data["thn_terbit"]);
    
    $gambar = uploadgambar();
    if (!$gambar){
        return false;
    }

    //query tambah data
    $query = "INSERT INTO buku VALUES
            ('', '$isbn', '$judul', '$pengarang', '$penerbit', '$thn_terbit', '$gambar' ) 
            "; 

    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}

function uploadgambar() {
    $namaFile = $_FILES['gambar']['name'];
    $ukuranFile = $_FILES['gambar']['size'];
    $error = $_FILES['gambar']['error'];
    $tmpName = $_FILES['gambar']['tmp_name'];

    //cek ada gambar yang diupload atau tidak
    if($error == 4){
        echo "
            <script>
                alert('pilih gambar dulu');
            </script>
        ";
    return false;
    }

    //cek yang diupload hanya gambar
    $ekstensiGambarValid = ['jpg', 'jpeg', 'png'];
    $ekstensiGambar = explode('.', $namaFile);
    $ekstensiGambar = strtolower(end($ekstensiGambar));

    if (!in_array($ekstensiGambar, $ekstensiGambarValid) ){
        echo "
            <script>
                alert('yang km upload bukan gambar!');
            </script>
        ";
        return false;
    }

    //cek jika ukuran terlalu besar
    if ($ukuranFile > 1000000) {
        echo "
            <script>
            alert('ukuran file terlalu besar');
            </script>
        ";
        return false;
    }

    //generate nama gambar baru
    $namaFileBaru = uniqid();
    $namaFileBaru .= '.';
    $namaFileBaru .= $ekstensiGambar;


    //lolos checking, gambar siap di upload
    move_uploaded_file($tmpName,'img/' .$namaFileBaru );

    return $namaFileBaru;
}


function hapusdata($id){
    global $conn;

    mysqli_query($conn,"DELETE FROM buku WHERE id= $id");

    return mysqli_affected_rows($conn);
}

function ubahdata($data){
    
    global $conn;

    //ambil data dari tiap elemen dalam form
    $id = $data["id"];
    $isbn = htmlspecialchars ($data["isbn"]);
    $judul = htmlspecialchars($data["judul"]);
    $pengarang = htmlspecialchars($data["pengarang"]);
    $penerbit = htmlspecialchars($data["penerbit"]);
    $thn_terbit = htmlspecialchars($data["thn_terbit"]);
    $gambarLama = htmlspecialchars($data["gambarLama"]);
    
    if($_FILES['gambar']['error'] == 4){
        $gambar = $gambarLama;
     } else{
         $gambar = uploadgambar();
     }

    //query tambah data
    $query = "UPDATE buku SET
                isbn = '$isbn', 
                judul = '$judul', 
                pengarang = '$pengarang', 
                penerbit = '$penerbit', 
                thn_terbit = '$thn_terbit', 
                gambar = '$gambar'
            WHERE id = $id
            
            "; 

    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}

function caridata($keyword){
    $query = "SELECT * FROM buku
        WHERE
    isbn LIKE '%$keyword%' OR
    judul LIKE '%$keyword%' OR
    pengarang LIKE '%$keyword%' OR
    penerbit LIKE '%$keyword%'OR
    thn_terbit LIKE '%$keyword%'
    ";
    return query($query);
}

function tambahuser($data) {
    global $conn;

    $username = strtolower(stripslashes($data ["username"]));
    $password = mysqli_real_escape_string($conn, $data ["password"]);
    $password2 = mysqli_real_escape_string($conn, $data ["password2"]);

    //cek username sudah ada di database atau belum 
    $result = mysqli_query($conn, "SELECT username FROM tambahuser WHERE username = '$username'");

    if (mysqli_fetch_assoc($result)){
        echo " <script>
                alert('username sudah terdaftar');
            </script>";
        return false;
    }

    //cek konfirmasi password
    if ($password !== $password2){
        echo "
            <script>
                alert('password tidak sesuai');
            </script> ";
        return false;
    }

    //enkripsi password
    $password = password_hash($password, PASSWORD_DEFAULT);

    //tambahkan username baru ke database
    mysqli_query($conn, "INSERT INTO tambahuser VALUES('', '$username', '$password')");

    return mysqli_affected_rows($conn);

}

?>