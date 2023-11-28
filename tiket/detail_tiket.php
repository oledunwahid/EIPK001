<?php
$sql = mysqli_query($koneksi, "SELECT ticketing.*,user.divisi,user.lokasi,user1.nama AS nama_request,
user2.nama AS nama_pic, login.username
FROM
ticketing
LEFT JOIN USER AS user1 ON ticketing.id_nik_request = user1.idnik
LEFT JOIN USER AS user2 ON ticketing.nik_pic = user2.idnik
INNER JOIN
	user
	ON 
		ticketing.id_nik_request = user.idnik
        INNER JOIN
	login
	ON 
		user.idnik = login.idnik
where id_tiket ='" . $_GET['id'] . "' ");
$row = mysqli_fetch_assoc($sql);

$id_tiket1 = $_GET['id'];



?>
<div class="row">
    <form action="function/update_it_tiket.php" method="POST">
        <div class="col-lg-12">
            <div class="card mt-n4 mx-n4 mb-n5">
                <div class="bg-soft-warning">
                    <div class="card-body pb-4 mb-5">
                        <div class="row">
                            <div class="col-md">
                                <div class="row align-items-center">
                                    <div class="col-md-auto">
                                        <div class="avatar-md mb-md-0 mb-4">
                                            <div class="avatar-title  rounded-circle" style="background-color: #b30000">
                                                <img src="assets/images/logo_MAAA.png" alt="" width="65px" />
                                            </div>
                                        </div>
                                    </div>
                                    <!--end col-->
                                    <div class="col-md">
                                        <input type="text" hidden name="id_tiket" value="<?= $row['id_tiket'] ?>">


                                        <h4 class="fw-semibold" id="ticket-title">#<?= $row['id_tiket'] ?> - Request Ticketing</h4>
                                        <div class="hstack gap-3 flex-wrap">
                                            <div class="text-muted"><i class="ri-building-line align-bottom me-1"></i><span id="ticket-client">MAA Group</span></div>
                                            <div class="vr"></div>
                                            <div class="text-muted"><span>Create Date :</span> <?= $row['start_date'] ?></span></div>
                                            <div class="vr"></div>
                                            <div class="text-muted"><span>Process Date :</span> <?= $row['proses_date'] ?></span></div>
                                            <div class="vr"></div>
                                            <div class="text-muted"><span>Closed Date :</span><?= $row['end_date'] ?></div>
                                            <br>
                                            <div class="col-lg-4  hstack gap-3 flex-wrap">
                                                <div class="mt-9">
                                                    <label for="choices-single-default" class="form-label text-muted"><span>Status : </span> <span style="font-weight: bold;"><?= $row['status_tiket'] ?></span></label>
                                                    <div class="vr"></div>
                                                    <label for="choices-single-default" class="form-label text-muted"><span>Request Type : </span><span style="font-weight: bold;"><?= $row['kategori_tiket'] ?></span></label>
                                                    <div class="vr"></div>
                                                    <label for="choices-single-default" class="form-label text-muted"><span>Assigned To : </span><span style="font-weight: bold;"><?= $row['nama_pic'] ?></span></label>
                                                </div>

                                            </div>

                                        </div>
                                        <!--end col-->
                                    </div>
                                    <!--end row-->
                                </div>
                            </div>
                            <!--end row-->
                        </div><!-- end card body -->
                    </div>
                </div><!-- end card -->
            </div><!-- end col -->
        </div><!-- end row -->

        <div class="row">
            <div class="col-lg-8">
                <div class="card">

                    <div class="card-body">
                        <h6 class="fw-semibold text-uppercase mb-3">Ticket Description</h6>
                        <div style="border: 1px solid #ccc; border-radius: 5px; padding: 10px; box-shadow: 2px 2px 5px rgba(0, 0, 0, 0.2);">
                            <label for="tasksTitle-field" class="form-label"><?= $row["disc_keluhan"]; ?></label>
                        </div>
                        <br>

                        <h6 class="fw-semibold text-uppercase mb-3">Justification IT</h6>
                        <div style="border: 1px solid #ccc; border-radius: 5px; padding: 10px; box-shadow: 2px 2px 5px rgba(0, 0, 0, 0.2);">
                            <label for="tasksTitle-field" class="form-label"><?= $row["justification"] ?></label>
                        </div>
                        <h6 class="fw-semibold text-uppercase mb-3 pt-4">Progress / Action Notes</h6>
                        <div style="border: 1px solid #ccc; border-radius: 5px; padding: 10px; box-shadow: 2px 2px 5px rgba(0, 0, 0, 0.2);">
                            <label for="tasksTitle-field" class="form-label"><?= $row["action_note"] ?></label>
                        </div>
                    </div>
                </div>
            
    </form>
    <!--end col-->

    <!--end col-->
</div>
<!--end row-->
<div class="col-xl-4">
    <div class="card">
        <div class="card-header">
            <h5 class="card-title fw-semibold mb-0">Ticket Details</h5>
        </div>
        <div class="card-body">
            <div class="table-responsive table-card">
                <table class="table table-borderless align-middle mb-0">
                    <tbody>
                        <tr>
                            <td class="fw-medium">Ticket</td>
                            <td><?= $row['id_tiket'] ?></td>
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
                            <td class="fw-medium">Start-Date</td>
                            <td><?= $row['start_date'] ?></td>
                        </tr>
                        <tr>
                            <td class="fw-medium">End-Date</td>
                            <td><?= $row['end_date'] ?></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

    </div>

    <div class="card">
        <div class="card-header">
            <h6 class="card-title fw-semibold mb-0">Files Attachment</h6>
        </div>
        <?php
        $file = "file/it/" . $row['lampiran1'];
        $filesize = filesize($file);
        if ($filesize >= 1024 * 1024) {
            $filesize = number_format($filesize / (1024 * 1024), 2) . ' MB';
        } elseif ($filesize >= 1024) {
            $filesize = number_format($filesize / 1024, 2) . ' KB';
        } else {
            $filesize = $filesize . ' bytes';
        }
        ?>
        <div class="card-body">
            <div class="d-flex align-items-center border border-dashed p-2 rounded">
                <div class="flex-shrink-0 avatar-sm">
                    <div class="avatar-title bg-light rounded">
                        <?php
                        $file_extension = pathinfo($row['lampiran1'], PATHINFO_EXTENSION);
                        if ($file_extension === 'jpg' || $file_extension === 'jpeg' || $file_extension === 'png') {
                            echo '<i class="ri-image-line fs-20 text-primary"></i>';
                        } elseif ($file_extension === 'pdf') {
                            echo '<i class="ri-file-pdf-line fs-20 text-danger"></i>';
                        } else {
                            echo '<i class="ri-file-zip-line fs-20 text-primary"></i>';
                        }
                        ?>
                    </div>
                </div>
                <?php if ($row['lampiran1']) : ?>
                    <div class="flex-grow-1 ms-3">
                        <a href="file/it/<?= $row['lampiran1'] ?>" class="download-link">
                            <i class="mb-1 ri-download-2-line"></i> <?= $row['lampiran1'] ?>
                            <small class="text-muted">(<?= $filesize ?>)</small>
                        </a>
                    </div>
                <?php else : ?>
                    <div class="flex-grow-1 ms-3 mt-3 alert alert-info" role="alert">
                        <i class="fa fa-info-circle me-2"></i>
                        No files uploaded.
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>



    <!-- <div class="card">
        <div class="card-header">
            <h6 class="card-title fw-semibold mb-0">Other Files Attachment</h6>
        </div>
        <div class="card-body">
            <div class="d-flex align-items-center border border-dashed p-2 rounded mt-2">
                <?php if (!empty($lampiran2)) : ?>
                    <div class="flex-shrink-0 avatar-sm">
                        <a href="#" data-toggle="modal" data-target="#lampiran2Modal">
                            <img src="../files/lampiran2/<?php echo $lampiran2; ?>" alt="Lampiran 2" />
                        </a>
                    </div>
                <?php else : ?>
                    <div class="alert alert-info mt-3 d-flex align-items-center">
                        <i class="fa fa-info-circle me-2"></i>
                        <div>
                            No files uploaded.
                        </div>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div> -->




</div>



<script src="../assets/libs/@ckeditor/ckeditor5-build-classic/build/ckeditor.js"></script>
<script src="../assets/js/pages/project-create.init.js"></script>
<script src="../assets/js/pages/ticketdetail.init.js"></script>