<?php
require '../connection/conn.php';
if ($_SESSION['role'] == '4' || $_SESSION['role'] == '') {
    header("location:../pages/sign-in.php");
}

$halaman_active = $_SERVER['PHP_SELF'];
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Rumah Sakit Harapan PAPA</title>

    <!-- Meta Tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="author" content="Kelompok 1">
    <meta name="description" content="Harapan PAPA Hospital">

    <!-- Favicon -->
    <link rel="shortcut icon" href="../assets/images/logo/logo.png">

    <!-- Google Font -->
    <link rel="preconnect" href="https://fonts.googleapis.com/">
    <link rel="preconnect" href="https://fonts.gstatic.com/" crossorigin>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Heebo:wght@400;500;700&amp;family=Roboto:wght@400;500;700&amp;display=swap">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- Plugins CSS -->
    <link rel="stylesheet" type="text/css" href="../assets/vendor/font-awesome/css/all.min.css">
    <link rel="stylesheet" type="text/css" href="../assets/vendor/bootstrap-icons/bootstrap-icons.css">
    <link rel="stylesheet" type="text/css" href="../assets/vendor/apexcharts/css/apexcharts.css">
    <link rel="stylesheet" type="text/css" href="../assets/vendor/overlay-scrollbar/css/OverlayScrollbars.min.css">
    <link rel="stylesheet" type="text/css" href="../assets/vendor/choices/css/choices.min.css">
    <link rel="stylesheet" type="text/css" href="../assets/vendor/aos/aos.css">
    <link rel="stylesheet" type="text/css" href="../assets/vendor/glightbox/css/glightbox.css">
    <link rel="stylesheet" type="text/css" href="../assets/vendor/quill/css/quill.snow.css">
    <link rel="stylesheet" type="text/css" href="../assets/vendor/stepper/css/bs-stepper.min.css">

    <!-- Theme CSS -->
    <link id="style-switch" rel="stylesheet" type="text/css" href="../assets/css/style.css">
    <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
    <script type='text/javascript' src="https://rawgit.com/RobinHerbots/jquery.inputmask/3.x/dist/jquery.inputmask.bundle.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.inputmask/5.0.8-beta.17/jquery.inputmask.min.js" integrity="sha512-zdfH1XdRONkxXKLQxCI2Ak3c9wNymTiPh5cU4OsUavFDATDbUzLR+SYWWz0RkhDmBDT0gNSUe4xrQXx8D89JIQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <!-- include toastr -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">
</head>

<body>
    <?php
    $dokter = mysqli_query($conn, "SELECT * FROM tbl_dokter WHERE id_dokter = '$_COOKIE[id_dokter]'");
    $perawat = mysqli_query($conn, "SELECT * FROM tbl_perawat WHERE id_perawat = '$_COOKIE[id_perawat]'");
    $pasien = mysqli_query($conn, "SELECT * FROM tbl_users WHERE id_user = '$_COOKIE[id_user]'");
    $admin = mysqli_query($conn, "SELECT * FROM tbl_users WHERE id_user = '$_COOKIE[id_user]'");

    $row_dokter = mysqli_fetch_assoc($dokter);
    $row_perawat = mysqli_fetch_assoc($perawat);
    $row_pasien = mysqli_fetch_assoc($pasien);
    $row_admin = mysqli_fetch_assoc($admin);
    ?>
    <!-- **************** MAIN CONTENT START **************** -->
    <main>
        <!-- Pre loader -->
        <div class="preloader">
            <div class="preloader-item">
                <div class="spinner-grow text-primary"></div>
            </div>
        </div>
        <!-- Sidebar START -->
        <nav class="navbar sidebar navbar-expand-xl navbar-dark bg-dark">

            <!-- Navbar brand for xl START -->
            <div class="d-flex align-items-center">
                <a class="navbar-brand" href="admin-dashboard.php">
                    <img class="navbar-brand-item" src="../assets/images/logo/logo_navbar.svg" alt="">
                </a>
            </div>
            <!-- Navbar brand for xl END -->

            <div class="offcanvas offcanvas-start flex-row custom-scrollbar h-100" data-bs-backdrop="true" tabindex="-1" id="offcanvasSidebar">
                <div class="offcanvas-body sidebar-content d-flex flex-column bg-dark">

                    <!-- Sidebar menu START -->
                    <ul class="navbar-nav flex-column" id="navbar-sidebar">

                        <!-- Menu item 0 -->
                        <li class="nav-item"><a href="admin-dashboard.php" class="nav-link <?= ($halaman_active == '/RS Harapan PAPA/admin/admin-dashboard.php' ? 'active' : '') ?>"><i class="bi bi-house faw-fw me-2"></i>Dashboard</a></li>

                        <?php if ($_SESSION["role"] == "1") { ?>
                            <!-- Title -->
                            <li class="nav-item ms-2 my-2">Landing Pages</li>

                            <!-- Menu item 1 -->
                            <li class="nav-item"> <a class="nav-link <?= ($halaman_active == '/RS Harapan PAPA/admin/admin-jumbotron.php' ? 'active' : '') ?>" href="admin-jumbotron.php"><i class="bi bi-tv faw-fw me-2"></i>Jumbotron</a></li>

                            <!-- Menu item 2 -->
                            <li class="nav-item"> <a class="nav-link <?= ($halaman_active == '/RS Harapan PAPA/admin/admin-fp.php' ? 'active' : '') ?>" href="admin-fp.php"><i class="bi bi-hdd-stack-fill fa-fw me-2"></i>Fasilitas & Pelayanan</a></li>

                            <!-- Menu item 3 -->
                            <li class="nav-item"> <a class="nav-link <?= ($halaman_active == '/RS Harapan PAPA/admin/admin-asuransi.php' ? 'active' : '') ?>" href="admin-asuransi.php"><i class="bi bi-file-text fa-fw me-2"></i></i>Asuransi Kesehatan</a></li>
                        <?php } ?>

                        <!-- Title -->
                        <li class="nav-item ms-2 my-2">Pages</li>

                        <!-- menu item 4 -->
                        <li class="nav-item">
                            <a class="nav-link" data-bs-toggle="collapse" href="#collapsepage" role="button" aria-expanded="false" aria-controls="collapsepage">
                                <i class="fas fa-user-nurse fa-fw me-2"></i>Pasien & Pengunjung
                            </a>
                            <!-- Submenu -->
                            <ul class="nav collapse flex-column <?= ($halaman_active == '/RS Harapan PAPA/admin/admin-dokter.php' ||
                                                                    $halaman_active == '/RS Harapan PAPA/admin/admin-perawat.php' ||
                                                                    $halaman_active == '/RS Harapan PAPA/admin/admin-poliklinik.php' ||
                                                                    $halaman_active == '/RS Harapan PAPA/admin/admin-rawatinap.php' ? 'show' : '') ?>" id="collapsepage" data-bs-parent="#navbar-sidebar">
                                <li class="nav-item"> <a class="nav-link  <?= ($halaman_active == '/RS Harapan PAPA/admin/admin-dokter.php' ? 'active' : '') ?>" href="admin-dokter.php">Dokter</a></li>
                                <li class="nav-item"> <a class="nav-link <?= ($halaman_active == '/RS Harapan PAPA/admin/admin-perawat.php' ? 'active' : '') ?>" href="admin-perawat.php">Perawat</a></li>
                                <?php if ($_SESSION["role"] == "1") { ?>
                                    <li class="nav-item"> <a class="nav-link <?= ($halaman_active == '/RS Harapan PAPA/admin/admin-poliklinik.php' ? 'active' : '') ?>" href="admin-poliklinik.php">Poli Klinik</a></li>
                                <?php }
                                if ($_SESSION["role"] == "3") { ?>
                                    <li class="nav-item"> <a class="nav-link <?= ($halaman_active == '/RS Harapan PAPA/admin/admin-rawatinap.php' ? 'active' : '') ?>" href="admin-rawatinap.php">Rawat Inap</a></li>
                                <?php } ?>
                            </ul>
                        </li>

                        <?php if ($_SESSION["role"] == "1") { ?>
                            <!-- Menu item 5 -->
                            <li class="nav-item">
                                <a class="nav-link" data-bs-toggle="collapse" href="#collapseinstructors" role="button" aria-expanded="false" aria-controls="collapseinstructors">
                                    <i class="fas fa-briefcase fa-fw me-2"></i>Layanan
                                </a>
                                <!-- Submenu -->
                                <ul class="nav collapse flex-column <?= ($halaman_active == '/RS Harapan PAPA/admin/admin-farmasi.php' ? 'show' : '') ?>" id="collapseinstructors" data-bs-parent="#navbar-sidebar">
                                    <li class="nav-item"> <a class="nav-link <?= ($halaman_active == '/RS Harapan PAPA/admin/admin-farmasi.php' ? 'active' : '') ?>" href="admin-farmasi.php">Farmasi</a></li>
                                </ul>
                            </li>
                        <?php } ?>

                        <!-- Menu item 6 -->
                        <li class="nav-item">
                            <a class="nav-link" data-bs-toggle="collapse" href="#collapseauthentication" role="button" aria-expanded="false" aria-controls="collapseauthentication">
                                <i class="bi bi-newspaper fa-fw me-2"></i>Berita & Artikel
                            </a>
                            <!-- Submenu -->
                            <ul class="nav collapse flex-column <?= ($halaman_active == '/RS Harapan PAPA/admin/admin-artikel-populer.php' ||
                                                                    $halaman_active == '/RS Harapan PAPA/admin/admin-edukasi-visual.php' ||
                                                                    $halaman_active == '/RS Harapan PAPA/admin/admin-buletin.php' ||
                                                                    $halaman_active == '/RS Harapan PAPA/admin/admin-video.php' ||
                                                                    $halaman_active == '/RS Harapan PAPA/admin/admin-promosi.php' ? 'show' : '') ?>" id="collapseauthentication" data-bs-parent="#navbar-sidebar">
                                <?php if ($_SESSION["role"] == "1" || $_SESSION["role"] == "2") { ?>
                                    <li class="nav-item"> <a class="nav-link  <?= ($halaman_active == '/RS Harapan PAPA/admin/admin-artikel-populer.php' ? 'active' : '') ?>" href="admin-artikel-populer.php">Artikel</a></li>
                                <?php }
                                if ($_SESSION["role"] == "2") { ?>
                                    <li class="nav-item"> <a class="nav-link <?= ($halaman_active == '/RS Harapan PAPA/admin/admin-edukasi-visual.php' ? 'active' : '') ?>" href="admin-edukasi-visual.php">Edukasi Visual</a></li>
                                <?php }
                                if ($_SESSION["role"] == "1") { ?>
                                    <li class="nav-item"> <a class="nav-link <?= ($halaman_active == '/RS Harapan PAPA/admin/admin-buletin.php' ? 'active' : '') ?>" href="admin-buletin.php">Buletin</a></li>
                                    <li class="nav-item"> <a class="nav-link <?= ($halaman_active == '/RS Harapan PAPA/admin/admin-video.php' ? 'active' : '') ?>" href="admin-video.php">Video</a></li>
                                    <li class="nav-item"> <a class="nav-link <?= ($halaman_active == '/RS Harapan PAPA/admin/admin-promosi.php' ? 'active' : '') ?>" href="admin-promosi.php">Promosi</a></li>
                                <?php } ?>
                            </ul>
                        </li>
                        <?php if ($_SESSION["role"] == "1") { ?>
                            <!-- Menu item 7 -->
                            <li class="nav-item"> <a class="nav-link <?= ($halaman_active == '/RS Harapan PAPA/admin/user.php' ? 'active' : '') ?>" href="user.php"><i class="fas fa-user-tie fa-fw me-2"></i></i>Users</a></li>
                        <?php } ?>
                    </ul>
                    <!-- Sidebar menu end -->

                    <!-- Sidebar footer START -->
                    <div class="px-3 mt-auto pt-3">
                        <div class="d-flex align-items-center justify-content-between text-primary-hover">
                            <a class="h5 mb-0 text-body" href="admin-setting.html" data-bs-toggle="tooltip" data-bs-placement="top" title="Settings">
                                <i class="bi bi-gear-fill"></i>
                            </a>
                            <a class="h5 mb-0 text-body" href="../pages/index.php" data-bs-toggle="tooltip" data-bs-placement="top" title="Home">
                                <i class="bi bi-globe"></i>
                            </a>
                            <form action="../connection/function.php" method="POST" id="logoutInput">
                                <input type="hidden" class="h5 mb-0 text-body" name="logout" value="Sign Out">
                                <a class="h5 mb-0 text-body" href="#" name="logout" onclick="document.getElementById('logoutInput').submit();" data-bs-toggle="tooltip" data-bs-placement="top" title="Sign Out">
                                    <i class="bi bi-power"></i>
                                </a>
                            </form>
                        </div>
                    </div>
                    <!-- Sidebar footer END -->

                </div>
            </div>
        </nav>
        <!-- Sidebar END -->

        <!-- Page content START -->
        <div class="page-content">

            <!-- Top bar START -->
            <nav class="top-bar navbar-light border-bottom py-0 py-xl-3">
                <div class="container-fluid p-0">
                    <div class="d-flex align-items-center w-100">

                        <!-- Logo START -->
                        <div class="d-flex align-items-center d-xl-none">
                            <a class="navbar-brand" href="index.html">
                                <img class="light-mode-item navbar-brand-item h-30px" src="../assets/images/logo-mobile.svg" alt="">
                                <img class="dark-mode-item navbar-brand-item h-30px" src="../assets/images/logo-mobile-light.svg" alt="">
                            </a>
                        </div>
                        <!-- Logo END -->

                        <!-- Toggler for sidebar START -->
                        <div class="navbar-expand-xl sidebar-offcanvas-menu">
                            <button class="navbar-toggler me-auto" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasSidebar" aria-controls="offcanvasSidebar" aria-expanded="false" aria-label="Toggle navigation" data-bs-auto-close="outside">
                                <i class="bi bi-text-right fa-fw h2 lh-0 mb-0 rtl-flip" data-bs-target="#offcanvasMenu"> </i>
                            </button>
                        </div>
                        <!-- Toggler for sidebar END -->

                        <!-- Top bar left -->
                        <div class="navbar-expand-lg ms-auto ms-xl-0">

                            <!-- Toggler for menubar START -->
                            <button class="navbar-toggler ms-auto" type="button" data-bs-toggle="collapse" data-bs-target="#navbarTopContent" aria-controls="navbarTopContent" aria-expanded="false" aria-label="Toggle navigation">
                                <span class="navbar-toggler-animation">
                                    <span></span>
                                    <span></span>
                                    <span></span>
                                </span>
                            </button>
                            <!-- Toggler for menubar END -->

                            <!-- Topbar menu START -->
                            <div class="collapse navbar-collapse w-100" id="navbarTopContent">
                                <!-- Top search START -->
                                <div class="nav my-3 my-xl-0 flex-nowrap align-items-center">
                                    <div class="nav-item w-100">
                                        <form class="position-relative">
                                            <input class="form-control pe-5 bg-secondary bg-opacity-10 border-0" type="search" placeholder="Search" aria-label="Search">
                                            <button class="btn bg-transparent px-2 py-0 position-absolute top-50 end-0 translate-middle-y" type="submit"><i class="fas fa-search fs-6 text-primary"></i></button>
                                        </form>
                                    </div>
                                </div>
                                <!-- Top search END -->
                            </div>
                            <!-- Topbar menu END -->
                        </div>
                        <!-- Top bar left END -->

                        <!-- Top bar right START -->
                        <div class="ms-xl-auto">
                            <ul class="navbar-nav flex-row align-items-center">

                                <!-- Profile dropdown START -->
                                <li class="nav-item ms-2 ms-md-3 dropdown">
                                    <!-- Avatar -->
                                    <a class="avatar avatar-sm p-0" href="#" id="profileDropdown" role="button" data-bs-auto-close="outside" data-bs-display="static" data-bs-toggle="dropdown" aria-expanded="false">
                                        <img class="avatar-img rounded-circle" src="<?php
                                                                                    if ($row_admin['user_picture'] == "") {
                                                                                        echo "../assets/images/avatar/01.jpg";
                                                                                    } else if ($row_admin['user_picture'] != "") {
                                                                                        if ($_COOKIE['role'] == "1") {
                                                                                            echo "../assets/images/upload/admin/" . $row_admin['user_picture'];
                                                                                        } else if ($_COOKIE['role'] == "2") {
                                                                                            echo "../assets/images/upload/dokter/" . $row_dokter['profile_picture'];
                                                                                        } else if ($_COOKIE['role'] == "3") {
                                                                                            echo "../assets/images/upload/perawat/" . $row_perawat['profile_picture'];
                                                                                        } else if ($_COOKIE['role'] == "4") {
                                                                                            echo "../assets/images/upload/pasien/" . $row_pasien['user_picture'];
                                                                                        }
                                                                                    }
                                                                                    ?>" alt="<?= $_COOKIE['full_name'] ?>">
                                    </a>

                                    <!-- Profile dropdown START -->
                                    <ul class="dropdown-menu dropdown-animation dropdown-menu-end shadow pt-3" aria-labelledby="profileDropdown">
                                        <!-- Profile info -->
                                        <li class="px-3">
                                            <div class="d-flex align-items-center">
                                                <!-- Avatar -->
                                                <div class="avatar me-3">
                                                    <img class="avatar-img rounded-circle shadow" src="<?php
                                                                                                        if ($row_admin['user_picture'] == "") {
                                                                                                            echo "../assets/images/avatar/01.jpg";
                                                                                                        } else if ($row_admin['user_picture'] != "") {
                                                                                                            if ($_COOKIE['role'] == "1") {
                                                                                                                echo "../assets/images/upload/admin/" . $row_admin['user_picture'];
                                                                                                            } else if ($_COOKIE['role'] == "2") {
                                                                                                                echo "../assets/images/upload/dokter/" . $row_admin['user_picture'];
                                                                                                            } else if ($_COOKIE['role'] == "3") {
                                                                                                                echo "../assets/images/upload/perawat/" . $row_perawat['profile_picture'];
                                                                                                            } else if ($_COOKIE['role'] == "4") {
                                                                                                                echo "../assets/images/upload/pasien/" . $row_pasien['user_picture'];
                                                                                                            }
                                                                                                        }
                                                                                                        ?>" alt="<?= $_COOKIE['full_name'] ?>">
                                                </div>
                                                <div>
                                                    <a class="h6 mt-2 mt-sm-0" href="#"><?= $row_admin['full_name']; ?></a>
                                                    <p class="small m-0"><?= $_COOKIE['email']; ?></p>
                                                </div>
                                            </div>
                                            <hr>
                                        </li>

                                        <!-- Links -->
                                        <li><a class="dropdown-item" href="../pages/edit-profile.php"><i class="bi bi-person fa-fw me-2"></i>Edit Profile</a></li>
                                        <li>
                                            <form action="../connection/function.php" method="POST" id="logoutInput">
                                                <input type="hidden" class="h5 mb-0 text-body" name="logout" value="Sign Out">
                                                <a class="dropdown-item bg-danger-soft-hover" name="logout" href="#" onclick="document.getElementById('logoutInput').submit();"><i class="bi bi-power fa-fw me-2"></i>Sign Out</a>
                                            </form>
                                        </li>
                                    </ul>
                                    <!-- Profile dropdown END -->
                                </li>
                                <!-- Profile dropdown END -->
                            </ul>
                        </div>
                        <!-- Top bar right END -->
                    </div>
                </div>
            </nav>
            <!-- Top bar END -->