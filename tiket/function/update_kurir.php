<?php
require_once("../koneksi.php");

if (isset($_POST["updateKurir"])) {
    $id_kurir = $_POST["id_kurir"];
    $id_nik_kurir = $_POST["id_nik_kurir"];
    $status_kurir = $_POST["statusKurir"];
    $whatsapp = $_POST["wa"];

    $queryupdate = mysqli_query($koneksi, "UPDATE kurir SET 
                        id_nik_kurir = '$id_nik_kurir', 
                        status_kurir = '$status_kurir'
                        WHERE id_kurir = '$id_kurir' ");

    if ($queryupdate) {
        if ($status_kurir === 'On Process') {
            session_start();
            $_SESSION["Messages"] = 'Update Data On Process';
            $_SESSION["Icon"] = 'success';
        } else if ($status_kurir === 'Canceled') {
            $namaEmployee = 'Bapak/Ibu';
            $link = 'https://eip.maagroup.co.id/tiket/index.php?page=ViewKurir&id=' . $id_kurir; // Ganti dengan URL yang valid
            $message = "Halo " . $namaEmployee . "!\n\nPackage dengan ID #" . $id_kurir . " Anda telah di update dengan status 'Canceled'\n\nTerima kasih telah menggunakan layanan kami. Jangan lupa untuk selalu cek Employee Information Portal (EIP) untuk informasi selanjutnya. Jika Anda memiliki pertanyaan lebih lanjut atau membutuhkan bantuan, jangan ragu untuk menghubungi tim IT kami.\n\nTerima kasih!\n\nInfo lebih lanjut tentang tiket ini: " . $link;
            $curl = curl_init();
            curl_setopt_array($curl, array(
                CURLOPT_URL => 'https://api.fonnte.com/send',
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => 'POST',
                CURLOPT_POSTFIELDS => array(
                    'target' => $whatsapp,
                    'message' => $message,
                    'countryCode' => '62', // Ganti kode negara jika perlu
                ),
                CURLOPT_HTTPHEADER => array(
                    'Authorization: SuQ7o9ufuZ89LqrLjN9N' // Ganti TOKEN dengan token Anda
                ),
            ));
            // Melakukan request pengiriman pesan WhatsApp
            $response = curl_exec($curl);
            // Menutup koneksi cURL
            curl_close($curl);
            session_start();
            $_SESSION["Messages"] = 'Update Data Canceled';
            $_SESSION["Icon"] = 'success';
        } else if ($status_kurir === 'Closed') {
            $namaEmployee = 'Bapak/Ibu';
            $link = 'https://eip.maagroup.co.id/tiket/index.php?page=ViewKurir&id=' . $id_kurir; // Ganti dengan URL yang valid
            $message = "Halo " . $namaEmployee . "!\n\nPackage dengan ID #" . $id_kurir . " Anda sudah selesai dengan status 'Closed'\n\nTerima kasih telah menggunakan layanan kami. Jangan lupa untuk selalu cek Employee Information Portal (EIP) untuk informasi selanjutnya. Jika Anda memiliki pertanyaan lebih lanjut atau membutuhkan bantuan, jangan ragu untuk menghubungi tim IT kami.\n\nTerima kasih!\n\nInfo lebih lanjut tentang tiket ini: " . $link;
            $curl = curl_init();
            curl_setopt_array($curl, array(
                CURLOPT_URL => 'https://api.fonnte.com/send',
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => 'POST',
                CURLOPT_POSTFIELDS => array(
                    'target' => $whatsapp,
                    'message' => $message,
                    'countryCode' => '62', // Ganti kode negara jika perlu
                ),
                CURLOPT_HTTPHEADER => array(
                    'Authorization: SuQ7o9ufuZ89LqrLjN9N' // Ganti TOKEN dengan token Anda
                ),
            ));
            // Melakukan request pengiriman pesan WhatsApp
            $response = curl_exec($curl);
            // Menutup koneksi cURL
            curl_close($curl);
            session_start();
            $_SESSION["Messages"] = 'Update Data Closed';
            $_SESSION["Icon"] = 'success';
        }
    }
    header("Location: ../index.php?page=EditKurir&id=" . urlencode($id_kurir));
} elseif (isset($_POST["updateRiwayat"])) {
    $id_kurir = $_POST["id_kurir"];
    $timestamp =  $_POST["timestamp"];
    $status_riwayat = $_POST["statusRiwayat"];
    $deskripsi_riwayat = $_POST["deskripsi"];

    $queryinsert = mysqli_query($koneksi, "INSERT INTO riwayat_kurir
                            VALUES ('','$id_kurir','$timestamp','$status_riwayat', '$deskripsi_riwayat')");
    $namaEmployee = 'Bapak/Ibu';
    $link = 'https://eip.maagroup.co.id/tiket/index.php?page=ViewKurir&id=' . $id_kurir; // Ganti dengan URL yang valid
    $message = "Halo " . $namaEmployee . "!\n\nPackage dengan ID #" . $id_kurir . " Sedang dalam status 'Proses' Silahkan cek riwayat pengiriman \n\n Jangan lupa untuk selalu cek Employee Information Portal (EIP) untuk melihat riwayat pengiriman serta informasi selanjutnya. Jika Anda memiliki pertanyaan lebih lanjut atau membutuhkan bantuan, jangan ragu untuk menghubungi tim IT kami.\n\nTerima kasih telah menggunakan layanan kami.\n\nInfo lebih lanjut tentang tiket ini: " . $link;
    $curl = curl_init();
    curl_setopt_array($curl, array(
        CURLOPT_URL => 'https://api.fonnte.com/send',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'POST',
        CURLOPT_POSTFIELDS => array(
            'target' => $whatsapp,
            'message' => $message,
            'countryCode' => '62', // Ganti kode negara jika perlu
        ),
        CURLOPT_HTTPHEADER => array(
            'Authorization: SuQ7o9ufuZ89LqrLjN9N' // Ganti TOKEN dengan token Anda
        ),
    ));
    // Melakukan request pengiriman pesan WhatsApp
    $response = curl_exec($curl);
    // Menutup koneksi cURL
    curl_close($curl);
    if ($queryinsert) {
        session_start();
        $_SESSION["Messages"] = 'Update Status Succesful';
        $_SESSION["Icon"] = 'success';
    } else {
        session_start();
        $_SESSION["Messages"] = 'Update Status Failed';
        $_SESSION["Icon"] = 'error';
    }
    header("Location: ../index.php?page=EditKurir&id=" . urlencode($id_kurir));
} else {
    die("Akses dilarang");
}
