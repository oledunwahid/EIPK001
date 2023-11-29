<?php
require_once("../../koneksi.php");

if (isset($_POST["add-stationary"])) {
    $currentDateTime = new DateTime('now', new DateTimeZone('Asia/Jakarta'));
    $timestamp = $currentDateTime->format('YmdHis');
    $counter = 1;
    $RequestATK = "ATK" . $timestamp . str_pad($counter, 1, '0', STR_PAD_LEFT);

    $id_ga_stationary = $RequestATK;
    $nik_request = $_POST = ["nikRequest"];
    $nik_pic = $_POST["nikPIC"];
    $category = $_POST["category"];
    $status = $_POST["statusATK"];
    $start_date = $_POST["startDate"];
    $end_date = $_POST["endDate"];

        $query = "INSERT INTO ga_stationary VALUES
        ('$id_ga_stationary', '$nik_request', '$nik_pic', '', '$category', '$status', '$start_date', '$end_date',  )";
        $kondisi = mysqli_query($koneksi, $query);

        $query2 = "INSERT INTO stationary_request_detail VALUES 
        ('$id_request_detail',)";

        if ($kondisi) {
            header('Location: ../index.php?page=ATK/Stationary&benar');
        } else {
            header('Location: ../index.php?page=ATK/Stationaryt&salah');

        } die("akses dilarang");
}