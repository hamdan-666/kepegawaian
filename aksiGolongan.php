<?php
session_start();
include 'db.php';

if ($_SESSION['status_login'] != true) {
    echo '<script>window.location="index.php"</script>';
}

if (isset($_GET['act'])) {
    // Insert
    if ($_GET['act'] == 'insert') {
        $kode = $_POST['id_golongan'];
        $namgol = $_POST['nama_golongan'];
        $tunkel = $_POST['tunjangan_keluarga'];
        $asuran = $_POST['asuransi'];

        if ($kode == '' || $namgol == '' || $tunkel == '' || $asuran == '') {
            header('location:dataGolongan.php?view=tambah&e=bl');
        } else {
            $simpan = mysqli_query($conn, "INSERT INTO golongan(id_golongan,nama_golongan,tunjangan_keluarga,asuransi) VALUES ('$kode', '$namgol','$tunkel','$asuran')");
            if ($simpan) {
                header('location:dataGolongan.php?e=sukses');
            } else {
                header('location:dataGolongan.php?e=gagal');
            }
        }
    } elseif ($_GET['act'] == 'update') {
        $kode = $_POST['id_golongan'];
        $namgol = $_POST['nama_golongan'];
        $tunkel = $_POST['tunjangan_keluarga'];
        $asuran = $_POST['asuransi'];

        if ($kode == '' || $namgol == '' || $tunkel == '' || $asuran == '') {
            header('location:dataGolongan.php?view=tambah&e=bl');
        } else {
            $update = mysqli_query($conn, "UPDATE golongan SET nama_golongan='$namgol',tunjangan_keluarga='$tunkel',asuransi='$asuran' WHERE id_golongan='$kode'");
            if ($update) {
                header('location:dataGolongan.php?e=sukses');
            } else {
                header('location:dataGolongan.php?e=gagal');
            }
        }
    } elseif ($_GET['act'] == 'del') {
        $hapus = mysqli_query($conn, "DELETE FROM golongan WHERE id_golongan='$_GET[id]'");
        if ($hapus) {
            header('location:dataGolongan.php?e=sukses');
        } else {
            header('location:dataGolongan.php?e=gagal');
        }
    }
}
