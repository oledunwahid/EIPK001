<?php
require_once("../koneksi.php");

if (isset($_POST["add-request"])) {
    $id_kurir = $_POST['id_kurir'];
    $tanggal_req = $_POST["tanggalRequest"];
    $jenis_barang = $_POST["jenisBarang"];
    $id_nik_request = $_POST["id_nik_request"];
    $description = $_POST["catatanKurir"];
    $alamat_kurir = $_POST["alamatKurir"];
    $id_nik_kurir = $_POST["id_nik_kurir"];
    $whatsapp = $_POST["wa"];
    $tipe_kurir = $_POST["tipe_kurir"];
    $status_kurir = $_POST["status_kurir"];
    $status_input = $_POST["status_input"];

    $query = "INSERT INTO kurir VALUES
    ('$id_kurir', '$id_nik_request', '$tanggal_req', '$jenis_barang', '$whatsapp',  '$tipe_kurir', '$description','$alamat_kurir','$id_nik_kurir', '', 'On Process')";
    $kondisi = mysqli_query($koneksi, $query);

    $namaEmployee = 'Bapak/Ibu'; // Ganti dengan nama yang sesuai
    $link = 'https://eip.maagroup.co.id/tiket/index.php?page=ViewKurir&id=' . $id_kurir; // Ganti dengan URL yang valid

    $message = "Halo " . $namaEmployee . "!\n\nPackage dengan ID #" . $id_kurir . " Anda sudah berhasil dibuat dengan status 'Pending'\n\nTerima kasih telah menggunakan layanan kami. Jangan lupa untuk selalu cek Employee Information Portal (EIP) untuk informasi selanjutnya. Jika Anda memiliki pertanyaan lebih lanjut atau membutuhkan bantuan, jangan ragu untuk menghubungi tim IT kami.\n\nTerima kasih!\n\nInfo lebih lanjut tentang tiket ini: " . $link;

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

    $tanggal_req = date('Y-m-d H:i:s');
    $currentDateTime = new DateTime('now', new DateTimeZone('Asia/Jakarta'));
    $timestamp = $currentDateTime->format('YmdHis');

    $query2 = "INSERT INTO riwayat_kurir VALUES
    ('', '$id_kurir', '$timestamp', 'Pending','$status_input')";
    $kondisi2 = mysqli_query($koneksi, $query2);

    if ($kondisi && $kondisi2) {
        session_start();
        $_SESSION["Messages"] = 'Data Berhasil Di Input';
        $_SESSION["Icon"] = 'success';
    } else {
        session_start();
        $_SESSION["Messages"] = 'Data Gagal Di Input';
        $_SESSION["Icon"] = 'error';
    }
    header('Location: ../index.php?page=Delivery');
    exit();
}
