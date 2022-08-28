<?php require '../head_footer_pages/head.php' ?>

<!-- **************** MAIN CONTENT START **************** -->
<main>
    <!-- =======================
Page content START -->
    <section class="pt-3 pt-xl-5">
        <div class="container" data-sticky-container>
            <!-- Title -->
            <div class="row mb-4">
                <h2 class="mb-4 text-center">Video</h2>
            </div>
            <div class="row g-4">

                <?php
                $batas = 3;
                $halaman = isset($_GET['halaman']) ? (int)$_GET['halaman'] : 1;
                $halaman_awal = ($halaman > 1) ? ($halaman * $batas) - $batas : 0;

                $previous = $halaman - 1;
                $next = $halaman + 1;

                $data = mysqli_query($conn, "SELECT * FROM tbl_video WHERE admission = 1");
                $jumlah_data = mysqli_num_rows($data);
                $total_halaman = ceil($jumlah_data / $batas);

                if ($_POST["search"]) {
                    $search = "AND judul_video LIKE '%" . $_POST["search"] . "%' OR date LIKE '%" . $_POST["search"] . "%' OR admission LIKE '%" . $_POST["search"] . "%'";
                }

                $video = mysqli_query($conn, "SELECT * FROM tbl_video WHERE admission = 1 AND id_video " . $search . " ORDER BY id_video DESC LIMIT $halaman_awal, $batas");

                $show_data = mysqli_num_rows($video);

                while ($row = mysqli_fetch_assoc($video)) {
                ?>
                    <!-- Main content START -->
                    <div class="col-xl-4">

                        <div class="row g-4">
                            <!-- Image and video -->
                            <div class="col-12 position-relative">
                                <div class="video-player rounded-3">
                                    <!-- Image -->
                                    <img src="<?php
                                                if ($row['video_picture'] == "") {
                                                    echo "../assets/images/admin/no-preview-available.png";
                                                } else {
                                                    echo "../assets/images/upload/video/" . $row['video_picture'];
                                                }
                                                ?>" class="border border-5 border-white rounded-2" alt="">
                                    <div class="position-absolute top-50 start-50 translate-middle">
                                        <!-- Video link -->
                                        <a href="<?= $row['link']; ?>" class="btn text-danger btn-round btn-white-shadow btn-lg mb-0" data-glightbox data-gallery="video-tour">
                                            <i class="fas fa-play"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>

                            <!-- About course START -->
                            <div class="col-12 mt-1">
                                <div class="card border">

                                    <!-- Card header START -->
                                    <div class="card-header border-bottom">
                                        <h3 class="mb-0"><?= $row['judul_video']; ?></h3>
                                    </div>
                                    <!-- Card header END -->

                                    <!-- Card body START -->
                                    <div class="card-body">
                                        <p class="mb-3">
                                            <?= $row['deskripsi']; ?>
                                        </p>
                                    </div>
                                </div>
                                <!-- Card body START -->
                            </div>
                        </div>
                        <!-- About course END -->

                    </div>
            </div>
            <!-- Main content END -->

        <?php } ?>

        </div><!-- Row END -->
        <!-- Pagination START -->
        <div class="col-12">
            <nav class="mt-4 d-flex justify-content-center" aria-label="navigation">
                <ul class="pagination pagination-primary-soft rounded mb-0">
                    <li class="page-item mb-0"><a class="page-link" tabindex="-1" <?php if ($halaman > 1) {
                                                                                        echo "href='?halaman=$previous'";
                                                                                    } ?>><i class="fas fa-angle-double-left"></i></a></li>
                    <?php
                    for ($x = 1; $x <= $total_halaman; $x++) {

                        if ($halaman == $x) {
                    ?>
                            <li class="page-item mb-0 active"><a class="page-link" href="?halaman=<?= $x ?>"><?= $x; ?></a></li>
                        <?php } else { ?>

                            <li class="page-item mb-0"><a class="page-link" href="?halaman=<?= $x ?>"><?= $x; ?></a></li>
                    <?php }
                    } ?>
                    <li class="page-item mb-0"><a class="page-link" <?php if ($halaman < $total_halaman) {
                                                                        echo "href='?halaman=$next'";
                                                                    } ?>><i class="fas fa-angle-double-right"></i></a></li>
                </ul>
            </nav>
        </div>
        <!-- Pagination END -->
    </section>
    <!-- =======================
Page content END -->

</main>
<!-- **************** MAIN CONTENT END **************** -->

<?php require '../head_footer_pages/footer.php' ?>