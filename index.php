<?php
    include 'koneksi.php';
    session_start();

    $query = "SELECT * FROM tb_siswa;";
    $sql = mysqli_query($conn,$query);
    $no = 0;
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <script src="js/bootstrap.bundle.min.js"></script>

    <!-- Font Awesome -->
    <link rel="stylesheet" href="fontawesome/css/font-awesome.min.css">

    <!-- Data Tables -->
    <link rel="stylesheet" type="text/css" href="datatables/datatables.css"/>
    <script type="text/javascript" src="datatables/datatables.js"></script>

    <title>CRUD</title>
</head>

<script type="text/javascript">
    $(document).ready(function(){
        $('#dt').DataTable();
    } );
</script>

<body>
    <nav class="navbar navbar-light bg-light">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">
                CRUD - BS5
            </a>
        </div>
    </nav>

    <!-- Judul -->
    <div class="container">
        <h1 class="mt-4">Data Siswa</h1>
        <figure>
            <blockquote class="blockquote">
                <p>Berisi data yang telah disimpan di database</p>
            </blockquote>
            <figcaption class="blockquote-footer">
                CRUD <cite title="Source Title">Create Read Update Delete</cite>
            </figcaption>
        </figure>

        <!-- Button Tambah Data (di bootstrap primary itu warna biru)-->
        <!-- mb-3 (margin buttom-3) -->
        <a href="kelola.php" type="button" class="btn btn-primary mb-3">
            <i class="fa fa-plus"></i>
            Tambah Data</a>

        <!-- Alert -->
        <?php
            if (isset($_SESSION['eksekusi'])):
        ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>
            <?php
            session_destroy();
                echo $_SESSION['eksekusi'];
            ?>
        </strong> 
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        <?php
            endif;
        ?>

        <!-- Tabel -->
        <div class="table-responsive">
            <table id="dt" class="table align-middle cell-border cell-border hover">
                <thead>
                    <tr>    
                        <th><center>No.</center></th>
                        <th>NISN</th>
                        <th>Nama Siswa</th>
                        <th>Jenis Kelamin</th>
                        <th>Foto Siswa</th>
                        <th>Alamat</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        while ($result = mysqli_fetch_assoc($sql)) {
                    ?>
                    <tr>
                        <!-- Pastikan kolom yang ada pada head dan kolom yang ada di body itu sama jumlahnya -->
                        <td><center>
                        <?php echo ++$no;?>.  
                        </center></td>
                        <td>
                            <?php echo $result['nisn'];?></td>
                        <td><?php echo $result['nama_siswa'];?></td>
                        <td><?php echo $result['jenis_kelamin'];?></td>
                        <td><img src="img/<?php echo $result['foto_siswa'];?>" style="width: 150px;"></td>
                        <td><?php echo $result['alamat'];?></td>
                        
                        <td>
                            <!-- Button Edit (di bootstrap danger itu warna hijau)-->
                            <a href="kelola.php?ubah=<?php echo $result['id_siswa'];?>" type="button" class="btn btn-success btn-sm">
                                <i class="fa fa-pencil"></i>
                                Edit</a>
                            <!-- Button Hapus (di bootstrap danger itu warna merah)-->
                            <a href="proses.php?hapus=<?php echo $result['id_siswa'];?>" type="button" class="btn btn-danger btn-sm" OnClick="return confirm('Apakah anda yakin ingin menghapus data tersebut???')">
                                <i class="fa fa-trash"></i>
                                Hapus
                            </a>
                        </td>
                    </tr>
                    <?php
                        }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>