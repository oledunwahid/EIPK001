<?php
$sql = mysqli_query($koneksi, "SELECT ticketing.*,user.divisi,user.lokasi,user1.nama AS nama_request,
user2.nama AS nama_pic, login.username
FROM
ticketing
LEFT JOIN USER AS user1 ON ticketing.id_nik_request = user1.idnik
LEFT JOIN USER AS user2 ON ticketing.nik_pic = user2.idnik
INNER JOIN
	user
	ON 
		ticketing.id_nik_request = user.idnik
        INNER JOIN
	login
	ON 
		user.idnik = login.idnik
where id_tiket ='" . $_GET['id'] . "' ");
$row = mysqli_fetch_assoc($sql);

$id_tiket1 = $_GET['id'];

?>
<div class="row">
    <form action="function/update_it_tiket.php" method="POST">

        <div class="row">
            <div class="col-lg-8">
                <div class="card">

                    <div class="card-body">
                        <h6 class="fw-semibold text-uppercase mb-3">Ticket Description</h6>
                        <label for="tasksTitle-field" class="form-label"><?= $row["disc_keluhan"]; ?></label>
                        <h6 class="fw-semibold text-uppercase mb-3">Justification IT</h6>
                        <textarea id="ckeditor-classic" name="justification"><?= $row["justification"] ?></textarea>
                        <h6 class="fw-semibold text-uppercase mb-3 pt-4">Progress / Action Notes</h6>
                        <textarea id="ckeditor-classic1" name="action_note"><?= $row["action_note"] ?></textarea>


                    </div>
                    <div class="card-body">
                        <button type="submit" class="btn btn-primary col-md-3" name="updateIT">Update</button>
                        <a href="#" class="btn btn-danger col-md-3" name="delete" id="delete-form">Delete</a>
                    </div>
                </div>
    </form>
    <!--end col-->

    <!--end col-->
</div>
<!--end row-->
<div class="col-xl-4">

    <div class="card">
        <div class="card-header">
            <h6 class="card-title fw-semibold mb-0">Files Attachment</h6>
        </div>
        <div class="card-body">
            <?php if ($row['lampiran1']) : ?>
                <a href="file/it/<?= $row['lampiran1'] ?>" class="download-link">
                    <i class="bx bx-download"></i> Download File
                </a>
            <?php else : ?>
                <div class="alert alert-info" role="alert">
                    <i class="fa fa-info-circle me-2"></i>
                    No files uploaded.
                </div>
            <?php endif; ?>
        </div>
    </div>




</div>



<script src="../assets/libs/@ckeditor/ckeditor5-build-classic/build/ckeditor.js"></script>
<script src="../assets/js/pages/project-create.init.js"></script>
<script src="../assets/js/pages/ticketdetail.init.js"></script>

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
                    window.location.href = 'function/delete_it_tiket.php?aksi=delete&id=<?= $_GET['id'] ?>';
                }
            });
        });
    });
</script>