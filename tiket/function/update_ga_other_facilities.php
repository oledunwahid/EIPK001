<?php
require_once("../koneksi.php");

if (isset($_POST["updateOther"])) {
    $currentDateTime = new DateTime('now', new DateTimeZone('Asia/Jakarta'));
    $timestamp = $currentDateTime->format('YmdHis');

    $id_ga_other_facilities = $_POST["id_ga_other_facilities"];
    $status = $_POST["statusOther"];
    $nik_pic = $_POST["nik_pic"];
    $justification = addslashes($_POST["justification"]);
    $action_note = addslashes($_POST['action_note']);

    $queryupdate = mysqli_query($koneksi, "UPDATE ga_other_facilities SET 
                            status = '$status', nik_pic = '$nik_pic',  
                            justification = '$justification', 
                            action_note = '$action_note' 
                            WHERE id_ga_other_facilities = '$id_ga_other_facilities' ");

    if ($queryupdate) {
        session_start();
        $_SESSION["Messages"] = 'Update Ticket Successful';
        $_SESSION["Icon"] = 'success';

        if ($status_tiket === 'Closed') {
            $updateEndDate = mysqli_query($koneksi, "UPDATE ga_other_facilities SET end_date = '$timestamp' WHERE id_ga_other$id_ga_other_facilities = '$id_ga_other_facilities'");
            if (!$updateEndDate) {
                $_SESSION["Messages"] = 'Failed to update end date';
                $_SESSION["Icon"] = 'error';
                header("Location: ../index.php?page=Edit Other Facilities&id=$id_ga_other_facilities");
                exit();
            }
        } elseif ($status_tiket === 'Canceled') {
            $updateProcessDate = mysqli_query($koneksi, "UPDATE ticketing SET proses_date = '$timestamp' WHERE id_tiket = '$id_tiket'");
            if (!$updateProcessDate) {
                $_SESSION["Messages"] = 'Failed to update process date';
                $_SESSION["Icon"] = 'error';
                header("Location: ../index.php?page=Edit Other Facilities&id=$id_ga_other_facilities");
                exit();
            }
        }

        header("Location: ../index.php?page=Edit Other Facilities&id=$id_ga_other_facilities");
        exit();
    } else {
        session_start();
        $_SESSION["Messages"] = 'Update Ticket Failed';
        $_SESSION["Icon"] = 'error';
        header("Location: ../index.php?page=Edit Other Facilities&id=$id_ga_other_facilities");
        exit();
    }
} else {
    die("Akses dilarang ");
}
