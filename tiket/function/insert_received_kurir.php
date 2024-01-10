<?php
require_once("../koneksi.php");

if (isset($_POST["add-received"])) {
    $currentDateTime = new DateTime('now', new DateTimeZone('Asia/Jakarta'));
    $timestamp = $currentDateTime->format('ymdHis');
    $RequestNumber = "RK" . $timestamp . str_pad(1, '0', STR_PAD_LEFT);

    $id_received = $RequestNumber;
    $received_jenis_barang = $_POST["jenisBarang"];
    $nama_pengirim =  $_POST["namaPengirim"];
    $nama_ekspedisi =  $_POST["namaEkspedisi"];
    $no_resi =  $_POST["noResi"];
    $idpic =   $_POST["idPIC"];
    $idnik =   $_POST["namaTujuan"];
    $whatsapp =  $_POST["wa"];
    $nama_pt = $_POST["namaPT"];
    $status_input = $_POST["status_input"];

    if (isset($_FILES['buktiFoto']['name']) && !empty($_FILES['buktiFoto']['name'])) {
        $ekstensi_diperbolehkan = array('pdf', 'xlsx', 'xls', 'doc', 'docx', 'jpg', 'png', 'jpeg');
        $nama_lampiran1 = $_FILES['buktiFoto']['name'];
        $file_ren = time() . '-' . $_FILES['buktiFoto']['name'];

        $x = explode('.', $file_ren);
        $extensi = strtolower(end($x));
        $ukuran = $_FILES['buktiFoto']['size'];
        $file_tmp = $_FILES['buktiFoto']['tmp_name'];

        if (in_array($extensi, $ekstensi_diperbolehkan) === true) {
            if ($ukuran < 5044070) {
                move_uploaded_file($file_tmp, '../file/facilities/' . $file_ren);
                $bukti_foto = $file_ren;
            } else {
                session_start();
                $_SESSION["Messages"] = 'Fail! File Size Too Big';
                $_SESSION["Icon"] = 'error';
                header('Location: ../index.php?page=Received&Gagal-Size-Too_Big');
                exit();
            }
        } else {
            session_start();
            $_SESSION["Messages"] = 'Fail! Wrong File Format';
            $_SESSION["Icon"] = 'error';
            header('Location: ../index.php?page=Received&Gagal-Wrong_Format');
            exit();
        }
    } else {
        $bukti_foto = ''; // Set default value if 'buktiFoto' is not uploaded
    }

    $query = "INSERT INTO rf_received_package (id_received, id_nik_pic,received_date, received_jenis_barang, nama_pengirim, nama_ekspedisi, no_resi, idnik, no_hp, nama_pt, bukti_foto, status_received) 
    VALUES ('$id_received','$idpic',  NOW(), '$received_jenis_barang', '$nama_pengirim', '$nama_ekspedisi', '$no_resi', '$idnik', '$whatsapp', '$nama_pt', '$bukti_foto', 'Received')";

    $kondisi = mysqli_query($koneksi, $query);

    if ($kondisi) {
        $namaEmployee = 'Bapak/Ibu';
        $link = 'https://localhost/index.php?page=ViewReceived&id=' . $id_received;
        $message = "Halo " . $namaEmployee . "!\n\nTicketing dengan ID #" . $id_received . " Anda sudah berhasil dibuat dengan status 'Received'\n\nTerima kasih telah menggunakan layanan kami. Jangan lupa untuk selalu cek Employee Information Portal (EIP) untuk informasi selanjutnya. Jika Anda memiliki pertanyaan lebih lanjut atau membutuhkan bantuan, jangan ragu untuk menghubungi tim IT kami.\n\nTerima kasih!\n\nInfo lebih lanjut tentang tiket ini: " . $link;

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
                'countryCode' => '62',
            ),
            CURLOPT_HTTPHEADER => array(
                'Authorization: SuQ7o9ufuZ89LqrLjN9N'
            ),
        ));

        $response = curl_exec($curl);
        curl_close($curl);

        $query2 = "INSERT INTO rf_riwayat_received_package VALUES
        ('', '$id_received', '$timestamp', 'Received','$status_input')";
        $kondisi2 = mysqli_query($koneksi, $query2);

        if ($kondisi2) {
            session_start();
            $_SESSION["Messages"] = 'Data Berhasil Di Input';
            $_SESSION["Icon"] = 'success';
        } else {
            session_start();
            $_SESSION["Messages"] = 'Data Gagal Di Input';
            $_SESSION["Icon"] = 'error';
        }
        header('Location: ../index.php?page=Received');
        exit();
    } else {
        session_start();
        $_SESSION["Messages"] = 'Data Gagal Di Input';
        $_SESSION["Icon"] = 'error';
        header('Location: ../index.php?page=Received');
        exit();
    }
}
