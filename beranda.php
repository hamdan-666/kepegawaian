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

        /* Container styles */
        .container {
            margin-left: 280px;
            padding: 20px;
            width: 70%;
            display: flex;
            /* Menambahkan flexbox */
            justify-content: space-between;
            /* Memberikan jarak antar box */
            align-items: center;
            /* Menyusun elemen di tengah secara vertikal */
        }

        .panel {
            background-color: rgb(106, 109, 106);
            border: 1px solid #ddd;
            border-radius: 5px;
            margin-top: 20px;
            color: #ffff;
            width: 30%;
            /* Memberikan lebar untuk setiap panel */
        }

        .panel-heading {
            background-color: #555;
            color: white;
            text-align: center;
            padding: 10px;
        }

        .panel-body {
            text-align: center;
            font-size: 36px;
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
        <!-- Box untuk menampilkan total pegawai -->
        <div class="panel panel-primary">
            <div class="panel-heading">
                <h3 class="panel-title">Total Pegawai</h3>
            </div>
            <?php
            // Query untuk menghitung jumlah total pegawai
            $sql = "SELECT COUNT(*) as total_pegawai FROM pegawai";
            $result = mysqli_query($conn, $sql);
            $data = mysqli_fetch_assoc($result);

            // Ambil total pegawai
            $total_pegawai = $data['total_pegawai'];
            ?>

            <div class="panel-body">
                <h2><?php echo $total_pegawai; ?></h2>
            </div>
        </div>

        <!-- Box untuk menampilkan total jabatan -->
        <div class="panel panel-primary">
            <div class="panel-heading">
                <h3 class="panel-title">Total Jabatan</h3>
            </div>
            <?php
            // Query untuk menghitung jumlah total jabatan
            $sqla = "SELECT COUNT(*) as total_jabatan FROM jabatan";
            $result = mysqli_query($conn, $sqla);
            $data = mysqli_fetch_assoc($result);

            // Ambil total jabatan
            $total_jabatan = $data['total_jabatan'];
            ?>

            <div class="panel-body">
                <h2><?php echo $total_jabatan; ?></h2>
            </div>
        </div>

        <!-- Box untuk menampilkan total golongan -->
        <div class="panel panel-primary">
            <div class="panel-heading">
                <h3 class="panel-title">Total Golongan</h3>
            </div>
            <?php
            // Query untuk menghitung jumlah total golongan
            $sqle = "SELECT COUNT(*) as total_golongan FROM golongan";
            $result = mysqli_query($conn, $sqle);
            $data = mysqli_fetch_assoc($result);

            // Ambil total golongan
            $total_golongan = $data['total_golongan'];
            ?>

            <div class="panel-body">
                <h2><?php echo $total_golongan; ?></h2>
            </div>
        </div>
    </div>

    <!-- Bootstrap core JavaScript -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

</body>

</html>