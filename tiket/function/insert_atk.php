<?php
require_once("../koneksi.php");

if (isset($_POST["add-atk"])) {
    $id_atk = $_POST["id_atk"];
    $description = $_POST["description"];

    $query = "INSERT INTO atk VALUES ('$id_atk', '$description')";
    $kondisi = mysqli_query($koneksi, $query);  

    session_start();
    if ($kondisi) {
        $_SESSION["Messages"] = 'Data Berhasil Di Input';
        $_SESSION["Icon"] = 'success';
    } else {
        $_SESSION["Messages"] = 'Data Gagal Di Input';
        $_SESSION["Icon"] = 'error';
    }

    header('Location: ../../index.php?page=ATKList');
    exit();
}
