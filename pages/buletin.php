<?php require '../head_footer_pages/head.php' ?>

<!-- **************** MAIN CONTENT START **************** -->
<main>

    <!-- =======================
Page Banner START -->
    <section class="bg-blue align-items-center d-flex" style="background:url(assets/images/pattern/04.png) no-repeat center center; background-size:cover;">
        <div class="container">
            <div class="row">
                <div class="col-12 text-center">
                    <!-- Title -->
                    <h1 class="text-white">Buletin Bicara Sehat</h1>
                </div>
            </div>
        </div>
    </section>
    <!-- =======================
Page Banner END -->

    <!-- =======================
Page content START -->
    <section class="py-5">
        <div class="container">
            <div class="row">
                <!-- Main content START -->
                <div class="col-lg-8 col-xl-9">

                    <!-- Search option START -->
                    <div class="row mb-4 align-items-center">
                        <!-- Search bar -->
                        <div class="col-sm-6 col-xl-4 mx-auto">
                            <form class="border rounded p-2" method="POST">
                                <div class="input-group input-borderless">
                                    <input class="form-control me-1" type="search" name="search" placeholder="Cari Buletin" value="<?= $_POST["search"] ?>">
                                </div>
                            </form>
                        </div>

                    </div>
                    <!-- Search option END -->

                    <!-- Course Grid START -->
                    <div class="row g-4">

                        <?php
                        $batas = 10;
                        $halaman = isset($_GET['halaman']) ? (int)$_GET['halaman'] : 1;
                        $halaman_awal = ($halaman > 1) ? ($halaman * $batas) - $batas : 0;

                        $previous = $halaman - 1;
                        $next = $halaman + 1;

                        $data = mysqli_query($conn, "SELECT * FROM tbl_buletin WHERE admission = 1");
                        $jumlah_data = mysqli_num_rows($data);
                        $total_halaman = ceil($jumlah_data / $batas);

                        if ($_POST["search"]) {
                            $search = "AND judul_buletin LIKE '%" . $_POST["search"] . "%' OR date LIKE '%" . $_POST["search"] . "%' OR admission LIKE '%" . $_POST["search"] . "%'";
                        }

                        $buletin = mysqli_query($conn, "SELECT * FROM tbl_buletin WHERE admission = 1 AND id_buletin " . $search . " ORDER BY id_buletin DESC LIMIT $halaman_awal, $batas");

                        $show_data = mysqli_num_rows($buletin);

                        while ($row = mysqli_fetch_assoc($buletin)) {
                        ?>
                            <!-- Card item START -->
                            <div class="col-sm-6 col-xl-4">
                                <div class="card shadow h-100">
                                    <!-- Image -->
                                    <img src="<?php
                                                if ($row['buletin_picture'] == "") {
                                                    echo "../assets/images/admin/no-preview-available.png";
                                                } else {
                                                    echo "../assets/images/upload/buletin/" . $row['buletin_picture'];
                                                }
                                                ?>" class="card-img-top" alt="course image">
                                    <!-- Card body -->
                                    <div class="card-body pb-0">
                                        <!-- Title -->
                                        <h5 class="card-title"><a href="#"><?= $row['judul_buletin']; ?></a></h5>
                                        <p><?= $row['deskripsi']; ?>
                                        </p>
                                    </div>
                                    <!-- Card footer -->
                                    <div class="card-footer pt-0 pb-3">
                                        <hr>
                                        <div class="d-flex justify-content-between">
                                            <span class="h6 fw-light mb-0"><a href="<?= $row['link']; ?>" class="badge bg-success bg-opacity-10 text-success">Download</a></span>
                                            <span class="h6 fw-light mb-0"><?= $row['date']; ?></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Card item END -->

                        <?php } ?>

                    </div>
                    <!-- Course Grid END -->
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

                </div>
                <!-- Main content END -->

            </div><!-- Row END -->
        </div>
    </section>
    <!-- =======================
Page content END -->


</main>
<!-- **************** MAIN CONTENT END **************** -->

<?php require '../head_footer_pages/footer.php' ?>