<?php require '../head_footer_pages/head.php' ?>


<!-- **************** MAIN CONTENT START **************** -->
<main>

    <!-- =======================
Page Banner START -->
    <section class="bg-dark align-items-center d-flex" style="background:url(assets/images/pattern/04.png) no-repeat center center; background-size:cover;">
        <!-- Main banner background image -->
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <!-- Title -->
                    <h1 class="text-white">Edukasi Visual</h1>
                </div>
            </div>
        </div>
    </section>
    <!-- =======================
Page Banner END -->

    <!-- =======================
Page content START -->
    <section class="pt-5">
        <div class="container">
            <!-- Search option START -->
            <div class="row mb-4 align-items-center">
                <!-- Search bar -->
                <div class="col-sm-6 col-xl-4 mx-auto">
                    <form class="border rounded p-2" method="POST">
                        <div class="input-group input-borderless">
                            <input class="form-control me-1" type="search" name="search" placeholder="Cari Edukasi Visual" value="<?= $_POST["search"] ?>">
                        </div>
                    </form>
                </div>

            </div>
            <!-- Search option END -->

            <!-- Course Grid START -->
            <div class="row g-4 justify-content-center">

                <?php
                $batas = 6;
                $halaman = isset($_GET['halaman']) ? (int)$_GET['halaman'] : 1;
                $halaman_awal = ($halaman > 1) ? ($halaman * $batas) - $batas : 0;

                $previous = $halaman - 1;
                $next = $halaman + 1;

                $data = mysqli_query($conn, "SELECT * FROM tbl_edukasivisual WHERE admission = 1");
                $jumlah_data = mysqli_num_rows($data);
                $total_halaman = ceil($jumlah_data / $batas);

                if ($_POST["search"]) {
                    $search = "AND judul_edukasivisual LIKE '%" . $_POST["search"] . "%' OR nama_kategori LIKE '%" . $_POST["search"] . "%' OR date LIKE '%" . $_POST["search"] . "%' OR admission LIKE '%" . $_POST["search"] . "%'";
                }

                $edukasivisual = mysqli_query($conn, "SELECT * FROM tbl_edukasivisual JOIN tbl_kategori_edukasi ON tbl_edukasivisual.id_kategori_edukasi = tbl_kategori_edukasi.id_kategori_edukasi WHERE admission = 1 AND id_edukasivisual " . $search . " ORDER BY id_edukasivisual DESC LIMIT $halaman_awal, $batas");

                $show_data = mysqli_num_rows($edukasivisual);

                while ($row = mysqli_fetch_assoc($edukasivisual)) {
                ?>
                    <!-- Card item START -->
                    <div class="col-lg-12 col-xxl-7">
                        <div class="card shadow h-100">
                            <!-- Image -->
                            <img src="<?php
                                        if ($row['edukasivisual_picture'] == "") {
                                            echo "../assets/images/admin/no-preview-available.png";
                                        } else {
                                            echo "../assets/images/upload/edukasivisual/" . $row['edukasivisual_picture'];
                                        }
                                        ?>" class=" card-img-top " alt="<?= $row['judul_edukasivisual']; ?> ">
                            <!-- Card body -->
                            <div class="card-body pb-0 ">
                                <!-- info -->
                                <li class="list-inline-item h6 fw-light mb-1 mb-sm-0 text-secondary ">
                                    <i class="fas fa-solid fa-clock "></i> <?= $row['date']; ?>
                                </li>
                                <a href="# " class="badge bg-purple bg-opacity-10 text-black "><?= $row['nama_kategori']; ?></a>
                                <!-- Title -->
                                <h5 class="card-title "><a href="# "><?= $row['judul_edukasivisual']; ?></a></h5>
                                <ul class="list-inline mb-0 ">
                                    <p class="mb-0 mt-3 "><?= $row['deskripsi']; ?>
                                    </p>
                            </div>
                            <!-- Card footer -->
                            <div class="card-footer pt-0 pb-3 ">
                                <hr>
                                <div class="d-flex justify-content-between ">
                                    <a href="<?= $row['link']; ?>" class="btn btn-lg btn-danger-soft me-2 mb-4 mb-sm-0">Downloads</a>
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
    </section>
    <!-- =======================
Page content END -->


</main>
<!-- **************** MAIN CONTENT END **************** -->

<?php require '../head_footer_pages/footer.php' ?>