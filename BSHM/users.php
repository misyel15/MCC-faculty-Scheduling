<?php include('db_connect.php'); ?>
<?php include 'includes/header.php'; ?>

<!-- Ensure Bootstrap and jQuery dependencies are included -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10.16.6/dist/sweetalert2.all.min.js"></script>
<script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">

<div class="container-fluid" style="margin-top:100px;">
    <div class="col-lg-12">
        <div class="row">
            <!-- Table Panel -->
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <b>User List</b>
                        <button class="btn btn-primary btn-block btn-sm col-sm-2 float-right" id="new_user">
                            <i class="fa fa-user-plus"></i> New user
                        </button>
                    </div>
                    <div class="card-body">
                        <table class="table table-striped table-bordered" id="userTable">
                            <thead>
                                <tr>
                                    <th class="text-center">#</th>
                                    <th class="text-center">Name</th>
                                    <th class="text-center">Username</th>
                                    <th class="text-center">Type</th>
                                    <th class="text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    $type = array("", "Admin", "Staff", "Alumnus/Alumna");
                                    $users = $conn->query("SELECT * FROM users ORDER BY name ASC");
                                    $i = 1;
                                    while ($row = $users->fetch_assoc()):
                                ?>
                                <tr>
                                    <td class="text-center"><?php echo $i++ ?></td>
                                    <td><?php echo ucwords($row['name']) ?></td>
                                    <td><?php echo $row['username'] ?></td>
                                    <td><?php echo $type[$row['type']] ?></td>
                                    <td class="text-center">
                                        <div class="btn-group">
                                        <button type="button" class="btn btn-sm btn-primary edit_user" data-id="<?php echo $row['id'] ?>">
    <i class="fas fa-edit"></i> <!-- Edit icon -->
</button>

                                            <!-- Uncomment if delete functionality is needed -->
                                            <!-- <button type="button" class="btn btn-sm btn-danger delete_user" data-id="<?php echo $row['id'] ?>">
                                                <i class="fa fa-trash"></i>
                                            </button> -->
                                        </div>
                                    </td>
                                </tr>
                                <?php endwhile; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal HTML (hidden by default) -->
<div class="modal fade" id="uni_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Modal Title</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- Content loaded via iframe -->
            </div>
        </div>
    </div>
</div>

<script>
$(document).ready(function() {
    // Initialize DataTable
    $('#userTable').DataTable();

    // Function to open modals
    function uni_modal(title, url) {
        $('#uni_modal .modal-title').text(title);
        $('#uni_modal .modal-body').html(`<iframe src="${url}" frameborder="0" style="width: 100%; height: 400px;"></iframe>`);
        $('#uni_modal').modal('show');
    }

    // New user modal
    $('#new_user').click(function() {
        uni_modal('New User', 'manage_user.php');
    });

    // Edit user modal
    $(document).on('click', '.edit_user', function() {
        uni_modal('Edit User', 'manage_user.php?id=' + $(this).attr('data-id'));
    });

    // Delete user action
    $(document).on('click', '.delete_user', function() {
        _conf("Are you sure to delete this user?", "delete_user", [$(this).attr('data-id')]);
    });

    // Delete user function
    window.delete_user = function(id) {
        $.ajax({
            url: 'ajax.php?action=delete_user',
            method: 'POST',
            data: {id: id},
            success: function(resp) {
                if (resp == 1) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Success!',
                        text: 'Data successfully deleted',
                        showConfirmButton: true
                    }).then(function() {
                        location.reload();
                    });
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'Something went wrong!'
                    });
                }
            }
        });
    };
});
</script>
