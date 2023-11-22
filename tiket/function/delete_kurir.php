<?php 
require_once("../koneksi.php");

if ($_GET["aksi"] == 'delete') {
    $id_kurir = mysqli_real_escape_string($koneksi, $_GET['id']);

    $query= "DELETE FROM kurir WHERE id_kurir='$id_kurir'";
    $querydelete = mysqli_query($koneksi, $query);

    if ($querydelete) {
        session_start();
        $_SESSION["DeleteMessages"] = 'Are you sure?';
        $_SESSION["IconWarn"] = 'warning';
        $_SESSION["TextDelete"] = 'You are about to delete this item!';
        header('Location: ../index.php?page=Delivery');
        exit;
    } else {
        session_start();
        $_SESSION["DeleteMessages"] = 'Failed to delete item.';
        $_SESSION["IconWarn"] = 'error';
        $_SESSION["TextDelete"] = 'There was an error while deleting this item.';
        header('Location: ../index.php?page=Delivery');
        exit;
    }
} else {
    die("Akses dilarang.");
}
?>
