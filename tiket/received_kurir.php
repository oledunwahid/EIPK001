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

    <?php
    $sql7 = mysqli_query($koneksi, "SELECT * FROM access_level WHERE idnik = $niklogin");
    $row7 = mysqli_fetch_assoc($sql7);
    ?>

    <!-- break between each contents -->

    <div class="row">
        <div class="col-lg-12">
            <div class="card" id="ticketsList">
                <div class="card-header border-0">
                    <div class="d-flex align-items-center">
                        <h5 class="card-title mb-0 flex-grow-1">List Received Items/Package</h5>
                        <?php if (isset($row7['admin']) && ($row7['admin'] == '1' || ($row7['ga4'] == '1'))) { ?>
                        <div class="flex-shrink-0">
                            <button class="btn btn-danger add-btn" data-bs-toggle="modal" data-bs-target="#showModal"><i class="ri-add-line align-bottom me-1"></i> Create Received</button>
                        </div>
                        <?php }?>
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
                                                <th>ID Received</th>
                                                <th>Nama PIC</th>
                                                <th>Tanggal Terima Barang</th>
                                                <th>Jenis Barang yang diterima</th>
                                                <th>Nama Pengirim</th>
                                                <th>Nama Ekspedisi</th>
                                                <th>No Resi</th>
                                                <th>Tujuan Penerima</th>
                                                <th>Whatsapp</th>
                                                <th>Nama PT</th>
                                                <th>Foto Barang</th>
                                                <th>Status Package</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>

                                        <tbody>
                                            <?php
                                            if (isset($_POST["filter"])) {


                                                $sql7 = mysqli_query($koneksi, "SELECT * FROM access_level WHERE idnik = $niklogin ");
                                                $row7 = mysqli_fetch_assoc($sql7); ?>
                                                <?php
                                                if (isset($row7['admin']) && ($row7['admin'] == '1' || ($row7['ga4'] == '1'))) {
                                                    $sql7 = mysqli_query($koneksi, "SELECT
                                                    rf_received_package.*,
                                                    user1.nama AS nama_request,
                                                    user2.nama AS nama_pic
                                                FROM
                                                    rf_received_package
                                                    LEFT JOIN user AS user1 ON rf_received_package.idnik = user1.idnik
                                                    LEFT JOIN user AS user2 ON rf_received_package.id_nik_pic = user2.idnik");
                                                    while ($row6 = mysqli_fetch_assoc($sql7)) {
                                                ?>
                                                        <tr>
                                                            <td><a href="index.php?page=EditReceived&id=<?= $row6['id_received']; ?>"><?= $row6['id_received'] ?></a></td>
                                                            <td><?= $row6['nama_pic'] ?></td>
                                                            <td><?= $row6['received_date'] ?></td>
                                                            <td><?= $row6['received_jenis_barang'] ?></td>
                                                            <td><?= $row6['nama_pengirim'] ?></td>
                                                            <td><?= $row6['nama_ekspedisi'] ?></td>
                                                            <td><?= $row6['no_resi'] ?></td>
                                                            <td><?= $row6['nama_request'] ?></td>
                                                            <td><?= $row6['no_hp'] ?></td>
                                                            <td><?= $row6['nama_pt'] ?></td>
                                                            <td>
                                                                <a href="file/facilities/<?= $row6['bukti_foto']; ?>" target="_blank">
                                                                    <?= $row6['bukti_foto'] ?>
                                                                </a>
                                                            </td>
                                                            <td><?= $row6['status_received'] ?></td>

                                                            <td>
                                                                <div class="dropdown d-inline-block">
                                                                    <button class="btn btn-soft-secondary btn-sm dropdown" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                                                        <i class="ri-more-fill align-middle"></i>
                                                                    </button>
                                                                    <ul class="dropdown-menu dropdown-menu-end">
                                                                        <li>
                                                                            <a href="index.php?page=EditReceived&id=<?= $row6['id_received']; ?>" class="dropdown-item"><i class="ri-pencil-fill align-bottom me-2 text-muted"></i> Edit</a>
                                                                        </li>
                                                                    </ul>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                    <?php
                                                    }
                                                } else {
                                                    $sql7 = mysqli_query($koneksi, "SELECT
                                                    rf_received_package.*,
                                                    user1.nama AS nama_request,
                                                    user2.nama AS nama_pic
                                                    FROM
                                                    rf_received_package
                                                    LEFT JOIN user AS user1 ON rf_received_package.idnik = user1.idnik
                                                    LEFT JOIN user AS user2 ON rf_received_package.id_nik_pic = user2.idnik
                                                    INNER JOIN user ON rf_received_package.idnik = user.idnik 
                                                    WHERE
                                                    rf_received_package.idnik = '$niklogin'");

                                                    while ($row6 = mysqli_fetch_assoc($sql7)) {
                                                    ?>
                                                        <tr>
                                                            <td><a href="index.php?page=ViewReceived&id=<?= $row6['id_received']; ?>"><?= $row6['id_received'] ?></a></td>
                                                            <td><?= $row6['nama_pic'] ?></td>
                                                            <td><?= $row6['received_date'] ?></td>
                                                            <td><?= $row6['received_jenis_barang'] ?></td>
                                                            <td><?= $row6['nama_pengirim'] ?></td>
                                                            <td><?= $row6['nama_ekspedisi'] ?></td>
                                                            <td><?= $row6['no_resi'] ?></td>
                                                            <td><?= $row6['nama_request'] ?></td>
                                                            <td><?= $row6['no_hp'] ?></td>
                                                            <td><?= $row6['nama_pt'] ?></td>
                                                            <td>
                                                                <a href="file/facilities/<?= $row6['bukti_foto']; ?>" target="_blank">
                                                                    <?= $row6['bukti_foto'] ?>
                                                                </a>
                                                            </td>
                                                            <td><?= $row6['status_received'] ?></td>

                                                            <td>
                                                                <div class="dropdown d-inline-block">
                                                                    <button class="btn btn-soft-secondary btn-sm dropdown" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                                                        <i class="ri-more-fill align-middle"></i>
                                                                    </button>
                                                                    <ul class="dropdown-menu dropdown-menu-end">
                                                                        <li>
                                                                            <a href="index.php?page=ViewReceived&id=<?= $row6['id_received']; ?>" class="dropdown-item"><i class="ri-pencil-fill align-bottom me-2 text-muted"></i> Edit</a>
                                                                        </li>
                                                                    </ul>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                <?php }
                                                }
                                            } else {
                                                $sql7 = mysqli_query($koneksi, "SELECT * FROM access_level WHERE idnik = $niklogin ");
                                                $row7 = mysqli_fetch_assoc($sql7);

                                                $tgl1 = date('Y-m-t', strtotime("-2 months"));
                                                $tgl2 = date('Y-m-t');
                                                ?>
                                                <?php
                                                if (isset($row7['admin']) && ($row7['admin'] == '1' || ($row7['ga4'] == '1'))) {
                                                    $sql7 = mysqli_query($koneksi, "SELECT
                                                    rf_received_package.*,
                                                    user1.nama AS nama_request,
                                                    user2.nama AS nama_pic
                                                    FROM
                                                    rf_received_package
                                                    LEFT JOIN user AS user1 ON rf_received_package.idnik = user1.idnik
                                                    LEFT JOIN user AS user2 ON rf_received_package.id_nik_pic = user2.idnik
                                                    INNER JOIN user ON rf_received_package.idnik = user.idnik ");
                                                    while ($row6 = mysqli_fetch_assoc($sql7)) {
                                                ?>
                                                        <tr>
                                                            <td><a href="index.php?page=EditReceived&id=<?= $row6['id_received']; ?>"><?= $row6['id_received'] ?></a></td>
                                                            <td><?= $row6['nama_pic'] ?></td>
                                                            <td><?= $row6['received_date'] ?></td>
                                                            <td><?= $row6['received_jenis_barang'] ?></td>
                                                            <td><?= $row6['nama_pengirim'] ?></td>
                                                            <td><?= $row6['nama_ekspedisi'] ?></td>
                                                            <td><?= $row6['no_resi'] ?></td>
                                                            <td><?= $row6['nama_request'] ?></td>
                                                            <td><?= $row6['no_hp'] ?></td>
                                                            <td><?= $row6['nama_pt'] ?></td>
                                                            <td>
                                                                <a href="file/facilities/<?= $row6['bukti_foto']; ?>" target="_blank">
                                                                    <?= $row6['bukti_foto'] ?>
                                                                </a>
                                                            </td>
                                                            <td><?= $row6['status_received'] ?></td>

                                                            <td>
                                                                <div class="dropdown d-inline-block">
                                                                    <button class="btn btn-soft-secondary btn-sm dropdown" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                                                        <i class="ri-more-fill align-middle"></i>
                                                                    </button>
                                                                    <ul class="dropdown-menu dropdown-menu-end">
                                                                        <li>
                                                                            <a href="index.php?page=EditReceived&id=<?= $row6['id_received']; ?>" class="dropdown-item"><i class="ri-pencil-fill align-bottom me-2 text-muted"></i> Edit</a>
                                                                        </li>
                                                                    </ul>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                    <?php
                                                    }
                                                } else {
                                                    $sql7 = mysqli_query($koneksi, "SELECT
                                                    rf_received_package.*,
                                                    user1.nama AS nama_request,
                                                    user2.nama AS nama_pic
                                                    FROM
                                                    rf_received_package
                                                    LEFT JOIN user AS user1 ON rf_received_package.idnik = user1.idnik
                                                    LEFT JOIN user AS user2 ON rf_received_package.id_nik_pic = user2.idnik
                                                    INNER JOIN user ON rf_received_package.idnik = user.idnik 
                                                    WHERE
                                                    rf_received_package.idnik = '$niklogin'");

                                                    while ($row6 = mysqli_fetch_assoc($sql7)) {
                                                    ?>
                                                        <tr>
                                                            <td><a href="index.php?page=ViewReceived&id=<?= $row6['id_received']; ?>"><?= $row6['id_received'] ?></a></td>
                                                            <td><?= $row6['nama_pic'] ?></td>
                                                            <td><?= $row6['received_date'] ?></td>
                                                            <td><?= $row6['received_jenis_barang'] ?></td>
                                                            <td><?= $row6['nama_pengirim'] ?></td>
                                                            <td><?= $row6['nama_ekspedisi'] ?></td>
                                                            <td><?= $row6['no_resi'] ?></td>
                                                            <td><?= $row6['nama_request'] ?></td>
                                                            <td><?= $row6['no_hp'] ?></td>
                                                            <td><?= $row6['nama_pt'] ?></td>
                                                            <td>
                                                                <a href="file/facilities/<?= $row6['bukti_foto']; ?>" target="_blank">
                                                                    <?= $row6['bukti_foto'] ?>
                                                                </a>
                                                            </td>
                                                            <td><?= $row6['status_received'] ?></td>

                                                            <td>
                                                                <div class="dropdown d-inline-block">
                                                                    <button class="btn btn-soft-secondary btn-sm dropdown" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                                                        <i class="ri-more-fill align-middle"></i>
                                                                    </button>
                                                                    <ul class="dropdown-menu dropdown-menu-end">
                                                                        <li>
                                                                            <a href="index.php?page=ViewReceived&id=<?= $row6['id_received']; ?>" class="dropdown-item"><i class="ri-pencil-fill align-bottom me-2 text-muted"></i> Edit</a>
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
                    <h5 class="modal-title" id="exampleModalLabel">Create Received Package</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" id="close-modal"></button>
                </div>
                <?php
                $sql8 = mysqli_query($koneksi, "SELECT * FROM access_level WHERE idnik = '21001638'");
                $row8 = mysqli_fetch_assoc($sql8);
                ?>
                <form action="function/insert_received_kurir.php" method="POST" enctype="multipart/form-data" id="formModalKurir">
                    <div class="modal-body">
                        <div class="row g-3">
                            <div class="col-lg-6">
                                <input type="hidden" class="form-control" value="<?= isset($row8['idnik']) ?>" name="idPIC" />

                                <div class="mb-3 mt-3">
                                    <label class="form-label">Tanggal/Jam diterima PIC</label>
                                    <input type="text" class="form-control" data-provider="flatpickr" data-date-format="Y-m-d" data-enable-time placeholder="Input tanggal barang diterima" name="tanggalRequest" required>
                                </div>

                                <div class="mb-3 mt-3">
                                    <label for="tasksTitle-field" class="form-label"><span> Nama Pengirim </span></label>
                                    <input type="text" class="form-control" placeholder="Insert nama PT perusahaan pengirim" name="namaPengirim" />
                                </div>

                                <div class="mb-3 mt-3">
                                    <label for="tasksTitle-field" class="form-label"><span> Nama Ekspedisi </span></label>
                                    <input type="text" class="form-control" placeholder="Insert nama ekspedisi" name="namaEkspedisi" />
                                </div>

                                <div class="mb-3 mt-3">
                                    <label for="tasksTitle-field" class="form-label"><span> No. Resi </span></label>
                                    <input type="text" class="form-control" placeholder="Insert nama PT perusahaan pengirim" name="noResi" />
                                </div>

                                <?php if (isset($row7['admin']) && ($row7['admin'] == '1' || ($row7['ga4'] == '1'))) { ?>
                                    <div class="mb-3 mt-3">
                                        <label for="tasksTitle-field" class="form-label"><span>Tujuan Paket Kepada </span></label>
                                        <select class="form-control" data-choices name="namaTujuan">
                                            <option value="">All users</option>
                                            <?php
                                            $sql5 = mysqli_query($koneksi, 'SELECT idnik, nama, divisi, lokasi, company FROM user WHERE lokasi = "HO"');
                                            while ($row5 = mysqli_fetch_assoc($sql5)) {
                                            ?>
                                                <option value="<?= $row5['idnik'] ?>">PT <?= $row5['company'] ?> | <strong><?= $row5['nama'] ?></strong> | <?= $row5['divisi'] ?></option>
                                            <?php } ?>
                                        </select>
                                        <input type="hidden" class="form-control" name="status_input" value="Package Received by Admin" />
                                    </div>
                                <?php } ?>
                            </div>

                            <div class="col-lg-6">
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
                                    <input type="number" class="form-control" placeholder="Insert your active number +(62) " name="wa" required />
                                </div>

                                <div class="mb-3 mt-3">
                                    <label for="tasksTitle-field" class="form-label"><span> Nama PT (jika ada)</span></label>
                                    <input type="text" class="form-control" placeholder="Insert nama PT perusahaan pengirim" name="namaPT" />
                                </div>

                                <div class="mb-3 mt-3">
                                    <label class="form-label">Lampiran Foto Barang (jika ada)</label>
                                    <input type="file" class="form-control" placeholder="Lampirkan foto barang saat diterima" name="buktiFoto" />
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="modal-footer mt-3">
                        <div class="hstack gap-2 justify-content-end">
                            <button type="button" class="btn btn btn-light waves-effect" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary waves-effect waves-light" name="add-received">Create Received Package</button>
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