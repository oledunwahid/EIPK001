<?php
require_once("../koneksi.php");

if (isset($_POST["updateBuilding"])) {
    $currentDateTime = new DateTime('now', new DateTimeZone('Asia/Jakarta'));
    $timestamp = $currentDateTime->format('YmdHis');

    $id_ga_building = $_POST["id_ga_building"];
    $status = $_POST["statusBuilding"];
    $nik_pic = $_POST["nik_pic"];
    $justification = addslashes($_POST["justification"]);
    $action_note = addslashes($_POST["action_note"]);
    $whatsapp = $_POST["wa"];

    $queryupdate = mysqli_query($koneksi, "UPDATE ga_building SET 
                            status = '$status',  
                            nik_pic = '$nik_pic',  
                            justification = '$justification', 
                            action_note = '$action_note' 
                            WHERE id_ga_building = '$id_ga_building' ");
    if ($queryupdate) {

        session_start();
        $_SESSION["Messages"] = 'Update Ticket Successful';
        $_SESSION["Icon"] = 'success';

        if ($status == 'Closed') {
            $updateEndDate = mysqli_query($koneksi, "UPDATE ga_building SET end_date = '$timestamp' WHERE id_ga_building = '$id_ga_building'");
            $namaEmployee = 'Bapak/Ibu';
            $link = 'https://eip.maagroup.co.id/tiket/index.php?page=View%20Building%20Facilities&id=' . $id_ga_building; // Ganti dengan URL yang valid
            $message = "Halo " . $namaEmployee . "!\n\nTicketing dengan ID #" . $id_ga_building . " Anda telah selesai dengan status 'Closed'\n\nTerima kasih telah menggunakan layanan kami. Jangan lupa untuk selalu cek Employee Information Portal (EIP) untuk informasi selanjutnya. Jika Anda memiliki pertanyaan lebih lanjut atau membutuhkan bantuan, jangan ragu untuk menghubungi tim IT kami.\n\nTerima kasih!\n\nInfo lebih lanjut tentang tiket ini: " . $link;
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
                header("Location: ../index.php?page=Edit Building Facilities&id=$id_ga_building");
                exit();
            }
        } elseif ($status == 'Canceled') {
            $updateProcessDate = mysqli_query($koneksi, "UPDATE ga_building SET status = '$status' WHERE id_ga_building = '$id_ga_building'");
            $namaEmployee = 'Bapak/Ibu';
            $link = 'https://eip.maagroup.co.id/tiket/index.php?page=View%20Building%20Facilities&id=' . $id_ga_building; // Ganti dengan URL yang valid
            $message = "Halo " . $namaEmployee . "!\n\nTicketing dengan ID #" . $id_ga_building . " Anda telah di update dengan status 'Canceled'\n\nTerima kasih telah menggunakan layanan kami. Jangan lupa untuk selalu cek Employee Information Portal (EIP) untuk informasi selanjutnya. Jika Anda memiliki pertanyaan lebih lanjut atau membutuhkan bantuan, jangan ragu untuk menghubungi tim IT kami.\n\nTerima kasih!\n\nInfo lebih lanjut tentang tiket ini: " . $link;
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

            if (!$updateProcessDate) {
                $_SESSION["Messages"] = 'Failed to update process date';
                $_SESSION["Icon"] = 'error';
                header("Location: ../index.php?page=Edit Building Facilities&id=$id_ga_building");
                exit();
            }
        }

        header("Location: ../index.php?page=Edit Building Facilities&id=$id_ga_building");
        exit();
    } else {
        session_start();
        $_SESSION["Messages"] = 'Update Ticket Failed';
        $_SESSION["Icon"] = 'error';
        header("Location: ../index.php?page=Edit Building Facilities&id=$id_ga_building");
        exit();
    }
} else {
    die("Akses dilarang ");
}
