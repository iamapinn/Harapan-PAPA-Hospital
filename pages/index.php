<?php require '../head_footer_pages/head.php' ?>

<!-- **************** MAIN CONTENT START **************** -->
<main>

    <!-- =======================
Main Banner START -->
    <section class="pt-0">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <!-- Slider START -->
                    <div class="tiny-slider arrow-round arrow-blur arrow-hover rounded-3 overflow-hidden">
                        <div class="tiny-slider-inner" data-autoplay="false" data-gutter="0" data-arrow="true" data-dots="false" data-items="1">

                            <?php

                            $jumbotron = mysqli_query($conn, "SELECT * FROM tbl_jumbotron WHERE admission = 1");
                            while ($row = mysqli_fetch_assoc($jumbotron)) {

                            ?>
                                <!-- Card item START -->
                                <div class="card overflow-hidden h-500px h-md-600px text-center rounded-0" style="background-image:url(<?php
                                                                                                                                        if ($row['jumbotron_picture'] == "") {
                                                                                                                                            echo "../assets/images/admin/no-preview-available.png";
                                                                                                                                        } else {
                                                                                                                                            echo "../assets/images/upload/jumbotron/" . $row['jumbotron_picture'];
                                                                                                                                        }
                                                                                                                                        ?>); background-position: center left; background-size: cover;">
                                    <!-- Background dark overlay -->
                                    <div class="bg-overlay bg-dark opacity-6"></div>
                                    <!-- Card image overlay -->
                                    <div class="card-img-overlay d-flex align-items-center p-2 p-sm-4">
                                        <div class="w-100 my-auto">
                                            <div class="row justify-content-center">
                                                <div class="col-11 col-lg-7">
                                                    <!-- Title -->
                                                    <h1 class="text-white display-6"><?= $row['judul_jumbotron']; ?></h1>
                                                    <p class="text-white"><?= $row['deskripsi_short']; ?></p>
                                                    <!-- Button -->
                                                    <a href="#" class="btn btn-outline-white mb-0" data-bs-toggle="modal" data-bs-target="#modalviewjumbotron<?= $row['id_jumbotron'] ?>">Selengkapnya</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- Card item END -->

                            <?php } ?>

                        </div>
                    </div>
                    <!-- Slider END -->
                </div>
            </div>
        </div>
    </section>
    <!-- =======================
Main Banner END -->

    <!-- =======================
Mengapa Kami START -->
    <section>
        <div class="container">
            <div class="row g-4 align-items-center">
                <div class="col-lg-5">
                    <!-- Title -->
                    <h2>Mengapa Kami ?, <br><span class="text-warning">RS Harapan PAPA</span>.</h2>
                    <!-- Image -->
                    <!-- Image -->
                    <div class="position-relative">
                        <!-- Image -->
                        <img src="../assets/images/RSHarapanPAPA.jpg" class="border border-5 border-white rounded-2" alt="">
                        <div class="position-absolute top-50 start-50 translate-middle">
                            <!-- Video link -->
                            <a href="https://www.youtube.com/watch?v=Y3RmZq35Uu8" class="btn text-danger btn-round btn-white-shadow btn-lg mb-0" data-glightbox data-gallery="video-tour">
                                <i class="fas fa-play"></i>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-7">
                    <div class="row g-4">
                        <!-- Item -->
                        <div class="col-sm-6">
                            <div class="icon-lg bg-orange bg-opacity-10 text-orange rounded-2"><i class="fas fa-share-alt fs-5"></i></div>
                            <h5 class="mt-2">Rumah Sakit Berbasis Digital</h5>
                            <p class="mb-0">Menerapkan sistem manajemen operasional berbasis teknologi informasi
                                jaringan</p>
                        </div>
                        <!-- Item -->
                        <div class="col-sm-6">
                            <div class="icon-lg bg-info bg-opacity-10 text-info rounded-2"><i class="fas fa-spinner fs-5"></i>
                            </div>
                            <h5 class="mt-2">Perawatan Berkelanjutan</h5>
                            <p class="mb-0">Kesinambungan pelayanan yang dilakukan mulai dari perawatan sampai
                                pasien pulang ke rumah oleh tim home care multi-profesi</p>
                        </div>
                        <!-- Item -->
                        <div class="col-sm-6">
                            <div class="icon-lg bg-success bg-opacity-10 text-success rounded-2"><i class="fas fa-search fs-5"></i></div>
                            <h5 class="mt-2">Praktik Berbasis Bukti</h5>
                            <p class="mb-0">Seluruh klien dikaji berdasarkan riwayat penyakit dahulu, keluarga, dan
                                pola hidup</p>
                        </div>
                        <!-- Item -->
                        <div class="col-sm-6">
                            <div class="icon-lg bg-purple bg-opacity-10 text-purple rounded-2"><i class="fas fa-users fs-5"></i></div>
                            <h5 class="mt-2">Kolaborasi Interprofesional</h5>
                            <p class="mb-0">Mengembangkan kolaborasi interprofesional dalam pelayanan, riset bidang
                                kesehatan, serta pengabdian masyarakat</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- =======================
Mengapa Kami END -->

    <!-- =======================
Penawaran START -->
    <section>
        <div class="container">
            <!-- Title -->
            <div class="row">
                <div class="col-lg-8 mb-4">
                    <h2>PENAWARAN SPESIAL</h2>
                    <p class="mb-0">Promo Medical Check up dengan 10 Telkomsel Poin bisa hemat 10% </p>
                </div>
            </div>

            <div class="row g-4 filter-container overflow-hidden" data-isotope='{"layoutMode": "masonry"}'>

                <?php

                $penawaran = mysqli_query($conn, "SELECT * FROM tbl_promosi WHERE admission = 1");
                while ($row = mysqli_fetch_assoc($penawaran)) {

                ?>
                    <!-- Card item -->
                    <div class="col-6 col-md-4 col-lg-3 grid-item">
                        <div class="card overflow-hidden">
                            <div class="card-overlay-hover">
                                <!-- Image -->
                                <img src="<?php
                                            if ($row['promosi_picture'] == "") {
                                                echo "../assets/images/admin/no-preview-available.png";
                                            } else {
                                                echo "../assets/images/upload/promosi/" . $row['promosi_picture'];
                                            }
                                            ?>" class="rounded-3" alt="course image">
                            </div>
                            <!-- Full screen button -->
                            <a class="card-element-hover position-absolute top-50 start-50 translate-middle bg-dark rounded-3 p-2 lh-1" data-glightbox="" data-gallery="portfolio" href="../assets/images/upload/promosi/<?= $row['promosi_picture']; ?>">
                                <i class="bi bi-fullscreen fa-fw fs-6 text-white"></i>
                            </a>
                        </div>
                    </div>
                    <!-- Card item END -->

                <?php } ?>

            </div>
        </div>
    </section>
    <!-- =======================
Penawaran END -->

    <!-- =======================
Fasilitas dan Layanan START -->
    <section class="bg-light position-relative">

        <div class="container">
            <!-- Fasilitas dan Layanan START -->
            <div class="row g-4 align-items-center justify-content-between">
                <!-- Content -->
                <div class="col-md-6 col-xl-4">
                    <h2 class="fs-1">Fasilitas dan Layanan</h2>
                </div>

                <!-- Fasilitas dan Layanan START -->
                <div class="col-md-6 col-xl-8">
                    <div class="row">
                        <!-- Slider START -->
                        <div class="tiny-slider arrow-round arrow-blur">
                            <div class="tiny-slider-inner" data-autoplay="false" data-edge="2" data-arrow="true" data-dots="false" data-items-lg="1" data-items-xl="2">

                                <?php

                                $fp = mysqli_query($conn, "SELECT * FROM tbl_fp WHERE admission = 1");
                                while ($row = mysqli_fetch_assoc($fp)) {

                                ?>

                                    <!-- Card item START -->
                                    <div>
                                        <div class="card p-2">
                                            <div class="position-relative">
                                                <!-- Image -->
                                                <img src="<?php
                                                            if ($row['fp_picture'] == "") {
                                                                echo "../assets/images/admin/no-preview-available.png";
                                                            } else {
                                                                echo "../assets/images/upload/fp/" . $row['fp_picture'];
                                                            }
                                                            ?>" class="card-img rounded-2" alt="Card image">
                                                <div class="card-img-overlay">
                                                    <div class="position-absolute top-50 start-50 translate-middle">

                                                        <!-- Full screen button -->
                                                        <a class="card-element-hover position-absolute top-50 start-50 translate-middle bg-dark rounded-3 p-2 lh-1" data-glightbox="" data-gallery="fasilitas-penawaran" href="../assets/images/upload/fp/<?= $row['fp_picture']; ?>">
                                                            <i class="bi bi-fullscreen fa-fw fs-6 text-white"></i>
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Card body -->
                                            <div class="card-body">
                                                <!-- Title -->
                                                <h5><?= $row['nama_fp']; ?></h5>
                                                <!-- Avatar group and button -->
                                                <div class="d-sm-flex justify-content-sm-between align-items-center mt-3">
                                                    <!-- Avatar Group -->
                                                    <div>
                                                        <h6 class="mb-1 fw-normal"><?= $row['deskripsi_short']; ?></h6>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Card item END -->

                                <?php } ?>

                            </div>
                        </div>
                        <!-- Slider END -->
                    </div>
                </div>
                <!-- Fasilitas dan Layanan END -->
            </div>
            <!-- Fasilitas dan Layanan END -->
        </div>
    </section>
    <!-- ======================= 
Fasilitas dan Layanan END -->

    <!-- =======================
Asuransi Kesehatan START -->
    <section class="pb-0 pb-md-5">
        <div class="container">
            <!-- Title -->
            <div class="row">
                <div class="col-lg-8 mx-auto text-center">
                    <h2>Asuransi Kesehatan</h2>
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-md-12">
                    <!-- Slider START -->
                    <div class="tiny-slider">
                        <div class="tiny-slider-inner" data-arrow="false" data-dots="false" data-gutter="80" data-items-xl="6" data-items-lg="5" data-items-md="4" data-items-sm="3" data-items-xs="2" data-autoplay="2000">

                            <?php

                            $asuransi = mysqli_query($conn, "SELECT * FROM tbl_asuransi WHERE admission = 1");
                            while ($row = mysqli_fetch_assoc($asuransi)) {

                            ?>

                                <!-- Slide item START -->
                                <div class="item">
                                    <a href="<?= $row['link']; ?>" target="_blank"><img class="grayscale" src="<?php
                                                                                                                if ($row['asuransi_picture'] == "") {
                                                                                                                    echo "../assets/images/admin/no-preview-available.png";
                                                                                                                } else {
                                                                                                                    echo "../assets/images/upload/asuransi/" . $row['asuransi_picture'];
                                                                                                                }
                                                                                                                ?>" alt="<?= $row['nama_asuransi']; ?>">
                                    </a>
                                </div>
                                <!-- Slide item END -->

                            <?php } ?>

                        </div>
                    </div>
                    <!-- Slider END -->
                </div>
            </div>
        </div>
    </section>
    <!-- =======================
Asuransi Kesehatan END -->

    <!-- =======================
Pengalaman Pasien START -->
    <section class="bg-light position-relative">
        <!-- SVG Image -->
        <figure class="position-absolute start-0 bottom-0 mb-0">
            <img src="../assets/images/element/10.svg" class="h-200px" alt="">
        </figure>

        <div class="container">
            <!-- Title -->
            <div class="row mb-4">
                <div class="col-lg-8 mx-auto text-center">
                    <h2>Pengalaman Pasien</h2>
                </div>
            </div>

            <!-- Pengalaman START -->
            <div class="row">
                <!-- Slider START -->
                <div class="tiny-slider arrow-round arrow-creative arrow-dark arrow-hover">
                    <div class="tiny-slider-inner" data-autoplay="true" data-edge="5" data-arrow="true" data-dots="false" data-items="4" data-items-xl="3" data-items-md="2" data-items-xs="1">

                        <!-- Pengalaman item START -->
                        <div>
                            <div class="bg-body text-center p-4 rounded-3 border border-1 position-relative">
                                <!-- Avatar -->
                                <div class="avatar avatar-lg mb-3">
                                    <img class="avatar-img rounded-circle" src="../assets/images/pengalamanpasien/20210525112327.jpg" alt="avatar">
                                </div>
                                <!-- Title -->
                                <h6 class="mb-2">Ekida Rehan Firmansyah</h6>
                                <!-- Content -->
                                <blockquote class="mt-1">
                                    <p>
                                        <span class="me-1 small"><i class="fas fa-quote-left"></i></span>
                                        Aku senang dan puas sekali dengan pelayanan MCU di RS Harapan PAPA.
                                        Gedungnya bagus dan
                                        fasilitasnya lengkap. Para Ners dan Dokternya juga ramah serta edukatif.
                                        Protokol kesehatannya juga dijalankan dengan baik, jadi aku merasa nyaman
                                        dan aman saat melakukan medical check up di #RSPAPA
                                        <span class="ms-1 small"><i class="fas fa-quote-right"></i></span>
                                    </p>
                                </blockquote>
                            </div>
                        </div>
                        <!-- Pengalaman Item END -->

                        <!-- Pengalaman item START -->
                        <div>
                            <div class="bg-body text-center p-4 rounded-3 border border-1 position-relative">
                                <!-- Avatar -->
                                <div class="avatar avatar-lg mb-3">
                                    <img class="avatar-img rounded-circle" src="../assets/images/pengalamanpasien/20210621122858.jpg" alt="avatar">
                                </div>
                                <!-- Title -->
                                <h6 class="mb-2">Tasya Kamila</h6>
                                <!-- Content -->
                                <blockquote class="mt-1">
                                    <p>
                                        <span class="me-1 small"><i class="fas fa-quote-left"></i></span>
                                        Jujur bangga ternyata di kampus almamaterku ada RSnya dan fasilitasnya
                                        lengkap banget, dokternya juga jagoan semua!! Bahkan, RS Harapan PAPA
                                        menjadi salah
                                        satu RS di depok yg dilengkapi alat-alat kesehatan berteknologi tinggi salah
                                        satunya MRI. Untuk MCU juga layanannya lengkap banget, MCU RS Harapan PAPA
                                        gedungnya
                                        terpisah dengan layanan kesehatan lainnya, sehingga aku merasa nyaman dan
                                        aman apalagi di masa pandemi Covid-19 ini.
                                        <span class="ms-1 small"><i class="fas fa-quote-right"></i></span>
                                    </p>
                                </blockquote>
                            </div>
                        </div>
                        <!-- Pengalaman Item END -->

                        <!-- Pengalaman item START -->
                        <div>
                            <div class="bg-body text-center p-4 rounded-3 border border-1 position-relative">
                                <!-- Avatar -->
                                <div class="avatar avatar-lg mb-3">
                                    <img class="avatar-img rounded-circle" src="../assets/images/pengalamanpasien/20210910102013.png" alt="avatar">
                                </div>
                                <!-- Title -->
                                <h6 class="mb-2">Anisful Lailil M</h6>
                                <!-- Content -->
                                <blockquote class="mt-1">
                                    <p>
                                        <span class="me-1 small"><i class="fas fa-quote-left"></i></span>
                                        Rumah sakit terbaik. Terima kasih RSUI dan tim diagnosa tepat sasaran dan
                                        tindakan cepat. Ada dokter obgyn terbaik dan hebat dr. Dido namanya. Nersnya
                                        semua tim ramah dan perhatian.
                                        <span class="ms-1 small"><i class="fas fa-quote-right"></i></span>
                                    </p>
                                </blockquote>
                            </div>
                        </div>
                        <!-- Pengalaman Item END -->

                        <!-- Pengalaman item START -->
                        <div>
                            <div class="bg-body text-center p-4 rounded-3 border border-1 position-relative">
                                <!-- Avatar -->
                                <div class="avatar avatar-lg mb-3">
                                    <img class="avatar-img rounded-circle" src="../assets/images/pengalamanpasien/20210910103010.jpg" alt="avatar">
                                </div>
                                <!-- Title -->
                                <h6 class="mb-2">Nadia Alatas</h6>
                                <!-- Content -->
                                <blockquote class="mt-1">
                                    <p>
                                        <span class="me-1 small"><i class="fas fa-quote-left"></i></span>
                                        Sangat nyaman Vaksin Drive Thru di RS Harapan PAPA, yang parno sama
                                        kerumunan atau di
                                        dalam ruangan Vaksin disini Recommended.
                                        <span class="ms-1 small"><i class="fas fa-quote-right"></i></span>
                                    </p>
                                </blockquote>
                            </div>
                        </div>
                        <!-- Pengalaman Item END -->


                    </div>
                </div>
                <!-- Slider START -->
            </div>
            <!-- Pengalaman END -->
        </div>
    </section>
    <!-- =======================
Pengalaman Pasien END -->

</main>
<!-- **************** MAIN CONTENT END **************** -->
<?php
$jumbotron = mysqli_query($conn, "SELECT * FROM tbl_jumbotron");

while ($row = mysqli_fetch_assoc($jumbotron)) {
?>
    <!-- Modal View Jumbotron START -->
    <div class="modal fade" id="modalviewjumbotron<?= $row['id_jumbotron'] ?>" tabindex="-1" aria-labelledby="viewjumbotronlabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">

                <!-- Modal header -->
                <div class="modal-header bg-dark">
                    <h5 class="modal-title text-white" id="viewjumbotronlabel"><?= $row['judul_jumbotron'] ?> Detail</h5>
                    <button type="button" class="btn btn-sm btn-light mb-0" data-bs-dismiss="modal" aria-label="Close"><i class="bi bi-x-lg"></i></button>
                </div>

                <!-- Modal body -->
                <div class="modal-body p-5">
                    <!-- Upload image END -->
                    <div class="position-relative">
                        <img src="<?php
                                    if ($row['jumbotron_picture'] == "") {
                                        echo "../assets/images/admin/no-preview-available.png";
                                    } else {
                                        echo "../assets/images/upload/jumbotron/" . $row['jumbotron_picture'];
                                    }
                                    ?>" class="rounded mb-3 w-500px" alt="">
                    </div>

                    <!-- Judul Artikel -->
                    <span class="small">Judul Jumbotron:</span>
                    <h6><?= $row['judul_jumbotron'] ?></h6>
                    <span class="small mb-3"><?= $row['date'] ?>&nbsp;&nbsp;&nbsp;<i class="bi bi-geo"> <?= $row['location'] ?></i><br><br></span>

                    <!-- Summary -->
                    <span class="small">Deskripsi:</span>
                    <p class="text-dark mb-2 w-400px"><?= $row['deskripsi'] ?></p>

                </div>

                <!-- Modal footer -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger-soft my-0" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal View Jumbotron END -->

<?php
}
require '../head_footer_pages/footer.php'
?>