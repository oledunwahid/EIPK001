<?php
require_once("../koneksi.php");

if (isset($_POST["updateReceived"])) {
    $id_received = $_POST["id_received"];
    $status_received = $_POST["statusReceived"];

    $queryupdate = mysqli_query($koneksi, "UPDATE rf_received_package SET 
                        status_received = '$status_received'
                        WHERE id_received = '$id_received' ");
    if ($queryupdate) {
        session_start();
        if ($status_received === 'Received') {
            $_SESSION["Messages"] = 'Update Status -> Received';
        } else if ($status_received === 'Canceled') {
            $_SESSION["Messages"] = 'Update Status -> Canceled';
        } else if ($status_received === 'Closed') {
            $_SESSION["Messages"] = 'Update Status -> Closed';
        }
        $_SESSION["Icon"] = 'success';
    }
    header("Location: ../index.php?page=EditReceived&id=" . urlencode($id_received));
} elseif (isset($_POST["updateRiwayatReceived"])) {
    $id_received = $_POST["id_received"];
    $timestamp =  $_POST["timestamp"];
    $status_riwayat_received = $_POST["statusRiwayat"];
    $deskripsi_riwayat_received = $_POST["deskripsi"];

    $queryinsert = mysqli_query($koneksi, "INSERT INTO rf_riwayat_received_package (id_riwayat_received,id_received, timestamp, status_riwayat_received, deskripsi_riwayat_received)
    VALUES ('', '$id_received', '$timestamp','$status_riwayat_received', '$deskripsi_riwayat_received')");

    if ($queryinsert) {
        session_start();
        $_SESSION["Messages"] = 'Update Status Successful';
        $_SESSION["Icon"] = 'success';
    } else {
        session_start();
        $_SESSION["Messages"] = 'Update Status Failed';
        $_SESSION["Icon"] = 'error';
    }
    var_dump($id_received);
    header("Location: ../index.php?page=EditReceived&id=" . urlencode($id_received));
} else {
    header("Location: ../index.php?page=404");
}
