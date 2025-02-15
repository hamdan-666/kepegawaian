<?php
session_start();
include 'db.php';

if ($_SESSION['status_login'] != true) {
    echo '<script>window.location="index.php"</script>';
}

if (isset($_GET['act'])) {
    // Insert
    if ($_GET['act'] == 'insert') {
        $bulan = $_POST['bulan'];
        $nip = $_POST['nip'];
        $masuk = $_POST['masuk'];
        $alfa = $_POST['alfa'];
        $izin = $_POST['izin'];
        $potongan = $_POST['potongan'];

        $count = count($nip);
        $sql = "INSERT INTO gaji (bulan, nip, masuk, alfa, izin, potongan) VALUES ";
        for ($i = 0; $i < $count; $i++) {
            $sql .= "('{$bulan[$i]}','{$nip[$i]}','{$masuk[$i]}','{$alfa[$i]}','{$izin[$i]}','{$potongan[$i]}')";
            $sql .= ",";
        }
        $sql = rtrim($sql, ",");

        $simpan = mysqli_query($conn, $sql);
        if ($simpan) {
            header('location:kehadiran.php?e=sukses');
        } else {
            header('location:kehadiran.php?e=gagal');
        }
    } elseif ($_GET['act'] == 'update') {
        $bulan = $_POST['bulan'];
        $nip = $_POST['nip'];
        $masuk = $_POST['masuk'];
        $alfa = $_POST['alfa'];
        $izin = $_POST['izin'];
        $potongan = $_POST['potongan'];

        $count = count($nip);

        for ($i = 0; $i < $count; $i++) {
            $update = mysqli_query($conn, "UPDATE gaji SET masuk='$masuk[$i]',alfa='$alfa[$i]',izin='$izin[$i]',potongan='$potongan[$i]'
            WHERE bulan='$bulan[$i]' AND nip='$nip[$i]'");
        }

        if ($update) {
            header('location:kehadiran.php?e=sukses');
        } else {
            header('location:kehadiran.php?e=gagal');
        }
    } elseif ($_GET['act'] == 'del') {
        $hapus = mysqli_query($conn, "DELETE FROM pegawai WHERE nip='$_GET[id]'");
        if ($hapus) {
            header('location:kehadiran.php?e=sukses');
        } else {
            header('location:kehadiran.php?e=gagal');
        }
    }
}
