<div class="container-fluid">
    <h3 class="text-dark mb-4">Admin</h3>
    <div class="card shadow">
        <div class="card-header py-3">
            <p class="text-primary m-0 fw-bold">Admin</p>
        </div>
        <div class="card-body">
            <button class="btn btn-primary" id="myBtn" onclick="show_modal(0)" type="button" style="background: var(--bs-gray-500);border-style: none;margin-bottom: 20px;">Add Admin</button>
            <div class="row">
                <div class="col-md-6 text-nowrap">
                    <div id="dataTable_length" class="dataTables_length" aria-controls="dataTable"><label class="form-label">Show&nbsp;<select class="d-inline-block form-select form-select-sm">
                                <option value="10" selected="">10</option>
                                <option value="25">25</option>
                                <option value="50">50</option>
                                <option value="100">100</option>
                            </select>&nbsp;</label></div>
                </div>
                <div class="col-md-6">
                    <div class="text-md-end dataTables_filter" id="dataTable_filter"><label class="form-label"><input type="search" class="form-control form-control-sm" aria-controls="dataTable" placeholder="Search"></label></div>
                </div>
            </div>
            <div class="table-responsive table mt-2" id="dataTable" role="grid" aria-describedby="dataTable_info">
                <table class="table my-0" id="dataTable">
                    <thead>
                        <tr>
                            <th class="text-center">Name</th>
                            <th class="text-center">Username</th>
                            <th class="text-center">Password</th>
                            <th class="text-center">Email</th>
                            <th class="text-center">Last Active</th>
                            <th class="text-center">Update</th>
                            <th class="text-center">Delete</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $i = 1;
                        foreach ($users as $user) : ?>
                            <tr>
                                <td class="text-center">
                                    <img class="rounded-circle me-2" width="30" height="30" src="<?= $user['path_image'] != '' ? $user['path_image'] : base_url("assets/img/avatars/icons8-admin-settings-male-60.png") ?>">&nbsp; <?= $user['name'] ?>
                                </td>
                                <td class="text-center">
                                    <?= $user['username'] ?>
                                </td>
                                <td class="text-center">
                                    **************
                                </td>
                                <td class="text-center">
                                    <?= $user['email'] ?>
                                </td>
                                <td class="text-center">
                                    <?= $user['last_login'] ?>
                                </td>
                                <td>
                                    <a onclick="show_modal(<?= $i ?>)" class="text-primary" href="#">
                                        <i class="icon ion-android-create text-center d-lg-flex justify-content-lg-center align-items-lg-center" style="font-size: 24px;"></i>
                                    </a>
                                </td>
                                <td>
                                    <a href="<?= base_url("/admin/delete/" . $user['id_user']) ?>" class="text-danger">
                                        <i class="icon ion-android-delete text-center d-lg-flex justify-content-lg-center align-items-lg-center" style="font-size: 24px;"></i>
                                    </a>
                                </td>
                                <!-- <td class="text-center"><i class="icon ion-android-delete" style="font-size: 24px;"></i></td> -->
                            </tr>
                            <!-- make modal -->
                            <div id="myModal<?= $i ?>" class="modal">
                                <!-- Modal content -->
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <span class="close" id="close<?= $i ?>">&times;</span>
                                        <h2>Update Admin</h2>
                                        <hr>
                                    </div>
                                    <div class="modal-body">
                                        <form name="input" method="post" enctype="multipart/form-data" action="<?= base_url('admin/update') ?>">
                                            <?= csrf_field() ?>
                                            <input type="hidden" name="id_user" value="<?= $user['id_user'] ?>">
                                            <label for="fnama">Name</label>
                                            <input type="text" id="fnama" name="name" placeholder="Name" value="<?= $user['name'] ?>" required>
                                            <label for="femail">Email</label>
                                            <input type="text" id="femail" name="email" placeholder="Email" value="<?= $user['email'] ?>" onkeyup="validateEmail(this)" required>
                                            <label for="fusername">Username</label>
                                            <input type="text" id="fusername" name="username" placeholder="Username" value="<?= $user['username'] ?>" required>
                                            <label for="fpassword">Password</label>
                                            <input type="password" id="fpassword" name="password" placeholder="Password" required>
                                            <label for="fprofile">Photo Profile</label><br>
                                            <input type="file" id="fprofile" accept="image/*" name="profile" placeholder="Photo Profile" value="<?= $user['path_image'] ?>"><br>
                                            <input type="submit" value="Submit">
                                        </form>
                                    </div>
                                </div>
                                <?= $i++ ?>
                            <?php endforeach; ?>
                    </tbody>
                    <tfoot>
                        <tr></tr>
                    </tfoot>
                </table>
            </div>
            <div class="row">
                <div class="col-md-6 align-self-center">
                    <p id="dataTable_info" class="dataTables_info" role="status" aria-live="polite">Showing 1 to 10 of 27</p>
                </div>
                <div class="col-md-6">
                    <nav class="d-lg-flex justify-content-lg-end dataTables_paginate paging_simple_numbers">
                        <ul class="pagination">
                            <li class="page-item disabled"><a class="page-link" aria-label="Previous" href="#"><span aria-hidden="true">«</span></a></li>
                            <li class="page-item active"><a class="page-link" href="#">1</a></li>
                            <li class="page-item"><a class="page-link" href="#">2</a></li>
                            <li class="page-item"><a class="page-link" href="#">3</a></li>
                            <li class="page-item"><a class="page-link" aria-label="Next" href="#"><span aria-hidden="true">»</span></a></li>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</div>

<div id="myModal0" class="modal">
    <!-- Modal content -->
    <div class="modal-content">
        <div class="modal-header">
            <span class="close" id="close0">&times;</span>
            <h2>Add Admin</h2>
            <hr>
        </div>
        <div class="modal-body">
            <form name="input" method="post" enctype="multipart/form-data" action="<?= base_url('admin/addData') ?>">
                <?= csrf_field() ?>
                <label for="fnama">Name</label>
                <input type="text" id="fnama" name="name" placeholder="Name" required>
                <label for="femail">Email</label>
                <input type="text" id="femail" name="email" placeholder="Email" onkeyup="validateEmail(this.value)" required>
                <label for="fusername">Username</label>
                <input type="text" id="fusername" name="username" placeholder="Username" required>
                <label for="fpassword">Pasword</label>
                <input type="password" id="fpassword" name="password" placeholder="Password" required minlength="8">
                <label for="fprofile">Photo Profile</label><br>
                <input type="file" id="fprofile" accept="image/*" name="profile" placeholder="Photo Profile"><br>
                <input type="submit">
            </form>
        </div>
    </div>
</div>

<?php
if (session()->getFlashdata('pesan')) {
    echo "<script>alert('" . session()->getFlashdata('pesan') . "')</script>";
}
?>

<script type="text/javascript">
    //    regex email validation
    function validateEmail(email) {
        var re = /\S+@\S+\.\S+/;
        return re.test(email);
    }

    function show_modal(id) {
        var modal = document.getElementById("myModal" + id);
        var span = document.getElementById("close" + id);
        modal.style.display = "block";
        span.onclick = function() {
            modal.style.display = "none";
        }
        window.onclick = function(event) {
            if (event.target == modal) {
                modal.style.display = "none";
            }
        }
    }
</script>