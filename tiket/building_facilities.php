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
                            <?php if (isset($row7['admin']) && ($row7['admin'] == '1' || ($row7['ga2'] == '1'))) {
                                $sql = mysqli_query($koneksi, "SELECT id_ga_building FROM ga_building");
                                $totalTicket = mysqli_num_rows($sql);
                            } else {
                                $sql = mysqli_query($koneksi, "SELECT id_ga_building FROM ga_building where nik_request='$niklogin' ");
                                $totalTicket = mysqli_num_rows($sql);
                            }
                            ?>
                            <p class="fw-medium text-muted mb-0">Total Tickets</p>
                            <h2 class="mt-4 ff-secondary fw-semibold">
                                <span class="counter-value" data-target="<?= htmlspecialchars($totalTicket) ?>"></span>
                            </h2>
                        </div>

                        <div>
                            <div class="avatar-sm flex-shrink-0">
                                <span class="avatar-title bg-soft-info text-info rounded-circle fs-4">
                                    <i class="ri-ticket-2-line"></i>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--end col-->

        <!-- (Pending, Closed, On Process) -->
        <div class="col-xxl-3 col-sm-6">
            <div class="card card-animate">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <div>
                            <?php
                            if (isset($row7['admin']) && ($row7['admin'] == '1' || ($row7['ga2'] == '1'))) {
                                $sql1 = mysqli_query($koneksi, "SELECT id_ga_building FROM ga_building WHERE status = 'Pending'");
                                $PendingTiket = mysqli_num_rows($sql1);
                            } else {
                                $sql1 = mysqli_query($koneksi, "SELECT id_ga_building FROM ga_building WHERE status = 'Pending' AND (nik_request = '$niklogin' OR id_ga_building = '$niklogin')");
                                $PendingTiket = mysqli_num_rows($sql1);
                            }
                            ?>
                            <p class="fw-medium text-muted mb-0">Pending Tickets</p>
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
                </div>
            </div>
        </div>

        <div class="col-xxl-3 col-sm-6">
            <div class="card card-animate">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <div>
                            <?php
                            if (isset($row7['admin']) && ($row7['admin'] == '1' || ($row7['ga2'] == '1'))) {
                                $sql1 = mysqli_query($koneksi, "SELECT id_ga_building FROM ga_building WHERE status = 'On Process'");
                                $ProcessTicket = mysqli_num_rows($sql1);
                            } else {
                                $sql1 = mysqli_query($koneksi, "SELECT id_ga_building FROM ga_building WHERE status = 'On Process' AND (nik_request = '$niklogin' OR id_ga_building = '$niklogin')");
                                $ProcessTicket = mysqli_num_rows($sql1);
                            }
                            ?>
                            <p class="fw-medium text-muted mb-0">On Process Tickets</p>
                            <h2 class="mt-4 ff-secondary fw-semibold"><span class="counter-value" data-target="<?= $ProcessTicket ?>">0</span></h2>
                        </div>
                        <div>
                            <div class="avatar-sm flex-shrink-0">
                                <span class="avatar-title bg-soft-info text-info rounded-circle fs-4">
                                    <i class="mdi mdi-timer-sand"></i>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xxl-3 col-sm-6">
            <div class="card card-animate">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <div>
                            <?php
                            if (isset($row7['admin']) && ($row7['admin'] == '1' || ($row7['ga2'] == '1'))) {
                                $sql2 = mysqli_query($koneksi, "SELECT id_ga_building FROM ga_building WHERE status = 'Closed'");
                                $ClosedTicket = mysqli_num_rows($sql2);
                            } else {
                                $sql2 = mysqli_query($koneksi, "SELECT id_ga_building FROM ga_building WHERE status = 'Closed' AND (nik_request = '$niklogin' OR id_ga_building = '$niklogin')");
                                $ClosedTicket = mysqli_num_rows($sql2);
                            }
                            ?>

                            <p class="fw-medium text-muted mb-0">Closed Tickets</p>
                            <h2 class="mt-4 ff-secondary fw-semibold"><span class="counter-value" data-target="<?= $ClosedTicket ?>">0</span></h2>

                        </div>
                        <div>
                            <div class="avatar-sm flex-shrink-0">
                                <span class="avatar-title bg-soft-info text-info rounded-circle fs-4">
                                    <i class="ri-mail-close-line"></i>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <div class="card" id="ticketsList">
                <div class="card-header border-0">
                    <div class="d-flex align-items-center">
                        <div class="card-title mb-0 flex-grow-1 flex">
                            <h5>Building Maintenance Support</h5>
                            <h6>Covers building and facility-related needs (e.g., Chair,
                                roller blind, glass partition, access
                                doors, and others).</h6>
                        </div>
                        <div class="flex-shrink-0">
                            <button class="btn btn-danger add-btn" data-bs-toggle="modal" data-bs-target="#showModal"><i class="ri-add-line align-bottom me-1"></i> Create Ticketing</button>

                        </div>
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
                                                <th>Start Date</th>
                                                <th>End Date</th>
                                                <th>Nama Request</th>
                                                <th>Description</th>
                                                <th>Status</th>
                                                <th>Type Of Service</th>
                                                <th>PIC</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>

                                        <tbody>
                                            <?php
                                            if (isset($_POST["filter"])) {

                                                $sql7 = mysqli_query($koneksi, "SELECT * FROM access_level WHERE idnik =$niklogin ");
                                                $row7 = mysqli_fetch_assoc($sql7); ?>
                                                <?php
                                                if (isset($row7['admin']) && ($row7['admin'] == '1' || ($row7['ga2'] == '1'))) {
                                                    $sql7 = mysqli_query($koneksi, "SELECT
                                                        ga_building.*,
                                                        user1.nama AS nama_request,
                                                        user2.nama AS nama_pic 
                                                        FROM ga_building
                                                        LEFT JOIN user AS user1 ON ga_building.nik_request = user1.idnik
                                                        LEFT JOIN user AS user2 ON ga_building.nik_pic = user2.idnik
                                                        INNER JOIN user ON ga_building.nik_request = user.idnik
                                                        ");

                                                    while ($row6 = mysqli_fetch_assoc($sql7)) {
                                                ?>
                                                        <tr>
                                                            <td><a href="index.php?page=Edit Building Facilities&id=<?= $row6['id_ga_building']; ?>"><?= $row6['id_ga_building'] ?></a></td>
                                                            <td><?= $row6['start_date'] ?></td>
                                                            <td><?= $row6['end_date'] ?></td>
                                                            <td><?= $row6['nama_request'] ?></td>
                                                            <td><?= $row6['description'] ?></td>
                                                            <td><?= $row6['status'] ?></td>
                                                            <td><?= $row6['category'] ?></td>
                                                            <td><?= $row6['nama_pic'] ?></td>
                                                            <td>
                                                                <div class="dropdown d-inline-block">
                                                                    <button class="btn btn-soft-secondary btn-sm dropdown" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                                                        <i class="ri-more-fill align-middle"></i>
                                                                    </button>
                                                                    <ul class="dropdown-menu dropdown-menu-end">
                                                                        <li>
                                                                            <a href="index.php?page=Edit Building Facilities&id=<?= $row6['id_ga_building']; ?>" class="dropdown-item"><i class="ri-pencil-fill align-bottom me-2 text-muted"></i> Edit</a>
                                                                        </li>
                                                                    </ul>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                    <?php
                                                    }
                                                } else {
                                                    $sql7 = mysqli_query($koneksi, "SELECT
                                                        ga_building.*,
                                                        user1.nama AS nama_request,
                                                        user2.nama AS nama_pic 
                                                        FROM ga_building
                                                        LEFT JOIN user AS user1 ON ga_building.nik_request = user1.idnik
                                                        LEFT JOIN user AS user2 ON ga_building.nik_pic = user2.idnik
                                                        INNER JOIN user ON ga_building.nik_request = user.idnik
                                                        WHERE ga_building.nik_request = '$niklogin'");

                                                    while ($row6 = mysqli_fetch_assoc($sql7)) {
                                                    ?>
                                                        <tr>
                                                            <td><a href="index.php?page=View Building Facilities&id=<?= $row6['id_ga_building']; ?>"><?= $row6['id_ga_building'] ?></a></td>
                                                            <td><?= $row6['start_date'] ?></td>
                                                            <td><?= $row6['end_date'] ?></td>
                                                            <td><?= $row6['nama_request'] ?></td>
                                                            <td><?= $row6['description'] ?></td>
                                                            <td><?= $row6['status'] ?></td>
                                                            <td><?= $row6['category'] ?></td>
                                                            <td><?= $row6['nama_pic'] ?></td>
                                                            <td>
                                                                <div class="dropdown d-inline-block">
                                                                    <button class="btn btn-soft-secondary btn-sm dropdown" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                                                        <i class="ri-more-fill align-middle"></i>
                                                                    </button>
                                                                    <ul class="dropdown-menu dropdown-menu-end">
                                                                        <li>
                                                                            <a href="index.php?page=View Building Facilities&id=<?= $row6['id_ga_building']; ?>" class="dropdown-item"><i class="ri-eye-fill align-bottom me-2 text-muted"></i> View</a>
                                                                        </li>
                                                                    </ul>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                <?php }
                                                    $rowNumber++;
                                                }
                                            } else {
                                                $sql7 = mysqli_query($koneksi, "SELECT * FROM access_level WHERE idnik =$niklogin ");
                                                $row7 = mysqli_fetch_assoc($sql7);
                                                ?>
                                                <?php
                                                if (isset($row7['admin']) && ($row7['admin'] == '1' || ($row7['ga3'] == '1'))) {
                                                    $sql7 = mysqli_query($koneksi, "SELECT
                                                    ga_building.*,
                                                    user1.nama AS nama_request,
                                                    user2.nama AS nama_pic 
                                                    FROM ga_building
                                                    LEFT JOIN user AS user1 ON ga_building.nik_request = user1.idnik
                                                    LEFT JOIN user AS user2 ON ga_building.nik_pic = user2.idnik
                                                    INNER JOIN user ON ga_building.nik_request = user.idnik");

                                                    while ($row6 = mysqli_fetch_assoc($sql7)) {
                                                ?>
                                                        <tr>
                                                            <td><a href="index.php?page=Edit Building Facilities&id=<?= $row6['id_ga_building']; ?>"><?= $row6['id_ga_building'] ?></a></td>
                                                            <td><?= $row6['start_date'] ?></td>
                                                            <td><?= $row6['end_date'] ?></td>
                                                            <td><?= $row6['nama_request'] ?></td>
                                                            <td><?= $row6['description'] ?></td>
                                                            <td><?= $row6['status'] ?></td>
                                                            <td><?= $row6['category'] ?></td>
                                                            <td><?= $row6['nama_pic'] ?></td>
                                                            <td>
                                                                <div class="dropdown d-inline-block">
                                                                    <button class="btn btn-soft-secondary btn-sm dropdown" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                                                        <i class="ri-more-fill align-middle"></i>
                                                                    </button>
                                                                    <ul class="dropdown-menu dropdown-menu-end">
                                                                        <li>
                                                                            <a href="index.php?page=Edit Building Facilities&id=<?= $row6['id_ga_building']; ?>" class="dropdown-item"><i class="ri-pencil-fill align-bottom me-2 text-muted"></i> Edit</a>
                                                                        </li>
                                                                    </ul>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                    <?php
                                                    }
                                                } else {
                                                    $sql7 = mysqli_query($koneksi, "SELECT
                                                    ga_building.*,
                                                    user1.nama AS nama_request,
                                                    user2.nama AS nama_pic 
                                                    FROM ga_building
                                                    LEFT JOIN user AS user1 ON ga_building.nik_request = user1.idnik
                                                    LEFT JOIN user AS user2 ON ga_building.nik_pic = user2.idnik
                                                    INNER JOIN user ON ga_building.nik_request = user.idnik
                                                    WHERE ga_building.nik_request = '$niklogin'");

                                                    while ($row6 = mysqli_fetch_assoc($sql7)) {
                                                    ?>
                                                        <tr>
                                                            <td><a href="index.php?page=View Building Facilities&id=<?= $row6['id_ga_building']; ?>"><?= $row6['id_ga_building'] ?></a></td>
                                                            <td><?= $row6['start_date'] ?></td>
                                                            <td><?= $row6['end_date'] ?></td>
                                                            <td><?= $row6['nama_request'] ?></td>
                                                            <td><?= $row6['description'] ?></td>
                                                            <td><?= $row6['status'] ?></td>
                                                            <td><?= $row6['category'] ?></td>
                                                            <td><?= $row6['nama_pic'] ?></td>
                                                            <td>
                                                                <div class="dropdown d-inline-block">
                                                                    <button class="btn btn-soft-secondary btn-sm dropdown" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                                                        <i class="ri-more-fill align-middle"></i>
                                                                    </button>
                                                                    <ul class="dropdown-menu dropdown-menu-end">
                                                                        <li>
                                                                            <a href="index.php?page=View Building Facilities&id=<?= $row6['id_ga_building']; ?>" class="dropdown-item"><i class="ri-eye-fill align-bottom me-2 text-muted"></i> View</a>
                                                                        </li>
                                                                    </ul>
                                                                </div>
                                                            </td>
                                                        </tr>
                                            <?php
                                                    }
                                                }
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
            </div>
            <!--end card-->
        </div>
        <!--end col-->
    </div>
    <!--end row-->
</div>

<div class="modal fade zoomIn" id="showModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" style="max-width: 1070px;">
        <div class="modal-content border-0">
            <div class="modal-header p-3 bg-soft-info">
                <h5 class="modal-title" id="exampleModalLabel">Create Request GA Facilities - Building Maintenance
                    Support</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" id="close-modal"></button>
            </div>
            <form action="function/insert_ga_building.php" method="POST" id="myForm" enctype="multipart/form-data">
                <?php
                $sql = mysqli_query($koneksi, "SELECT * FROM ga_building");
                $row = mysqli_fetch_assoc($sql);
                $currentDateTime = date('Y-m-d H:i:s');
                ?>
                <div class="modal-body">
                    <div class="row g-3">
                        <div class="col-lg-6">
                            <input class="form-control" value="<?= $currentDateTime ?>" name="startDate" hidden />
                            <input type="text" class="form-control" value="<?= $niklogin ?>" name="nik_request" hidden />
                            <input type="text" class="form-control" value="<?= $row['status'] ?>" name="statusBuilding" hidden />
                            <input type="text" class="form-control" value="<?= $row['category'] ?>" name="category" hidden />
                            <div>
                                <h6 class="fw-semibold text-uppercase mb-3">Description</h6>
                                <textarea id="ckeditor-classic" name="description"></textarea>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="mb-3 mt-1">
                                <label class="form-label">Building Request Form (if any)</label>
                                <input type="file" class="form-control" name="file" />
                            </div>
                            <div>
                                <label for="wa" class="form-label">No.Whatsapp</label>
                                <input type="number" class="form-control" placeholder="Insert your active number +(62) " name="wa" required />
                            </div>
                            <div>
                                <?php if (isset($row7['ga3']) && ($row7['ga3'] == '1' || ($row7['admin'] == '1'))) { ?>
                                    <div class="mb-3 mt-3">
                                        <label for="tasksTitle-field" class="form-label"><span> Request User</span></label>
                                        <select class="form-control" data-choices name="nik_request">
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
                                    <input type="text" class="form-control" hidden name="nik_request" value="<?= $niklogin ?>" />
                                <?php } ?>
                            </div>
                        </div>

                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger waves-effect" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary waves-effect waves-light" name="add-ga-building">Create</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script src="assets/libs/@ckeditor/ckeditor5-build-classic/build/ckeditor.js"></script>
<script src="assets/js/pages/project-create.init.js"></script>
<script src="assets/js/pages/ticketdetail.init.js"></script>


<!-- Sweet Alert -->
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