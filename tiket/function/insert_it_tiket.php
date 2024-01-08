<?php
require_once("../koneksi.php");

if (isset($_POST["add-tiket-admin"])) {
    $currentDateTime = new DateTime('now', new DateTimeZone('Asia/Jakarta'));
    $timestamp = $currentDateTime->format('YmdHis');
    $counter = 1;
    $ticketNumber = "IT" . $timestamp . str_pad($counter, 1, '0', STR_PAD_LEFT);

    $id_tiket = $ticketNumber;
    $start_date = $_POST["kodok"];
    $proses_date = $_POST['proses_date'];
    $end_date = $_POST['end_date'];
    $id_nik_request = $_POST["id_nik_request"];
    $description = $_POST["description"];
    $whatsapp = $_POST["wa"];
    $status_tiket = $_POST['status_tiket'];
    $nik_pic = $_POST["nik_pic"];
    $kategori_tiket = $_POST["kategori_tiket"];
    $justification = $_POST["justification"];
    $action_note = $_POST["action_note"];


    $ekstensi_diperbolehkan = array('pdf', 'xlsx', 'xls', 'doc', 'docx', 'jpg', 'png', 'jpeg');
    $nama_lampiran1 = $_FILES['lampiran1']['name'];


    $file_ren = time() . '-' . $_FILES['lampiran1']['name'];

    $x = explode('.', $file_ren);
    $extensi = strtolower(end($x));
    $ukuran = $_FILES['lampiran1']['size'];
    $file_tmp = $_FILES['lampiran1']['tmp_name'];

    if ($_FILES['lampiran1']['name'] == null) {

        $query = "INSERT INTO ticketing VALUES
        ('$id_tiket', '$id_nik_request', '$whatsapp', '$start_date', '$proses_date', '$end_date','$description', '', '', '$kategori_tiket', '$status_tiket', '$nik_pic', '$justification', '$action_note')";
        $kondisi = mysqli_query($koneksi, $query);

        $namaEmployee = 'Bapak/Ibu'; // Ganti dengan nama yang sesuai
        $link = 'https://localhost/index.php?page=ViewTicketIT&id=' . $id_tiket; // Ganti dengan URL yang valid

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

        if ($kondisi) {
            session_start();
            $_SESSION["Messages"] = 'Data Berhasil Di Input';
            $_SESSION["Icon"] = 'success';
            header('Location: ../index.php?page=ITSupport');
            exit();
        } else {
            session_start();
            $_SESSION["Messages"] = 'Data Gagal Di Input';
            $_SESSION["Icon"] = 'error';
            header('Location: ../index.php?page=ITSupport');
            exit();
        }
    } else {
        if (in_array($extensi, $ekstensi_diperbolehkan) === true) {
            if ($ukuran < 2544070) {
                move_uploaded_file($file_tmp, '../file/it/' . $file_ren);

                $lampiran_1 = $file_ren;
                $query = "INSERT INTO ticketing VALUES
                ('$id_tiket', '$id_nik_request', '$whatsapp', '$start_date', '$proses_date', '$end_date','$description', '$lampiran_1', '', '$kategori_tiket', '$status_tiket', '$nik_pic', '$justification', '$action_note')";
                $kondisi = mysqli_query($koneksi, $query);

                $namaEmployee = 'Bapak/Ibu'; // Ganti dengan nama yang sesuai
                $link = 'https://localhost/index.php?page=ViewTicketIT&id=' . $id_tiket; // Ganti dengan URL yang valid

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

                if ($kondisi) {
                    session_start();
                    $_SESSION["Messages"] = 'Data Berhasil Di Input';
                    $_SESSION["Icon"] = 'success';
                    header('Location: ../index.php?page=ITSupport');
                    exit();
                } else {
                    session_start();
                    $_SESSION["Messages"] = 'Data Gagal Di Input';
                    $_SESSION["Icon"] = 'error';
                    header('Location: ../index.php?page=ITSupport');
                    exit();
                }
            } else {
                session_start();
                $_SESSION["Messages"] = 'Fail! File Size Too Big';
                $_SESSION["Icon"] = 'error';
                header('Location: ../index.php?page=ITSupport&Gagal-Size-Too_Big');
                exit();
            }
        } else {
            session_start();
            $_SESSION["Messages"] = 'Fail! Wrong File Format';
            $_SESSION["Icon"] = 'error';
            header('Location: ../index.php?page=ITSupport&Gagal-Wrong_Format');
            exit();
        }
    }
} elseif (isset($_POST["add-tiket-user"])) {
    $currentDateTime = new DateTime('now', new DateTimeZone('Asia/Jakarta'));
    $timestamp = $currentDateTime->format('YmdHis');
    $counter = 1;
    $ticketNumber = "IT" . $timestamp . str_pad($counter, 1, '0', STR_PAD_LEFT);

    $id_tiket = $ticketNumber;
    $start_date = $_POST["kodok"];
    $id_nik_request = $_POST["id_nik_request"];
    $description = $_POST["description"];
    $whatsapp = $_POST["wa"];
    $status_tiket = 'Process';



    $ekstensi_diperbolehkan = array('pdf', 'xlsx', 'xls', 'doc', 'docx', 'jpg', 'png', 'jpeg');
    $nama_lampiran1 = $_FILES['lampiran1']['name'];
    $file_ren = time() . '-' . $_FILES['lampiran1']['name'];

    $x = explode('.', $file_ren);
    $extensi = strtolower(end($x));
    $ukuran = $_FILES['lampiran1']['size'];
    $file_tmp = $_FILES['lampiran1']['tmp_name'];

    if ($_FILES['lampiran1']['name'] == null) {

        $query = "INSERT INTO ticketing VALUES
        ('$id_tiket', '$id_nik_request', '$whatsapp', '$start_date','', '','$description', '', '', '', '$status_tiket', '', '', '')";
        $kondisi = mysqli_query($koneksi, $query);

        $namaEmployee = 'Bapak/Ibu'; // Ganti dengan nama yang sesuai
        $link = 'https://localhost/index.php?page=ViewTicketIT&id=' . $id_tiket; // Ganti dengan URL yang valid

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

        if ($kondisi) {
            session_start();
            $_SESSION["Messages"] = 'Data Berhasil Di Input';
            $_SESSION["Icon"] = 'success';
            header('Location: ../index.php?page=ITSupport');
            exit();
        } else {
            session_start();
            $_SESSION["Messages"] = 'Data Gagal Di Input';
            $_SESSION["Icon"] = 'error';
            header('Location: ../index.php?page=ITSupport');
            exit();
        }
    } else {
        if (in_array($extensi, $ekstensi_diperbolehkan) === true) {
            if ($ukuran < 5044070) {
                move_uploaded_file($file_tmp, '../file/it/' . $file_ren);

                $lampiran_1 = $file_ren;
                $query = "INSERT INTO ticketing VALUES
                ('$id_tiket', '$id_nik_request', '$whatsapp', '$start_date','', '','$description', '$lampiran_1', '', '', '$status_tiket', '', '', '')";
                $kondisi = mysqli_query($koneksi, $query);

                $namaEmployee = 'Bapak/Ibu'; // Ganti dengan nama yang sesuai
                $link = 'https://localhost/index.php?page=ViewTicketIT&id=' . $id_tiket; // Ganti dengan URL yang valid

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

                if ($kondisi) {
                    session_start();
                    $_SESSION["Messages"] = 'Data Berhasil Di Input';
                    $_SESSION["Icon"] = 'success';
                    header('Location: ../index.php?page=ITSupport');
                    exit();
                } else {
                    session_start();
                    $_SESSION["Messages"] = 'Data Gagal Di Input';
                    $_SESSION["Icon"] = 'error';
                    header('Location: ../index.php?page=ITSupport');
                    exit();
                }
            } else {
                session_start();
                $_SESSION["Messages"] = 'Fail! File Size Too Big';
                $_SESSION["Icon"] = 'error';
                header('Location: ../index.php?page=ITSupport&Gagal-Size-Too_Big');
                exit();
            }
        } else {
            session_start();
            $_SESSION["Messages"] = 'Fail! Wrong File Format';
            $_SESSION["Icon"] = 'error';
            header('Location: ../index.php?page=ITSupport&Gagal-Wrong_Format');
            exit();
        }
    }
} else {
    die("akses dilarang");
}
