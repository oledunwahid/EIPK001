<?php
require_once("../koneksi.php");

if (isset($_POST["updateBuilding"])) {
    $currentDateTime = new DateTime('now', new DateTimeZone('Asia/Jakarta'));
    $timestamp = $currentDateTime->format('YmdHis');

    $id_ga_building = $_POST["id_ga_building"];
    $status = $_POST["statusBuilding"];
    $nik_pic = $_POST["nik_pic"];
    $justification = addslashes($_POST["justification"]);
    $action_note = addslashes($_POST["action_note"]);

    $queryupdate = mysqli_query($koneksi, "UPDATE ga_building SET 
                            status = '$status',  
                            nik_pic = '$nik_pic',  
                            justification = '$justification', 
                            action_note = '$action_note' 
                            WHERE id_ga_building = '$id_ga_building' ");

    if ($queryupdate) {
        session_start();
        $_SESSION["Messages"] = 'Update Ticket Successful';
        $_SESSION["Icon"] = 'success';

        if ($status == 'Closed') {
            $updateEndDate = mysqli_query($koneksi, "UPDATE ga_building SET end_date = '$timestamp' WHERE id_ga_building = '$id_ga_building'");
            if (!$updateEndDate) {
                $_SESSION["Messages"] = 'Failed to update end date';
                $_SESSION["Icon"] = 'error';
                header("Location: ../index.php?page=Edit Building Facilities&id=$id_ga_building");
                exit();
            }
        } elseif ($status == 'Canceled') {
            $updateProcessDate = mysqli_query($koneksi, "UPDATE ga_building SET status = '$status' WHERE id_ga_building = '$id_ga_building'");
            if (!$updateProcessDate) {
                $_SESSION["Messages"] = 'Failed to update process date';
                $_SESSION["Icon"] = 'error';
                header("Location: ../index.php?page=Edit Building Facilities&id=$id_ga_building");
                exit();
            }
        }

        header("Location: ../index.php?page=Edit Building Facilities&id=$id_ga_building");
        exit();
    } else {
        session_start();
        $_SESSION["Messages"] = 'Update Ticket Failed';
        $_SESSION["Icon"] = 'error';
        header("Location: ../index.php?page=Edit Building Facilities&id=$id_ga_building");
        exit();
    }
} else {
    die("Akses dilarang ");
}
