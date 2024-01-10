<?php
$sql7 = mysqli_query($koneksi, "SELECT * FROM access_level WHERE idnik = $niklogin");
$row7 = mysqli_fetch_assoc($sql7);
$lokasi = $row7['lokasi']; ?>
<div class="container-fluid">
    <form action="function/insert_it_tiket.php" method="POST" enctype="multipart/form-data">
        <div class="card">
            <div class="card-body">
                <div class="row g-3">
                    <div class="col-lg-6">
                        <!-- Masukkan label untuk elemen input -->
                        <label for="id_nik_request" class="form-label" hidden>ID Nik Request</label>
                        <input type="text" class="form-control" value="<?= $niklogin ?>" hidden id="nik_pic" name="nik_pic" />

                        <div class="mb-3 mt-4">
                            <label for="lampiran1" class="form-label">Material Request Form (if any)</label>
                            <input type="file" class="form-control" id="lampiran1" name="lampiran1" />
                        </div>

                        <!-- Tambahkan placeholder pada input tanggal -->
                        <div class="mb-3 mt-3">
                            <label class="form-label mb-0">Create date:</label>
                            <input type="text" class="form-control" data-provider="flatpickr" data-date-format="Y-m-d" data-enable-time placeholder="YYYY-MM-DD" name="kodok" required>
                        </div>

                        <!-- Tambahkan placeholder pada input tanggal -->
                        <div class="mb-3 mt-3">
                            <label class="form-label mb-0">Start/Process date:</label>
                            <input type="text" class="form-control" data-provider="flatpickr" data-date-format="Y-m-d" data-enable-time placeholder="YYYY-MM-DD" name="proses_date" required>
                        </div>

                        <!-- Tambahkan placeholder pada input tanggal -->
                        <div class="mb-3 mt-3">
                            <label class="form-label mb-0">End date:</label>
                            <input type="text" class="form-control" data-provider="flatpickr" data-date-format="Y-m-d" data-enable-time placeholder="YYYY-MM-DD" name="end_date" required>
                        </div>

                        <!-- Tambahkan label pada input nomor WhatsApp -->
                        <div>
                            <label for="wa" class="form-label">No. WhatsApp</label>
                            <input type="number" class="form-control" placeholder="Insert your active number +(62)" id="wa" name="wa" required />
                        </div>

                        <!-- Tambahkan label pada dropdown "Request Type" -->
                        <div class="mt-3">
                            <label for="kategori_tiket" class="form-label"><span>Request Type :</span></label>
                            <select class="form-control" data-choices id="kategori_tiket" name="kategori_tiket" required>
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

                        <!-- Select User -->
                        <div class="mt-3">
                            <label for="tasksTitle-field" class="form-label"><span> Request User</span></label>
                            <select class="form-control" data-choices name="id_nik_request">
                                <option value="">All Users</option>
                                <?php
                                $sql5 = mysqli_query($koneksi, "SELECT user.idnik, user.nama, user.lokasi, login.status_login FROM user INNER JOIN
                                login
                                ON 
                                    user.idnik = login.idnik WHERE lokasi IN ($lokasi) AND login.status_login = 'Aktif'");
                                while ($row5 = mysqli_fetch_assoc($sql5)) {
                                ?>
                                    <option value="<?= $row5['idnik'] ?>"><?= $row5['nama'] ?> | <?= $row5['lokasi'] ?></option>
                                <?php } ?>
                            </select>
                        </div>


                        <!-- Tambahkan label pada dropdown "Status" -->
                        <div>
                            <div class="mt-3">
                                <label for="status_tiket" class="form-label"><span>Status :</span></label>
                                <select class="form-control" data-choices id="status_tiket" name="status_tiket" required>
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

                    </div>
                    <div class="col-lg-6">
                        <div class="col-lg-12">
                            <!-- Bagian CKEditor dipindahkan ke sini -->
                            <?php
                            $sql3 = mysqli_query($koneksi, "SELECT * FROM ticketing");
                            $row = mysqli_fetch_assoc($sql3);
                            ?>
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
                </div>


                <!-- Bagian Footer Form -->

                <div class="modal-footer mt-3 mb-3 p-3">
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