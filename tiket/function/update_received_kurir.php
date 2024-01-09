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
        if ($status_received === '1') {
            $_SESSION["Messages"] = 'Update Status -> Received';
        } else if ($status_received === '2') {
            $_SESSION["Messages"] = 'Update Status -> Canceled';
        } else if ($status_received === '0') {
            $_SESSION["Messages"] = 'Update Status -> Closed';
        }
        $_SESSION["Icon"] = 'success';
    }
    var_dump($id_received);
    header("Location: ../index.php?page=EditReceived&id=$id_received");
} elseif (isset($_POST["updateRiwayat"])) {
    $query_last_id = "SELECT MAX(id_riwayat_received) AS max_id FROM rf_riwayat_received_package";
    $result_last_id = mysqli_query($koneksi, $query_last_id);
    $row = mysqli_fetch_assoc($result_last_id);
    $max_id = $row['max_id'];

    // Jika tidak ada data di database, atur nilai awal ID
    if (!$max_id) {
        $id_riwayat_received = 1; // Atur nilai awal ID
    } else {
        // Tambahkan 1 ke nilai terakhir untuk mendapatkan nilai baru
        $id_riwayat_received = $max_id + 1;
    }

    // Periksa panjang ID, jika kurang dari 11 digit, tambahkan angka 0 di depannya
    $id_riwayat_received = str_pad($id_riwayat_received, 11, '0', STR_PAD_LEFT);

    $id_received = $_POST["id_received2"];
    $timestamp =  $_POST["timestamp"];
    $status_riwayat_received = $_POST["statusRiwayat"];
    $deskripsi_riwayat_received = $_POST["deskripsi"];

    $queryinsert = mysqli_query($koneksi, "INSERT INTO rf_riwayat_received_package (id_riwayat_received,id_received, timestamp, status_riwayat_received, deskripsi_riwayat_received)
    VALUES ('$id_riwayat_received', '$id_received', '$timestamp','$status_riwayat_received', '$deskripsi_riwayat_received')");

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
    header("Location: ../index.php?page=EditReceived&id=$id_received");
} else {
    header("Location: ../index.php?page=404");
}
