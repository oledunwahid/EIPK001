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
                                            <div class="text-muted">
                                                <span>Create Date :</span>
                                                <span class="fw-semibold"><?= $row['start_date'] ?></span>
                                            </div>
                                            <div class="vr"></div>
                                            <div class="text-muted">
                                                <span>Process Date :</span>
                                                <span class="fw-semibold"><?= $row['proses_date'] ?></span>
                                            </div>
                                            <div class="vr"></div>
                                            <div class="text-muted">
                                                <span>Closed Date :</span>
                                                <span class="fw-semibold"><?= $row['end_date'] ?></span>
                                            </div>

                                            <br>


                                            <div class="row-lg-4 col-md-6">
                                                <div class="mb-6">
                                                    <div class="me-2 form-label text-muted"><span>Status :</span></div>
                                                    <div>
                                                        <select class="form-control" data-choices name="status_tiket">
                                                            <?php
                                                            $statusOptions = ['Closed', 'Process', 'Pending', 'Reject'];

                                                            foreach ($statusOptions as $option) {
                                                                $selected = ($option === $row['status_tiket']) ? 'selected' : '';
                                                                echo '<option value="' . $option . '" ' . $selected . '>' . $option . '</option>';
                                                            }
                                                            ?>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>


                                            <div class="col-lg-4 row-md-8">
                                                <div class="mb-6">
                                                    <label for="choices-single-default" class="form-label text-muted"><span>Request Type :</span></label>
                                                    <select class="form-control" data-choices name="kategori_tiket">
                                                        <?php
                                                        $statusOptions = ['Cloud Storage', 'Email', 'Hardware', 'Network', 'Printer & Scanner', 'Software', 'Documentation', 'Infrastructure', 'License/Agreement'];
                                                        foreach ($statusOptions as $option) {
                                                            $selected = ($option === $row['kategori_tiket']) ? 'selected' : '';
                                                            echo '<option value="' . $option . '" ' . $selected . '>' . $option . '</option>';
                                                        }
                                                        ?>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="row-lg-4 col-md-6">
                                                <div class="mb-6">
                                                    <label for="choices-single-default" class="form-label text-muted"><span>Assigned To :</span></label>
                                                    <select class="form-control" data-choices name="nik_pic">
                                                        <option value="<?= $row['nik_pic'] ?>"><?= $row['nama_pic'] ?></option>
                                                        <?php
                                                        $sql5 = mysqli_query($koneksi, "SELECT access_level.idnik, user.nama FROM access_level INNER JOIN USER ON access_level.idnik = user.idnik WHERE user.lokasi = '$lokasilogin' AND it = 1 ");
                                                        while ($row5 = mysqli_fetch_assoc($sql5)) {
                                                        ?>
                                                            <option value="<?= $row5['idnik'] ?>"><?= $row5['nama'] ?> </option>
                                                        <?php } ?>
                                                    </select>
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
                        <label for="tasksTitle-field" class="form-label"><?= $row["disc_keluhan"]; ?></label>
                        <h6 class="fw-semibold text-uppercase mb-3">Justification IT</h6>
                        <textarea id="ckeditor-classic1" name="justification"><?= $row["justification"] ?></textarea>
                        <h6 class="fw-semibold text-uppercase mb-3 pt-4">Progress / Action Notes</h6>
                        <textarea id="ckeditor-classic2" name="action_note"><?= $row["action_note"] ?></textarea>


                    </div>
                    <div class="card-body">
                        <button type="submit" class="btn btn-primary col-md-3" name="updateIT">Update</button>
                        <a href="#" class="btn btn-danger col-md-3" name="delete" id="delete-form">Delete</a>
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

<script>
    document.addEventListener("DOMContentLoaded", function() {
        const deleteButton = document.getElementById('delete-form');

        deleteButton.addEventListener('click', function(event) {
            event.preventDefault();

            Swal.fire({
                title: 'Are you sure?',
                text: 'You are about to delete this item!',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Yes, delete it!',
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = 'function/delete_it_tiket.php?aksi=delete&id=<?= $_GET['id'] ?>';
                }
            });
        });
    });
</script>