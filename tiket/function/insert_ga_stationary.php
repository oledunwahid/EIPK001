<?php
require_once("../koneksi.php");

if (isset($_POST["add-stationary"])) {
    function generateTimestampedID($prefix, $counter)
    {
        $currentDateTime = new DateTime('now', new DateTimeZone('Asia/Jakarta'));
        $timestamp = $currentDateTime->format('ymdHis');
        return $prefix . $timestamp . str_pad($counter, 1, '0', STR_PAD_LEFT);
    }

    // Generate unique IDs based on counters obtained from the database
    $id_ga_stationary = generateTimestampedID("ATK", 1); // Replace '1' with counter retrieved from the database
    $id_request_detail = generateTimestampedID("ARD", 1); // Replace '1' with counter retrieved from the database

    $nik_request = $_POST["nikRequest"];
    $nama_pic = $_POST["nikPIC"];
    $whatsapp = $_POST["wa"];
    $category = $_POST["category"];
    $status = $_POST["statusATK"];
    $start_date = $_POST["startDate"];

    // Example of using arrays for multiple values
    $idATK = array($_POST["idATK1"], $_POST["idATK2"], $_POST["idATK3"], $_POST["idATK4"], $_POST["idATK5"]);
    $totalReq = array($_POST["totalReq1"], $_POST["totalReq2"], $_POST["totalReq3"], $_POST["totalReq4"], $_POST["totalReq5"]);

    // Insert ga_stationary
    $query = "INSERT INTO ga_stationary VALUES ('$id_ga_stationary', '$nik_request', '$nama_pic', '$whatsapp', '$category', 'Pending', '$start_date', '')";
    $kondisi = mysqli_query($koneksi, $query);

    $namaEmployee = 'Bapak/Ibu'; // Ganti dengan nama yang sesuai
    $link = 'https://eip.maagroup.co.id/tiket/index.php?page=ViewATK/Stationary&id=' . $id_ga_stationary; // Ganti dengan URL yang valid

    $message = "Halo " . $namaEmployee . "!\n\nTicketing dengan ID #" . $id_ga_stationary . " Anda sudah berhasil dibuat dengan status 'On Process'\n\nTerima kasih telah menggunakan layanan kami. Jangan lupa untuk selalu cek Employee Information Portal (EIP) untuk informasi selanjutnya. Jika Anda memiliki pertanyaan lebih lanjut atau membutuhkan bantuan, jangan ragu untuk menghubungi tim IT kami.\n\nTerima kasih!\n\nInfo lebih lanjut tentang tiket ini: " . $link;

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
        // Insert into stationary_request_detail for each item
        foreach ($idATK as $key => $value) {
            // Generate a unique ID for each detail entry
            $detail_id = generateTimestampedID("ARD", $key + 1); // Use $key as part of the ID generation

            $query2 = "INSERT INTO atk_detail_request VALUES ('$detail_id', '$id_ga_stationary', '$value', '$totalReq[$key]', '', '')";
            $kondisi2 = mysqli_query($koneksi, $query2);

            // Handle errors or further processing if needed
            if (!$kondisi2) {
                // Additional processing for failure
                echo "Error: " . mysqli_error($koneksi);
                // You can choose to break the loop, log the error, or perform other actions
                break;
            }
        }

        session_start();
        $_SESSION["Messages"] = 'Data Berhasil Di Input';
        $_SESSION["Icon"] = 'success';
        header('Location: ../index.php?page=ATK/Stationary&benar');
        die();
    } else {
        // Handle ga_stationary insertion failure
        session_start();
        $_SESSION["Messages"] = 'Data Gagal Di Input';
        $_SESSION["Icon"] = 'error';
        header('Location: ../index.php?page=ATK/Stationaryt&salah');
        die("akses dilarang");
    }
}
