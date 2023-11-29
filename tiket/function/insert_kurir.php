<?php
require_once("../koneksi.php");

if (isset($_POST["add-request"])) {
    $currentDateTime = new DateTime('now', new DateTimeZone('Asia/Jakarta'));
    $timestamp = $currentDateTime->format('YmdHis');
    $counter = 1;
    $RequestNumber = "D" . $timestamp . str_pad($counter, 1, '0', STR_PAD_LEFT);

    $id_kurir = $RequestNumber;
    $tanggal_req = $_POST["tanggalRequest"];
    $jenis_barang = $_POST["jenisBarang"];
    $id_nik_request = $_POST["id_nik_request"];
    $description = $_POST["catatanKurir"];
    $alamat_kurir = $_POST["alamatKurir"];
    $id_nik_kurir = $_POST["id_nik_kurir"];
    $whatsapp = $_POST["wa"];
    $tipe_kurir = $_POST["tipe_kurir"];
    $status_kurir = $_POST["status_kurir"];
    $status_input = $_POST["status_input"];

    $query = "INSERT INTO kurir VALUES
    ('$id_kurir', '$id_nik_request', '$tanggal_req', '$jenis_barang', '$whatsapp',  '$tipe_kurir', '$description','$alamat_kurir','$id_nik_kurir', '', 'On Process')";
    $kondisi = mysqli_query($koneksi, $query);

    $query2 = "INSERT INTO riwayat_kurir VALUES
    ('', '$id_kurir', '$timestamp', 'Pending','$status_input')";
    $kondisi2 = mysqli_query($koneksi, $query2);

    if ($kondisi && $kondisi2) {
        session_start();
        $_SESSION["Messages"] = 'Data Berhasil Di Input';
        $_SESSION["Icon"] = 'success';
    }else{
        session_start();
        $_SESSION["Messages"] = 'Data Gagal Di Input';
        $_SESSION["Icon"] = 'error';
    }
    header('Location: ../index.php?page=Delivery');
    exit();
}
