<?php
session_start();
require_once("../koneksi.php");

function redirectToFacilitiesPage($message, $icon)
{
    $_SESSION["Messages"] = $message;
    $_SESSION["Icon"] = $icon;
    header('Location: ../index.php?page=Other Facilities');
    exit();
}

if (isset($_POST['add-ga-other-facilities'])) {
    $currentDateTime = new DateTime('now', new DateTimeZone('Asia/Jakarta'));
    $timestamp = $currentDateTime->format('ymdHis');
    $ticketNumber = "GA" . $timestamp . str_pad(1, '0', STR_PAD_LEFT);

    $id_ga_other_facilities = $ticketNumber;
    $start_date = $_POST["startDate"];
    $nik_request = $_POST["nik_request"];
    $description = $_POST["description"];
    $whatsapp = $_POST["wa"];
    $status = $_POST["statusOther"];
    $category = $_POST["category"];
    $file = $_POST["file"];
    $justification = addslashes($_POST["justification"]);
    $action_note = addslashes($_POST['action_note']);

    if (!empty($_FILES['file']['name'])) {
        $ekstensi_diperbolehkan = array('pdf', 'xlsx', 'xls', 'doc', 'docx', 'jpg', 'png', 'jpeg');
        $nama_file = $_FILES['file']['name'];

        $file_ren = time() . '-' . $_FILES['file']['name'];

        $x = explode('.', $file_ren);
        $extensi = strtolower(end($x));
        $ukuran = $_FILES['file']['size'];
        $file_tmp = $_FILES['file']['tmp_name'];

        if (in_array($extensi, $ekstensi_diperbolehkan) === true) {
            if ($ukuran < 2544070) {
                move_uploaded_file($file_tmp, '../file/facilities/' . $file_ren);
                $file = $file_ren;
            } else {
                redirectToFacilitiesPage('Ukuran file terlalu besar.', 'error');
            }
        } else {
            redirectToFacilitiesPage('Jenis file tidak diizinkan.', 'error');
        }
    } else {
        $file = '';
    }

    $query = "INSERT INTO ga_other_facilities (id_ga_other_facilities, nik_request, nik_pic, whatsapp, file, description, category, status, justification, action_note, start_date, end_date) 
    VALUES (?, ?, '', ?, ?, ?, ?, 'On Process', 'Waiting for response', 'Waiting for response', ?, ?)";

    $statement = mysqli_prepare($koneksi, $query);
    mysqli_stmt_bind_param($statement, 'ssssssss', $id_ga_other_facilities, $nik_request, $whatsapp, $file, $description, $category, $start_date, $end_date);
    $result = mysqli_stmt_execute($statement);

    $namaEmployee = 'Bapak/Ibu'; // Ganti dengan nama yang sesuai
    $link = 'https://eip.maagroup.co.id/tiket/index.php?page=View%20Other%20Facilities&id=' . $id_ga_other_facilities; // Ganti dengan URL yang valid

    $message = "Halo " . $namaEmployee . "!\n\nTicketing dengan ID #" . $id_ga_other_facilities . " Anda sudah berhasil dibuat dengan status 'On Process'\n\nTerima kasih telah menggunakan layanan kami. Jangan lupa untuk selalu cek Employee Information Portal (EIP) untuk informasi selanjutnya. Jika Anda memiliki pertanyaan lebih lanjut atau membutuhkan bantuan, jangan ragu untuk menghubungi tim IT kami.\n\nTerima kasih!\n\nInfo lebih lanjut tentang tiket ini: " . $link;

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

    if ($result) {
        redirectToFacilitiesPage('Data Berhasil Di Input', 'success');
    } else {
        redirectToFacilitiesPage('Data Gagal Di Input', 'error');
    }
}
