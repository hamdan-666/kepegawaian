<?php
session_start();
include 'db.php';

if ($_SESSION['status_login'] != true) {
    echo '<script>window.location="index.php"</script>';
}

if (isset($_GET['act'])) {
    // Insert
    if ($_GET['act'] == 'insert') {
        $kode = $_POST['id_jabatan'];
        $jabat = $_POST['nama_jabatan'];
        $gapok = $_POST['gaji_pokok'];
        $tunjang = $_POST['tunjangan'];

        if ($kode == '' || $jabat == '' || $gapok == '' || $tunjang == '') {
            header('location:dataJabatan.php?view=tambah&e=bl');
        } else {
            $simpan = mysqli_query($conn, "INSERT INTO jabatan(id_jabatan,nama_jabatan,gaji_pokok,tunjangan) VALUES ('$kode', '$jabat','$gapok','$tunjang')");
            if ($simpan) {
                header('location:datajabatan.php?e=sukses');
            } else {
                header('location:datajabatan.php?e=gagal');
            }
        }
    } elseif ($_GET['act'] == 'update') {
        $kode = $_POST['id_jabatan'];
        $jabat = $_POST['nama_jabatan'];
        $gapok = $_POST['gaji_pokok'];
        $tunjang = $_POST['tunjangan'];

        if ($kode == '' || $jabat == '' || $gapok == '' || $tunjang == '') {
            header('location:dataJabatan.php?view=tambah&e=bl');
        } else {
            $update = mysqli_query($conn, "UPDATE jabatan SET nama_jabatan='$jabat',gaji_pokok='$gapok',tunjangan='$tunjang' WHERE id_jabatan='$kode'");
            if ($update) {
                header('location:dataJabatan.php?e=sukses');
            } else {
                header('location:dataJabatan.php?e=gagal');
            }
        }
    } elseif ($_GET['act'] == 'del') {
        $hapus = mysqli_query($conn, "DELETE FROM jabatan WHERE id_jabatan='$_GET[id]'");
        if ($hapus) {
            header('location:dataJabatan.php?e=sukses');
        } else {
            header('location:dataJabatan.php?e=gagal');
        }
    }
}
