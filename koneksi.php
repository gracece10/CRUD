<?php
    $host = 'localhost';
    $username = 'root';
    $pass = '';
    $db = 'db_sekolah';
    $conn = mysqli_connect($host,$username,$pass,$db);
    if ($conn) {
        //echo "Koneksi Berhasil";
    }

    mysqli_select_db($conn, $db);
?>