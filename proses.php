<?php
include 'fungsi.php'; // Mengimpor file 'fungsi.php'.
session_start();

// Memeriksa apakah terdapat aksi yang dikirim melalui metode POST.
if (isset($_POST['aksi'])) {//Button Tambahkan
    // Jika aksi adalah 'add', tambahkan data dengan memanggil fungsi 'tambah_data'.
    if ($_POST['aksi']=="add") {

        $berhasil = tambah_data($_POST,$_FILES); // Memanggil fungsi 'tambah_data' untuk menambahkan data ke dalam database.
        
        if ($berhasil) {
            $_SESSION['eksekusi'] = "Data Berhasil Ditambahkan";
            header("location: index.php");
        } else {
            echo $berhasil;
        }
    } elseif ($_POST['aksi'] == "edit") { // Jika aksi adalah 'edit', ubah data dengan memanggil fungsi 'ubah_data'.
     
        $berhasil = ubah_data($_POST,$_FILES);

        if ($berhasil) {
            $_SESSION['eksekusi'] = "Data Berhasil Diperbarui";
            header("location: index.php");
        } else {
            echo $berhasil;
        }
    }
}
    // Memeriksa apakah terdapat parameter GET 'hapus'.
    if (isset($_GET['hapus'])) {

        // Hapus data dengan memanggil fungsi 'hapus_data'.
        $berhasil = hapus_data($_GET);

        // Jika data berhasil dihapus, atur pesan sesi dan alihkan kembali ke halaman utama.
        if ($berhasil) {
            $_SESSION['eksekusi'] = "Data Berhasil Dihapus";
            header("location: index.php");
        } else {
            echo $query; //Jika terjadi kesalahan, tampilkan pesan kesalahan.
    }
}
?>