<?php
$sql = mysqli_query($koneksi, "SELECT ga_stationary.*,user.divisi,user.lokasi,user1.nama AS nama_request,
user2.nama AS nama_pic, login.username
FROM
ga_stationary
LEFT JOIN USER AS user1 ON ga_stationary.nik_request = user1.idnik
LEFT JOIN USER AS user2 ON ga_stationary.nik_pic = user2.idnik
INNER JOIN
	user
	ON 
		ga_stationary.nik_request = user.idnik
        INNER JOIN
	login
	ON 
		user.idnik = login.idnik
where id_ga_stationary ='" . $_GET['id'] . "' ");
$row = mysqli_fetch_assoc($sql);

$id_tiket1 = $_GET['id'];



?>
<div class="row">
    <form action="function/update_ga_facilities.php" method="POST">
        <input type="text" hidden name="id_nik_request" value="<?= $row['nik_request'] ?>">
        <div class="row">
            <div class="col-lg-12">
                <div class="card mt-n4 mx-n4 mb-n5">
                    <div class="bg-soft-warning">
                        <div class="card-body pb-4 mb-5">
                            <div class="row">
                                <div class="col-md">
                                    <div class="row align-items-center">
                                        <div class="col-md-auto">
                                            <div class="avatar-md mb-md-0 mb-4">
                                                <input type="hidden" name="_method" value="PUT">
                                                <div class="avatar-title rounded-circle" style="background-color: #b30000">
                                                    <img src="assets/images/logo_MAAA.png" alt="" width="65px" />
                                                </div>
                                            </div>
                                        </div>
                                        <!--end col-->

                                        <div class="col-md">
                                            <h4 class="fw-semibold" id="ticket-title">#<?= $row['id_ga_stationary'] ?> - ATK / Stationary</h4>
                                            <div class="hstack gap-3 flex-wrap">
                                                <div class="text-muted"><i class="ri-building-line align-bottom me-1"></i>
                                                    MAA GROUP</div>
                                                <div class="vr"></div>
                                                <div>
                                                    <div class="mb-6">
                                                        <label for="choices-single-default" class="form-label text-muted"><span>Status :</span></label>
                                                        <div>
                                                            <select class="form-control" data-choices name="statusATK">
                                                                <?php
                                                                $statusOptions = ['Closed', 'Process', 'Pending', 'Reject'];

                                                                foreach ($statusOptions as $option) {
                                                                    $selected = ($option === $row['status']) ? 'selected' : '';
                                                                    echo '<option value="' . $option . '" ' . $selected . '>' . $option . '</option>';
                                                                }
                                                                ?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="vr"></div>
                                                <div class="text-muted">Assigned To : <span class="fw-medium"> </span>
                                                </div>
                                                <div>
                                                    <select class="form-select" name="nik_pic" data-choices id="choices-status-input">
                                                        <option value="">No Set</option>
                                                        <?php foreach ($usersGA as $userGA) : ?>
                                                            <option value="<?= $userGA->idnik ?>" <?= $ticket->nik_pic == $userGA->idnik ? 'selected' : '' ?>>
                                                                <?= $userGA->nama ?>
                                                            </option>
                                                        <?php endforeach; ?>
                                                    </select>
                                                </div>
                                                <div>
                                                    <button type="submit" class="btn btn-primary">Update</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
    <!--end col-->

    <!--end col-->
</div>

<div class="card-body border border-dashed border-end-0 border-start-0">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <table id="buttons-datatables" class="display table table-bordered dt-responsive" style="width:100%">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>ID Ticket</th>
                                <th>ID ATK</th>
                                <th>Deskripsi</th>
                                <th>Total Request</th>
                                <th>Total Approve</th>
                                <th>Feedback</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $sql6 = "SELECT ga_stationary.*, user1.nama AS nik_request, user2.nama AS nik_pic
                                    FROM ga_stationary
                                    LEFT JOIN USER AS user1 ON ga_stationary.nik_request = user1.idnik
                                    LEFT JOIN USER AS user2 ON ga_stationary.nik_pic = user2.idnik
                                    INNER JOIN USER ON ga_stationary.nik_request = user.idnik";
                            $result6 = mysqli_query($koneksi, $sql6);
                            $rowNumber = 1;
                            while ($row6 = mysqli_fetch_assoc($result6)) {
                            ?>
                                <tr>
                                    <td><?= $rowNumber ?></td>
                                    <td><?= $row6[''] ?></td>
                                    <td><?= $row6[''] ?></td>
                                    <td><?= $row6[''] ?></td>
                                    <td><?= $row6[''] ?></td>
                                    <td><?= $row6[''] ?></td>
                                    <td><?= $row6[''] ?></td>
                                    <td>
                                        <div>
                                            <button type="submit" class="btn btn-primary">Edit</button>
                                        </div>
                                    </td>
                                </tr>
                            <?php
                                $rowNumber++;
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
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
                            <td><?= $row['id_ga_stationary'] ?></td>
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








</div>
</div>


</div>


<script src="../assets/libs/@ckeditor/ckeditor5-build-classic/build/ckeditor.js"></script>
<script src="../assets/js/pages/project-create.init.js"></script>
<script src="../assets/js/pages/ticketdetail.init.js"></script>