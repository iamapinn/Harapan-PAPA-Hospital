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
                    <h1 class="text-white">Artikel Populer</h1>
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
                            <input class="form-control me-1" type="search" name="search" placeholder="Cari Artikel Populer" value="<?= $_POST["search"] ?>">
                        </div>
                    </form>
                </div>

            </div>
            <!-- Search option END -->

            <!-- Course list START -->
            <div class="row g-4 justify-content-center">

                <?php
                $batas = 10;
                $halaman = isset($_GET['halaman']) ? (int)$_GET['halaman'] : 1;
                $halaman_awal = ($halaman > 1) ? ($halaman * $batas) - $batas : 0;

                $previous = $halaman - 1;
                $next = $halaman + 1;

                $data = mysqli_query($conn, "SELECT * FROM tbl_artikel WHERE admission = 1");
                $jumlah_data = mysqli_num_rows($data);
                $total_halaman = ceil($jumlah_data / $batas);

                if ($_POST["search"]) {
                    $search = "AND judul_artikel LIKE '%" . $_POST["search"] . "%' OR penulis LIKE '%" . $_POST["search"] . "%' OR date LIKE '%" . $_POST["search"] . "%'";
                }

                $artikel = mysqli_query($conn, "SELECT * FROM tbl_artikel WHERE admission = 1 AND id_artikel " . $search . " ORDER BY id_artikel DESC LIMIT $halaman_awal, $batas");

                $show_data = mysqli_num_rows($artikel);

                while ($row = mysqli_fetch_assoc($artikel)) {
                ?>

                    <!-- Card item START -->
                    <div class="col-lg-12 col-xxl-7">
                        <div class="card rounded overflow-hidden shadow">
                            <div class="row g-0">
                                <!-- Image -->
                                <div class="col-md-4">
                                    <img src=<?php
                                                if ($row['artikel_picture'] == "") {
                                                    echo "../assets/images/admin/no-preview-available.png";
                                                } else {
                                                    echo "../assets/images/upload/artikel/" . $row['artikel_picture'];
                                                }
                                                ?> alt="card image">
                                </div>

                                <!-- Card body -->
                                <div class="col-md-8">
                                    <div class="card-body">
                                        <!-- Title -->
                                        <div class="d-flex justify-content-between mb-2">
                                            <h5 class="card-title mb-0"><a href=""><?= $row['judul_artikel']; ?></a>
                                            </h5>
                                        </div>
                                        <!-- Content -->
                                        <!-- Info -->
                                        <ul class="list-inline mb-1 text-secondary d-flex justify-content-between mb-2">
                                            <li class="list-inline-item h6 fw-light mb-1 mb-sm-0 text-secondary"><i class="fas fa-solid fa-user me-2"></i><?= $row['penulis']; ?>
                                            </li>
                                            <li class="list-inline-item h6 fw-light mb-1 mb-sm-0 text-secondary">
                                                <i class="fas fa-solid fa-clock"></i> <?= $row['date']; ?>
                                            </li>
                                            </li>
                                        </ul>
                                        <!-- Rating -->
                                        <ul class="list-inline mb-0">
                                            <p class="mb-0 mt-2"><?= $row['content_short']; ?>
                                                <a href="#" class="btn btn-primary-soft me-1 mb-0" data-bs-toggle="modal" data-bs-target="#modalviewartikel<?= $row['id_artikel'] ?>">Selengkapnya</a>
                                            </p>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Card item END -->
                    <!-- Modal View artikel START -->
                    <div class="modal fade" id="modalviewartikel<?= $row['id_artikel'] ?>" tabindex="-1" aria-labelledby="viewartikellabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered modal-lg">
                            <div class="modal-content">

                                <!-- Modal header -->
                                <div class="modal-header bg-dark">
                                    <h5 class="modal-title text-white" id="viewartikellabel"><?= $row['judul_artikel'] ?> Detail</h5>
                                    <button type="button" class="btn btn-sm btn-light mb-0" data-bs-dismiss="modal" aria-label="Close"><i class="bi bi-x-lg"></i></button>
                                </div>

                                <!-- Modal body -->
                                <div class="modal-body p-5">
                                    <!-- Upload image END -->
                                    <div class="position-relative">
                                        <img src="<?php
                                                    if ($row['artikel_picture'] == "") {
                                                        echo "../assets/images/admin/no-preview-available.png";
                                                    } else {
                                                        echo "../assets/images/upload/artikel/" . $row['artikel_picture'];
                                                    }
                                                    ?>" class="rounded mb-3" alt="">
                                    </div>

                                    <!-- Judul Artikel -->
                                    <span class="small">Judul Artikel:</span>
                                    <h6><?= $row['judul_artikel'] ?> (<?= $row['penulis'] ?>)</h6>
                                    <span class="small mb-3"><?= $row['date'] ?><br></span>

                                    <!-- Summary -->
                                    <span class="small">Content:</span>
                                    <p class="text-dark mb-2"><?= $row['content'] ?></p>

                                </div>

                                <!-- Modal footer -->
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-danger-soft my-0" data-bs-dismiss="modal">Close</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Modal View artikel END -->

                <?php } ?>


            </div>
            <!-- Course list END -->
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