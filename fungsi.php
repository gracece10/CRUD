<?php
    include 'koneksi.php'; // Mengimpor file 'koneksi.php' yang berisi koneksi ke database.

    // Fungsi untuk menambahkan data siswa ke dalam database.
    function tambah_data($data,$files){   
        $nisn = $data['nisn']; // Mengambil data NISN dari formulir.
        $nama_siswa = $data['nama_siswa']; // Mengambil data nama siswa dari formulir.
        $jenis_kelamin = $data['jenis_kelamin']; // Mengambil data jenis kelamin dari formulir.

        // Memproses file foto siswa yang diunggah.
        $split = explode('.',$files['foto']['name']); // Membagi nama file berdasarkan titik.

        $ekstensi = $split[count($split)-1]; // Mengambil ekstensi file.
        $foto = $nisn.'.'.$ekstensi; // Menentukan nama file foto siswa.
        $alamat = $data['alamat']; // Mengambil data alamat dari formulir.

        // Menentukan direktori penyimpanan foto siswa dan memindahkan file foto ke direktori tersebut.
        $directory = "img/";
        $tmpFile = $files['foto']['tmp_name'];
        move_uploaded_file($tmpFile,$directory.$foto);

        // Query untuk menambahkan data siswa ke dalam tabel 'tb_siswa'.
        $query = "INSERT INTO tb_siswa VALUES(null, '$nisn', '$nama_siswa', '$jenis_kelamin','$foto','$alamat')";
        $sql = mysqli_query($GLOBALS['conn'],$query); // Menjalankan query.

        return true; // Mengembalikan nilai true sebagai indikasi berhasilnya operasi.
    }

    // Fungsi untuk mengubah data siswa dalam database.
    function ubah_data($data,$files){
        $id_siswa = $data['id_siswa']; // Mengambil ID siswa dari formulir.
        $nisn = $data['nisn']; // Mengambil data NISN dari formulir.
        $nama_siswa = $data['nama_siswa']; // Mengambil data nama siswa dari formulir.
        $jenis_kelamin = $data['jenis_kelamin']; // Mengambil data jenis kelamin dari formulir.
        $alamat = $data['alamat']; // Mengambil data alamat dari formulir.

        // Mengambil data siswa berdasarkan ID siswa untuk memperoleh informasi foto sebelumnya.
        $queryShow = "SELECT * FROM tb_siswa WHERE id_siswa = '$id_siswa';";
        $sqlShow = mysqli_query($GLOBALS['conn'],$queryShow);
        $result = mysqli_fetch_assoc($sqlShow);

        // Memeriksa apakah file foto diunggah. Jika tidak, gunakan foto yang ada sebelumnya.
        if ($files['foto']['name'] =="") {
            $foto = $result['foto_siswa'];
        } else {
            $split = explode('.',$files['foto']['name']);
            $ekstensi = $split[count($split)-1];

            // Menentukan nama file foto siswa yang baru.
            $foto = $result['nisn'].'.'.$ekstensi;
            unlink("img/".$result['foto_siswa']); // Menghapus foto lama dari direktori.
            move_uploaded_file($files['foto']['tmp_name'], 'img/'. $foto); // Memindahkan foto baru ke direktori.
        }
      
        // Query untuk memperbarui data siswa dalam tabel 'tb_siswa' berdasarkan ID siswa.
        $query = "UPDATE tb_siswa SET nisn='$nisn', nama_siswa='$nama_siswa',jenis_kelamin='$jenis_kelamin',alamat='$alamat', foto_siswa = '$foto' WHERE id_siswa = '$id_siswa';";
        
        $sql = mysqli_query($GLOBALS['conn'],$query); // Menjalankan query.

        return true; // Mengembalikan nilai true sebagai indikasi berhasilnya operasi.
    }

    // Fungsi untuk menghapus data siswa dari database.
    function hapus_data($data){
        $id_siswa = $data['hapus']; // Mengambil ID siswa yang akan dihapus.

        // Mengambil data siswa berdasarkan ID siswa untuk memperoleh informasi foto.
        $queryShow = "SELECT * FROM tb_siswa WHERE id_siswa = '$id_siswa';";
        $sqlShow = mysqli_query($GLOBALS['conn'],$queryShow);
        $result = mysqli_fetch_assoc($sqlShow);

        // Menghapus foto siswa dari direktori.
        unlink("img/".$result['foto_siswa']);

        // Query untuk menghapus data siswa dari tabel 'tb_siswa' berdasarkan ID siswa.
        $query = "DELETE FROM tb_siswa WHERE id_siswa = '$id_siswa';";
        $sql = mysqli_query($GLOBALS['conn'],$query); // Menjalankan query.

        return true; // Mengembalikan nilai true sebagai indikasi berhasilnya operasi.
    }
?>
