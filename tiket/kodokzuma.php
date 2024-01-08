<?php require_once("koneksi.php"); ?>

<html lang="en" data-layout="vertical" data-topbar="light" data-sidebar="dark" data-sidebar-size="lg" data-sidebar-image="none" data-preloader="disable">

<head>
    <meta charset="utf-8" />
    <title>EIP | Mineral Alam Abadi</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
    <meta content="Themesbrand" name="author" />
    <!-- App favicon -->
    <link rel="shortcut icon" href="assets/images/logo.svg">
    <!-- jsvectormap css -->
    <link href="assets/libs/jsvectormap/css/jsvectormap.min.css" rel="stylesheet" type="text/css" />
    <!--Swiper slider css-->
    <link href="assets/libs/swiper/swiper-bundle.min.css" rel="stylesheet" type="text/css" />
    <!-- Layout config Js -->
    <!-- Bootstrap Css -->
    <link href="assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <!-- Icons Css -->
    <link href="assets/css/icons.min.css" rel="stylesheet" type="text/css" />
    <!-- App Css-->
    <link href="assets/css/app.min.css" rel="stylesheet" type="text/css" />
    <!-- custom Css-->
    <link href="assets/css/custom.min.css" rel="stylesheet" type="text/css" />
    <link href="assets/libs/sweetalert2/sweetalert2.min.css" rel="stylesheet" type="text/css" />
</head>


<div class="container-fluid">
    <form action="function/insert_it_tiket.php" method="POST" enctype="multipart/form-data">
        <div class="card">
            <div class="card-body">
                <div class="row g-3">
                    <div class="col-lg-6">
                        <!-- Input Hidden -->
                        <input type="text" class="form-control" value="<?= $niklogin ?>" hidden name="id_nik_request" />
                        <div class="col-lg-12">
                            <!-- Upload File -->
                            <div class="mb-3 mt-4">
                                <label for="lampiran1" class="form-label">Material Request Form (if any)</label>
                                <input type="file" class="form-control" name="lampiran1" />
                            </div>
                            <!-- Date Inputs -->
                            <!-- Create date -->
                            <div class="mb-3 mt-3">
                                <label class="form-label mb-0">Create date:</label>
                                <input type="text" class="form-control" data-provider="flatpickr" data-date-format="Y-m-d" name="kodok" required>
                            </div>
                            <!-- Start/Process date -->
                            <div class="mb-3 mt-3">
                                <label class="form-label mb-0">Start/Process date:</label>
                                <input type="text" class="form-control" data-provider="flatpickr" data-date-format="Y-m-d" data-enable-time name="proses_date" required>
                            </div>
                            <!-- End date -->
                            <div class="mb-3 mt-3">
                                <label class="form-label mb-0">End date:</label>
                                <input type="text" class="form-control" data-provider="flatpickr" data-date-format="Y-m-d" data-enable-time name="end_date" required>
                            </div>
                            <!-- Whatsapp Number -->
                            <div>
                                <label for="wa" class="form-label">No.Whatsapp</label>
                                <input type="number" class="form-control" placeholder="Insert your active number +(62) " name="wa" required />
                            </div>
                            <!-- Description, Justification, Action Notes -->
                            <div class="col-lg-6">
                                <div class="col-lg-12">
                                    <div class="card-body">
                                        <h6 class="fw-semibold text-uppercase mb-3">Description</h6>
                                        <textarea id="ckeditor-classic1" name="description"></textarea>
                                        <h6 class="fw-semibold text-uppercase mt-3">Justification IT</h6>
                                        <textarea id="ckeditor-classic2" name="justification"></textarea>
                                        <h6 class="fw-semibold text-uppercase mb-3 pt-4">Progress / Action Notes</h6>
                                        <textarea id="ckeditor-classic" name="action_note"></textarea>
                                    </div>
                                </div>
                            </div>

                            <div class="modal-footer mt-3">
                                <div class="hstack gap-2 justify-content-end">
                                    <a href="index.php?page=ITSupport" type="button" class="btn btn-light">Close</a>
                                    <button type="submit" class="btn btn-primary" name="add-tiket-admin">Add Ticket</button>
                                </div>
                            </div>
                            <!-- Request Type -->
                            <div class="mt-3">
                                <label for="choices-single-default" class="form-label"><span>Request Type :</span></label>
                                <select class="form-control" data-choices name="kategori_tiket" required>
                                    <option value="">Select Request Type</option>
                                    <?php
                                    $statusOptions = ['Cloud Storage', 'Email', 'Hardware', 'Network', 'Printer & Scanner', 'Software', 'Documentation', 'Infrastructure', 'License/Agreement'];
                                    foreach ($statusOptions as $option) {
                                        $selected = ($option === $row['kategori_tiket']) ? 'selected' : '';
                                        echo '<option value="' . $option . '" ' . $selected . '>' . $option . '</option>';
                                    }
                                    ?>
                                </select>
                            </div>
                            <!-- Status -->
                            <div class="mt-3">
                                <div class="form-label"><span>Status :</span></div>
                                <div>
                                    <select class="form-control" data-choices name="status_tiket" required>
                                        <option value="">Select Status</option>
                                        <?php
                                        $statusOptions = ['Closed', 'Process', 'Reject'];
                                        foreach ($statusOptions as $option) {
                                            $selected = ($option === $row['status_tiket']) ? 'selected' : '';
                                            echo '<option value="' . $option . '" ' . $selected . '>' . $option . '</option>';
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <!-- Assigned To -->
                            <div>
                                <?php $sql = mysqli_query($koneksi, "SELECT ticketing.*,user.divisi,user.lokasi,user1.nama AS nama_request, user2.nama AS nama_pic, login.username FROM ticketing LEFT JOIN user AS user1 ON ticketing.id_nik_request = user1.idnik LEFT JOIN user AS user2 ON ticketing.nik_pic = user2.idnik INNER JOIN user ON ticketing.id_nik_request = user.idnik INNER JOIN login ON user.idnik = login.idnik WHERE id_tiket ='id_tiket' ");
                                $row = mysqli_fetch_assoc($sql);
                                ?>
                                <div class="mt-3">
                                    <label for="choices-single-default" class="form-label "><span>Assigned To :</span></label>
                                    <select class="form-control" data-choices name="nik_pic" required>
                                        <option value="">Select PIC</option>
                                        <?php
                                        $sql5 = mysqli_query($koneksi, "SELECT access_menu.idnik, user.nama FROM access_menu INNER JOIN user ON access_menu.idnik = user.idnik where access_type = 'IT' ");
                                        while ($row5 = mysqli_fetch_assoc($sql5)) {
                                        ?>
                                            <option value="<?= $row5['idnik'] ?>"><?= $row5['nama'] ?> </option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                            <!-- Select User -->
                            <div class="mb-3 mt-3">
                                <label for="tasksTitle-field" class="form-label"><span> Request User</span></label>
                                <select class="form-control" data-choices name="id_nik_request" required>
                                    <option value="">All Users</option>
                                    <?php
                                    $sql5 = mysqli_query($koneksi, 'SELECT idnik, nama, lokasi FROM user');
                                    while ($row5 = mysqli_fetch_assoc($sql5)) {
                                    ?>
                                        <option value="<?= $row5['idnik'] ?>"><?= $row5['nama'] ?> | <?= $row5['lokasi'] ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Modal Footer -->
                <div class="modal-footer mt-3">
                    <div class="hstack gap-2 justify-content-end">
                        <a href="index.php?page=ITSupport" type="button" class="btn btn-light">Close</a>
                        <button type="submit" class="btn btn-primary" name="add-tiket-admin">Add Ticket</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>


<!--end row-->
<script src="assets/libs/@ckeditor/ckeditor5-build-classic/build/ckeditor.js"></script>
<script src="assets/js/pages/project-create.init.js"></script>
<script src="assets/js/pages/ticketdetail.init.js"></script>

<script>
    ClassicEditor
        .create(document.querySelector('#ckeditor-classic1'))
        .catch(error => {
            console.error(error);
        });

    ClassicEditor
        .create(document.querySelector('#ckeditor-classic2'))
        .catch(error => {
            console.error(error);
        });

    ClassicEditor
        .create(document.querySelector('#ckeditor-classic'))
        .catch(error => {
            console.error(error);
        });
</script>