<?php
$sql = mysqli_query($koneksi, "SELECT ga_building.*,user.divisi,user.lokasi,user1.nama AS nama_request,
user2.nama AS nama_pic, login.username
FROM
ga_building
LEFT JOIN USER AS user1 ON ga_building.nik_request = user1.idnik
LEFT JOIN USER AS user2 ON ga_building.nik_pic = user2.idnik
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

<div class="row">
    <input type="text" hidden name="nik_request" value="<?= $row['nik_request'] ?>">
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
                                        <input type="text" hidden name="id_ga_building" value="<?= $row['id_ga_building'] ?>">
                                        <h4 class="fw-semibold" id="ticket-title">#<?= $row['id_ga_building'] ?> - Building Ticket </h4>
                                        <div class="hstack gap-3 flex-wrap">
                                            <div class="text-muted"><i class="ri-building-line align-bottom me-1"></i><span id="ticket-client">MAA Group</span></div>
                                            <div class="vr"></div>
                                            <div class="me-2 text-muted">Status : </div>
                                            <div>
                                                <select class="form-control" data-choices name="statusKurir">
                                                    <?php
                                                    $statusOptions = [
                                                        0 => 'Closed',
                                                        1 => 'On Process',
                                                        2 => 'Canceled',
                                                    ];

                                                    $lastUpdatedStatus = $row['status_kurir'];

                                                    foreach ($statusOptions as $value => $option) {
                                                        $selected = ($value == $lastUpdatedStatus) ? 'selected' : '';
                                                        echo '<option value="' . $value . '" ' . $selected . '>' . $option . '</option>';
                                                    }
                                                    ?>
                                                </select>
                                            </div>


                                            <div class="vr"></div>
                                            <div class="me-2 text-muted">Assigned To :</div>
                                            <div>
                                                <select class="form-select" name="nik_pic" data-choices id="choices-status-input">
                                                    <option value="<?= $row['nik_pic'] ?>"><?= $row['nama_pic'] ?></option>
                                                    <?php
                                                    $sql5 = mysqli_query($koneksi, "SELECT access_level.idnik, user.nama 
                                                    FROM access_level 
                                                    INNER JOIN USER ON access_level.idnik = user.idnik 
                                                    WHERE access_level.ga2 = 1");
                                                    while ($row5 = mysqli_fetch_assoc($sql5)) {
                                                    ?>
                                                        <option value="<?= $row5['idnik'] ?>"><?= $row5['nama'] ?></option>
                                                    <?php
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                            <div class="col-md-5">
                                                <div class="card-body">
                                                    <button type="submit" class="btn btn-primary col-md-3" name="updateKurir">Update</button>
                                                    <a href="#" class="btn btn-danger col-md-3" name="delete" id="delete-form">Delete</a>
                                                </div>
                                            </div>
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
                            <h5 class="card-title flex-grow-1 mb-2">Ticket Description</h5>
                        </div>
                        <div style="border: 1px solid #ccc; border-radius: 5px; padding: 10px; box-shadow: 2px 2px 5px rgba(0, 0, 0, 0.2);">
                            <label for="tasksTitle-field" class="form-label"><?= $row["description"]; ?></label>
                        </div>
                    </div>
                    <div class="card-body p-4">
                        <h5 class="card-title flex-grow-1 mb-2">Feedback</h5>
                        <!-- Feedback dari GA PIC -->
                        <div>
                            <div class="d-flex mb-4">
                                <div class="flex-shrink-0">
                                    <img src="../assets/images/users/avatar-9.jpg" alt="" class="avatar-xs rounded-circle" />
                                </div>
                                <div class="flex-grow-1 ms-3">
                                    <h5 class="fs-13">General Affair PIC <small><?php echo date('d M Y - h:iA', strtotime('2023-12-27 05:47AM')); ?></small>
                                    </h5>
                                    <p>I got a message from you guys that they have a problem. Can you state their problems?</p>
                                </div>
                            </div>
                        </div>

                        <!-- Feedback dari user -->
                        <div>
                            <div class="d-flex mb-4">
                                <div class="flex-shrink-0">
                                    <img src="../assets/images/users/avatar-1.jpg" alt="" class="avatar-xs rounded-circle" />
                                </div>
                                <div class="flex-grow-1 ms-3">
                                    <h5 class="fs-13"><?= $row['nama_request'] ?> <small><?php echo date('d M Y - h:iA', strtotime($timestamp)); ?></small>
                                    </h5>
                                    <p>Feedback text goes here...</p>
                                </div>
                            </div>
                        </div>

                        <!-- Form untuk menambah feedback baru -->
                        <?php if ($row['status'] != 'Closed') : ?>
                            <div>
                                <form action="function/insert_feedback.php" method="POST" class="mt-3">
                                    <input type="hidden" name="id_ga_building" value="<?= $row['id_ga_building'] ?>">
                                    <div class="row g-3">
                                        <div class="col-lg-12">
                                            <label for="keterangan_komen" class="form-label">Leave a Feedback</label>
                                            <textarea class="form-control bg-light border-light" name="keterangan_komen" rows="3" placeholder="Type Here"></textarea>
                                        </div>
                                        <div class="col-lg-12">
                                            <button type="submit" class="btn btn-secondary">Post Feedback</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        <?php else : ?>
                            <div class="alert alert-warning" role="alert">
                                Feedback cannot be added as the ticket is already closed.
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>


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
            </div>
        </div>
    </div>
</div>