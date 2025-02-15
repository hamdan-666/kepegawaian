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
    }

    .sidebar {
        height: 100%;
        width: 250px;
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
        height: 100%;
    }

    .alert-info {
        padding: 20px;
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
        <div class="row">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <h3 class="panel-title">Data Kehadiran</h3>
                </div>
                <div class="panel-body">
                    <form method="get" action="" class="form-inline">
                        <div class="form-group">
                            <label>Bulan</label>
                            <select name="bulan" class="form-control">
                                <option value="">-- Pilih Bulan --</option>
                                <option value="01">Januari</option>
                                <option value="02">Februari</option>
                                <option value="03">Maret</option>
                                <option value="04">April</option>
                                <option value="05">Mei</option>
                                <option value="06">Juni</option>
                                <option value="07">Juli</option>
                                <option value="08">Agustus</option>
                                <option value="09">September</option>
                                <option value="10">Oktober</option>
                                <option value="11">November</option>
                                <option value="12">Desember</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Tahun</label>
                            <select name="tahun" class="form-control">
                                <option value="">-- Pilih Tahun --</option>
                                <?php
                                        $y = date('Y');
                                        for ($i = 2024; $i <= $y; $i++) {
                                            echo "<option value='$i'>$i</option>";
                                        }
                                        ?>
                            </select>
                        </div>
                        <button class="btn btn-primary" type="submit">Tampilkan Data</button>
                        <a href="kehadiran.php?view=tambah" class="btn btn-primary">Input Kehadiran</a>
                    </form>
                    <br>
                    <?php
                            if ((isset($_GET['bulan']) && $_GET['bulan'] != '') && (isset($_GET['tahun']) && $_GET['tahun'] != '')) {
                                $bulan = $_GET['bulan'];
                                $tahun = $_GET['tahun'];
                                $bulantahun = $bulan . $tahun;
                            } else {
                                $bulan = date('m');
                                $tahun = date('y');
                                $bulantahun = $bulan . $tahun;
                            }
                            ?>
                    <div class="alert alert-info"><strong>Bulan : <?php echo $bulan; ?></strong> Tahun :
                        <?php echo $tahun; ?></div>
                    <table class="table table-bordered table-striped">
                        <tr>
                            <th>No</th>
                            <th>NIP</th>
                            <th>Nama Pegawai</th>
                            <th>Jabatan</th>
                            <th>Masuk</th>
                            <th>Izin</th>
                            <th>Alfa</th>
                            <th>Potongan</th>
                        </tr>
                        <?php
                                $sql = mysqli_query($conn, "SELECT gaji.*, pegawai.nama_pegawai, pegawai.id_jabatan, jabatan.nama_jabatan FROM gaji INNER JOIN pegawai ON gaji.nip = pegawai.nip INNER JOIN jabatan ON pegawai.id_jabatan = jabatan.id_jabatan WHERE gaji.bulan=$bulantahun ");

                                $no = 1;
                                while ($d = mysqli_fetch_array($sql)) {
                                    echo "<tr>
                                            <td>$no</td>
                                            <td>$d[nip]</td>
                                            <td>$d[nama_pegawai]</td>
                                            <td>$d[nama_jabatan]</td>
                                            <td>$d[masuk]</td>
                                            <td>$d[izin]</td>
                                            <td>$d[alfa]</td>
                                            <td>$d[potongan]</td>
                                            </tr>";
                                    $no++;
                                }
                                if (mysqli_num_rows($sql) > 0) {
                                    echo "<tr>
                                            <td colspan='8' text-align='center'>
                                                <a class='btn btn-primary' href='kehadiran.php?view=edit&bulan=$bulan&tahun=$tahun'>Edit Kehadiran</a>
                                            </td>
                                            </tr>";
                                } else {
                                    echo "<tr>
                                            <td colspan='8' text-align='center'>
                                                Belum ada data dari bulan dan tahun yang dipilih
                                            </td>
                                            </tr>";
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
                    <h3 class="panel-title">Tambah Kehadiran Pegawai</h3>
                </div>
                <div class="panel-body">
                    <form method="get" action="" class="form-inline">
                        <input type="hidden" name="view" value="tambah">
                        <div class="form-group">
                            <label>Bulan</label>
                            <select name="bulan" class="form-control">
                                <option value="">-- Pilih Bulan --</option>
                                <option value="01">Januari</option>
                                <option value="02">Februari</option>
                                <option value="03">Maret</option>
                                <option value="04">April</option>
                                <option value="05">Mei</option>
                                <option value="06">Juni</option>
                                <option value="07">Juli</option>
                                <option value="08">Agustus</option>
                                <option value="09">September</option>
                                <option value="10">Oktober</option>
                                <option value="11">November</option>
                                <option value="12">Desember</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Tahun</label>
                            <select name="tahun" class="form-control">
                                <option value="">-- Pilih Tahun --</option>
                                <?php
                                        $y = date('Y');
                                        for ($i = 2024; $i <= $y; $i++) {
                                            echo "<option value='$i'>$i</option>";
                                        }
                                        ?>
                            </select>
                        </div>
                        <button class="btn btn-primary" type="submit">Generate</button>
                    </form>
                    <br>

                    <?php
                            if ((isset($_GET['bulan']) && $_GET['bulan'] != '') && (isset($_GET['tahun']) && $_GET['tahun'] != '')) {
                                $bulan = $_GET['bulan'];
                                $tahun = $_GET['tahun'];
                                $bulantahun = $bulan . $tahun;
                            } else {
                                $bulan = date('m');
                                $tahun = date('y');
                                $bulantahun = $bulan . $tahun;
                            }
                            ?>
                    <div class="alert alert-info"><strong>Bulan : <?php echo $bulan; ?></strong> Tahun :
                        <?php echo $tahun; ?></div>
                    <form action="aksiKehadiran.php?act=insert" method="post">
                        <table class="table">
                            <tr>
                                <th>No</th>
                                <th>NIP</th>
                                <th>Nama Pegawai</th>
                                <th>Jabatan</th>
                                <th>Masuk</th>
                                <th>Izin</th>
                                <th>Alfa</th>
                                <th>Potongan</th>
                            </tr>
                            <?php
                                    $no = 1;
                                    $p = mysqli_query($conn, "SELECT pegawai.*,jabatan.nama_jabatan FROM pegawai INNER JOIN jabatan ON pegawai.id_jabatan = jabatan.id_jabatan WHERE NOT EXISTS(SELECT * FROM gaji WHERE bulan='$bulantahun' AND pegawai.nip = gaji.nip) ORDER BY pegawai.nip");
                                    $jmlPegawai = mysqli_num_rows($p);
                                    while ($d = mysqli_fetch_array($p)) {
                                    ?>
                            <input type="hidden" name="bulan[]" value="<?php echo $bulantahun ?>">
                            <input type="hidden" name="nip[]" value="<?php echo $d['nip'] ?>">
                            <tr>
                                <td><?php echo $no; ?></td>
                                <td><?php echo $d['nip']; ?></td>
                                <td><?php echo $d['nama_pegawai']; ?></td>
                                <td><?php echo $d['nama_jabatan']; ?></td>
                                <td><input type="number" name="masuk[]" class="form-control" value="0" required></td>
                                <td><input type="number" name="alfa[]" class="form-control" value="0" required></td>
                                <td><input type="number" name="izin[]" class="form-control" value="0" required></td>
                                <td><input type="number" name="potongan[]" class="form-control" value="0" required></td>
                            </tr>
                            <?php
                                        $no++;
                                    }
                                    if ($jmlPegawai > 0) {
                                    ?>
                            <tr>
                                <td colspan="4"></td>
                                <td colspan="4">
                                    <input type="submit" value="Simpan" class="btn btn-primary">
                                    <a href="kehadiran.php" class="btn btn-danger">Kembali</a>
                                </td>
                            </tr>
                            <?php
                                    } else {
                                    ?>
                            <tr>
                                <td colspan="8">
                                    <label class="label label-warning">Bulan dan Tahun sudah sudah diproses, Silahkan
                                        Edit Data</label>
                                </td>
                            </tr>
                            <?php
                                    }
                                    ?>
                        </table>
                    </form>
                </div>
            </div>
        </div>
        <?php
                break;
            case 'edit':
                $bulan =  $_GET['bulan'];
                $tahun =  $_GET['tahun'];
                $bulantahun =  $bulan . $tahun;
            ?>
        <div class="row">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <h3>Edit Data Kehadiran</h3>
                </div>
                <div class="panel-body">
                    <div class="alert alert-info"><strong>Bulan : <?php echo $bulan; ?></strong> Tahun :
                        <?php echo $tahun; ?>
                    </div>
                    <form action="aksiKehadiran.php?act=update" method="post">
                        <table class="table">
                            <tr>
                                <th>No</th>
                                <th>NIP</th>
                                <th>Nama Pegawai</th>
                                <th>Jabatan</th>
                                <th>Masuk</th>
                                <th>Izin</th>
                                <th>Alfa</th>
                                <th>Potongan</th>
                            </tr>
                            <?php
                                    $no = 1;
                                    $p = mysqli_query($conn, "SELECT gaji.*,pegawai.nama_pegawai,jabatan.nama_jabatan FROM gaji INNER JOIN pegawai ON gaji.nip = pegawai.nip INNER JOIN jabatan ON pegawai.id_jabatan = jabatan.id_jabatan WHERE gaji.bulan = '$bulantahun' ORDER BY gaji.nip");
                                    $jmlPegawai = mysqli_num_rows($p);
                                    while ($d = mysqli_fetch_array($p)) {
                                    ?>
                            <input type="hidden" name="bulan[]" value="<?php echo $bulantahun ?>">
                            <input type="hidden" name="nip[]" value="<?php echo $d['nip'] ?>">
                            <tr>
                                <td><?php echo $no; ?></td>
                                <td><?php echo $d['nip']; ?></td>
                                <td><?php echo $d['nama_pegawai']; ?></td>
                                <td><?php echo $d['nama_jabatan']; ?></td>
                                <td><input type="number" name="masuk[]" class="form-control"
                                        value="<?php echo $d['masuk']; ?>" required></td>
                                <td><input type="number" name="alfa[]" class="form-control"
                                        value="<?php echo $d['alfa']; ?>" required></td>
                                <td><input type="number" name="izin[]" class="form-control"
                                        value="<?php echo $d['izin']; ?>" required></td>
                                <td><input type="number" name="potongan[]" class="form-control"
                                        value="<?php echo $d['potongan']; ?>" required></td>
                            </tr>
                            <?php
                                        $no++;
                                    }
                                    ?>
                            <tr>
                                <td colspan="4"></td>
                                <td colspan="4">
                                    <input type="submit" value="Update" class="btn btn-primary">
                                    <a href="kehadiran.php" class="btn btn-danger">Kembali</a>
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