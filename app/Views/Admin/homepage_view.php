<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Dashboard - Video Reka</title>
    <link rel="stylesheet" href="<?= base_url("assets/bootstrap/css/bootstrap.min.css") ?>">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i&amp;display=swap">
    <link rel="stylesheet" href="<?= base_url("assets/fonts/fontawesome-all.min.css") ?>">
    <link rel="stylesheet" href=" <?= base_url("assets/fonts/ionicons.min.css") ?>">
    <link rel="stylesheet" href="<?= base_url('assets/css/modal.css') ?>">
    <!-- import ajax -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

</head>

<body id="page-top" class="sidebar-toggled">
    <div id="wrapper">

        <nav class="navbar navbar-dark align-items-start sidebar sidebar-dark accordion bg-gradient-primary p-0 toggled" style="color: var(--bs-accordion-bg);background: var(--bs-code-color);">
            <div class="container-fluid d-flex flex-column p-0"><a class="navbar-brand d-flex justify-content-center align-items-center sidebar-brand m-0" href="#">
                    <div class="sidebar-brand-icon rotate-n-15"><i class="fas fa-film"></i></div>
                    <!-- text size 12 -->
                    <div class="sidebar-brand-text mx-3"><span>Video Storage</span></div>
                </a>
                <hr class="sidebar-divider my-0">

                <ul class="navbar-nav text-light" id="accordionSidebar">
                    <li class="nav-item"><a class="nav-link <?= $status == 'dashboard' ? 'active' : '' ?>" href=" <?= base_url("user/dashboard") ?>"><i class="fas fa-tachometer-alt"></i><span>Dashboard</span></a></li>
                    <li class="nav-item"></li>
                    <li class="nav-item"><a class="nav-link <?= $status == 'category' ? 'active' : '' ?>" href="<?= base_url("user/category") ?>"><i class="fas fa-search"></i><span>Category</span></a></li>
                    <li class="nav-item"><a class="nav-link <?= $status == 'video' ? 'active' : '' ?> " href=" <?= base_url("user/video") ?>"><i class="fas fa-video"></i><span>Video</span></a></li>
                    <?php if (session()->get('logged_in') == 'super_admin') : ?>
                        <li class="nav-item"><a class="nav-link <?= $status == 'user' ? 'active' : '' ?> " href=" <?= base_url("user/user") ?>"><i class="fas fa-user"></i><span>User</span></a></li>
                    <?php endif; ?>
                    <li class="nav-item"></li>
                </ul>
                <!-- Side bar kiri -->
                <div class="text-center d-none d-md-inline"><button class="btn rounded-circle border-0" id="sidebarToggle" type="button"></button></div>

            </div>
        </nav>

        <div class="d-flex flex-column" id="content-wrapper">
            <div id="content">
                <nav class="navbar navbar-light navbar-expand bg-white shadow mb-4 topbar static-top">
                    <div class="container-fluid">
                        <button class="btn btn-link d-md-none rounded-circle me-3" id="sidebarToggleTop" type="button"><i class="fas fa-bars"></i></button>
                        <div>
                            <p class="text-dark mb-2">
                                <?php
                                // cek ip address server dan port yang digunakan
                                $ip = $_SERVER['SERVER_ADDR'];
                                $port = $_SERVER['SERVER_PORT'];
                                echo 'IP Address : ' . $ip . ':' . $port;

                                // tampilkan storage yang digunakan
                                $total = disk_total_space("/");
                                $free = disk_free_space("/");
                                $used = $total - $free;
                                $used_percent = round(($used / $total) * 100, 2);
                                echo '<br>Storage Used : ' . $used_percent . '%';
                                ?>
                            </p>
                        </div>

                        <ul class="navbar-nav flex-nowrap ms-auto">
                            <div class="d-none d-sm-block topbar-divider"></div>
                            <!-- Profile kanan atas -->
                            <li class="nav-item dropdown no-arrow">
                                <div class="nav-item dropdown no-arrow"><a class="dropdown-toggle nav-link" aria-expanded="false" data-bs-toggle="dropdown" href="#"><span class="d-none d-lg-inline me-2 text-gray-600 small"><?= $username ?>
                                        </span><img class="border rounded-circle img-profile" src="<?= session()->get('path_image') != "" ? session()->get('path_image') : base_url("assets/img/avatars/icons8-admin-settings-male-60.png") ?>"></a>
                                    <div class="dropdown-menu shadow dropdown-menu-end animated--grow-in">
                                        <a class="dropdown-item" href="<?= base_url("user/profile") ?>"><i class="fas fa-user fa-sm fa-fw me-2 text-gray-400"></i>&nbsp;Profile</a>
                                        <div class="dropdown-divider"></div>
                                        <a class="dropdown-item" href="<?= base_url("user/logout") ?>"><i class="fas fa-sign-out-alt fa-sm fa-fw me-2 text-gray-400"></i>&nbsp;Logout</a>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                </nav>

                <!-- Content -->
                <?php
                if (isset($page)) {
                    echo $page;
                }
                ?>

            </div>

            <footer class="bg-white sticky-footer">
                <div class="container my-auto">
                    <div class="text-center my-auto copyright"><span>Copyright © Video Reka 2023</span></div>
                </div>
            </footer>

        </div><a class="border rounded d-inline scroll-to-top" href="#page-top"><i class="fas fa-angle-up"></i></a>

    </div>
    <script type="text/javascript" src="<?= base_url("assets/bootstrap/js/bootstrap.min.js") ?>"></script>
    <script type="text/javascript" src=" <?= base_url("assets/js/theme.js") ?>"></script>
    <script type="text/javascript" src="<?= base_url("assets/js/modal.js") ?>"></script>
    <script type="text/javascript">
        function hapusData(id, identifier) {
            console.log(id);
            if (confirm("Apakah anda yakin akan menghapus data ini?")) {
                switch (identifier) {
                    case 1:
                        window.location.href = "<?= base_url('category/delete') ?>/" + id;
                        break;
                    case 2:
                        window.location.href = "<?= base_url('video/delete/') ?>/" + id;
                        break;
                }
            }
        }
    </script>
</body>

</html>