<div class="container-fluid">
    <h3 class="text-dark mb-4">Profile</h3>
    <div class="row mb-3">
        <div class="col-lg-4">
            <div class="card mb-3">
                <div class="card-body text-center shadow"><img class="rounded-circle mb-3 mt-4" id="image" src="
                <?= session()->get('path_image') != "" ? session()->get('path_image') : base_url("assets/img/avatars/icons8-admin-settings-male-60.png") ?>
                " width="160" height="160">
                    <div class="mb-3"><button class="btn btn-primary btn-sm" type="button" onclick="document.getElementById('file').click();">Change Photo</button></div>
                </div>
            </div>
        </div>
        <div class="col-lg-8">
            <div class="row mb-3 d-none">
                <div class="col">
                    <div class="card text-white bg-primary shadow">
                        <div class="card-body">
                            <div class="row mb-2">
                                <div class="col">
                                    <p class="m-0">Peformance</p>
                                    <p class="m-0"><strong>65.2%</strong></p>
                                </div>
                                <div class="col-auto"><i class="fas fa-rocket fa-2x"></i></div>
                            </div>
                            <p class="text-white-50 small m-0"><i class="fas fa-arrow-up"></i>&nbsp;5% since last month</p>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="card text-white bg-success shadow">
                        <div class="card-body">
                            <div class="row mb-2">
                                <div class="col">
                                    <p class="m-0">Peformance</p>
                                    <p class="m-0"><strong>65.2%</strong></p>
                                </div>
                                <div class="col-auto"><i class="fas fa-rocket fa-2x"></i></div>
                            </div>
                            <p class="text-white-50 small m-0"><i class="fas fa-arrow-up"></i>&nbsp;5% since last month</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <div class="card shadow mb-3">
                        <div class="card-header py-3">
                            <p class="text-primary m-0 fw-bold">User Settings</p>
                        </div>
                        <div class="card-body">
                            <form action="<?= base_url('user/updateProfile') ?>" method="post" enctype="multipart/form-data">
                                <!-- input file type hidden -->
                                <!-- ambil hanya image saja -->
                                <input type="file" id="file" name="photo" style="display: none;" onchange="
                                    // simpan ke dalam id image
                                document.getElementById('image').src = window.URL.createObjectURL(this.files[0]);" accept="image/*">
                                <div class="row">
                                    <div class="col">
                                        <div class="mb-3"><label class="form-label" for="fusername"><strong>Username</strong></label><input class="form-control" type="text" id="fusername" placeholder="username" name="username" value="<?= $profile->username ?>"></div>
                                    </div>
                                    <div class="col">
                                        <div class="mb-3"><label class="form-label" for="femail"><strong>Email Address</strong></label><input class="form-control" type="email" id="femail" placeholder="user@example.com" name="email" value="<?= $profile->email ?>"></div>
                                    </div>
                                </div>
                                <div class="row">

                                    <div class="col">
                                        <div class="mb-3"><label class="form-label" for="fpasword"><strong>Password</strong></label><input class="form-control" type="password" id="password" placeholder="Password" name="password"></div>
                                    </div>
                                    <div class="col">
                                        <div class="mb-3"><label class="form-label" for="fpasswordconfirmation"><strong>Confirm Password</strong></label><input class="form-control" type="password" id="fpasswordconfirmation" placeholder="Confirm Password" name="passwordconfirmation"></div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col">
                                        <div class="mb-3"><label class="form-label" for="fname"><strong>Full Name</strong></label><input class="form-control" type="text" id="fname" placeholder="Full Name" name="fullname" value="<?= $profile->name ?>"></div>
                                    </div>
                                </div>
                                <div class="mb-3"><button class="btn btn-primary btn-sm" type="submit">Save Settings</button></div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>