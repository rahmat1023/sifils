<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <title> <?= $title; ?> | SiFilsafat</title>

    <!-- General CSS Files -->
    <link rel="stylesheet" href="<?= base_url() ?>/stisla/node_modules/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?= base_url() ?>/stisla/node_modules/@fortawesome/fontawesome-free/css/all.min.css">
    <link rel="stylesheet" href="<?= base_url() ?>/stisla/node_modules/select2/dist/css/select2.css">
    <!-- CSS Libraries -->
    <link rel="stylesheet" href="<?= base_url() ?>/stisla/node_modules/fullcalendar/dist/fullcalendar.min.css">

    <!-- Template CSS -->
    <link rel="stylesheet" href="<?= base_url() ?>/stisla/assets/css/style.css">
    <link rel="stylesheet" href="<?= base_url() ?>/stisla/assets/css/components.css">
    <link rel="stylesheet" href="<?= base_url() ?>/css/custom.css">
    <script src="<?= base_url() ?>/stisla/node_modules/jquery/dist/jquery.min.js"></script>
    <script src="<?= base_url() ?>/stisla/node_modules/popper.js/dist/umd/popper.min.js"></script>
    <script src="<?= base_url() ?>/stisla/node_modules/bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="<?= base_url() ?>/stisla/node_modules/nicescroll/dist/jquery.nicescroll.min.js"></script>
    <script src="<?= base_url() ?>/stisla/node_modules/moment/min/moment.min.js"></script>
    <script src="<?= base_url() ?>/stisla/node_modules/select2/dist/js/select2.full.min.js"></script>
    <script src="<?= base_url() ?>/stisla/assets/js/stisla.js"></script>
    <script type="text/javascript" src="<?= base_url() ?>/stisla/node_modules/fullcalendar/dist/fullcalendar.min.js"></script>
    <!-- <script type="text/javascript" src="<?= base_url() ?>/stisla/node_modules/sweetalert/dist/sweetalert.min.js"></script> -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/locale-all.js"></script>

</head>

<body>

    <div id="app">
        <div class="main-wrapper">
            <div class="navbar-bg"></div>
            <nav class="navbar navbar-expand-lg main-navbar">
                <form class="form-inline mr-auto">
                    <ul class="navbar-nav mr-3">
                        <li><a href="#" data-toggle="sidebar" class="nav-link nav-link-lg"><i class="fas fa-bars"></i></a></li>
                    </ul>
                </form>
                <ul class="navbar-nav navbar-right">
                    <li class="dropdown"><a href="#" data-toggle="dropdown" class="nav-link dropdown-toggle nav-link-lg nav-link-user">
                            <img alt="image" src="<?= base_url() ?>/stisla/assets/img/avatar/avatar-1.png" class="rounded-circle mr-1">
                            <div class="d-sm-none d-lg-inline-block">Hi, <?= session('name'); ?></div>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right">
                            <div class="dropdown-title">Logged in 0 min ago</div>
                            <a href="#" class="dropdown-item has-icon text-capitalize">
                                <i class="far fa-user"></i> <?= session('role'); ?>
                            </a>
                            <a href="<?= site_url('changepass'); ?>" class="dropdown-item has-icon">
                                <i class="fas fa-cog"></i> Ganti Password
                            </a>
                            <div class="dropdown-divider"></div>
                            <a href="<?= site_url('logout'); ?>" class="dropdown-item has-icon text-danger">
                                <i class="fas fa-sign-out-alt"></i> Logout
                            </a>
                        </div>
                    </li>
                </ul>
            </nav>
            <div class="main-sidebar sidebar-style-2">
                <aside id="sidebar-wrapper">
                    <div class="sidebar-brand">
                        <a href="index.html">SiFilsafat</a>
                    </div>
                    <div class="sidebar-brand sidebar-brand-sm">
                        <a href="index.html">SF</a>
                    </div>

                    <?= $this->include('layout/menu'); ?>

                </aside>
            </div>

            <?= $this->renderSection('content'); ?>

            <footer class="main-footer">
                <div class="footer-left">
                    Copyright &copy; <?= date('Y'); ?> <div class="bullet"></div> <a href="https://filsafat.ugm.ac.id/">Rahmat A</a>
                </div>
                <div class="footer-right">
                    Version 2.0
                </div>
            </footer>
        </div>
    </div>

    <!-- General JS Scripts -->


    <!-- JS Libraies -->


    <!-- Template JS File -->
    <script src="<?= base_url() ?>/stisla/assets/js/scripts.js"></script>
    <script src="<?= base_url() ?>/stisla/assets/js/custom.js"></script>

    <!-- Page Specific JS File -->
    <script src="<?= base_url() ?>/js/js.js"></script>

</body>

</html>