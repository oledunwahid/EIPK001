<link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css" />
<!--datatable responsive css-->
<link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.bootstrap.min.css" />

<link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.2.2/css/buttons.dataTables.min.css">

<div class="card-body border border-dashed border-end-0 border-start-0">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex align-items-center">
                        <h5 class="card-title mb-0 flex-grow-1">ATK List</h5>
                        <div class="flex-shrink-0">
                            <button class="btn btn-danger add-btn" data-bs-toggle="modal" data-bs-target="#showModal">
                                <i class="ri-add-line align-bottom me-1"></i> Add ATK
                            </button>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <table id="buttons-datatables" class="display table table-bordered dt-responsive" style="width:100%">
                        <thead>
                            <tr>
                                <th>ID ATK</th>
                                <th>Description</th>
                                <th>Action</th>
                            </tr>
                        </thead>

                        <tbody>
                            <?php
                            $sql = mysqli_query($koneksi, "SELECT * FROM atk ");
                            while ($row = mysqli_fetch_assoc($sql)) {
                            ?>
                                <tr>
                                    <td><?= $row['id_atk'] ?></td>
                                    <td><?= $row['description'] ?></td>
                                    <td>
                                        <div class="dropdown d-inline-block">
                                            <button class="btn btn-soft-secondary btn-sm dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                                <i class="ri-more-fill align-middle"></i>
                                            </button>
                                            <ul class="dropdown-menu dropdown-menu-end">
                                                <li>
                                                    <a href="javascript:void(0);" class="dropdown-item edit-item-btn" data-bs-toggle="modal" data-bs-target="#editModal<?= $row['id_atk'] ?>" data-name="<?= $row['description'] ?>">
                                                        <i class="ri-pencil-fill align-bottom me-2 text-muted"></i>Edit
                                                    </a>
                                                </li>
                                                <li>
                                                    <form action="" method="POST" class="delete-form">
                                                        <button type="button" class="dropdown-item edit-item-btn" onclick="showConfirmation('<?= $row['id_atk'] ?>', '<?= $row['description'] ?>')">
                                                            <i class="bx bx bxs-trash align-bottom me-2 text-muted" name="delete" id="delete-form" href="#"></i> Delete
                                                        </button>
                                                    </form>
                                                </li>
                                            </ul>
                                        </div>
                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- add modal -->
<div class="modal fade zoomIn" id="showModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content border-0">
            <div class="modal-header p-3 bg-soft-info">
                <h5 class="modal-title" id="exampleModalLabel">Add ATK</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" id="close-modal"></button>
            </div>
            <form action="function/insert_atk.php" method="POST">
                <div class="modal-body">
                    <div class="row g-3">
                        <div class="col-lg-6">
                            <div id="modal-id">
                                <label for="choices-status-input" class="form-label">ID ATK</label>
                                <input type="text" class="form-control" name="id_atk" required />
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <label for="choices-status-input" class="form-label">Description</label>
                            <input type="text" class="form-control" name="description" required />
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger waves-effect" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary waves-effect waves-light" name="add-atk">Add</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- edit modal -->
<div class="modal fade zoomIn" id="editModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content border-0">
            <div class="modal-header p-3 bg-soft-info">
                <h5 class="modal-title" id="exampleModalLabel">Edit ATK</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" id="close-edit-modal"></button>
            </div>
            <form action="" method="POST">
                <div class="modal-body">
                    <div class="row g-3">
                        <div class="col-lg-6">
                            <div id="modal-id">
                                <label for="choices-status-input" class="form-label">ID ATK</label>
                                <input type="text" class="form-control" name="id" value="">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <label for="choices-status-input" class="form-label">Description</label>
                            <input type="text" class="form-control" name="desc" value="">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger waves-effect" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary waves-effect waves-light">Save Changes</button>
                </div>
            </form>
        </div>
    </div>
</div>


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

<script>
$('.edit-item-btn').on('click', function() {
    var description = $(this).data('name'); 
    var id_atk = $(this).data('id-atk'); 

    $('#editModal input[name="id_atk"]').val(id_atk);
    $('#editModal input[name="description"]').val(description); 
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
                    window.location.href = 'function/delete_atk.php?aksi=delete&id=<?= $_GET['id'] ?>';
                }
            });
        });
    });
</script>