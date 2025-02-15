<?php
session_start();
if ($_SESSION['status_login'] != true) {
    echo '<script>window.location="index.php"</script>';
}
include 'db.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../favicon.ico">

    <title>Dashboard Pegawai</title>

    <!-- Bootstrap core CSS -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="sticky-footer-navbar.css" rel="stylesheet">

    <style>
    /* Sidebar styles */
    body {
        padding-top: 50px;
        height: 100%;
        width: 100%;
        display: flex;
        flex-direction: column;
    }

    .sidebar {
        height: 100%;
        width: 20%;
        position: fixed;
        top: 0;
        left: 0;
        background-color: #222;
        padding-top: 10px;
    }

    .sidebar a {
        color: white;
        padding: 10px 15px;
        text-decoration: none;
        font-size: 18px;
        display: block;
        margin-top: 20px;
    }

    .sidebar a:hover {
        background-color: #575757;
    }

    .container {
        margin-left: 280px;
        padding: 20px;
        width: 70%;
    }
    </style>
</head>

<body>

    <!-- Sidebar -->
    <div class="sidebar">
        <a href="beranda.php">Dashboard</a>
        <a href="dataPegawai.php">Data Pegawai</a>
        <a href="dataJabatan.php">Data Jabatan</a>
        <a href="dataGolongan.php">Data Golongan</a>
        <a href="kehadiran.php">Kehadiran</a>
        <a href="logout.php">Logout</a>
    </div>

    <!-- Page content -->
    <div class="container">
        <?php
        $view = isset($_GET['view']) ? $_GET['view'] : null;
        switch ($view) {
            default:
        ?>
        <?php
                if (isset($_GET['e']) && $_GET['e'] == 'sukses') {
                ?>
        <div class="row">
            <div class="col-md-4 col-md-offset-4">
                <div class="alert alert-success alert-dismissible" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                            aria-hidden="true">&times;</span></button>
                    <strong>Selamat</strong> Proses Berhasil
                </div>
            </div>
        </div>
        <?php
                } elseif (isset($_GET['e']) && $_GET['e'] == 'gagal') {
                ?>
        <div class="row">
            <div class="col-md-4 col-md-offset-4">
                <div class="alert alert-danger alert-dismissible" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                            aria-hidden="true">&times;</span></button>
                    <strong>Error!</strong> Proses Gagal
                </div>
            </div>
        </div>
        <?php
                }
                ?>
        <div class="row">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <h3 class="panel-title">Data Golongan</h3>
                </div>
                <div class="panel-body">
                    <a href="dataGolongan.php?view=tambah" class="btn btn-primary" style="margin-bottom: 10px;">Tambah
                        Data</a>
                    <table class="table table-bordered table-striped">
                        <tr>
                            <th>No</th>
                            <th>ID Golongan</th>
                            <th>Nama Golongan</th>
                            <th>Tunjangan Keluarga</th>
                            <th>Asuransi</th>
                            <th>Aksi</th>
                        </tr>
                        <?php
                                $sql = mysqli_query($conn, "SELECT * FROM golongan");
                                $no = 1;
                                while ($d = mysqli_fetch_array($sql)) {
                                    echo "<tr>
                                <td width='40px' align='center'>$no</td>
                                <td>$d[id_golongan]</td>
                                <td>$d[nama_golongan]</td>
                                <td>$d[tunjangan_keluarga]</td>
                                <td>$d[asuransi]</td>
                                <td width='160px' align='center'><a class='btn btn-warning btn-sm'href='dataGolongan.php?view=edit&id=$d[id_golongan]'>Edit</a>
                                <a class='btn btn-danger btn-sm'href='aksiGolongan.php?act=del&id=$d[id_golongan]'>Hapus</a></td>
                            </tr>";
                                    $no++;
                                }
                                ?>
                    </table>
                </div>
            </div>
        </div>
        <?php
                break;
            case 'tambah':
                $simbol = 'A';
                $query = mysqli_query($conn, "SELECT max(id_golongan) AS last FROM golongan WHERE id_golongan LIKE '$simbol%'");
                $data = mysqli_fetch_array($query);
                $idTerakhir = $data['last'];
                $nomorTerakhir = substr($idTerakhir, 1, 3);
                $nextNomor = $nomorTerakhir + 1;
                $nextId = $simbol . sprintf('%03s', $nextNomor);
            ?>

        <div class="row">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <h3 class="panel-title">Tambah Data Golongan</h3>
                </div>
                <div class="panel-body">
                    <form action="aksiGolongan.php?act=insert" method="post">
                        <table class="table">
                            <tr>
                                <td width="160px">ID Golongan</td>
                                <td><input class="form-control" type="text" name="id_golongan"
                                        value="<?php echo $nextId ?>" readonly></td>
                            </tr>
                            <tr>
                                <td>Nama Golongan</td>
                                <td>
                                    <input class="form-control" type="text" name="nama_golongan" required>
                                </td>
                            </tr>
                            <tr>
                                <td>Tunjangan Keluarga</td>
                                <td>
                                    <input class="form-control" type="number" name="tunjangan_keluarga" required>
                                </td>
                            </tr>
                            <tr>
                                <td>Asuransi</td>
                                <td>
                                    <input class="form-control" type="number" name="asuransi" required>
                                </td>
                            </tr>
                            <tr>
                                <td></td>
                                <td><input class="btn btn-primary" type="submit" value="Simpan">
                                    <a href="dataGolongan.php" class="btn btn-danger">Kembali</a>
                                </td>
                            </tr>
                        </table>
                    </form>
                </div>
                <?php
                    break;
                case 'edit':
                    $sqlEdit = mysqli_query($conn, "SELECT * FROM golongan WHERE id_golongan = '$_GET[id]'");
                    $e = mysqli_fetch_array($sqlEdit);
                    ?>

                <div class="row">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <h3 class="panel-title">Edit Data Golongan</h3>
                        </div>
                        <div class="panel-body">
                            <form action="aksiGolongan.php?act=update" method="post">
                                <table class="table">
                                    <tr>
                                        <td width="160px">ID Golongan</td>
                                        <td>
                                            <input type="text" name="id_golongan" class="form-control"
                                                value="<?php echo $e['id_golongan'] ?>" readonly>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Nama Golongan</td>
                                        <td>
                                            <input type="text" name="nama_golongan" class="form-control"
                                                value="<?php echo $e['nama_golongan'] ?>" required>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Tunjangan Keluarga</td>
                                        <td>
                                            <input type="number" name="tunjangan_keluarga" class="form-control"
                                                value="<?php echo $e['tunjangan_keluarga'] ?>" required>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Asuransi</td>
                                        <td>
                                            <input type="number" name="asuransi" class="form-control"
                                                value="<?php echo $e['asuransi'] ?>" required>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td></td>
                                        <td><input class="btn btn-primary" type="submit" value="Update Data">
                                            <a href="dataGolongan.php" class="btn btn-danger">Kembali</a>
                                        </td>
                                    </tr>
                                </table>
                            </form>
                        </div>
                    </div>
                </div>
                <?php
                    break;
            }
                ?>
            </div>

            <!-- Bootstrap core JavaScript -->
            <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
            <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

</body>

</html>