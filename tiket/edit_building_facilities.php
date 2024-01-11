<?php
$sql = mysqli_query($koneksi, "SELECT ga_building.*,user.divisi,user.lokasi,user1.nama AS nama_request,
user2.nama AS nama_pic, login.username
FROM
ga_building
LEFT JOIN user   AS user1 ON ga_building.nik_request = user1.idnik
LEFT JOIN user   AS user2 ON ga_building.nik_pic = user2.idnik
INNER JOIN
	user
	ON 
		ga_building.nik_request = user.idnik
        INNER JOIN
	login
	ON 
		user.idnik = login.idnik
WHERE id_ga_building ='" . $_GET['id'] . "' ");
$row = mysqli_fetch_assoc($sql);

$id_ga_building = $_GET['id'];

$dateTime = new DateTime('now', new DateTimeZone('Asia/Jakarta'));
$timestamp = $dateTime->format('Y-m-d H:i:s');

?>

<form action="function/update_ga_building.php" method="POST" enctype="multipart/form-data">
    <div class="row">
        <div class="col-lg-12">
            <div class="card mt-n4 mx-n4 mb-n5">
                <div class="bg-soft-warning">
                    <div class="card-body pb-4 mb-5">
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
                                    <input type="text" hidden name="id_ga_building" value="<?= $row['id_ga_building'] ?>">
                                    <input type="text" hidden name="wa" value="<?= $row['whatsapp'] ?>">
                                    <h4 class="fw-semibold" id="ticket-title">#<?= $row['id_ga_building'] ?> - Building Facilities Ticket </h4>
                                    <div class="hstack gap-3 flex-wrap">
                                        <div class="text-muted"><i class="ri-building-line align-bottom me-1"></i><span id="ticket-client">MAA Group</span></div>
                                        <div class="vr"></div>
                                        <div class="me-2 text-muted">Status : </div>
                                        <div>
                                            <select class="form-control" data-choices name="statusBuilding">
                                                <?php
                                                $statusOptions = [
                                                    'Closed',
                                                    'On Process',
                                                    'Canceled',
                                                ];

                                                $lastUpdatedStatus = $row['status'];

                                                foreach ($statusOptions as $option) {
                                                    $selected = ($option === $lastUpdatedStatus) ? 'selected' : '';
                                                    echo '<option value="' . $option . '" ' . $selected . '>' . $option . '</option>';
                                                }
                                                ?>
                                            </select>
                                        </div>


                                        <div class="vr"></div>
                                        <div class="me-3 text-muted">Assigned To :</div>
                                        <div>
                                            <select class="form-select" name="nik_pic" data-choices id="choices-status-input">
                                                <option value="<?= $row['nik_pic'] ?>"><?= $row['nama_pic'] ?></option>
                                                <?php
                                                $sql5 = mysqli_query($koneksi, "SELECT access_level.idnik, user.nama 
                                                    FROM access_level 
                                                    INNER JOIN user  ON access_level.idnik = user.idnik 
                                                    WHERE access_level.ga2 = 1");
                                                while ($row5 = mysqli_fetch_assoc($sql5)) {
                                                ?>
                                                    <option value="<?= $row5['idnik'] ?>"><?= $row5['nama'] ?></option>
                                                <?php
                                                }
                                                ?>
                                            </select>
                                        </div>

                                    </div>
                                </div>
                                <!--end row-->
                            </div>
                        </div>
                        <!--end row-->

                    </div>
                </div><!-- end card -->
            </div>
        </div>

        <div class="col-xl-8">
            <div class="card">
                <div class="card-header">
                    <div class="d-sm-flex align-items-center">
                        <h5 class="card-title flex-grow-1 mb-2">Ticket Description</h5>
                    </div>
                    <div style="border: 1px solid #ccc; border-radius: 5px; padding: 10px; box-shadow: 2px 2px 5px rgba(0, 0, 0, 0.2);">
                        <label for="tasksTitle-field" class="form-label"><?= $row["description"]; ?></label>
                    </div>
                    <div class="p-4">
                        <h6 class="fw-semibold text-uppercase mb-3">Justification</h6>
                        <textarea id="ckeditor-classic1" name="justification"><?= $row["justification"] ?></textarea>
                        <h6 class="fw-semibold text-uppercase mb-3 pt-4">Progress / Action Notes</h6>
                        <textarea id="ckeditor-classic2" name="action_note"><?= $row["action_note"] ?></textarea>
                    </div>
                    <div class="col-md-8 pb-3">
                        <div class="card-body">
                            <button type="submit" class="btn btn-primary col-md-3" name="updateBuilding">Update</button>
                            <a href="#" class="btn btn-danger col-md-3" name="deleteBuilding" id="delete-form">Delete</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
</form>







<div class="col-xl-4">
    <div class="card">
        <div class="card-header">
            <h5 class="card-title fw-semibold mb-0">Ticketing Details</h5>
        </div>
        <div class="card-body">
            <div class="table-responsive table-card">
                <table class="table table-borderless align-middle mb-0">
                    <tbody>
                        <tr>
                            <td class="fw-medium">ID Ticket</td>
                            <td><?= $row['id_ga_building'] ?></td>
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
                            <td class="fw-medium">Start Date</td>
                            <td><?= $row['start_date'] ?></td>
                        </tr>
                        <tr>
                            <td class="fw-medium">End Date</td>
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
        $file = "file/facilities/" . $row['file'];
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
                        $file_extension = pathinfo($row['file'], PATHINFO_EXTENSION);
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
                <?php if ($row['file']) : ?>
                    <div class="flex-grow-1 ms-3">
                        <a href="file/facilities/<?= $row['file'] ?>" class="download-link">
                            <i class="mb-1 ri-download-2-line"></i> <?= $row['file'] ?>
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
</div>
</div>



<script src="assets/libs/@ckeditor/ckeditor5-build-classic/build/ckeditor.js"></script>
<script src="assets/js/pages/project-create.init.js"></script>
<script src="assets/js/pages/ticketdetail.init.js"></script>

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
                    window.location.href = 'function/delete_ga_building.php?aksi=deleteBuilding&id=<?= $_GET['id'] ?>';
                }
            });
        });
    });
</script>