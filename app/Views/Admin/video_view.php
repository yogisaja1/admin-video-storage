<div class="container-fluid">
    <h3 class="text-dark mb-4">Video</h3>
    <div class="card shadow">
        <div class="card-header py-3">
            <p class="text-primary m-0 fw-bold">Video</p>
        </div>
        <div class="card-body">
            <button class="btn btn-primary" type="button" id="myBtn" onclick="show_modal(0)" style="background: var(--bs-gray-500);margin-bottom: 20px;border-style: none;">Add video</button>
            <div class="row">
                <div class="col-md-6 text-nowrap">
                    <div id="dataTable_length" class="dataTables_length" aria-controls="dataTable">
                        <label class="form-label">Show&nbsp;<select class="d-inline-block form-select form-select-sm">
                                <option value="10" selected="">10</option>
                                <option value="25">25</option>
                                <option value="50">50</option>
                                <option value="100">100</option>
                            </select>&nbsp;
                        </label>
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
                            <th class="text-center">Tittle</th>
                            <th class="text-center">Category</th>
                            <th class="text-center">Duration</th>
                            <th class="text-center">Update</th>
                            <th class="text-center">Delete</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $i = 1;
                        foreach ($videos as $key => $lvideo) {
                        ?>
                            <tr>
                                <td class="d-flex justify-content-center" style="text-align: center;"><img class="rounded-circle me-2" width="30" height="30" src="<?= base_url("thumbnail/$lvideo[name_thumbnail]") ?>"></td>
                                <td class="text-center"><?= $lvideo['title'] ?></td>
                                <!-- Jika kategory id sama dengan id kategory maka cetak -->
                                <?php foreach ($category as $key => $lcategory) {
                                    if ($lvideo['kategory_id'] === $lcategory->id_kategory_video) {
                                ?>
                                        <td class="text-center"><?= $lcategory->category_name ?></td>
                                <?php }
                                } ?>
                                <!--  -->
                                <td class="text-center"><?= $lvideo['duration'] ?></td>
                                <td>
                                    <a onclick="show_modal(<?= $i ?>)" class="text-primary" href="#">
                                        <i class="icon ion-android-create text-center d-lg-flex justify-content-lg-center align-items-lg-center" style="font-size: 24px;"></i>
                                    </a>
                                </td>
                                <td>
                                    <a href="javascript:hapusData('<?= $lvideo['id_video']; ?>', 2)" class="text-danger">
                                        <i class="icon ion-android-delete text-center d-lg-flex justify-content-lg-center align-items-lg-center" style="font-size: 24px;"></i>
                                    </a>
                                </td>
                            </tr>
                            <div id="myModal<?= $i ?>" class="modal">
                                <!-- Modal content -->
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <span class="close" id="close<?= $i ?>">&times;</span>
                                        <h2>Update Video</h2>
                                        <hr>
                                    </div>
                                    <div class="modal-body">
                                        <form name="input" method="post" enctype="multipart/form-data" action="<?= base_url('video/updateData') ?>">
                                            <?= csrf_field() ?>
                                            <input type="hidden" name="old_id" value="<?= $lvideo['id_video']; ?>">
                                            <label for="fnama">Tittle</label>
                                            <input type="text" id="fnama" name="name" placeholder="Title Name" value="<?= $lvideo['title'] ?>" required>
                                            <label for="fduration">Duration</label>
                                            <input type="number" id="fduration" name="duration" placeholder="Duration" value="<?= $lvideo['duration'] ?>" required>
                                            <label for="fthumbnail">Thumbnail</label><br>
                                            <input type="file" id="fthumbnail" accept="image/*" name="thumbnail" placeholder="Thumbnail"><br>
                                            <select class="form-select mt-2" aria-label="Category Video" name="category">
                                                <?php foreach ($category as $key => $lcategory) { ?>
                                                    <option value="<?= $lcategory->id_kategory_video ?>" <?= ($lcategory->id_kategory_video === $lvideo['kategory_id']) ? "selected" : "" ?>><?= $lcategory->category_name ?></option>
                                                <?php } ?>
                                            </select>
                                            <input type="submit" value="Update">
                                        </form>
                                    </div>
                                </div>
                            </div>
                        <?php
                            $i++;
                        }
                        ?>
                    </tbody>
                </table>
            </div>
            <div class="row">
                <div class="col-md-6 align-self-center">
                    <p id="dataTable_info" class="dataTables_info" role="status" aria-live="polite">Showing 1 to 10 of 27</p>
                </div>
                <div class="col-md-6">
                    <nav class="d-lg-flex justify-content-lg-end dataTables_paginate paging_simple_numbers">
                        <ul class="pagination">
                            <li class="page-item disabled">
                                <a class="page-link" aria-label="Previous" href="#">
                                    <span aria-hidden="true">«</span>
                                </a>
                            </li>
                            <li class="page-item active">
                                <a class="page-link" href="#">1</a>
                            </li>
                            <li class="page-item">
                                <a class="page-link" href="#">2</a>
                            </li>
                            <li class="page-item">
                                <a class="page-link" href="#">3</a>
                            </li>
                            <li class="page-item">
                                <a class="page-link" aria-label="Next" href="#"><span aria-hidden="true">»</span></a>
                            </li>
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
            <h2>Add Video</h2>
            <hr>
        </div>
        <div class="modal-body">
            <form name="input" method="post" enctype="multipart/form-data" action="<?= base_url('video/addData') ?>">
                <?= csrf_field() ?>
                <label for="fnama">Tittle</label>
                <input type="text" id="fnama" name="name" placeholder="Title Name" required>
                <label for="fduration">Duration</label>
                <input type="number" id="fduration" name="duration" placeholder="Duration" required>
                <!-- // upload file image for thumbnail -->
                <label for="fthumbnail">Thumbnail</label><br>
                <input type="file" id="fthumbnail" accept="image/*" name="thumbnail" placeholder="Thumbnail" required><br>
                <select class="form-select mt-2" aria-label="Category Video" name="category">
                    <option selected>Category Video</option>
                    <?php foreach ($category as $key => $lcategory) { ?>
                        <option value="<?= $lcategory->id_kategory_video ?>"><?= $lcategory->category_name ?></option>
                    <?php } ?>
                </select>
                <label for="fvideo">Video</label><br>
                <input type="file" id="fvideo" accept="video/*" name="video" placeholder="Video" required><br>
                <input type="submit">
            </form>
        </div>
    </div>
</div>