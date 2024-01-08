<?php 
require_once("../koneksi.php");

if ($_GET["aksi"] == 'deleteBuilding') {

    $id_ga_building = $_GET['id'];

    $sql = mysqli_query($koneksi, "SELECT * FROM ga_building WHERE id_ga_building = '$id_ga_building'");
    $data = mysqli_fetch_array($sql);

    
    unlink("../file/facilities/".$data['file']);
    $query= "DELETE FROM ga_building WHERE id_ga_building='$id_ga_building'";
    $querydelete = mysqli_query($koneksi, $query);
    
    if ($querydelete) {
        session_start();
        $_SESSION["Messages"] = 'Data Berhasil Di Delete';
        $_SESSION["Icon"] = 'success';
        header('Location: ../index.php?page=Building Facilities');
        exit();
    } else {
        session_start();
        $_SESSION["Messages"] = 'Data gagal Di Input';
        $_SESSION["Icon"] = 'success';
        header('Location: ../index.php?page=Building Facilities');
        exit();
    }
} else {
    die("akses dilarang ");
}
?>