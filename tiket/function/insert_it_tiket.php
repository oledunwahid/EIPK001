<?php
require_once("../koneksi.php");

if (isset($_POST["add-tiket"])) {
    $currentDateTime = new DateTime('now', new DateTimeZone('Asia/Jakarta'));
    $timestamp = $currentDateTime->format('YmdHis');
    $counter = 1;
    $ticketNumber = "IT" . $timestamp . str_pad($counter, 1, '0', STR_PAD_LEFT);

    $id_tiket = $ticketNumber;
    $start_date = $_POST["kodok"];
    $id_nik_request = $_POST["id_nik_request"];
    $description = $_POST["description"];
    $whatsapp = $_POST["wa"];
    $status_tiket = 'Pending';
    $justification = $_POST["justification"];


    $ekstensi_diperbolehkan = array('pdf', 'xlsx', 'xls', 'doc', 'docx', 'jpg', 'png', 'jpeg');

    $nama_lampiran1 = $_FILES['lampiran1']['name'];


    $file_ren = time() . '-' . $_FILES['lampiran1']['name'];

    $x = explode('.', $file_ren);
    $extensi = strtolower(end($x));
    $ukuran = $_FILES['lampiran1']['size'];
    $file_tmp = $_FILES['lampiran1']['tmp_name'];

    if ($_FILES['lampiran1']['name'] == null) {

        $query = "INSERT INTO ticketing VALUES
        ('$id_tiket', '$id_nik_request', '$whatsapp', '$start_date', '','$description', '', '', '', '$status_tiket', '', '$justification', '')";
        $kondisi = mysqli_query($koneksi, $query);

        if ($kondisi) {
            session_start();
            $_SESSION["Messages"] = 'Data Berhasil Di Input';
            $_SESSION["Icon"] = 'success';
            header('Location: ../index.php?page=ITSupport');
            exit();
        } else {
            session_start();
            $_SESSION["Messages"] = 'Data Gagal Di Input';
            $_SESSION["Icon"] = 'error';
            header('Location: ../index.php?page=ITSupport');
            exit();
        }
    } else {
        if (in_array($extensi, $ekstensi_diperbolehkan) === true) {
            if ($ukuran < 5044070) {
                move_uploaded_file($file_tmp, '../file/it/' . $file_ren);

                $lampiran_1 = $file_ren;
                $query = "INSERT INTO ticketing VALUES
            ('$id_tiket', '$id_nik_request', '$whatsapp', '$start_date', '','$description', '$lampiran_1', '', '', '$status_tiket', '', '', '')";
                $kondisi = mysqli_query($koneksi, $query);

                if ($kondisi) {
                    session_start();
                    $_SESSION["Messages"] = 'Data Berhasil Di Input';
                    $_SESSION["Icon"] = 'success';
                    header('Location: ../index.php?page=ITSupport');
                    exit();
                } else {
                    session_start();
                    $_SESSION["Messages"] = 'Data Gagal Di Input';
                    $_SESSION["Icon"] = 'error';
                    header('Location: ../index.php?page=ITSupport');
                    exit();
                }
            } else {
                session_start();
                $_SESSION["Messages"] = 'Fail! File Size Too Big';
                $_SESSION["Icon"] = 'error';
                header('Location: ../index.php?page=ITSupport&Gagal-Size-Too_Big');
                exit();
            }
        } else {
            session_start();
            $_SESSION["Messages"] = 'Fail! Wrong File Format';
            $_SESSION["Icon"] = 'error';
            header('Location: ../index.php?page=ITSupport&Gagal-Wrong_Format');
            exit();
        }
    }
} else {
    die("akses dilarang");
}
