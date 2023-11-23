<link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css" />
<link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.bootstrap.min.css" />
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.2.2/css/buttons.dataTables.min.css">

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