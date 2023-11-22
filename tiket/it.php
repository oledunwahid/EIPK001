<link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css" />
<!--datatable responsive css-->
<link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.bootstrap.min.css" />

<link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.2.2/css/buttons.dataTables.min.css">



<div class="container-fluid">
    <!-- start page title -->
    <div class="row">
        <?php
        $sql7 = mysqli_query($koneksi, "SELECT * FROM access_menu WHERE idnik = $niklogin");
        $row7 = mysqli_fetch_assoc($sql7);
        ?>
        <div class="col-xxl-3 col-sm-6">
            <div class="card card-animate">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <div>
                            <?php if (isset($row7['access_type']) && ($row7['access_type'] == 'Admin' || $row7['access_type'] == 'IT')) {
                                $sql = mysqli_query($koneksi, "SELECT id_tiket FROM ticketing ");
                                $totalRequest = mysqli_num_rows($sql);
                            } else {
                                $sql = mysqli_query($koneksi, "SELECT id_tiket FROM ticketing WHERE id_nik_request='$niklogin' ");
                                $totalRequest = mysqli_num_rows($sql);
                            }
                            ?>
                            <p class="fw-medium text-muted mb-0">Total Tickets</p>
                            <h2 class="mt-4 ff-secondary fw-semibold"><span class="counter-value" data-target="<?= htmlspecialchars($totalRequest) ?>"></span></h2>
                        </div>
                        <div>
                            <div class="avatar-sm flex-shrink-0">
                                <span class="avatar-title bg-soft-info text-info rounded-circle fs-4">
                                    <i class="ri-ticket-2-line"></i>
                                </span>
                            </div>
                        </div>
                    </div>
                </div><!-- end card body -->
            </div> <!-- end card-->
        </div>
        <!--end col-->

        <!-- (Pending, Closed, Process) -->
        <div class="col-xxl-3 col-sm-6">
            <div class="card card-animate">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <div>
                            <p class="fw-medium text-muted mb-0">Pending Tickets</p>
                            <?php if (isset($row7['access_type']) && ($row7['access_type'] == 'Admin' || $row7['access_type'] == 'IT')) {
                                $sql1 = mysqli_query($koneksi, "SELECT id_tiket FROM ticketing WHERE status_tiket = 'Pending' ");
                                $PendingTiket = mysqli_num_rows($sql1);
                            } else {
                                $sql1 = mysqli_query($koneksi, "SELECT id_tiket FROM ticketing WHERE status_tiket = 'Pending' AND (id_nik_request = '$niklogin' OR id_nik_request = '$niklogin') ");
                                $PendingTiket = mysqli_num_rows($sql1);
                            }
                            ?>
                            <h2 class="mt-4 ff-secondary fw-semibold"><span class="counter-value" data-target="<?= $PendingTiket ?>">0</span></h2>
                        </div>
                        <div>
                            <div class="avatar-sm flex-shrink-0">
                                <span class="avatar-title bg-soft-info text-info rounded-circle fs-4">
                                    <i class="mdi mdi-timer-sand"></i>
                                </span>
                            </div>
                        </div>
                    </div>
                </div><!-- end card body -->
            </div>
        </div>
        <!--end col-->
        <div class="col-xxl-3 col-sm-6">
            <div class="card card-animate">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <div>
                            <p class="fw-medium text-muted mb-0">Closed Tickets</p>
                            <?php if (isset($row7['access_type']) && ($row7['access_type'] == 'Admin' || $row7['access_type'] == 'IT')) {
                                $sql2 = mysqli_query($koneksi, "SELECT id_tiket FROM ticketing WHERE status_tiket = 'Closed' ");
                                $ClosedTiket = mysqli_num_rows($sql2);
                            } else {
                                $sql2 = mysqli_query($koneksi, "SELECT id_tiket FROM ticketing WHERE status_tiket = 'Closed'AND (id_nik_request = '$niklogin' OR id_nik_request = '$niklogin') ");
                                $ClosedTiket = mysqli_num_rows($sql2);
                            } ?>
                            <h2 class="mt-4 ff-secondary fw-semibold"><span class="counter-value" data-target="<?= $ClosedTiket ?>">0</span></h2>
                        </div>
                        <div>
                            <div class="avatar-sm flex-shrink-0">
                                <span class="avatar-title bg-soft-info text-info rounded-circle fs-4">
                                    <i class="ri-mail-close-line"></i>
                                </span>
                            </div>
                        </div>
                    </div>
                </div><!-- end card body -->
            </div>
        </div>
        <!--end col-->
        <div class="col-xxl-3 col-sm-6">
            <div class="card card-animate">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <div>
                            <p class="fw-medium text-muted mb-0">Process Tickets</p>
                            <?php if (isset($row7['access_type']) && ($row7['access_type'] == 'Admin' || $row7['access_type'] == 'IT')) {
                                $sql3 = mysqli_query($koneksi, "SELECT id_tiket FROM ticketing WHERE status_tiket = 'Process' ");
                                $ProcessTiket = mysqli_num_rows($sql3);
                            } else {
                                $sql3 = mysqli_query($koneksi, "SELECT id_tiket FROM ticketing WHERE status_tiket = 'Process' AND (id_nik_request = '$niklogin' OR id_nik_request = '$niklogin')");
                                $ProcessTiket = mysqli_num_rows($sql3);
                            }
                            ?>
                            <h2 class="mt-4 ff-secondary fw-semibold"><span class="counter-value" data-target="<?= $ProcessTiket ?>">0</span></h2>
                        </div>
                        <div>
                            <div class="avatar-sm flex-shrink-0">
                                <span class="avatar-title bg-soft-info text-info rounded-circle fs-4">
                                    <i class="ri-delete-bin-line"></i>
                                </span>
                            </div>
                        </div>
                    </div>
                </div><!-- end card body -->
            </div>
        </div>
        <!--end col-->
    </div>


    <!-- break between each contents -->
    <!-- bikin if else lagi yang buat admin buat ngarahin ke arah halaman baru -->
    <div class="row">
        <div class="col-lg-12">
            <div class="card" id="ticketsList">
                <div class="card-header border-0">
                    <div class="d-flex align-items-center">
                        <h5 class="card-title mb-0 flex-grow-1">List Ticketing</h5>


                        <?php if (isset($row7['access_type']) && ($row7['access_type'] == 'Admin' || $row7['access_type'] == 'IT')) : ?>
                            <a href="index.php?page=AddSupport" class="btn btn-danger add-btn">
                                <i class="ri-add-line align-bottom me-1"></i> Create Tickets
                            </a>
                        <?php else : ?>
                            <div class="flex-shrink-0">
                                <button class="btn btn-danger add-btn" data-bs-toggle="modal" data-bs-target="#showModal">
                                    <i class="ri-add-line align-bottom me-1"></i> Create Tickets
                                </button>
                            </div>
                        <?php endif; ?>

                    </div>
                </div>
                <div class="card-body border border-dashed border-end-0 border-start-0">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="card-body">
                                    <table id="buttons-datatables" class="table nowrap align-middle dt-responsive" style="width:100%">
                                        <thead>
                                            <tr>
                                                <th>ID Ticket</th>
                                                <th>Create Date</th>
                                                <th>End Date</th>
                                                <th>Location</th>
                                                <th>Request</th>
                                                <th>Whatsapp</th>
                                                <th>Description</th>
                                                <th>Status</th>
                                                <th>Category</th>
                                                <th>PIC</th>
                                                <th>Justification</th>
                                                <th>Progress Note</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <?php $sql7 = mysqli_query($koneksi, "SELECT * FROM access_menu WHERE idnik =$niklogin ");
                                        $row7 = mysqli_fetch_assoc($sql7); ?>
                                        <tbody>

                                            <?php if (isset($row7['access_type']) && ($row7['access_type'] == 'Admin' || $row7['access_type'] == 'IT')) {
                                                $sql4 = mysqli_query($koneksi, "SELECT
ticketing.*, user.lokasi,
user1.nama AS nama_request,
user2.nama AS nama_pic 
FROM
ticketing
LEFT JOIN USER AS user1 ON ticketing.id_nik_request = user1.idnik
LEFT JOIN USER AS user2 ON ticketing.nik_pic = user2.idnik
INNER JOIN USER ON ticketing.id_nik_request = user.idnik ");
                                                while ($row = mysqli_fetch_assoc($sql4)) { ?>
                                                    <tr>

                                                        <td><a href="index.php?page=EditTicketIT&id=<?= $row['id_tiket']; ?>"><?= $row['id_tiket'] ?></a></td>
                                                        <td><?= $row['start_date'] ?></td>
                                                        <td><?= $row['end_date'] ?></td>
                                                        <td><?= $row['lokasi'] ?></td>
                                                        <td><?= $row['nama_request'] ?></td>
                                                        <td><?= $row['whatsapp'] ?></td>
                                                        <td><?= $row['disc_keluhan'] ?></td>
                                                        <td><?= $row['status_tiket'] ?></td>
                                                        <td><?= $row['kategori_tiket'] ?></td>
                                                        <td><?= $row['nama_pic'] ?></td>
                                                        <td><?= $row['justification'] ?></td>
                                                        <td><?= $row['action_note'] ?></td>
                                                        <td>
                                                            <div class="dropdown d-inline-block">
                                                                <button class="btn btn-soft-secondary btn-sm dropdown" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                                                    <i class="ri-more-fill align-middle"></i>
                                                                </button>
                                                                <ul class="dropdown-menu dropdown-menu-end">
                                                                    <li>
                                                                        <a href="index.php?page=EditTicketIT&id=<?= $row['id_tiket']; ?>" class="dropdown-item"><i class="ri-pencil-fill align-bottom me-2 text-muted"></i> Edit</a>
                                                                    </li>
                                                                </ul>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                <?php } ?>

                                                <?php
                                            } else {

                                                $sql4 = mysqli_query($koneksi, "SELECT
    ticketing.*, user.lokasi,
    user1.nama AS nama_request,
    user2.nama AS nama_pic 
    FROM
    ticketing
    LEFT JOIN USER AS user1 ON ticketing.id_nik_request = user1.idnik
    LEFT JOIN USER AS user2 ON ticketing.nik_pic = user2.idnik
    INNER JOIN USER ON ticketing.id_nik_request = user.idnik
    WHERE user.idnik = $niklogin  ");

                                                while ($row = mysqli_fetch_assoc($sql4)) {

                                                ?>
                                                    <tr>

                                                        <td><a href="index.php?page=ViewTicketIT&id=<?= $row['id_tiket']; ?>"><?= $row['id_tiket'] ?></a></td>
                                                        <td><?= $row['start_date'] ?></td>
                                                        <td><?= $row['end_date'] ?></td>
                                                        <td><?= $row['lokasi'] ?></td>
                                                        <td><?= $row['nama_request'] ?></td>
                                                        <td><?= $row['whatsapp'] ?></td>
                                                        <td><?= $row['disc_keluhan'] ?></td>
                                                        <td><?= $row['status_tiket'] ?></td>
                                                        <td><?= $row['kategori_tiket'] ?></td>
                                                        <td><?= $row['nama_pic'] ?></td>
                                                        <td><?= $row['justification'] ?></td>
                                                        <td><?= $row['action_note'] ?></td>
                                                        <td>
                                                            <div class="dropdown d-inline-block">
                                                                <button class="btn btn-soft-secondary btn-sm dropdown" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                                                    <i class="ri-more-fill align-middle"></i>
                                                                </button>
                                                                <ul class="dropdown-menu dropdown-menu-end">
                                                                    <li>
                                                                        <a href="index.php?page=ViewTicketIT&id=<?= $row['id_tiket']; ?>" class="dropdown-item"><i class="ri-eye-fill align-bottom me-2 text-muted"></i> View</a>
                                                                    </li>
                                                                </ul>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                <?php } ?>

                                            <?php }
                                            ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div><!--end row-->
                </div>
                <!--end card-body-->
                <div class="card-body">



                    <!-- Modal -->

                    <!--end modal -->
                </div>
                <!--end card-body-->
            </div>
            <!--end card-->
        </div>
        <!--end col-->
    </div>
    <!--end row-->


    <!-- ini modal buat user kalo admin buat yang ke halaman baru -->
    <div class="modal fade zoomIn" id="showModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content border-0">
                <div class="modal-header p-3 bg-soft-info">
                    <h5 class="modal-title" id="exampleModalLabel">Create Ticketing</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" id="close-modal"></button>
                </div>
                <form action="function/insert_it_tiket.php" method="POST" enctype="multipart/form-data">
                    <div class="modal-body">
                        <?php $start_date = date('Y-m-d H:i:s'); ?>
                        <div class="row g-3">
                            <div class="col-lg-6">
                                <input class="form-control" value="<?= $start_date ?>" name="kodok" hidden />
                                <input type="text" class="form-control" value="<?= $niklogin ?>" hidden name="id_nik_request" />
                                <div class="col-lg-12">

                                    <div class="mb-3">
                                        <label for="lampiran1" class="form-label">Material Request Form (if any)</label>
                                        <input type="file" class="form-control" name="lampiran1" />
                                    </div>

                                    <div>
                                        <label for="wa" class="form-label">No.Whatsapp</label>
                                        <input type="number" class="form-control" placeholder="Insert your active number +(62) " name="wa" />
                                    </div>

                                    <!-- Select User -->
                                    <div>
                                        <?php if (isset($row7['access_type']) && ($row7['access_type'] == 'Admin' || $row7['access_type'] == 'IT')) { ?>
                                            <div class="mb-3 mt-3">
                                                <label for="tasksTitle-field" class="form-label"><span> Request User</span></label>
                                                <select class="form-control" data-choices name="id_nik_request">
                                                    <option value="">All Users</option>
                                                    <?php
                                                    $sql5 = mysqli_query($koneksi, 'SELECT idnik, nama, lokasi FROM user');
                                                    while ($row5 = mysqli_fetch_assoc($sql5)) {
                                                    ?>
                                                        <option value="<?= $row5['idnik'] ?>"><?= $row5['nama'] ?> | <?= $row5['lokasi'] ?></option>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                        <?php } else { ?>
                                            <input type="text" class="form-control" hidden name="id_nik_request" value="<?= $niklogin ?>" />
                                        <?php } ?>
                                    </div>



                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="col-lg-12">
                                    <div>
                                        <?php
                                        $sql3 = mysqli_query($koneksi, "SELECT * FROM ticketing");
                                        $row3 = mysqli_fetch_assoc($sql3);
                                        ?>
                                        <div class="card-body">
                                            <h6 class="fw-semibold text-uppercase mb-3">Description</h6>
                                            <textarea class="ckeditor-classic" name="description"></textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>


                        </div>
                    </div>
                    <div class="modal-footer mt-3">
                        <div class="hstack gap-2 justify-content-end">
                            <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary" name="add-tiket">Add Ticket</button>
                        </div>
                    </div>

                </form>
            </div>
        </div>

    </div>
</div>



<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

<!--datatable js-->
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.2/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.print.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.html5.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>

<script src="../assets/js/pages/datatables.init.js"></script>

<script src="../assets/libs/@ckeditor/ckeditor5-build-classic/build/ckeditor.js"></script>
<script src="../assets/libs/@ckeditor/ckeditor5-build-classic/build/ckeditor.js"></script>
<script src="../assets/libs/@ckeditor/ckeditor5-build-classic/build/ckeditor.js"></script>
<script src="../assets/js/pages/form-editor.init.js"></script>

<script src="../assets/js/pages/select2.init.js"></script>