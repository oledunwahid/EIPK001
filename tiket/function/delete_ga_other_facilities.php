<?php 
require_once("../koneksi.php");

if ($_GET["aksi"] == 'deleteOther') {

    $id_ga_other_facilities = $_GET['id'];

    $sql = mysqli_query($koneksi, "SELECT * FROM ga_other_facilities WHERE id_ga_other_facilities = '$id_ga_other_facilities'");
    $data = mysqli_fetch_array($sql);

    
    unlink("../file/facilities/".$data['file']);
    $query= "DELETE FROM ga_other_facilities WHERE id_ga_other_facilities='$id_ga_other_facilities'";
    $querydelete = mysqli_query($koneksi, $query);
    
    if ($querydelete) {
        session_start();
        $_SESSION["Messages"] = 'Data Berhasil Di Delete';
        $_SESSION["Icon"] = 'success';
        header('Location: ../index.php?page=Other Facilities');
        exit();
    } else {
        session_start();
        $_SESSION["Messages"] = 'Data gagal Di Input';
        $_SESSION["Icon"] = 'success';
        header('Location: ../index.php?page=Other Facilities');
        exit();
    }
} else {
    die("akses dilarang ");
}
?>