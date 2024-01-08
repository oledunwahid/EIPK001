<?php
$sql = mysqli_query($koneksi, "SELECT kurir.*,user.divisi,user.lokasi,user1.nama AS nama_request,
user2.nama AS nama_pic, login.username
FROM
kurir
LEFT JOIN user AS user1 ON kurir.id_nik_request = user1.idnik
LEFT JOIN user AS user2 ON kurir.id_nik_kurir = user2.idnik
INNER JOIN
	user
	ON 
		kurir.id_nik_request = user.idnik
        INNER JOIN
	login
	ON 
		user.idnik = login.idnik
where id_kurir ='" . $_GET['id'] . "' ");
$row = mysqli_fetch_assoc($sql);

$id_kurir = $_GET['id'];

$dateTime = new DateTime('now', new DateTimeZone('Asia/Jakarta'));
$timestamp = $dateTime->format('Y-m-d H:i:s');

?>


<div class="row">
    <input type="text" hidden name="id_nik_request" value="<?= $row['id_nik_request'] ?>">
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
                                        <input type="text" hidden name="id_kurir" value="<?= $row['id_kurir'] ?>">
                                        <h4 class="fw-semibold" id="ticket-title">#<?= $row['id_kurir'] ?> - Delivery Ticket </h4>
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
                                            <div class="me-2 text-muted">PIC Courier:</div>
                                            <div>
                                                <select class="form-select" name="id_nik_kurir" data-choices id="choices-status-input">
                                                    <option value="<?= $row['id_nik_kurir'] ?>"><?= $row['nama_pic'] ?></option>
                                                    <?php
                                                    $sql5 = mysqli_query($koneksi, "SELECT access_level.idnik, user.nama 
                                                    FROM access_level 
                                                    INNER JOIN user ON access_level.idnik = user.idnik 
                                                    WHERE access_level.internal_kurir = 1"); 
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
                            <h5 class="card-title flex-grow-1 mb-2">Note untuk Kurir</h5>
                        </div>
                        <div style="border: 1px solid #ccc; border-radius: 5px; padding: 10px; box-shadow: 2px 2px 5px rgba(0, 0, 0, 0.2);">
                            <label for="tasksTitle-field" class="form-label"><?= $row["deskripsi"]; ?></label>
                        </div>
                    </div>
                </div>


                <div class="card">
                    <div class="card-header">
                        <div class="d-sm-flex align-items-center">
                            <h5 class="card-title flex-grow-1 mb-0">Delivery Status</h5>
                            <div class="flex-shrink-0 mt-2 mt-sm-0">
                                <a href="javascript:void(0);" class="btn btn-soft-info btn-sm mt-2 mt-sm-0" data-bs-toggle="modal" data-bs-target="#showModal">Update Delivery</a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="profile-timeline">
                            <div class="accordion" id="accordionFlushExample">
                                <?php
                                $sql = "SELECT * FROM riwayat_kurir WHERE id_kurir = '$id_kurir'";
                                $result = mysqli_query($koneksi, $sql);
                                while ($row2 = mysqli_fetch_assoc($result)) {
                                    $status = $row2['status_riwayat'];
                                    $avatar_icon = '';

                                    if ($status === 'Pending') {
                                        $avatar_icon = '<i class=" las la-clock"></i>';
                                    } elseif ($status === 'Proses') {
                                        $avatar_icon = '<i class="las la-hourglass-half"></i>';
                                    } elseif ($status === 'Delivery') {
                                        $avatar_icon = '<i class="las la-truck"></i>';
                                    } elseif ($status === 'Delivered') {
                                        $avatar_icon = '<i class="las la-check-circle"></i>';
                                    } elseif ($status === 'Hold') {
                                        $avatar_icon = '<i class="las la-pause-circle"></i>';
                                    } elseif ($status === 'Rejected') {
                                        $avatar_icon = '<i class="las la-times-circle"></i>';
                                    } elseif ($status === 'Returned') {
                                        $avatar_icon = '<i class="las la-undo-alt"></i>';
                                    }

                                ?>
                                    <div class="accordion-item border-0">
                                        <div class="accordion-header" id="headingFive">
                                            <a class="accordion-button p-2 shadow-none" data-bs-toggle="collapse" href="#collapseFile" aria-expanded="false">
                                                <div class="d-flex align-items-center">
                                                    <div class="flex-shrink-0 avatar-xs">
                                                        <div class="avatar-title bg-light text-success rounded-circle">
                                                            <?= $avatar_icon ?>
                                                        </div>
                                                    </div>
                                                    <div class="flex-grow-1 ms-3">
                                                        <h6 class="fs-14 mb-0 fw-semibold">
                                                            <?= $row2['status_riwayat'] ?> -
                                                            <span class="fw-semibold"><?= date('l, j F Y g:i A', strtotime($row2["timestamp"])) ?>
                                                            </span>
                                                        </h6>
                                                    </div>
                                                </div>
                                            </a>
                                            <div id="collapseThree" class="accordion-collapse collapse show" aria-labelledby="headingThree" data-bs-parent="#accordionExample">
                                                <div class="accordion-body ms-2 ps-5 pt-0">
                                                    <h6 class="fs-14">
                                                        <span>ID Delivery Ticket</span><span> - <?= $row2["id_kurir"] ?></span>
                                                    </h6>
                                                    <span style="font-weight: 400;">Description : </span>
                                                    <span style="display: inline-block; margin-left: 5px;"><?= $row2['deskripsi_riwayat'] ?></span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


            <div class="col-xl-4">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title fw-semibold mb-0">Delivery Request Details</h5>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive table-card">
                            <table class="table table-borderless align-middle mb-0">
                                <tbody>
                                    <tr>
                                        <td class="fw-medium">ID Delivery</td>
                                        <td><?= $row['id_kurir'] ?></td>
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
                                        <td class="fw-medium">Alamat Pengiriman</td>
                                        <td><?= $row['alamat_kurir'] ?></td>
                                    </tr>
                                    <tr>
                                        <td class="fw-medium">Delivery Type</td>
                                        <td><?= $row['tipe_kurir'] ?></td>
                                    </tr>
                                    <tr>
                                        <td class="fw-medium">Item Types</td>
                                        <td><?= $row['jenis_barang'] ?></td>
                                    </tr>
                                    <tr>
                                        <td class="fw-medium">Request Date</td>
                                        <td><?= $row['tanggal_req'] ?></td>
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


<div class="modal fade zoomIn" id="showModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content border-0">
            <div class="modal-header p-3 bg-soft-info">
                <h5 class="modal-title" id="exampleModalLabel">Update Status Delivery</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" id="close-modal"></button>
            </div>
            <form action="function/update_kurir.php" method="POST" enctype="multipart/form-data">
                <div class="modal-body">
                    <div class="row g-3">
                        <div class="col-lg-6">
                            <input type="text" class="form-control" hidden name="id_kurir" value="<?= $id_kurir ?>" />
                            <input type="text" class="form-control" hidden name="timestamp" value="<?= $timestamp ?>" />
                            <div class="col-lg-12">
                                <div class="col-lg-12">
                                    <label for="choices-single-default" class="form-label fw-semibold"><span>Status Delivery</span></label>
                                    <select class="form-control" data-choices name="statusRiwayat">
                                        <?php
                                        $statusOptions = ['Proses', 'Hold',  'Delivery', 'Rejected', 'Returned', 'Delivered'];

                                        foreach ($statusOptions as $option) {
                                            $selected = ($option === $row['status_riwayat']) ? 'selected' : '';
                                            echo '<option value="' . $option . '" ' . $selected . '>' . $option . '</option>';
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="col-lg-12">
                                <div>
                                    <label for="tasksTitle-field" class="form-label fw-semibold">Feedback Description</label>
                                    <div class="card-body">
                                        <textarea class="ckeditor-classic" name="deskripsi" required placeholder="*Isi keterangan secara detail">
                                        </textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer mt-3">
                            <div class="hstack gap-2 justify-content-end">
                                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-success" name="updateRiwayat">Add Update Delivery</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>



<!--end row-->


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

<script src="assets/libs/@ckeditor/ckeditor5-build-classic/build/ckeditor.js"></script>
<script src="assets/js/pages/project-create.init.js"></script>
<script src="assets/js/pages/ticketdetail.init.js"></script>


<script src="assets/js/pages/datatables.init.js"></script>
<script src="assets/js/pages/form-editor.init.js"></script>

<!-- dropzone min -->
<script src="assets/libs/dropzone/dropzone-min.js"></script>

<!-- cleave.js -->
<script src="assets/libs/cleave.js/cleave.min.js"></script>

<!--Invoice create init js-->
<script src="assets/js/pages/invoicecreate.init.js"></script>


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
                    window.location.href = 'function/delete_kurir.php?aksi=delete&id=<?= $_GET['id'] ?>';
                }
            });
        });
    });
</script>