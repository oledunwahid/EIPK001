<?php
require_once("../koneksi.php");

if (isset($_POST["updateKurir"])) {
    $id_kurir = $_POST["id_kurir"];
    $id_nik_kurir = $_POST["id_nik_kurir"];
    $status_kurir = $_POST["statusKurir"];

    $queryupdate = mysqli_query($koneksi, "UPDATE kurir SET 
                        id_nik_kurir = '$id_nik_kurir', 
                        status_kurir = '$status_kurir'
                        WHERE id_kurir = '$id_kurir' ");

    if ($queryupdate) {
        if ($status_kurir === '1') {
            session_start();
            $_SESSION["Messages"] = 'Update Data Active';
            $_SESSION["Icon"] = 'success';
        } else if ($status_kurir === '2') {
            session_start();
            $_SESSION["Messages"] = 'Update Data Canceled';
            $_SESSION["Icon"] = 'success';
        } else if ($status_kurir === '0') {
            session_start();
            $_SESSION["Messages"] = 'Update Data Closed';
            $_SESSION["Icon"] = 'success';
        }
    }
    header("Location: ../index.php?page=EditKurir&id=" . urlencode($id_kurir));
} elseif (isset($_POST["updateRiwayat"])) {
    $id_kurir = $_POST["id_kurir"];
    $timestamp =  $_POST["timestamp"];
    $status_riwayat = $_POST["statusRiwayat"];
    $deskripsi_riwayat = $_POST["deskripsi"];

    $queryinsert = mysqli_query($koneksi, "INSERT INTO riwayat_kurir
                            VALUES ('','$id_kurir','$timestamp','$status_riwayat', '$deskripsi_riwayat')");

    if ($queryinsert) {
        session_start();
        $_SESSION["Messages"] = 'Update Status Succesful';
        $_SESSION["Icon"] = 'success';
    } else {
        session_start();
        $_SESSION["Messages"] = 'Update Status Failed';
        $_SESSION["Icon"] = 'error';
    }
    header("Location: ../index.php?page=EditKurir&id=" . urlencode($id_kurir));
} else {
    die("Akses dilarang");
}
