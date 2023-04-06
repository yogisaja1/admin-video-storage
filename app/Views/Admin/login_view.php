<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Login - Video Reka</title>
    <link rel="stylesheet" href="<?= base_url("assets/bootstrap/css/bootstrap.min.css") ?>">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i&amp;display=swap">
    <link rel="stylesheet" href="<?= base_url("assets/fonts/fontawesome-all.min.css") ?>">
    <link rel="stylesheet" href="<?= base_url("assets/fonts/ionicons.min.css") ?>">
    <link rel="stylesheet" href="<?= base_url('assets/css/login.css') ?>">
</head>

<body class="bg-gradient-primary" style="background: var(--bs-pink);">
    <div class="container" title="hello" style="margin-top: 60px;">
        <div class="row justify-content-center">
            <div class="col-md-9 col-lg-12 col-xl-10">
                <div class="card shadow-lg o-hidden border-0 my-5">
                    <div class="card-body p-0">
                        <div class="row">
                            <div class="col-lg-6 d-none d-lg-flex">
                                <div class="flex-grow-1 bg-login-image" style="background: url(<?= base_url("assets/img/dogs/sleeper.jpg") ?>) center / cover no-repeat;transform: perspective(0px);"></div>
                            </div>
                            <div class="col-lg-6">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h4 class="text-dark mb-4">Welcome Admin</h4>
                                    </div>
                                    <form class="user" action="<?= base_url("user/login") ?>" method="post">
                                        <div class="mb-3"><input class="form-control form-control-user" type="text" id="InputUsername" placeholder="Username" name="username"></div>
                                        <div class="mb-3"><input class="form-control form-control-user" type="password" id="InputPassword" placeholder="Password" name="password"></div>
                                        <div class="mb-3">
                                            <div class="custom-control custom-checkbox small"></div>
                                        </div><button class="btn btn-primary d-block btn-user w-100" type="submit">Login</button>
                                    </form>
                                    <div class="message-wrapper">
                                        <?php
                                        if (!empty(session()->getFlashdata('salah'))) {
                                        ?>
                                            <div class="message">
                                                <p><?= session()->getFlashdata('salah') ?></p>
                                            </div>
                                        <?php
                                        }
                                        ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="<?= base_url("assets/bootstrap/js/bootstrap.min.js") ?>"></script>
    <script src=" <?= base_url("assets/js/theme.js") ?>"></script>
</body>

</html>