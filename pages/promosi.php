<?php require '../head_footer_pages/head.php' ?>

<!-- **************** MAIN CONTENT START **************** -->
<main>

    <!-- =======================
Promosi START -->
    <section class="pb-0 pb-md-5">
        <div class="container">
            <!-- Title -->
            <div class="row mb-4">
                <h2 class="mb-4 text-center">Promosi</h2>
            </div>
            <!-- Main content START -->
            <div class="col-12">

                <!-- Promosi Grid START -->
                <div class="row g-4">

                    <?php
                    $batas = 8;
                    $halaman = isset($_GET['halaman']) ? (int)$_GET['halaman'] : 1;
                    $halaman_awal = ($halaman > 1) ? ($halaman * $batas) - $batas : 0;

                    $previous = $halaman - 1;
                    $next = $halaman + 1;

                    $data = mysqli_query($conn, "SELECT * FROM tbl_promosi WHERE admission = 1");
                    $jumlah_data = mysqli_num_rows($data);
                    $total_halaman = ceil($jumlah_data / $batas);

                    if ($_POST["search"]) {
                        $search = "AND judul_promosi LIKE '%" . $_POST["search"] . "%' OR date LIKE '%" . $_POST["search"] . "%' OR location LIKE '%" . $_POST["search"] . "%' OR admission LIKE '%" . $_POST["search"] . "%'";
                    }

                    $promosi = mysqli_query($conn, "SELECT * FROM tbl_promosi WHERE admission = 1 AND id_promosi " . $search . " ORDER BY id_promosi DESC LIMIT $halaman_awal, $batas");

                    $show_data = mysqli_num_rows($promosi);

                    while ($row = mysqli_fetch_assoc($promosi)) {
                    ?>
                        <!-- Card item START -->
                        <div class="col-sm-6 col-lg-4 col-xl-3">
                            <div class="card bg-transparent">
                                <div class="position-relative">
                                    <!-- Image -->
                                    <img src="<?php
                                                if ($row['promosi_picture'] == "") {
                                                    echo "../assets/images/admin/no-preview-available.png";
                                                } else {
                                                    echo "../assets/images/upload/promosi/" . $row['promosi_picture'];
                                                }
                                                ?>" class="card-img" alt="promosi image">
                                    <!-- Overlay -->
                                    <div class="card-img-overlay d-flex align-items-start flex-column p-3">
                                        <div class="w-100 mt-auto">
                                            <!-- Category -->
                                            <div class="badge text-dark bg-white fs-6 rounded-1"><i class="far fa-calendar-alt text-orange me-2"></i><?= $row['date']; ?></div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Card body -->
                                <div class="card-body px-2">
                                    <!-- Title -->
                                    <h5 class="card-title"><a href="#"><?= $row['judul_promosi']; ?></a>
                                    </h5>
                                    <!-- Address and button -->
                                    <div class="d-flex justify-content-between align-items-center">
                                        <Address class="mb-0"><i class="fas fa-map-marker-alt me-2"></i><?= $row['location']; ?></Address>
                                        <a href="#" class="btn btn-sm btn-primary-soft mb-0" data-bs-toggle="modal" data-bs-target="#modalviewpromosi<?= $row['id_promosi'] ?>">View</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Card item END -->
                        <!-- Modal View Promosi START -->
                        <div class="modal fade" id="modalviewpromosi<?= $row['id_promosi'] ?>" tabindex="-1" aria-labelledby="viewpromosilabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered modal-lg">
                                <div class="modal-content">

                                    <!-- Modal header -->
                                    <div class="modal-header bg-dark">
                                        <h5 class="modal-title text-white" id="viewpromosilabel"><?= $row['judul_promosi'] ?> Detail</h5>
                                        <button type="button" class="btn btn-sm btn-light mb-0" data-bs-dismiss="modal" aria-label="Close"><i class="bi bi-x-lg"></i></button>
                                    </div>

                                    <!-- Modal body -->
                                    <div class="modal-body p-5">
                                        <!-- Upload image END -->
                                        <div class="position-relative">
                                            <img src="<?php
                                                        if ($row['promosi_picture'] == "") {
                                                            echo "../assets/images/admin/no-preview-available.png";
                                                        } else {
                                                            echo "../assets/images/upload/promosi/" . $row['promosi_picture'];
                                                        }
                                                        ?>" class="rounded mb-3" alt="">
                                        </div>

                                        <!-- Judul Artikel -->
                                        <span class="small">Judul Promosi:</span>
                                        <h6><?= $row['judul_promosi'] ?></h6>
                                        <span class="small mb-3"><?= $row['date'] ?>&nbsp;&nbsp;&nbsp;<i class="bi bi-geo"> <?= $row['location'] ?></i><br><br></span>

                                        <!-- Summary -->
                                        <span class="small">Deskripsi:</span>
                                        <p class="text-dark mb-2"><?= $row['deskripsi'] ?></p>

                                    </div>

                                    <!-- Modal footer -->
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-danger-soft my-0" data-bs-dismiss="modal">Close</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Modal View Promosi END -->
                    <?php } ?>

                </div>
                <!-- Promosi Grid End -->
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
        </div>
        </div>
    </section>
    <!-- =======================
Event END -->


</main>
<!-- **************** MAIN CONTENT END **************** -->

<?php require '../head_footer_pages/footer.php' ?>