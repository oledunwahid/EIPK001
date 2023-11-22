<?php
$sql = mysqli_query($koneksi, "SELECT kurir.*,user.divisi,user.lokasi,user1.nama AS nama_request,
user2.nama AS nama_pic, login.username
FROM
kurir
LEFT JOIN USER AS user1 ON kurir.id_nik_request = user1.idnik
LEFT JOIN USER AS user2 ON kurir.id_nik_kurir = user2.idnik
INNER JOIN
	user
	ON 
		kurir.id_nik_request = user.idnik
        INNER JOIN
	login
	ON 
		user.idnik = login.idnik
where id_kurir ='" . $_GET['id'] . "' ");
$row = mysqli_fetch_assoc($sql);

$id_kurir = $_GET['id'];



?>
<div class="row">
    <input type="text" hidden name="id_nik_request" value="<?= $row['id_nik_request'] ?>">
    <div class="col-lg-12">
        <div class="card mt-n4 mx-n4 mb-n5">
            <div class="bg-soft-warning">
                <div class="card-body pb-4 mb-5">
                    <div class="row">
                        <div class="col-md">
                            <div class="row align-items-center">
                                <div class="col-md-auto">
                                    <div class="avatar-md mb-md-0 mb-4">
                                        <div class="avatar-title rounded-circle" style="background-color: #b30000">
                                            <img src="assets/images/logo_MAAA.png" alt="" width="65px" />
                                        </div>
                                    </div>
                                </div>


                                <div class="col-md">
                                    <form action="function/update_kurir.php" method="POST">
                                        <input type="text" hidden name="id_kurir" value="<?= $row['id_kurir'] ?>">
                                        <h4 class="fw-semibold" id="ticket-title">#<?= $row['id_kurir'] ?> - Delivery Ticket </h4>
                                        <div class="hstack gap-3 flex-wrap">
                                            <div class="text-muted"><i class="ri-building-line align-bottom me-1"></i><span id="ticket-client">MAA Group</span></div>
                                            <div class="vr"></div>
                                            <div class="me-2 text-muted">Status:
                                                <?php
                                                $statusOptions = [
                                                    0 => ['text' => 'Closed', 'class' => 'alert alert-danger'],
                                                    1 => ['text' => 'Active', 'class' => 'alert alert-success'],
                                                ];

                                                $lastUpdatedStatus = $row['status_kurir'];

                                                $statusText = $statusOptions[$lastUpdatedStatus]['text'] ?? 'Unknown';
                                                $statusClass = $statusOptions[$lastUpdatedStatus]['class'] ?? '';

                                                echo '<span class="' . $statusClass . '">' . $statusText . '</span>';
                                                ?>
                                            </div>


                                            <div class="vr"></div>
                                            <div class="me-2 text-muted">PIC Courier : <?= $row['nama_pic'] ?></div>
                                            <?php
                                            $sql5 = mysqli_query($koneksi, "SELECT access_menu.*, nama 
                                                                                    FROM access_menu 
                                                                                    INNER JOIN USER ON access_menu.idnik = user.idnik 
                                                                                    WHERE access_type ='Kurir'  ");
                                            while ($row5 = mysqli_fetch_assoc($sql5)) {
                                            ?>
                                            <?php
                                            }
                                            ?>
                                        </div>
                                    </form>
                                </div>
                                <!--end row-->
                            </div>
                        </div>
                        <!--end row-->
                    </div><!-- end card body -->
                </div>
            </div><!-- end card -->
        </div>
        <div class="row">
            <div class="col-lg-8">
                <div class="card">
                    <div class="card-header">
                        <div class="d-sm-flex align-items-center">
                            <h5 class="card-title flex-grow-1 mb-2">Note untuk Kurir</h5>
                        </div>
                        <div style="border: 1px solid #ccc; border-radius: 5px; padding: 10px; box-shadow: 2px 2px 5px rgba(0, 0, 0, 0.2);">
                            <label for="tasksTitle-field" class="form-label"><?= $row["deskripsi"]; ?></label>
                        </div>
                    </div>
                </div>


                <div class="card">
                    <div class="card-header">
                        <div class="d-sm-flex align-items-center">
                            <h5 class="card-title flex-grow-1 mb-0">Delivery Status</h5>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="profile-timeline">
                            <div class="accordion" id="accordionFlushExample">
                                <?php
                                $sql = "SELECT * FROM riwayat_kurir WHERE id_kurir = '$id_kurir'";
                                $result = mysqli_query($koneksi, $sql);
                                while ($row2 = mysqli_fetch_assoc($result)) {
                                    $status = $row2['status_riwayat'];
                                    $avatar_icon = '';

                                    if ($status === 'Pending') {
                                        $avatar_icon = '<i class=" las la-clock"></i>';
                                    } elseif ($status === 'Proses') {
                                        $avatar_icon = '<i class="las la-hourglass-half"></i>';
                                    } elseif ($status === 'Delivery') {
                                        $avatar_icon = '<i class="las la-truck"></i>';
                                    } elseif ($status === 'Delivered') {
                                        $avatar_icon = '<i class="las la-check-circle"></i>';
                                    } elseif ($status === 'Hold') {
                                        $avatar_icon = '<i class="las la-pause-circle"></i>';
                                    } elseif ($status === 'Rejected') {
                                        $avatar_icon = '<i class="las la-times-circle"></i>';
                                    } elseif ($status === 'Returned') {
                                        $avatar_icon = '<i class="las la-undo-alt"></i>';
                                    }

                                ?>
                                    <div class="accordion-item border-0">
                                        <div class="accordion-header" id="headingFive">
                                            <a class="accordion-button p-2 shadow-none" data-bs-toggle="collapse" href="#collapseFile" aria-expanded="false">
                                                <div class="d-flex align-items-center">
                                                    <div class="flex-shrink-0 avatar-xs">
                                                        <div class="avatar-title bg-light text-success rounded-circle">
                                                            <?= $avatar_icon ?>
                                                        </div>
                                                    </div>
                                                    <div class="flex-grow-1 ms-3">
                                                        <h6 class="fs-14 mb-0 fw-semibold">
                                                            <?= $row2['status_riwayat'] ?> -
                                                            <span class="fw-semibold"><?= date('l, j F Y g:i A', strtotime($row2["timestamp"])) ?>
                                                            </span>
                                                        </h6>
                                                    </div>
                                                </div>
                                            </a>
                                            <div id="collapseThree" class="accordion-collapse collapse show" aria-labelledby="headingThree" data-bs-parent="#accordionExample">
                                                <div class="accordion-body ms-2 ps-5 pt-0">
                                                    <h6 class="fs-14">
                                                        <span>ID Delivery Ticket</span><span> - <?= $row2["id_kurir"] ?></span>
                                                    </h6>
                                                    <h6 class="mb-1"><span class="fw-semibold">Description : </span><?= $row2['deskripsi_riwayat'] ?></h6>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


            <div class="col-xl-4">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title fw-semibold mb-0">Delivery Request Details</h5>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive table-card">
                            <table class="table table-borderless align-middle mb-0">
                                <tbody>
                                    <tr>
                                        <td class="fw-medium">ID Delivery</td>
                                        <td><?= $row['id_kurir'] ?></td>
                                    </tr>
                                    <tr>
                                        <td class="fw-medium">Client</td>
                                        <td><?= $row['nama_request'] ?></td>
                                    </tr>
                                    <tr>
                                        <td class="fw-medium">Email</td>
                                        <td><?= $row['username'] ?></td>
                                    </tr>
                                    <tr>
                                        <td class="fw-medium">No.Hp</td>
                                        <td><?= $row['whatsapp'] ?></td>
                                    </tr>
                                    <tr>
                                        <td class="fw-medium">Division</td>
                                        <td><?= $row['divisi'] ?></td>
                                    </tr>
                                    <tr>
                                        <td class="fw-medium">Office Location</td>
                                        <td><?= $row['lokasi'] ?></td>
                                    </tr>
                                    <tr>
                                        <td class="fw-medium">Alamat Pengiriman</td>
                                        <td><?= $row['alamat_kurir'] ?></td>
                                    </tr>
                                    <tr>
                                        <td class="fw-medium">Delivery Type</td>
                                        <td><?= $row['tipe_kurir'] ?></td>
                                    </tr>
                                    <tr>
                                        <td class="fw-medium">Item Types</td>
                                        <td><?= $row['jenis_barang'] ?></td>
                                    </tr>
                                    <tr>
                                        <td class="fw-medium">Request Date</td>
                                        <td><?= $row['tanggal_req'] ?></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!--end row-->


<script src="../assets/libs/@ckeditor/ckeditor5-build-classic/build/ckeditor.js"></script>
<script src="../assets/js/pages/project-create.init.js"></script>
<script src="../assets/js/pages/ticketdetail.init.js"></script>