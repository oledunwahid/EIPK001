<link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/fixedcolumns/4.3.0/css/fixedColumns.dataTables.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.4.2/css/buttons.dataTables.min.css">

<link href="https://cdn.datatables.net/searchbuilder/1.6.0/css/searchBuilder.dataTables.min.css" rel="stylesheet" type="text/css" />
<link href="https://cdn.datatables.net/datetime/1.5.1/css/dataTables.dateTime.min.css" rel="stylesheet" type="text/css" />


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

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.19/dist/sweetalert2.min.css">




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
                            <?php if (isset($row7['admin']) && ($row7['admin'] == '1' || ($row7['ga4'] == '1'))) {
                                $sql = mysqli_query($koneksi, "SELECT id_kurir FROM kurir");
                                $totalRequest = mysqli_num_rows($sql);
                            } else {
                                $sql = mysqli_query($koneksi, "SELECT id_kurir FROM kurir where id_nik_request='$niklogin' ");
                                $totalRequest = mysqli_num_rows($sql);
                            }
                            ?>
                            <p class="fw-medium text-muted mb-0">Total Request</p>
                            <h2 class="mt-4 ff-secondary fw-semibold">
                                <span class="counter-value" data-target="<?= htmlspecialchars($totalRequest) ?>"></span>
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

        <!-- (Pending, Closed, Process) -->
        <div class="col-xxl-3 col-sm-6">
            <div class="card card-animate">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <div>
                            <?php
                            if (isset($row7['admin']) && ($row7['admin'] == '1' || ($row7['ga4'] == '1'))) {
                                $sql1 = mysqli_query($koneksi, "SELECT id_kurir FROM kurir WHERE status_kurir = 'On Process'");
                                $ActiveDelivery = mysqli_num_rows($sql1);
                            } else {
                                $sql1 = mysqli_query($koneksi, "SELECT id_kurir FROM kurir WHERE status_kurir = 'On Process' AND (id_nik_request = '$niklogin' OR id_nik_kurir = '$niklogin')");
                                $ActiveDelivery = mysqli_num_rows($sql1);
                            }
                            ?>
                            <p class="fw-medium text-muted mb-0">Total Active Delivery </p>
                            <h2 class="mt-4 ff-secondary fw-semibold"><span class="counter-value" data-target="<?= $ActiveDelivery ?>">0</span></h2>
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

        <div class="col-xxl-3 col-sm-6">
            <div class="card card-animate">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <div>
                            <?php
                            if (isset($row7['admin']) && ($row7['admin'] == '1' || ($row7['ga4'] == '1'))) {
                                $sql1 = mysqli_query($koneksi, "SELECT id_kurir FROM kurir WHERE status_kurir = 'Canceled'");
                                $CanceledDelivery = mysqli_num_rows($sql1);
                            } else {
                                $sql1 = mysqli_query($koneksi, "SELECT id_kurir FROM kurir WHERE status_kurir = 'Canceled' AND (id_nik_request = '$niklogin' OR id_nik_kurir = '$niklogin')");
                                $CanceledDelivery = mysqli_num_rows($sql1);
                            }
                            ?>
                            <p class="fw-medium text-muted mb-0">Total Canceled Delivery </p>
                            <h2 class="mt-4 ff-secondary fw-semibold"><span class="counter-value" data-target="<?= $CanceledDelivery ?>">0</span></h2>
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
        <!--end col-->
        <div class="col-xxl-3 col-sm-6">
            <div class="card card-animate">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <div>
                            <?php
                            if (isset($row7['admin']) && ($row7['admin'] == '1' || ($row7['ga4'] == '1'))) {
                                $sql2 = mysqli_query($koneksi, "SELECT id_kurir FROM kurir WHERE status_kurir = 'Closed'");
                                $Delivered = mysqli_num_rows($sql2);
                            } else {
                                $sql2 = mysqli_query($koneksi, "SELECT id_kurir FROM kurir WHERE status_kurir = 'Closed' AND (id_nik_request = '$niklogin' OR id_nik_kurir = '$niklogin')");
                                $Delivered = mysqli_num_rows($sql2);
                            }
                            ?>

                            <p class="fw-medium text-muted mb-0">Total Items Delivered</p>
                            <h2 class="mt-4 ff-secondary fw-semibold"><span class="counter-value" data-target="<?= $Delivered ?>">0</span></h2>

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
    </div>

    <!-- break between each contents -->

    <div class="row">
        <div class="col-lg-12">
            <div class="card" id="ticketsList">
                <div class="card-header border-0">
                    <div class="d-flex align-items-center">
                        <h5 class="card-title mb-0 flex-grow-1">List Sent Package</h5>
                        <div class="flex-shrink-0">
                            <button class="btn btn-danger add-btn" data-bs-toggle="modal" data-bs-target="#showModal"><i class="ri-add-line align-bottom me-1"></i> Create Delivery</button>

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
                                                <th>ID Delivery</th>
                                                <th>Nama Request</th>
                                                <th>Tanggal Request</th>
                                                <th>Jenis Barang</th>
                                                <th>Whatsapp</th>
                                                <th>Tipe Kurir</th>
                                                <th>Description</th>
                                                <th>Alamat</th>
                                                <th>Nama Kurir</th>
                                                <th>Status Ticket</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>

                                        <tbody>
                                            <?php
                                            if (isset($_POST["filter"])) {


                                                $sql7 = mysqli_query($koneksi, "SELECT * FROM access_level WHERE idnik =$niklogin ");
                                                $row7 = mysqli_fetch_assoc($sql7); ?>
                                                <?php
                                                if (isset($row7['admin']) && ($row7['admin'] == '1' || ($row7['ga4'] == '1'))) {
                                                    $sql7 = mysqli_query($koneksi, "SELECT
                                                        kurir.*,
                                                        user1.nama AS nama_request,
                                                        user2.nama AS nama_kurir 
                                                        FROM kurir
                                                        LEFT JOIN user AS user1 ON kurir.id_nik_request = user1.idnik
                                                        LEFT JOIN user AS user2 ON kurir.id_nik_kurir = user2.idnik
                                                        INNER JOIN user ON kurir.id_nik_request = user.idnik ");
                                                    while ($row6 = mysqli_fetch_assoc($sql7)) {
                                                ?>
                                                        <tr>
                                                            <td><a href="index.php?page=EditKurir&id=<?= $row6['id_kurir']; ?>"><?= $row6['id_kurir'] ?></a></td>
                                                            <td><?= $row6['nama_request'] ?></td>
                                                            <td><?= $row6['tanggal_req'] ?></td>
                                                            <td><?= $row6['jenis_barang'] ?></td>
                                                            <td><?= $row6['whatsapp'] ?></td>
                                                            <td><?= $row6['tipe_kurir'] ?></td>
                                                            <td><?= $row6['deskripsi'] ?></td>
                                                            <td><?= $row6['alamat_kurir'] ?></td>
                                                            <td><?= $row6['nama_kurir'] ?></td>

                                                            <td>
                                                                <?php
                                                                if ($row6['status_kurir'] == 'On Process') {
                                                                    echo 'On Process';
                                                                } elseif ($row6['status_kurir'] == 'Canceled') {
                                                                    echo 'Canceled';
                                                                } else {
                                                                    echo 'Closed';
                                                                }
                                                                ?>

                                                            </td>
                                                            <td>
                                                                <div class="dropdown d-inline-block">
                                                                    <button class="btn btn-soft-secondary btn-sm dropdown" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                                                        <i class="ri-more-fill align-middle"></i>
                                                                    </button>
                                                                    <ul class="dropdown-menu dropdown-menu-end">
                                                                        <li>
                                                                            <a href="index.php?page=EditKurir&id=<?= $row6['id_kurir']; ?>" class="dropdown-item"><i class="ri-pencil-fill align-bottom me-2 text-muted"></i> Edit</a>
                                                                        </li>
                                                                    </ul>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                    <?php
                                                    }
                                                } else {
                                                    $sql7 = mysqli_query($koneksi, "SELECT
                                                        kurir.*,
                                                        user1.nama AS nama_request,
                                                        user2.nama AS nama_kurir 
                                                        FROM kurir
                                                        LEFT JOIN user AS user1 ON kurir.id_nik_request = user1.idnik
                                                        LEFT JOIN user AS user2 ON kurir.id_nik_kurir = user2.idnik
                                                        INNER JOIN user ON kurir.id_nik_request = user.idnik
                                                        WHERE kurir.id_nik_request = '$niklogin'");

                                                    while ($row6 = mysqli_fetch_assoc($sql7)) {
                                                    ?>
                                                        <tr>
                                                            <td><a href="index.php?page=ViewKurir&id=<?= $row6['id_kurir']; ?>"><?= $row6['id_kurir'] ?></a></td>
                                                            <td><?= $row6['nama_request'] ?></td>
                                                            <td><?= $row6['tanggal_req'] ?></td>
                                                            <td><?= $row6['jenis_barang'] ?></td>
                                                            <td><?= $row6['whatsapp'] ?></td>
                                                            <td><?= $row6['tipe_kurir'] ?></td>
                                                            <td><?= $row6['deskripsi'] ?></td>
                                                            <td><?= $row6['alamat_kurir'] ?></td>
                                                            <td><?= $row6['nama_kurir'] ?></td>

                                                            <td>
                                                                <?php
                                                                if ($row6['status_kurir'] == 'On Process') {
                                                                    echo 'On Process';
                                                                } elseif ($row6['status_kurir'] == 'Canceled') {
                                                                    echo 'Canceled';
                                                                } else {
                                                                    echo 'Closed';
                                                                }
                                                                ?>

                                                            </td>
                                                            <td>
                                                                <div class="dropdown d-inline-block">
                                                                    <button class="btn btn-soft-secondary btn-sm dropdown" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                                                        <i class="ri-more-fill align-middle"></i>
                                                                    </button>
                                                                    <ul class="dropdown-menu dropdown-menu-end">
                                                                        <li>
                                                                            <a href="index.php?page=ViewKurir&id=<?= $row6['id_kurir']; ?>" class="dropdown-item"><i class="ri-eye-fill align-bottom me-2 text-muted"></i> View</a>
                                                                        </li>
                                                                    </ul>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                <?php }
                                                }
                                            } else {
                                                $sql7 = mysqli_query($koneksi, "SELECT * FROM access_level WHERE idnik =$niklogin ");
                                                $row7 = mysqli_fetch_assoc($sql7);

                                                $tgl1 = date('Y-m-t', strtotime("-2 months"));
                                                $tgl2 = date('Y-m-t');
                                                ?>
                                                <?php
                                                if (isset($row7['admin']) && ($row7['admin'] == '1' || ($row7['ga4'] == '1'))) {
                                                    $sql7 = mysqli_query($koneksi, "SELECT
                                                    kurir.*,
                                                    user1.nama AS nama_request,
                                                    user2.nama AS nama_kurir 
                                                    FROM kurir
                                                    LEFT JOIN user AS user1 ON kurir.id_nik_request = user1.idnik
                                                    LEFT JOIN user AS user2 ON kurir.id_nik_kurir = user2.idnik
                                                    INNER JOIN user ON kurir.id_nik_request = user.idnik");

                                                    while ($row6 = mysqli_fetch_assoc($sql7)) {
                                                ?>
                                                        <tr>
                                                            <td><a href="index.php?page=EditKurir&id=<?= $row6['id_kurir']; ?>"><?= $row6['id_kurir'] ?></a></td>
                                                            <td><?= $row6['nama_request'] ?></td>
                                                            <td><?= $row6['tanggal_req'] ?></td>
                                                            <td><?= $row6['jenis_barang'] ?></td>
                                                            <td><?= $row6['whatsapp'] ?></td>
                                                            <td><?= $row6['tipe_kurir'] ?></td>
                                                            <td><?= $row6['deskripsi'] ?></td>
                                                            <td><?= $row6['alamat_kurir'] ?></td>
                                                            <td><?= $row6['nama_kurir'] ?></td>

                                                            <td>
                                                                <?php
                                                                if ($row6['status_kurir'] == 'On Process') {
                                                                    echo 'On Process';
                                                                } elseif ($row6['status_kurir'] == 'Canceled') {
                                                                    echo 'Canceled';
                                                                } else {
                                                                    echo 'Closed';
                                                                }
                                                                ?>

                                                            </td>
                                                            <td>
                                                                <div class="dropdown d-inline-block">
                                                                    <button class="btn btn-soft-secondary btn-sm dropdown" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                                                        <i class="ri-more-fill align-middle"></i>
                                                                    </button>
                                                                    <ul class="dropdown-menu dropdown-menu-end">
                                                                        <li>
                                                                            <a href="index.php?page=EditKurir&id=<?= $row6['id_kurir']; ?>" class="dropdown-item"><i class="ri-pencil-fill align-bottom me-2 text-muted"></i> Edit</a>
                                                                        </li>
                                                                    </ul>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                    <?php
                                                    }
                                                } else {
                                                    $sql7 = mysqli_query($koneksi, "SELECT
                                                    kurir.*,
                                                    user1.nama AS nama_request,
                                                    user2.nama AS nama_kurir 
                                                    FROM kurir
                                                    LEFT JOIN user AS user1 ON kurir.id_nik_request = user1.idnik
                                                    LEFT JOIN user AS user2 ON kurir.id_nik_kurir = user2.idnik
                                                    INNER JOIN user ON kurir.id_nik_request = user.idnik
                                                    WHERE kurir.id_nik_request = '$niklogin'");

                                                    while ($row6 = mysqli_fetch_assoc($sql7)) {
                                                    ?>
                                                        <tr>
                                                            <td><a href="index.php?page=ViewKurir&id=<?= $row6['id_kurir']; ?>"><?= $row6['id_kurir'] ?></a></td>
                                                            <td><?= $row6['nama_request'] ?></td>
                                                            <td><?= $row6['tanggal_req'] ?></td>
                                                            <td><?= $row6['jenis_barang'] ?></td>
                                                            <td><?= $row6['whatsapp'] ?></td>
                                                            <td><?= $row6['tipe_kurir'] ?></td>
                                                            <td><?= $row6['deskripsi'] ?></td>
                                                            <td><?= $row6['alamat_kurir'] ?></td>
                                                            <td><?= $row6['nama_kurir'] ?></td>

                                                            <td>
                                                                <?php
                                                                if ($row6['status_kurir'] == 'On Process') {
                                                                    echo 'On Process';
                                                                } elseif ($row6['status_kurir'] == 'Canceled') {
                                                                    echo 'Canceled';
                                                                } else {
                                                                    echo 'Closed';
                                                                }
                                                                ?>

                                                            </td>
                                                            <td>
                                                                <div class="dropdown d-inline-block">
                                                                    <button class="btn btn-soft-secondary btn-sm dropdown" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                                                        <i class="ri-more-fill align-middle"></i>
                                                                    </button>
                                                                    <ul class="dropdown-menu dropdown-menu-end">
                                                                        <li>
                                                                            <a href="index.php?page=ViewKurir&id=<?= $row6['id_kurir']; ?>" class="dropdown-item"><i class="ri-eye-fill align-bottom me-2 text-muted"></i> View</a>
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


    <div class="modal fade zoomIn" id="showModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content border-0">
                <div class="modal-header p-3 bg-soft-info">
                    <h5 class="modal-title" id="exampleModalLabel">Create Sent Package</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" id="close-modal"></button>
                </div>
                <form action="function/insert_kurir.php" method="POST" enctype="multipart/form-data" id="formModalKurir">
                    <div class="modal-body">
                        <?php
                        $tanggal_req = date('Y-m-d H:i:s');
                        $currentDateTime = new DateTime('now', new DateTimeZone('Asia/Jakarta'));
                        $timestamp = $currentDateTime->format('ymdHis');

                        $RequestNumber = "D" . $timestamp . str_pad(1, '0', STR_PAD_LEFT);
                        ?>
                        <div class="row g-3">
                            <div class="col-lg-6">
                                <input class="form-control" value="<?= $tanggal_req ?>" name="tanggalRequest" hidden />
                                <input type="text" class="form-control" value="<?= $niklogin ?>" name="id_nik_request" hidden />

                                <div class="mb-3 mt-3">
                                    <input type="text" readonly class="form-control" value="<?= $RequestNumber ?>" name="id_kurir" />
                                </div>

                                <?php if (isset($row7['admin']) && ($row7['admin'] == '1' || ($row7['ga4'] == '1'))) { ?>
                                    <div class="mb-3 mt-3">
                                        <label for="tasksTitle-field" class="form-label"><span>Tujuan Pengiriman Kepada </span></label>
                                        <select class="form-control" data-choices name="id_nik_request">
                                            <option value="">All Users</option>
                                            <?php
                                            $sql5 = mysqli_query($koneksi, 'SELECT idnik, nama, divisi, lokasi, company FROM user');
                                            while ($row5 = mysqli_fetch_assoc($sql5)) {
                                            ?>
                                                <option value="<?= $row5['idnik'] ?>">PT <?= $row5['company'] ?> | <strong><?= $row5['nama'] ?></strong> | <?= $row5['divisi'] ?></option>
                                            <?php } ?>
                                        </select>
                                        <input type="text" class="form-control" hidden name="status_input" value="Input by Admin" />
                                    </div>
                                <?php } else { ?>
                                    <input type="text" class="form-control" hidden name="id_nik_request" value="<?= $niklogin ?>" />
                                    <input type="text" class="form-control" hidden name="status_input" value="Input by User" />
                                <?php } ?>


                                <div class="col-lg-12 mt-3">
                                    <div>
                                        <div class="mb-3 mt-3">
                                            <label for="tasksTitle-field" class="form-label"><span> Jenis Barang </span></label>
                                            <select class="form-control" data-choices name="jenisBarang">
                                                <option value="">Select Tipe Barang</option>
                                                <option value="Surat/Dokumen"></option>
                                                <option value="Pakaian"></option>
                                                <option value="Pecah Belah"></option>
                                                <option value="Elektronik"></option>
                                                <option value="Lainnya"></option>
                                            </select>
                                        </div>
                                    </div>

                                    <div>
                                        <label for="wa" class="form-label">No.Whatsapp</label>
                                        <input type="number" class="form-control" placeholder="Insert your active number +(62) " name="wa" />
                                    </div>

                                    <div class="mb-3 mt-3">
                                        <label for="tasksTitle-field" class="form-label"><span> Select Courier External or Internal </span></label>
                                        <select class="form-control" data-choices name="tipe_kurir">
                                            <option value="">Select Courier</option>
                                            <option value="Internal Courier"></option>
                                            <option value="Ekspedisi Coorporate Reguler"></option>
                                            <option value="Ekspedisi Coorporate Express"></option>
                                            <option value="Grab Express Instant Courier"></option>
                                        </select>
                                    </div>
                                </div>

                                <?php if (isset($row7['admin']) && ($row7['admin'] == '1' || ($row7['ga4'] == '1'))) { ?>
                                    <div class="mb-3 mt-3">
                                        <label for="tasksTitle-field" class="form-label"><span> PIC Courier</span></label>
                                        <select class="form-control" data-choices name="id_nik_kurir">
                                            <option value="">All PIC Internal Courier</option>
                                            <?php
                                            $sql5 = mysqli_query($koneksi, "SELECT access_level.*, nama FROM access_level 
                                        INNER JOIN user ON access_level.idnik = user.idnik WHERE access_level.internal_kurir ='1'  ");
                                            while ($row5 = mysqli_fetch_assoc($sql5)) {
                                            ?>
                                                <option value="<?= $row5['idnik'] ?>"><?= $row5['nama'] ?></option>
                                            <?php
                                            }
                                            ?>
                                        </select>
                                        <input class="form-control" name="tanggal_proses" hidden value="<?= $tanggal_proses ?>" />
                                    </div>
                                <?php } ?>
                            </div>

                            <div class="col-lg-6">
                                <div class="mb-3 mt-3">
                                    <div class="col-lg-12">
                                        <div>
                                            <label for="address" class="form-label">Alamat Tujuan</label>
                                            <textarea class="form-control" id="ckeditor-classic" name="alamatKurir" placeholder="*Tuliskan alamat pengiriman secara lengkap"></textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <br>

                            <div>
                                <label for="catatanKurir" class="form-label">Catatan untuk kurir</label>
                                <div class="card-body">
                                    <input type="text" class="form-control" name="catatanKurir" required placeholder="*Isi keterangan/catatan secara detail barang serta tujuan"></input>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="modal-footer mt-3">
                        <div class="hstack gap-2 justify-content-end">
                            <button type="button" class="btn btn btn-light waves-effect" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary waves-effect waves-light" name="add-request">Create Request</button>
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


<script>
    $(document).ready(function() {
        var table = $('#datalengkap').DataTable({
            dom: 'QBfrtip',
            scrollX: true,
            scrollY: 400,
            scrollCollapse: !0,
            order: [2, 'desc'],

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