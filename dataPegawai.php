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
                    <h3 class="panel-title">Data Pegawai</h3>
                </div>
                <div class="panel-body">
                    <a href="dataPegawai.php?view=tambah" class="btn btn-primary" style="margin-bottom: 10px;">Tambah
                        Data</a>
                    <table class="table table-bordered table-striped">
                        <tr>
                            <th>No</th>
                            <th>NIP</th>
                            <th>Nama Pegawai</th>
                            <th>Nama Jabatan</th>
                            <th>Nama Golongan</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                        <?php
                                $sql = mysqli_query($conn, "SELECT pegawai.*,jabatan.nama_jabatan,golongan.nama_golongan FROM pegawai INNER JOIN jabatan ON pegawai.id_jabatan = jabatan.id_jabatan INNER JOIN golongan ON pegawai.id_golongan = golongan.id_golongan");
                                $no = 1;
                                while ($d = mysqli_fetch_array($sql)) {
                                    echo "<tr>
                                <td width='40px' align='center'>$no</td>
                                <td>$d[nip]</td>
                                <td>$d[nama_pegawai]</td>
                                <td>$d[nama_jabatan]</td>
                                <td>$d[nama_golongan]</td>
                                <td>$d[status]</td>
                                <td width='160px' align='center'><a class='btn btn-warning btn-sm'href='dataPegawai.php?view=edit&id=$d[nip]'>Edit</a>
                                <a class='btn btn-danger btn-sm'href='aksiPegawai.php?act=del&id=$d[nip]'>Hapus</a></td>
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
            ?>

        <div class="row">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <h3 class="panel-title">Tambah Data Pegawai</h3>
                </div>
                <div class="panel-body">
                    <form action="aksiPegawai.php?act=insert" method="post">
                        <table class="table">
                            <tr>
                                <td width="160px">NIP</td>
                                <td><input class="form-control" type="text" name="nip" required></td>
                            </tr>
                            <tr>
                                <td>Nama Pegawai</td>
                                <td>
                                    <input class="form-control" type="text" name="nama_pegawai" required>
                                </td>
                            </tr>
                            <tr>
                                <td>Jabatan</td>
                                <td>
                                    <select name="jabatan" class="form-control">
                                        <option value="">-- Pilih Jabatan --</option>
                                        <?php
                                                $sqlJabatan = mysqli_query($conn, "SELECT * FROM jabatan");
                                                while ($j = mysqli_fetch_array($sqlJabatan)) {
                                                    echo "<option value='$j[id_jabatan]'>$j[nama_jabatan]</option>";
                                                }
                                                ?>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td>Golongan</td>
                                <td>
                                    <select name="golongan" class="form-control">
                                        <option value="">-- Pilih Golongan --</option>
                                        <?php
                                                $sqlGolongan = mysqli_query($conn, "SELECT * FROM golongan");
                                                while ($g = mysqli_fetch_array($sqlGolongan)) {
                                                    echo "<option value='$g[id_golongan]'>$g[nama_golongan]</option>";
                                                }
                                                ?>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td>Status</td>
                                <td>
                                    <select name="status" class="form-control">
                                        <option value="">-- Pilih Status --</option>
                                        <option value="Menikah">Menikah</option>
                                        <option value="Belum Menikah">Belum Menikah</option>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td></td>
                                <td><input class="btn btn-primary" type="submit" value="Simpan">
                                    <a href="dataPegawai.php" class="btn btn-danger">Kembali</a>
                                </td>
                            </tr>
                        </table>
                    </form>
                </div>
                <?php
                    break;
                case 'edit':
                    $sqlEdit = mysqli_query($conn, "SELECT * FROM pegawai WHERE nip = '$_GET[id]'");
                    $e = mysqli_fetch_array($sqlEdit);
                    ?>

                <div class="row">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <h3 class="panel-title">Edit Data Pegawai</h3>
                        </div>
                        <div class="panel-body">
                            <form action="aksiPegawai.php?act=update" method="post">
                                <table class="table">
                                    <tr>
                                        <td width="160px">NIP</td>
                                        <td><input class="form-control" type="text" name="nip"
                                                value="<?php echo $e['nip'] ?>" readonly></td>
                                    </tr>
                                    <tr>
                                        <td>Nama Pegawai</td>
                                        <td>
                                            <input class="form-control" type="text" name="nama_pegawai"
                                                value="<?php echo $e['nama_pegawai'] ?>" required>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Jabatan</td>
                                        <td>
                                            <select name="jabatan" class="form-control">
                                                <option value="">-- Pilih Jabatan --</option>
                                                <?php
                                                        $sqlJabatan = mysqli_query($conn, "SELECT * FROM jabatan");
                                                        while ($j = mysqli_fetch_array($sqlJabatan)) {
                                                            $selected = ($j['id_jabatan'] == $e['id_jabatan']) ? 'selected = "selected"' : '';
                                                            echo "<option value='$j[id_jabatan]' $selected>$j[nama_jabatan]</option>";
                                                        }
                                                        ?>
                                            </select>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Golongan</td>
                                        <td>
                                            <select name="golongan" class="form-control">
                                                <option value="">-- Pilih Golongan --</option>
                                                <?php
                                                        $sqlGolongan = mysqli_query($conn, "SELECT * FROM golongan");
                                                        while ($g = mysqli_fetch_array($sqlGolongan)) {
                                                            $selected = ($g['id_golongan'] == $e['id_golongan']) ? 'selected = "selected"' : '';
                                                            echo "<option value='$g[id_golongan]' $selected>$g[nama_golongan]</option>";
                                                        }
                                                        ?>
                                            </select>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Status</td>
                                        <td>
                                            <select name="status" class="form-control">
                                                <option value="<?php echo $e['status'] ?>" selected>
                                                    <?php echo $e['status'] ?></option>
                                                <option value="Menikah">Menikah</option>
                                                <option value="Belum Menikah">Belum Menikah</option>
                                            </select>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td></td>
                                        <td><input class="btn btn-primary" type="submit" value="Simpan">
                                            <a href="dataPegawai.php" class="btn btn-danger">Kembali</a>
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