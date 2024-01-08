<?php 
require_once("../koneksi.php");

if ($_GET["aksi"] == 'delete') {

    $id_tiket = $_GET['id'];

    $sql = mysqli_query($koneksi, "SELECT * FROM ticketing WHERE id_tiket = '$id_tiket'");
    $data = mysqli_fetch_array($sql);

    
    unlink("../file/it/".$data['lampiran1']);
    $query= "DELETE FROM ticketing WHERE id_tiket='$id_tiket'";
    $querydelete = mysqli_query($koneksi, $query);
    
    if ($querydelete) {
        session_start();
        $_SESSION["Messages"] = 'Data Berhasil Di Delete';
        $_SESSION["Icon"] = 'success';
        header('Location: ../index.php?page=ITSupport');
        exit();
    } else {
        session_start();
        $_SESSION["Messages"] = 'Data gagal Di Input';
        $_SESSION["Icon"] = 'success';
        header('Location: ../index.php?page=ITSupport');
        exit();
    }
} else {
    die("akses dilarang ");
}
?>