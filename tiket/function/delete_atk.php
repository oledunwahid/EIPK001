<?php 
require_once("../koneksi.php");

if ($_GET["aksi"] == 'delete') {

    $id_tiket = $_GET['id'];

    $sql = mysqli_query($koneksi, "SELECT * FROM atk WHERE id_atk = '$id_atk'");
    $data = mysqli_fetch_array($sql);

    $query= "DELETE FROM atk WHERE id_atk='$id_atk'";
    $querydelete = mysqli_query($koneksi, $query);
    
    if ($querydelete) {
        session_start();
        $_SESSION["Messages"] = 'Data Berhasil Di Delete';
        $_SESSION["Icon"] = 'success';
        header('Location: ../index.php?page=ATKList');
        exit();
    } else {
        session_start();
        $_SESSION["Messages"] = 'Data gagal Di Input';
        $_SESSION["Icon"] = 'success';
        header('Location: ../index.php?page=ATKList');
        exit();
    }
} else {
    die("akses dilarang ");
}
?>