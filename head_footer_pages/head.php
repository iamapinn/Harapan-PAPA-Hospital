<?php
require '../connection/conn.php';

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

    <!-- Plugins CSS -->
    <link rel="stylesheet" type="text/css" href="../assets/vendor/font-awesome/css/all.min.css">
    <link rel="stylesheet" type="text/css" href="../assets/vendor/bootstrap-icons/bootstrap-icons.css">
    <link rel="stylesheet" type="text/css" href="../assets/vendor/tiny-slider/tiny-slider.css">
    <link rel="stylesheet" type="text/css" href="../assets/vendor/glightbox/css/glightbox.css">
    <link rel="stylesheet" type="text/css" href="../assets/vendor/choices/css/choices.min.css">

    <!-- toastr -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">

    <!-- JQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
    <script type='text/javascript' src="https://rawgit.com/RobinHerbots/jquery.inputmask/3.x/dist/jquery.inputmask.bundle.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.inputmask/5.0.8-beta.17/jquery.inputmask.min.js" integrity="sha512-zdfH1XdRONkxXKLQxCI2Ak3c9wNymTiPh5cU4OsUavFDATDbUzLR+SYWWz0RkhDmBDT0gNSUe4xrQXx8D89JIQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <!-- Theme CSS -->
    <link id="style-switch" rel="stylesheet" type="text/css" href="../assets/css/style.css">

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
    <!-- Pre loader -->
    <div class="preloader">
        <div class="preloader-item">
            <div class="spinner-grow text-primary"></div>
        </div>
    </div>
    <!-- Header START -->
    <header class="navbar-light navbar-sticky header-static">
        <!-- Logo Nav START -->
        <nav class="navbar navbar-expand-xl">
            <div class="container-fluid px-3 px-xl-5">
                <!-- Logo START -->
                <a class="navbar-brand" href="index.php">
                    <img class="light-mode-item navbar-brand-item" src="../assets/images/logo/logo_navbar.svg" alt="logo">
                </a>
                <!-- Logo END -->

                <!-- Responsive navbar toggler -->
                <button class="navbar-toggler ms-auto" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-animation">
                        <span></span>
                        <span></span>
                        <span></span>
                    </span>
                </button>

                <!-- Main navbar START -->
                <div class="navbar-collapse w-100 collapse" id="navbarCollapse">

                    <!-- Nav Main menu START -->
                    <ul class="navbar-nav navbar-nav-scroll me-auto">
                        <!-- Nav item 1 Menu Pasien & Pengunjung -->
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="Pasien&Pengunjung" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Pasien &
                                Pengunjung</a>
                            <ul class="dropdown-menu" aria-labelledby="Pasien&Pengunjung">
                                <li> <a class="dropdown-item <?= ($halaman_active == '/RS Harapan PAPA/pages/cari_dokter.php' ? 'active' : '') ?>" href="cari_dokter.php">Cari Dokter</a></li>
                                <li> <a class="dropdown-item <?= ($halaman_active == '/RS Harapan PAPA/pages/perawat.php' ? 'active' : '') ?>" href="perawat.php">Cari Perawat</a></li>
                                <li> <a class="dropdown-item <?= ($halaman_active == '/RS Harapan PAPA/pages/poliklinik.php' ? 'active' : '') ?>" href="poliklinik.php">Poliklinik</a></li>
                                <li> <a class="dropdown-item <?= ($halaman_active == '/RS Harapan PAPA/pages/rawat_inap.php' ? 'active' : '') ?>" href="rawat_inap.php">Rawat Inap</a></li>
                                <li> <a class="dropdown-item <?= ($halaman_active == '/RS Harapan PAPA/pages/location.php' ? 'active' : '') ?>" href="location.php">Petunjuk Lokasi</a></li>
                                <li> <a class="dropdown-item <?= ($halaman_active == '/RS Harapan PAPA/pages/faq.php' ? 'active' : '') ?>" href="faq.php">FAQ</a></li>
                            </ul>
                        </li>

                        <!-- Nav item 2 Menu Layanan -->
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="Layanan" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Layanan</a>
                            <ul class="dropdown-menu" aria-labelledby="Layanan">
                                <li> <a class="dropdown-item <?= ($halaman_active == '/RS Harapan PAPA/pages/farmasi.php' ? 'active' : '') ?>" href="farmasi.php">Farmasi</a></li>
                                <li> <a class="dropdown-item <?= ($halaman_active == '/RS Harapan PAPA/pages/gawat-darurat.php' ? 'active' : '') ?>" href="gawat-darurat.php">Gawat Darurat</a></li>
                                <li> <a class="dropdown-item <?= ($halaman_active == '/RS Harapan PAPA/pages/mcu.php' ? 'active' : '') ?>" href="mcu.php">Medical Check Up</a></li>
                                <li> <a class="dropdown-item <?= ($halaman_active == '/RS Harapan PAPA/pages/perawatan_intensif.php' ? 'active' : '') ?>" href="perawatan_intensif.php">Perawatan Intensif</a></li>
                                <li> <a class="dropdown-item <?= ($halaman_active == '/RS Harapan PAPA/pages/hemodialisis.php' ? 'active' : '') ?>" href="hemodialisis.php">Hemodialisis</a></li>
                                <li> <a class="dropdown-item <?= ($halaman_active == '/RS Harapan PAPA/pages/laboratorium.php' ? 'active' : '') ?>" href="laboratorium.php">Laboratorium</a></li>
                            </ul>
                        </li>

                        <!-- Nav item 3 Menu Berita & Artikel Kesehatan -->
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="Berita&Artikel" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Berita & Artikel Kesehatan</a>
                            <ul class="dropdown-menu" aria-labelledby="Berita&Artikel">
                                <li> <a class="dropdown-item <?= ($halaman_active == '/RS Harapan PAPA/pages/artikel_populer.php' ? 'active' : '') ?>" href="artikel_populer.php">Artikel Populer</a></li>
                                <li> <a class="dropdown-item <?= ($halaman_active == '/RS Harapan PAPA/pages/edukasi_visual.php' ? 'active' : '') ?>" href="edukasi_visual.php">Edukasi Visual</a></li>
                                <li> <a class="dropdown-item <?= ($halaman_active == '/RS Harapan PAPA/pages/buletin.php' ? 'active' : '') ?>" href="buletin.php">Buletin Bicara Sehat</a></li>
                                <li> <a class="dropdown-item <?= ($halaman_active == '/RS Harapan PAPA/pages/video.php' ? 'active' : '') ?>" href="video.php">Video</a></li>
                                <li> <a class="dropdown-item <?= ($halaman_active == '/RS Harapan PAPA/pages/promosi.php' ? 'active' : '') ?>" href="promosi.php">Promosi</a></li>
                            </ul>
                        </li>

                        <!-- Nav item 4 Menu Tentang RS -->
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="TentangRS" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Tentang RS</a>
                            <ul class="dropdown-menu" aria-labelledby="TentangRS">
                                <li> <a class="dropdown-item <?= ($halaman_active == '/RS Harapan PAPA/pages/visimisi.php' ? 'active' : '') ?>" href="visimisi.php">Visi & Misi</a></li>
                                <li> <a class="dropdown-item <?= ($halaman_active == '/RS Harapan PAPA/pages/capres.php' ? 'active' : '') ?>" href="capres.php">Capaian & Prestasi</a></li>
                                <li> <a class="dropdown-item <?= ($halaman_active == '/RS Harapan PAPA/pages/jajaran_direksi.php' ? 'active' : '') ?>" href="jajaran_direksi.php">Jajaran Direksi</a></li>
                                <li> <a class="dropdown-item <?= ($halaman_active == '/RS Harapan PAPA/pages/pengalaman_pasien.php' ? 'active' : '') ?>" href="pengalaman_pasien.php">Pengalaman Pasien</a></li>
                                <li> <a class="dropdown-item <?= ($halaman_active == '/RS Harapan PAPA/pages/mengapaRSPAPA.php' ? 'active' : '') ?>" href="mengapaRSPAPA.php">Mengapa RS Harapan PAPA</a></li>
                            </ul>
                        </li>
                    </ul>
                    <!-- Nav Main menu END -->

                    <!-- Nav Search START -->
                    <div class="nav my-3 my-xl-0 px-4 flex-nowrap align-items-center">
                        <div class="nav-item w-100">
                            <form class="position-relative">
                                <input class="form-control pe-5 bg-transparent" type="search" placeholder="Cari" aria-label="Search">
                                <button class="btn bg-transparent px-2 py-0 position-absolute top-50 end-0 translate-middle-y" type="submit"><i class="fas fa-search fs-6 "></i></button>
                            </form>
                        </div>
                    </div>
                    <!-- Nav Search END -->
                </div>
                <!-- Main navbar END -->

                <!-- Profile START -->
                <div class="dropdown ms-1 ms-lg-0">
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
                                                                    ?>" alt="<?= $row_admin['full_name']; ?>">
                    </a>
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
                                                                                                echo "../assets/images/upload/dokter/" . $row_dokter['profile_picture'];
                                                                                            } else if ($_COOKIE['role'] == "3") {
                                                                                                echo "../assets/images/upload/perawat/" . $row_perawat['profile_picture'];
                                                                                            } else if ($_COOKIE['role'] == "4") {
                                                                                                echo "../assets/images/upload/pasien/" . $row_pasien['user_picture'];
                                                                                            }
                                                                                        }
                                                                                        ?>" alt="<?= $row_admin['full_name']; ?>">
                                </div>
                                <div>
                                    <a class="h6" href="#"><?php
                                                            if ($row_admin['full_name'] == "") {
                                                                echo "Hi! User";
                                                            } else if ($row_admin['full_name'] != "") {
                                                                echo $row_admin['full_name'];
                                                            }
                                                            ?> </a>
                                    <p class="small m-0"><?= $_COOKIE['email']; ?></p>
                                </div>
                            </div>
                            <hr>
                        </li>
                        <!-- Links -->
                        <li>
                            <?php
                            if ($_SESSION['role'] != "") {
                                echo '<a class="dropdown-item" href="../pages/edit-profile.php"><i class="bi bi-person fa-fw me-2"></i>Edit Profile</a>';
                            } ?>
                        <li>
                            <?php
                            if ($_SESSION['role'] == '1' || $_SESSION['role'] == '2' || $_SESSION['role'] == '3') {
                                echo '<a class="dropdown-item" href="../admin/admin-dashboard.php"><i class="bi bi-house faw-fw me-2"></i>Admin Dashboard</a>';
                            }
                            ?>
                        </li>
                        <li>
                            <?php
                            if ($_SESSION['role'] == "") {
                                echo '<a class="dropdown-item" href="../pages/sign-in.php"><i class="bi bi-lock fa-fw me-2"></i>Login</a>';
                            } else if ($_SESSION['role'] != "") {
                            ?>
                                <form action="../connection/function.php" method="POST" id="logoutInput">
                                    <input type="hidden" class="h5 mb-0 text-body" name="logout" value="Sign Out">
                                    <a class="dropdown-item" name="logout" href="#" onclick="document.getElementById('logoutInput').submit();"><i class="bi bi-power fa-fw me-2"></i>Sign Out</a>
                                </form>
                            <?php } ?>

                    </ul>
                </div>
                <!-- Profile START -->
            </div>
        </nav>
        <!-- Logo Nav END -->
    </header>
    <!-- Header END -->