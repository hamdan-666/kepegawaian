<?php
session_start();
include 'db.php';

if ($_SESSION['status_login'] != true) {
    echo '<script>window.location="index.php"</script>';
}

if (isset($_GET['act'])) {
    // Insert
    if ($_GET['act'] == 'insert') {
        $nip = $_POST['nip'];
        $nama = $_POST['nama_pegawai'];
        $jab = $_POST['jabatan'];
        $gol = $_POST['golongan'];
        $stat = $_POST['status'];

        if ($nip == '' || $nama == '' || $jab == '' || $gol == '' || $stat == '') {
            header('location:dataPegawai.php?view=tambah&e=bl');
        } else {
            $simpan = mysqli_query($conn, "INSERT INTO pegawai(nip,nama_pegawai,id_jabatan,id_golongan,status) VALUES ('$nip', '$nama','$jab','$gol', '$stat')");
            if ($simpan) {
                header('location:dataPegawai.php?e=sukses');
            } else {
                header('location:dataPegawai.php?e=gagal');
            }
        }
    } elseif ($_GET['act'] == 'update') {
        $nip = $_POST['nip'];
        $nama = $_POST['nama_pegawai'];
        $jab = $_POST['jabatan'];
        $gol = $_POST['golongan'];
        $stat = $_POST['status'];

        if ($nip == '' || $nama == '' || $jab == '' || $gol == '' || $stat == '') {
            header('location:dataPegawai.php?view=tambah&e=bl');
        } else {
            $update = mysqli_query($conn, "UPDATE pegawai SET nama_pegawai='$nama',id_jabatan='$jab',id_golongan='$gol', status='$stat' WHERE nip='$nip'");
            if ($update) {
                header('location:dataPegawai.php?e=sukses');
            } else {
                header('location:dataPegawai.php?e=gagal');
            }
        }
    } elseif ($_GET['act'] == 'del') {
        $hapus = mysqli_query($conn, "DELETE FROM pegawai WHERE nip='$_GET[id]'");
        if ($hapus) {
            header('location:dataPegawai.php?e=sukses');
        } else {
            header('location:dataPegawai.php?e=gagal');
        }
    }
}
