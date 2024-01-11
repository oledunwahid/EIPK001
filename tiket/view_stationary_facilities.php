<?php
$sql = mysqli_query($koneksi, "SELECT ga_stationary.*,user.divisi,user.lokasi,user1.nama AS nama_request,
user2.nama AS nama_pic, login.username
FROM
ga_stationary
LEFT JOIN user AS user1 ON ga_stationary.nik_request = user1.idnik
LEFT JOIN user AS user2 ON ga_stationary.nik_pic = user2.idnik
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
                                                <div class="text-muted"><i class="ri-building-line align-bottom me-1"></i><span id="ticket-client">MAA Group</span></div>
                                                <div class="vr"></div>
                                                <div class="text-muted"><span>Create Date :</span> <?= $row['start_date'] ?></span></div>
                                                <div class="vr"></div>
                                                <div class="text-muted"><span>Closed Date :</span><?= $row['end_date'] ?></div>
                                                <br>
                                                <div class="col-lg-4  hstack gap-3 flex-wrap">
                                                    <div class="mt-9">
                                                        <label for="choices-single-default" class="form-label text-muted"><span>Status : </span> <span style="font-weight: bold;"><?= $row['status'] ?></span></label>
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
        </div>
    </form>
    <!--end col-->

    <!--end col-->
</div>

<div class="card-body border border-dashed border-end-0 border-start-0">
    <div class="row">
        <div class="col-lg-9">
            <div class="card">
                <div class="card-body">
                    <table id="datalengkap" class="display table table-bordered dt-responsive" style="width:100%">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>ID Ticket</th>
                                <th>ID ATK</th>
                                <th>Deskripsi</th>
                                <th>Total Request</th>
                                <th>Total Approve</th>
                                <th>Feedback</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $sql6 = "SELECT
                            atk_detail_request.*, 
                            atk.description
                        FROM
                            atk_detail_request
                            INNER JOIN
                            atk
                            ON 
                                atk_detail_request.id_atk = atk.id_atk
                        WHERE
                            id_ga_stationary = '$id_tiket1'";
                            $result6 = mysqli_query($koneksi, $sql6);
                            $rowNumber = 1;
                            while ($row6 = mysqli_fetch_assoc($result6)) {
                            ?>
                                <tr>
                                    <td><?= $rowNumber ?></td>
                                    <td><?= $row6['id_request_detail'] ?></td>
                                    <td><?= $row6['id_atk'] ?></td>
                                    <td><?= $row6['description'] ?></td>
                                    <td><?= $row6['total_request'] ?></td>
                                    <td><?= $row6['total_approve'] ?></td>
                                    <td><?= $row6['feedback'] ?></td>
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
        <div class="col-xl-3">
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
                                    <td>#<?= $row['id_ga_stationary'] ?></td>
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

<div class="modal fade zoomIn" id="showModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-sm" style="max-width: 1070px;">
        <div class="modal-content border-0">
            <?php
            $sql_modal = "SELECT * FROM atk_detail_request INNER JOIN atk ";
            $result_modal = mysqli_query($koneksi, $sql_modal);
            $row_modal = mysqli_fetch_assoc($result_modal);
            ?>
            <div class="modal-header p-3 bg-soft-info">
                <h5 class="modal-title" id="exampleModalLabel">
                    Edit Total Approve and Feedback - ATK / Stationary</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" id="close-modal"></button>
            </div>
            <form action="function/insert_ga_stationary.php" method="POST" enctype="multipart/form-data">
                <div class="modal-body">
                    <div class="row g-3">
                        <div class="col-lg-9">
                            <input type="" class="form-control" value="<?= $row_modal['id_request_detail'] ?>" name="id_request_detail" />

                            <div class="form-group mb-3">
                                <label for="id_atk">ID ATK:</label>
                                <input type="" class="form-control" id="id_atk" name="id_atk" value="<?= $row_modal['id_atk'] ?>" readonly>
                            </div>

                            <div class="form-group mb-3">
                                <label for="description_atk">Description ATK:</label>
                                <input type="" class="form-control" id="description_atk" name="description_atk" value="<?= $row_modal['description'] ?>" readonly>
                            </div>

                            <div class="form-group mb-3">
                                <label for="total_request">Total Request:</label>
                                <input type="" class="form-control" id="total_request" name="total_request" value="<?= $row_modal['total_request'] ?>" readonly>
                            </div>

                            <div class="form-group mb-3">
                                <label for="total_approve">Total Approve:</label>
                                <input type="number" max="10" class="form-control" id="total_approve" name="total_approve" value="<?= $row_modal['total_approve'] ?>">
                            </div>

                            <div class="form-group mb-3">
                                <label for="feedback">Feedback:</label>
                                <textarea class="form-control" id="feedback" name="feedback"></textarea>
                            </div>

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