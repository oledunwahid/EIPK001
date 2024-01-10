<link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/fixedcolumns/4.3.0/css/fixedColumns.dataTables.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.4.2/css/buttons.dataTables.min.css">

<link href="https://cdn.datatables.net/searchbuilder/1.6.0/css/searchBuilder.dataTables.min.css" rel="stylesheet" type="text/css" />
<link href="https://cdn.datatables.net/datetime/1.5.1/css/dataTables.dateTime.min.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.19/dist/sweetalert2.min.css">

<script src="https://code.jquery.com/jquery-3.7.0.js"></script>
<script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/fixedcolumns/4.3.0/js/dataTables.fixedColumns.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.2/js/dataTables.buttons.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.html5.min.js"></script>



<script src="https://cdn.datatables.net/searchbuilder/1.6.0/js/dataTables.searchBuilder.min.js"></script>
<script src="https://cdn.datatables.net/datetime/1.5.1/js/dataTables.dateTime.min.js"></script>


<div class="container-fluid">
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            <?php if (isset($_SESSION['success_message'])) { ?>
                Swal.fire({
                    icon: 'success',
                    title: 'Success',
                    text: '<?php echo $_SESSION['success_message']; ?>',
                    showConfirmButton: false,
                    timer: 3000
                });
                <?php unset($_SESSION['success_message']); ?>
            <?php } ?>
            <?php if (isset($_SESSION['error_message'])) { ?>
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: '<?php echo $_SESSION['error_message']; ?>',
                    showConfirmButton: false,
                    timer: 3000
                });
                <?php unset($_SESSION['error_message']); ?>
            <?php } ?>
        });
    </script>

    <style>
        /* Ensure that the demo table scrolls */
        th,
        td {
            white-space: nowrap;
        }

        div.dataTables_wrapper {
            margin: 0 auto;
        }
    </style>

    <div class="container-fluid">
        <!-- start page title -->
        <div class="row">
            <?php
            $sql7 = mysqli_query($koneksi, "SELECT * FROM access_level WHERE idnik = $niklogin");
            $row7 = mysqli_fetch_assoc($sql7);
            ?>
            <div class="col-xxl-3 col-sm-6">
                <div class="card card-animate">
                    <div class="card-body">
                        <div class="d-flex justify-content-between">
                            <div>
                                <?php if (isset($row7['admin']) && ($row7['admin'] == '1')) {
                                    $sql = mysqli_query($koneksi, "SELECT id_tiket FROM ticketing ");
                                    $totalRequest = mysqli_num_rows($sql);
                                } elseif (isset($row7['it']) && ($row7['it'] == '1')) {
                                    $lokasi = $row7['lokasi'];
                                    $sql = mysqli_query($koneksi, "SELECT ticketing.id_tiket, user.lokasi FROM ticketing INNER JOIN user ON ticketing.id_nik_request = user.idnik WHERE user.lokasi IN ($lokasi) ");
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
                                <?php if (isset($row7['admin']) && ($row7['admin'] == '1')) {
                                    $sql1 = mysqli_query($koneksi, "SELECT id_tiket FROM ticketing WHERE status_tiket = 'Pending' ");
                                    $PendingTiket = mysqli_num_rows($sql1);
                                } elseif (isset($row7['it']) && ($row7['it'] == '1')) {
                                    $sql1 = mysqli_query($koneksi, "SELECT ticketing.id_tiket, user.lokasi FROM ticketing INNER JOIN user ON ticketing.id_nik_request = user.idnik  WHERE status_tiket = 'Pending' AND user.lokasi IN ($lokasi) ");
                                    $PendingTiket = mysqli_num_rows($sql1);
                                } else {
                                    $sql1 = mysqli_query($koneksi, "SELECT id_tiket FROM ticketing WHERE status_tiket = 'Pending' AND id_nik_request='$niklogin' ");
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
                                <?php if (isset($row7['admin']) && ($row7['admin'] == '1')) {
                                    $sql2 = mysqli_query($koneksi, "SELECT id_tiket FROM ticketing WHERE status_tiket = 'Closed' ");
                                    $ClosedTiket = mysqli_num_rows($sql2);
                                } elseif (isset($row7['it']) && ($row7['it'] == '1')) {
                                    $sql2 = mysqli_query($koneksi, "SELECT ticketing.id_tiket, user.lokasi FROM ticketing INNER JOIN user ON ticketing.id_nik_request = user.idnik  WHERE status_tiket = 'Closed' AND user.lokasi IN ($lokasi) ");
                                    $ClosedTiket = mysqli_num_rows($sql2);
                                } else {
                                    $sql2 = mysqli_query($koneksi, "SELECT id_tiket FROM ticketing WHERE status_tiket = 'Closed' AND id_nik_request='$niklogin' ");
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
                                <?php if (isset($row7['admin']) && ($row7['admin'] == '1')) {
                                    $sql3 = mysqli_query($koneksi, "SELECT id_tiket FROM ticketing WHERE status_tiket = 'Process' ");
                                    $ProcessTiket = mysqli_num_rows($sql3);
                                } elseif (isset($row7['it']) && ($row7['it'] == '1')) {
                                    $sql3 = mysqli_query($koneksi, "SELECT ticketing.id_tiket, user.lokasi FROM ticketing INNER JOIN user ON ticketing.id_nik_request = user.idnik  WHERE status_tiket = 'Process' AND user.lokasi IN ($lokasi) ");
                                    $ProcessTiket = mysqli_num_rows($sql3);
                                } else {
                                    $sql3 = mysqli_query($koneksi, "SELECT id_tiket FROM ticketing WHERE status_tiket = 'Process' AND id_nik_request='$niklogin' ");
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
                            <div class="card-title mb-0 flex-grow-1 flex">
                                <h5>IT Support</h5>
                                <h6>Submit your IT - related issues here. Our IT team will assist you as soon as possible.</h6>
                            </div>
                            <?php if (isset($row7['it']) && ($row7['it'] == '1')) : ?>
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
                                        <table id="datalengkap" class="stripe row-border order-column" style="width:100%">
                                            <thead>
                                                <tr>
                                                    <th>ID Ticket</th>
                                                    <th>Create Date</th>
                                                    <th>Proses Date</th>
                                                    <th>End Date</th>
                                                    <th>Duration Process</th>
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

                                            <tbody>
                                                <?php
                                                $sql7 = mysqli_query($koneksi, "SELECT * FROM access_level WHERE idnik =$niklogin ");
                                                $row7 = mysqli_fetch_assoc($sql7);
                                                ?>

                                                <?php if (isset($row7['admin']) && ($row7['admin'] == '1')) {
                                                    $sql4 = mysqli_query($koneksi, "SELECT
                                                    ticketing.*, user.lokasi,
                                                    user1.nama AS nama_request,
                                                    user2.nama AS nama_pic 
                                                    FROM
                                                    ticketing
                                                    LEFT JOIN user AS user1 ON ticketing.id_nik_request = user1.idnik
                                                    LEFT JOIN user AS user2 ON ticketing.nik_pic = user2.idnik
                                                    INNER JOIN user ON ticketing.id_nik_request = user.idnik ");
                                                    while ($row = mysqli_fetch_assoc($sql4)) { ?>
                                                        <tr>
                                                            <td>
                                                                <a href="index.php?page=ViewTicketIT&id=<?= $row['id_tiket']; ?>"><?= $row['id_tiket'] ?>
                                                                </a>
                                                            </td>
                                                            <td><?= $row['start_date'] ?></td>
                                                            <td><?= $row['proses_date'] ?></td>
                                                            <td><?= $row['end_date'] ?></td>
                                                            <td><?php $waktuawal = new DateTime($row['proses_date']);
                                                                $waktuakhir = new DateTime($row['end_date']);
                                                                $durasi = $waktuawal->diff($waktuakhir);
                                                                $jam = $durasi->h;
                                                                $menit = $durasi->i;
                                                                $formatted_menit = sprintf("%02d", $menit);
                                                                echo "$jam jam $formatted_menit menit";
                                                                ?></td>
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
                                                                            <a href="index.php?page=ViewTicketIT&id=<?= $row['id_tiket']; ?>" class="dropdown-item"><i class="ri-pencil-fill align-bottom me-2 text-muted"></i>View</a>
                                                                        </li>
                                                                    </ul>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                    <?php }
                                                } elseif (isset($row7['it']) && ($row7['it'] == '1')) {
                                                    $sql4 = mysqli_query($koneksi, "SELECT
                                                    ticketing.*, user.lokasi,
                                                    user1.nama AS nama_request,
                                                    user2.nama AS nama_pic 
                                                    FROM
                                                    ticketing
                                                    LEFT JOIN user AS user1 ON ticketing.id_nik_request = user1.idnik
                                                    LEFT JOIN user AS user2 ON ticketing.nik_pic = user2.idnik
                                                    INNER JOIN user ON ticketing.id_nik_request = user.idnik 
                                                    WHERE user.lokasi IN ($lokasi)
                                                    ");

                                                    while ($row = mysqli_fetch_assoc($sql4)) {

                                                    ?>
                                                        <tr>
                                                            <td>
                                                                <a href="index.php?page=EditTicketIT&id=<?= $row['id_tiket']; ?>"><?= $row['id_tiket'] ?>
                                                                </a>
                                                            </td>
                                                            <td><?= $row['start_date'] ?></td>
                                                            <td><?= $row['proses_date'] ?></td>
                                                            <td><?= $row['end_date'] ?></td>
                                                            <td><?php $waktuawal = new DateTime($row['proses_date']);
                                                                $waktuakhir = new DateTime($row['end_date']);
                                                                $durasi = $waktuawal->diff($waktuakhir);
                                                                $jam = $durasi->h;
                                                                $menit = $durasi->i;
                                                                $formatted_menit = sprintf("%02d", $menit);
                                                                echo "$jam jam $formatted_menit menit";
                                                                ?></td>
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
                                                    <?php }
                                                } else {
                                                    $sql4 = mysqli_query($koneksi, "SELECT
                                                    ticketing.*, user.lokasi,
                                                    user1.nama AS nama_request,
                                                    user2.nama AS nama_pic 
                                                    FROM
                                                    ticketing
                                                    LEFT JOIN user AS user1 ON ticketing.id_nik_request = user1.idnik
                                                    LEFT JOIN user AS user2 ON ticketing.nik_pic = user2.idnik
                                                    INNER JOIN user ON ticketing.id_nik_request = user.idnik 
                                                    WHERE user.idnik = $niklogin  ");
                                                    while ($row = mysqli_fetch_assoc($sql4)) {
                                                    ?>
                                                        <tr>
                                                            <td>
                                                                <a href="index.php?page=ViewTicketIT&id=<?= $row['id_tiket']; ?>"><?= $row['id_tiket'] ?>
                                                                </a>
                                                            </td>
                                                            <td><?= $row['start_date'] ?></td>
                                                            <td><?= $row['proses_date'] ?></td>
                                                            <td><?= $row['end_date'] ?></td>
                                                            <td><?php $waktuawal = new DateTime($row['proses_date']);
                                                                $waktuakhir = new DateTime($row['end_date']);
                                                                $durasi = $waktuawal->diff($waktuakhir);
                                                                $jam = $durasi->h;
                                                                $menit = $durasi->i;
                                                                $formatted_menit = sprintf("%02d", $menit);
                                                                echo "$jam jam $formatted_menit menit";
                                                                ?></td>
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
                                                <?php }
                                                }
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
                        <h5 class="modal-title" id="exampleModalLabel">Create Request IT Ticketing - IT-Support</h5>
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
                                            <input type="number" class="form-control" placeholder="Insert your active number +(62) " name="wa" required />
                                        </div>

                                        <!-- Select user -->
                                        <div>
                                            <?php if (isset($row7['it']) && ($row7['it'] == '1')) { ?>
                                                <div class="mb-3 mt-3">
                                                    <label for="tasksTitle-field" class="form-label"><span> Request user</span></label>
                                                    <select class="form-control" data-choices name="id_nik_request">
                                                        <option value="">All users</option>
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
                                                <textarea id="ckeditor-classic" name="description"></textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>


                            </div>
                        </div>
                        <div class="modal-footer mt-3">
                            <div class="hstack gap-2 justify-content-end">
                                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary" name="add-tiket-user">Add Ticket</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="assets/libs/@ckeditor/ckeditor5-build-classic/build/ckeditor.js"></script>
    <script src="assets/js/pages/project-create.init.js"></script>
    <script src="assets/js/pages/ticketdetail.init.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.19/dist/sweetalert2.all.min.js"></script>

    <script>
        $(document).ready(function() {
            var table = $('#datalengkap').DataTable({
                dom: 'QBfrtip',
                scrollX: true,
                scrollY: 400,
                scrollCollapse: !0,
                order: [
                    [1, 'desc']
                ],

                lengthMenu: [
                    [5, 10, 25, 50, 100, -1],
                    ['5 rows', '10 rows', '25 rows', '50 rows', '100 rows', 'Show all']
                ],
                buttons: ['pageLength',
                    {
                        extend: 'fixedColumns',
                        text: 'Freeze Column',
                        config: {
                            left: 1,
                            right: 1
                        }
                    }, {
                        extend: 'excel',
                        title: 'Data Export Candidate'
                    }
                ],

                deferRender: true
            });
        });
    </script>