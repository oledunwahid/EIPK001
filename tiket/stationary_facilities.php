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
                            <?php if (isset($row7['admin']) && ($row7['admin'] == '1' || ($row7['ga1'] == '1'))) {

                                $sql = mysqli_query($koneksi, "SELECT id_ga_stationary FROM ga_stationary");
                                $totalRequest = mysqli_num_rows($sql);
                            } else {

                                $sql = mysqli_query($koneksi, "SELECT id_ga_stationary FROM ga_stationary where nik_request='$niklogin' ");
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
                            <?php if (isset($row7['admin']) && ($row7['admin'] == '1' || ($row7['ga1'] == '1'))) {
                                $sql1 = mysqli_query($koneksi, "SELECT id_ga_stationary FROM ga_stationary WHERE status = 'Pending'");
                                $PendingDelivery = mysqli_num_rows($sql1);
                            } else {
                                $sql1 = mysqli_query($koneksi, "SELECT id_ga_stationary FROM ga_stationary WHERE status = 'Pending' AND nik_request = '$niklogin' ");
                                $PendingDelivery = mysqli_num_rows($sql1);
                            }
                            ?>

                            <p class="fw-medium text-muted mb-0">Pending Delivery</p>
                            <h2 class="mt-4 ff-secondary fw-semibold"><span class="counter-value" data-target="<?= $PendingDelivery ?>">0</span></h2>
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
                            <?php if (isset($row7['admin']) && ($row7['admin'] == '1' || ($row7['ga1'] == '1'))) {
                                $sql2 = mysqli_query($koneksi, "SELECT id_ga_stationary FROM ga_stationary WHERE status = 'Closed'");
                                $Delivered = mysqli_num_rows($sql2);
                            } else {
                                $sql2 = mysqli_query($koneksi, "SELECT id_ga_stationary FROM ga_stationary WHERE status = 'Closed' AND nik_request = '$niklogin'");
                                $Delivered = mysqli_num_rows($sql2);
                            }
                            ?>

                            <p class="fw-medium text-muted mb-0">Items Delivered</p>
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
        <div class="col-xxl-3 col-sm-6">
            <div class="card card-animate">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <div>
                            <p class="fw-medium text-muted mb-0">Request on Process</p>
                            <?php if (isset($row7['admin']) && ($row7['admin'] == '1' || ($row7['ga1'] == '1'))) {
                                $sql3 = mysqli_query($koneksi, "SELECT id_ga_stationary FROM ga_stationary WHERE status = 'Proses'");
                                $ProcessItems = mysqli_num_rows($sql3);
                            } else {
                                $sql3 = mysqli_query($koneksi, "SELECT id_ga_stationary FROM ga_stationary WHERE status = 'Proses' AND nik_request = '$niklogin'");
                                $ProcessItems = mysqli_num_rows($sql3);
                            }
                            ?>
                            <h2 class="mt-4 ff-secondary fw-semibold"><span class="counter-value" data-target="<?= $ProcessItems ?>">0</span></h2>
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
    </div>



    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex align-items-center">
                        <div class="card-title mb-0 flex-grow-1 flex">
                            <h5>ATK/Stationary</h5>
                            <h6>Offers support for stationary-related requests.</h6>
                        </div>
                        <div class="flex-shrink-0">
                            <button class="btn btn-danger add-btn" data-bs-toggle="modal" data-bs-target="#showModal">
                                <i class="ri-add-line align-bottom me-1"></i> Add ATK
                            </button>
                        </div>
                    </div>
                </div>

                <div class="card-body border border-dashed border-end-0 border-start-0">
                    <div class="row">
                        <div class="col-lg-12">

                            <div class="card">

                                <div class="card-body">

                                    <table id="datalengkap" class="display table table-bordered dt-responsive" style="width:100%">
                                        <thead>
                                            <tr>
                                                <th>No.</th>
                                                <th>ID Ticket</th>
                                                <th>Start Date</th>
                                                <th>End Date</th>
                                                <th>Status</th>
                                                <th>Type of service</th>
                                                <th>PIC</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php if (isset($row7['admin']) && ($row7['admin'] == '1' || ($row7['ga1'] == '1'))) {
                                                $sql6 = mysqli_query($koneksi, "SELECT
                                                ga_stationary.*,
                                                user1.nama AS nik_request,
                                                user2.nama AS nik_pic
                                                FROM ga_stationary
                                                LEFT JOIN user AS user1 ON ga_stationary.nik_request = user1.idnik
                                                LEFT JOIN user AS user2 ON ga_stationary.nik_pic = user2.idnik
                                                INNER JOIN user ON ga_stationary.nik_request = user.idnik");
                                                $rowNumber = 1;
                                                while ($row6 = mysqli_fetch_assoc($sql6)) {
                                            ?>
                                                    <tr>
                                                        <td><?= $rowNumber ?></td>
                                                        <td><a href="index.php?page=EditATK/Stationary&id=<?= $row6['id_ga_stationary']; ?>"><?= $row6['id_ga_stationary'] ?></a></td>
                                                        <td><?= $row6['start_date'] ?></td>
                                                        <td><?= $row6['end_date'] ?></td>
                                                        <td><?= $row6['status'] ?></td>
                                                        <td><?= $row6['category'] ?></td>
                                                        <td><?= $row6['nik_pic'] ?></td>
                                                        <td>
                                                            <div class="dropdown d-inline-block">
                                                                <button class="btn btn-soft-secondary btn-sm dropdown" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                                                    <i class="ri-more-fill align-middle"></i>
                                                                </button>
                                                                <ul class="dropdown-menu dropdown-menu-end">
                                                                    <li>
                                                                        <a href="index.php?page=EditATK/Stationary&id=<?= $row6['id_ga_stationary']; ?>" class="dropdown-item"><i class="ri-pencil-fill align-bottom me-2 text-muted"></i> Edit</a>
                                                                    </li>
                                                                </ul>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                <?php
                                                    $rowNumber++;
                                                }
                                            } else {
                                                $sql6 = mysqli_query($koneksi, "SELECT
                                            ga_stationary.*,
                                            user1.nama AS nik_request,
                                            user2.nama AS nik_pic
                                            FROM ga_stationary
                                            LEFT JOIN user AS user1 ON ga_stationary.nik_request = user1.idnik
                                            LEFT JOIN user AS user2 ON ga_stationary.nik_pic = user2.idnik
                                            INNER JOIN user ON ga_stationary.nik_request = user.idnik
                                            WHERE ga_stationary.nik_request = '$niklogin'");
                                                $rowNumber = 1;
                                                while ($row6 = mysqli_fetch_assoc($sql6)) {
                                                ?>
                                                    <tr>
                                                        <td><?= $rowNumber ?></td>
                                                        <td><a href="index.php?page=ViewATK/Stationary&id=<?= $row6['id_ga_stationary']; ?>"><?= $row6['id_ga_stationary'] ?></a></td>
                                                        <td><?= $row6['start_date'] ?></td>
                                                        <td><?= $row6['end_date'] ?></td>
                                                        <td><?= $row6['status'] ?></td>
                                                        <td><?= $row6['category'] ?></td>
                                                        <td><?= $row6['nik_pic'] ?></td>
                                                        <td>
                                                            <div class="dropdown d-inline-block">
                                                                <button class="btn btn-soft-secondary btn-sm dropdown" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                                                    <i class="ri-more-fill align-middle"></i>
                                                                </button>
                                                                <ul class="dropdown-menu dropdown-menu-end">
                                                                    <li>
                                                                        <a href="index.php?page=ViewATK/Stationary&id=<?= $row6['id_ga_stationary']; ?>" class="dropdown-item"><i class="ri-eye-fill align-bottom me-2 text-muted"></i> View</a>
                                                                    </li>
                                                                </ul>
                                                            </div>
                                                        </td>
                                                    </tr>
                                            <?php
                                                    $rowNumber++;
                                                }
                                            }
                                            ?>
                                        </tbody>
                                    </table>

                                </div>

                            </div>

                        </div>

                    </div>
                </div>


                <div class="modal fade zoomIn" id="showModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered modal-lg" style="max-width: 1070px;">
                        <div class="modal-content border-0">
                            <div class="modal-header p-3 bg-soft-info">
                                <h5 class="modal-title" id="exampleModalLabel">Create Request GA Facilities - ATK / Stationary</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" id="close-modal"></button>
                            </div>
                            <form action="function/insert_ga_stationary.php" method="POST" enctype="multipart/form-data">
                                <?php
                                $sql = mysqli_query($koneksi, "SELECT * FROM ga_stationary");
                                $row = mysqli_fetch_assoc($sql);
                                $currentDateTime = date('Y-m-d H:i:s');
                                $nik_pic = '21001638';
                                ?>
                                <div class="modal-body">
                                    <div class="row g-3">
                                        <div class="col-lg-9">
                                            <input type="hidden" class="form-control" value="<?= $currentDateTime ?>" name="startDate" />
                                            <input type="hidden" class="form-control" value="<?= $niklogin ?>" name="nikRequest" />
                                            <input type="hidden" class="form-control" value="<?= $nik_pic ?>" name="nikPIC" />
                                            <input type="hidden" class="form-control" value="<?= $row["status"] ?>" name="statusATK" />
                                            <input type="hidden" class="form-control" value="<?= $row["category"] ?>" name="category" />

                                            <!-- Select item ATK 1 -->
                                            <div class="row">
                                                <div class="col-md-9 mb-3">
                                                    <label for="atkSelect" class="form-label"><span> Select Item </span></label>
                                                    <select class="form-control" data-choices name="idATK1">
                                                        <option value="">Select ATK/Stationary</option>
                                                        <?php
                                                        $sql5 = mysqli_query($koneksi, 'SELECT * FROM atk ');
                                                        while ($row5 = mysqli_fetch_assoc($sql5)) {
                                                        ?>
                                                            <option value="<?= $row5['id_atk'] ?>"><?= $row5['description'] ?></option>
                                                        <?php } ?>
                                                    </select>
                                                </div>
                                                <div class="col-md-2 pt-1">
                                                    <div class="col-sm-5">
                                                        <div>
                                                            <h5 class="fs-13 fw-medium text-muted">Qty</h5>
                                                            <div class="input-step light">
                                                                <button type="button" class="minus">–</button>
                                                                <input type="number" class="product-quantity" value="0" min="0" max="100" name="totalReq1" readonly>
                                                                <button type="button" class="plus">+</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Select item ATK 2 -->
                                            <div class="row">
                                                <div class="col-md-9 mb-3">
                                                    <label for="atkSelect" class="form-label"><span> Select Item </span></label>
                                                    <select class="form-control" data-choices name="idATK2">
                                                        <option value="">Select ATK/Stationary</option>
                                                        <?php
                                                        $sql5 = mysqli_query($koneksi, 'SELECT * FROM atk ');
                                                        while ($row5 = mysqli_fetch_assoc($sql5)) {
                                                        ?>
                                                            <option value="<?= $row5['id_atk'] ?>"><?= $row5['description'] ?></option>
                                                        <?php } ?>
                                                    </select>
                                                </div>
                                                <div class="col-md-2 pt-1">
                                                    <div class="col-sm-5">
                                                        <div>
                                                            <h5 class="fs-13 fw-medium text-muted">Qty</h5>
                                                            <div class="input-step light">
                                                                <button type="button" class="minus">–</button>
                                                                <input type="number" class="product-quantity" value="0" min="0" max="100" name="totalReq2" readonly>
                                                                <button type="button" class="plus">+</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Select item ATK 3 -->
                                            <div class="row">
                                                <div class="col-md-9 mb-3">
                                                    <label for="atkSelect" class="form-label"><span> Select Item </span></label>
                                                    <select class="form-control" data-choices name="idATK3">
                                                        <option value="">Select ATK/Stationary</option>
                                                        <?php
                                                        $sql5 = mysqli_query($koneksi, 'SELECT * FROM atk ');
                                                        while ($row5 = mysqli_fetch_assoc($sql5)) {
                                                        ?>
                                                            <option value="<?= $row5['id_atk'] ?>"><?= $row5['description'] ?></option>
                                                        <?php } ?>
                                                    </select>
                                                </div>
                                                <div class="col-md-2 pt-1">
                                                    <div class="col-sm-5">
                                                        <div>
                                                            <h5 class="fs-13 fw-medium text-muted">Qty</h5>
                                                            <div class="input-step light">
                                                                <button type="button" class="minus">–</button>
                                                                <input type="number" class="product-quantity" value="0" min="0" max="100" name="totalReq3" readonly>
                                                                <button type="button" class="plus">+</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Select item ATK 4 -->
                                            <div class="row">
                                                <div class="col-md-9 mb-3">
                                                    <label for="atkSelect" class="form-label"><span> Select Item </span></label>
                                                    <select class="form-control" data-choices name="idATK4">
                                                        <option value="">Select ATK/Stationary</option>
                                                        <?php
                                                        $sql5 = mysqli_query($koneksi, 'SELECT * FROM atk ');
                                                        while ($row5 = mysqli_fetch_assoc($sql5)) {
                                                        ?>
                                                            <option value="<?= $row5['id_atk'] ?>"><?= $row5['description'] ?></option>
                                                        <?php } ?>
                                                    </select>
                                                </div>
                                                <div class="col-md-2 pt-1">
                                                    <div class="col-sm-5">
                                                        <div>
                                                            <h5 class="fs-13 fw-medium text-muted">Qty</h5>
                                                            <div class="input-step light">
                                                                <button type="button" class="minus">–</button>
                                                                <input type="number" class="product-quantity" value="0" min="0" max="100" name="totalReq4" readonly>
                                                                <button type="button" class="plus">+</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Select item ATK 5 -->
                                            <div class="row">
                                                <div class="col-md-9 mb-3">
                                                    <label for="atkSelect" class="form-label"><span> Select Item </span></label>
                                                    <select class="form-control" data-choices name="idATK5">
                                                        <option value="">Select ATK/Stationary</option>
                                                        <?php
                                                        $sql5 = mysqli_query($koneksi, 'SELECT * FROM atk ');
                                                        while ($row5 = mysqli_fetch_assoc($sql5)) {
                                                        ?>
                                                            <option value="<?= $row5['id_atk'] ?>"><?= $row5['description'] ?></option>
                                                        <?php } ?>
                                                    </select>
                                                </div>
                                                <div class="col-md-2 pt-1">
                                                    <div class="col-sm-5">
                                                        <div>
                                                            <h5 class="fs-13 fw-medium text-muted">Qty</h5>
                                                            <div class="input-step light">
                                                                <button type="button" class="minus">–</button>
                                                                <input type="number" class="product-quantity" value="0" min="0" max="100" name="totalReq5" readonly>
                                                                <button type="button" class="plus">+</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>

                                        <div class="col-lg-3">
                                            <div>
                                                <label for="wa" class="form-label">No.Whatsapp</label>
                                                <input type="number" class="form-control" placeholder="Insert your active number +(62)" name="wa" />
                                            </div>

                                            <?php if (isset($row7['admin']) && ($row7['admin'] == '1' || ($row7['ga1'] == '1'))) : ?>
                                                <div class="mb-3 mt-3">
                                                    <label for="id_nik_request" class="form-label"><span> Request User</span></label>
                                                    <select class="form-control" data-choices name="nikRequest">
                                                        <option value="">All Users</option>
                                                        <?php
                                                        $sql5 = mysqli_query($koneksi, 'SELECT idnik, nama, divisi, lokasi FROM user WHERE lokasi = "HO" ');
                                                        while ($row5 = mysqli_fetch_assoc($sql5)) {
                                                        ?>
                                                            <option value="<?= $row5['idnik'] ?>"><?= $row5['nama'] ?> | <?= $row5['divisi']  ?></option>
                                                        <?php } ?>
                                                    </select>
                                                </div>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-danger waves-effect" data-bs-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary waves-effect waves-light" name="add-stationary">Create</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="assets/libs/@ckeditor/ckeditor5-build-classic/build/ckeditor.js"></script>
<script src="assets/js/pages/project-create.init.js"></script>
<script src="assets/js/pages/ticketdetail.init.js"></script>

<!-- multi.js -->
<script src="assets/libs/multi.js/multi.min.js"></script>
<!-- autocomplete js -->
<script src="assets/libs/@tarekraafat/autocomplete.js/autoComplete.min.js"></script>

<!-- init js -->
<script src="assets/js/pages/form-advanced.init.js"></script>
<!-- input spin init -->
<script src="assets/js/pages/form-input-spin.init.js"></script>
<!-- input flag init -->
<script src="assets/js/pages/flag-input.init.js"></script>


<!-- Sweet Alert -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.19/dist/sweetalert2.all.min.js"></script>

<script>
    $(document).ready(function() {
        var table = $('#datalengkap').DataTable({
            dom: 'QBfrtip',
            scrollX: true,
            scrollY: 400,
            scrollCollapse: !0,
            order: [[2,'desc']],

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