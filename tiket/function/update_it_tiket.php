<?php
require_once("../koneksi.php");

if (isset($_POST["updateIT"])) {
    $currentDateTime = new DateTime('now', new DateTimeZone('Asia/Jakarta'));
    $timestamp = $currentDateTime->format('YmdHis');
    $id_tiket = $_POST["id_tiket"];
    $kategori_tiket = $_POST["kategori_tiket"];
    $status_tiket = $_POST["status_tiket"];
    $nik_pic = $_POST["nik_pic"];
    $justification = $_POST["justification"];
    $action_note = $_POST["action_note"];

    $queryupdate = mysqli_query($koneksi, "UPDATE ticketing SET 
                            kategori_tiket = '$kategori_tiket', 
                            status_tiket = '$status_tiket',  
                            nik_pic = '$nik_pic',  
                            justification = '$justification', 
                            action_note = '$action_note' 
                            WHERE id_tiket = '$id_tiket' ");

    if ($queryupdate) {
        session_start();
        $_SESSION["Messages"] = 'Update Ticket Successful';
        $_SESSION["Icon"] = 'success';

        if ($status_tiket === 'Closed') {
            $updateEndDate = mysqli_query($koneksi, "UPDATE ticketing SET end_date = '$timestamp' WHERE id_tiket = '$id_tiket'");
            if (!$updateEndDate) {
                $_SESSION["Messages"] = 'Failed to update end date';
                $_SESSION["Icon"] = 'error';
                header('Location: ../index.php?page=ITSupport');
                exit();
            }
        } elseif ($status_tiket === 'Process') {
            $updateProcessDate = mysqli_query($koneksi, "UPDATE ticketing SET proses_date = '$timestamp' WHERE id_tiket = '$id_tiket'");
            if (!$updateProcessDate) {
                $_SESSION["Messages"] = 'Failed to update process date';
                $_SESSION["Icon"] = 'error';
                header('Location: ../index.php?page=ITSupport');
                exit();
            }
        }

        header('Location: ../index.php?page=ITSupport');
        exit();
    } else {
        session_start();
        $_SESSION["Messages"] = 'Update Ticket Failed';
        $_SESSION["Icon"] = 'error';
        header('Location: ../index.php?page=ITSupport');
        exit();
    }
} else {
    die("Akses dilarang ");
}
