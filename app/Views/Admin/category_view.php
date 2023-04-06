<div class="container-fluid">
    <h3 class="text-dark mb-4">Kategory</h3>
    <div class="card shadow">
        <div class="card-header py-3">
            <p class="text-primary m-0 fw-bold">Kategory</p>
        </div>
        <div class="card-body">
            <button class="btn btn-primary" id="myBtn" onclick="show_modal(0)" type="button" style="margin-bottom: 20px;background: var(--bs-gray-500);border-style: none;">Add Kategory</button>
            <div class="row">
                <div class="col-md-6 text-nowrap">
                    <div id="dataTable_length" class="dataTables_length" aria-controls="dataTable">
                        <label class="form-label">Show&nbsp;
                            <select class="d-inline-block form-select form-select-sm">
                                <option value="10" selected="">10</option>
                                <option value="25">25</option>
                                <option value="50">50</option>
                                <option value="100">100</option>
                            </select>&nbsp;</label>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="text-md-end dataTables_filter" id="dataTable_filter">
                        <label class="form-label">
                            <input type="search" class="form-control form-control-sm" aria-controls="dataTable" placeholder="Search">
                        </label>
                    </div>
                </div>
            </div>
            <div class="table-responsive table mt-2" id="dataTable" role="grid" aria-describedby="dataTable_info">
                <table class="table my-0" id="dataTable">
                    <thead>
                        <tr>
                            <th class="text-center">Thumbnail</th>
                            <th class="text-center">Name</th>
                            <th class="text-center">Total</th>
                            <th class="text-center">Update</th>
                            <th class="text-center">Delete</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php

                        use CodeIgniter\Filters\CSRF;

                        $i = 1;
                        foreach ($categorys as $key => $lKategory) {
                        ?>
                            <tr>

                                <td class="text-center"><img class="rounded-circle me-2" width="30" height="30" src="<?= base_url('thumbnail/' . $lKategory->name_thumbnail) ?>"></td>
                                <td class="text-center"><?= $lKategory->category_name; ?></td>
                                <td class="text-center"><?= $lKategory->video_count; ?></td>
                                <td>
                                    <a onclick="show_modal(<?= $i ?>)" class="text-primary" href="#">
                                        <i class="icon ion-android-create d-lg-flex justify-content-lg-center align-items-lg-center" style="font-size: 23px;"></i>
                                    </a>

                                </td>
                                <td>
                                    <a href="javascript:hapusData('<?= $lKategory->id_kategory_video; ?>', 1)" class="text-danger">
                                        <i class="icon ion-android-delete d-lg-flex justify-content-lg-center align-items-lg-center" style="font-size: 23px;"></i>
                                    </a>
                                </td>
                            </tr>

                            <div id="myModal<?= $i ?>" class="modal">
                                <!-- Modal content -->
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <span class="close" id="close<?= $i ?>">&times;</span>
                                        <h2>Update Category</h2>
                                        <hr>
                                    </div>
                                    <div class="modal-body">
                                        <form name="input" method="post" enctype="multipart/form-data" action="<?= base_url('category/updateData') ?>">
                                            <?= csrf_field() ?>
                                            <input type="hidden" name="old_id" value="<?= $lKategory->id_kategory_video; ?>">
                                            <label for="Cname">Name</label>
                                            <input type="text" id="Cname" name="name" value="<?= $lKategory->category_name; ?>" maxlength="255" required>
                                            <label for="fthumbnail">Thumbnail</label><br>
                                            <input type="file" id="fthumbnail" accept="image/*" name="thumbnail" placeholder="Thumbnail" required><br>
                                            <input type="submit" value="Update">
                                        </form>
                                    </div>
                                </div>
                            </div>

                        <?php $i++;
                        } ?>
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

<!-- Modal Input Data -->
<div id="myModal0" class="modal">
    <!-- Modal content -->
    <div class="modal-content">
        <div class="modal-header">
            <span class="close" id="close0">&times;</span>
            <h2>Add Categori</h2>
            <hr>
        </div>
        <div class="modal-body">
            <form name="input" method="post" enctype="multipart/form-data" action="<?= base_url('category/addData') ?>">
                <?= csrf_field() ?>
                <label for="fnama">Name</label>
                <input type="text" id="fnama" name="name" placeholder="Name" required>
                <!-- // upload file image for thumbnail -->
                <label for="fthumbnail">Thumbnail</label><br>
                <input type="file" id="fthumbnail" accept="image/*" name="thumbnail" placeholder="Thumbnail" required><br>
                <input type="submit">
            </form>
        </div>
    </div>
</div>