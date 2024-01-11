<?php
require_once("../koneksi.php");

if (isset($_POST["updateIT"])) {
    $currentDateTime = new DateTime('now', new DateTimeZone('Asia/Jakarta'));
    $timestamp = $currentDateTime->format('YmdHis');
    $id_tiket = $_POST["id_tiket"];
    $kategori_tiket = $_POST["kategori_tiket"];
    $status_tiket = $_POST["status_tiket"];
    $nik_pic = $_POST["nik_pic"];
    $justification = $_POST["justification"];
    $action_note = $_POST["action_note"];
    $whatsapp = $_POST['wa'];

    $queryupdate = mysqli_query($koneksi, "UPDATE ticketing SET 
                            kategori_tiket = '$kategori_tiket', 
                            status_tiket = '$status_tiket',  
                            nik_pic = '$nik_pic',  
                            whatsapp = '$whatsapp',
                            justification = '$justification', 
                            action_note = '$action_note' 
                            WHERE id_tiket = '$id_tiket' ");
    $namaEmployee = 'Bapak/Ibu'; // Ganti dengan nama yang sesuai
    $link = 'https://eip.maagroup.co.id/tiket/index.php?page=ViewTicketIT&id=' . $id_tiket; // Ganti dengan URL yang valid
    $message = "Halo " . $namaEmployee . "!\n\nTicketing dengan ID #" . $id_tiket . " Anda sudah berhasil dibuat dengan status 'Process'\n\nTerima kasih telah menggunakan layanan kami. Jangan lupa untuk selalu cek Employee Information Portal (EIP) untuk informasi selanjutnya. Jika Anda memiliki pertanyaan lebih lanjut atau membutuhkan bantuan, jangan ragu untuk menghubungi tim IT kami.\n\nTerima kasih!\n\nInfo lebih lanjut tentang tiket ini: " . $link;
    // Pengaturan untuk cURL
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
    if ($queryupdate) {
        session_start();
        $_SESSION["Messages"] = 'Update Ticket Successful';
        $_SESSION["Icon"] = 'success';

        if ($status_tiket === 'Closed') {
            $updateEndDate = mysqli_query($koneksi, "UPDATE ticketing SET end_date = '$timestamp', whatsapp = '$whatsapp' WHERE id_tiket = '$id_tiket'");
            $namaEmployee = 'Bapak/Ibu'; 
            $link = 'https://eip.maagroup.co.id/tiket/index.php?page=ViewTicketIT&id=' . $id_tiket; // Ganti dengan URL yang valid
            $message = "Halo " . $namaEmployee . "!\n\nTicketing dengan ID #" . $id_tiket . " Anda sudah selesai dengan status 'Closed'\n\nTerima kasih telah menggunakan layanan kami. Jangan lupa untuk selalu cek Employee Information Portal (EIP) untuk informasi selanjutnya. Jika Anda memiliki pertanyaan lebih lanjut atau membutuhkan bantuan, jangan ragu untuk menghubungi tim IT kami.\n\nTerima kasih!\n\nInfo lebih lanjut tentang tiket ini: " . $link;
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

            if (!$updateEndDate) {
                $_SESSION["Messages"] = 'Failed to update end date';
                $_SESSION["Icon"] = 'error';
                header('Location: ../index.php?page=ITSupport');
                exit();
            }
        } elseif ($status_tiket === 'Process') {
            $updateProcessDate = mysqli_query($koneksi, "UPDATE ticketing SET proses_date = '$timestamp' , whatsapp = '$whatsapp' WHERE id_tiket = '$id_tiket'");
            if (!$updateProcessDate) {
                $_SESSION["Messages"] = 'Failed to update process date';
                $_SESSION["Icon"] = 'error';
                header('Location: ../index.php?page=ITSupport');
                exit();
            }
        }

        header('Location: ../index.php?page=ITSupport');
        exit();
    } else {
        session_start();
        $_SESSION["Messages"] = 'Update Ticket Failed';
        $_SESSION["Icon"] = 'error';
        header('Location: ../index.php?page=ITSupport');
        exit();
    }
} else {
    die("Akses dilarang ");
}
