<?php

session_start();

if (!isset ($_SESSION["login"])){
    header("location: login.php");
    exit;
}

    require "admin_function.php";   

    $id = $_GET["id"];

    if(hapusdata($id) > 0){
        echo "
        <script>
            alert ('sukses dihapus');
            document.location.href = 'admin.php';
        </script>
        ";
    } else {
        echo "
        <script>
            alert ('gagal dihapus');
            document.location.href = 'admin.php';
        </script>
        ";
    }

?>