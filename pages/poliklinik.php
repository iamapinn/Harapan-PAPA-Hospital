<?php require '../head_footer_pages/head.php' ?>

<!-- **************** MAIN CONTENT START **************** -->
<main>

    <!-- =======================
Page content START -->
    <section class="pt-0">
        <div class="container">

            <!-- Title -->
            <div class="row mb-4">
                <div class="col-lg-8 mx-auto text-center">
                    <h2 class="mb-0">Poli Klinik</h2>
                    <p class="mb-0">Membuat janji temu dan konsultasi dengan dokter spesialis</p>
                </div>
            </div>

            <!-- Filter bar START -->
            <form class="bg-light border p-4 rounded-3 my-4 z-index-9 position-relative" method="POST">
                <div class="row g-3 justify-content-center">
                    <!-- Input -->
                    <div class="col-xl-3 col-sm-6 col-md-3 pb-2 pb-md-0">
                        <input class="form-control me-1" type="search" name="search" placeholder="Cari Poli Klinik" value="<?= $_POST["search"] ?>">
                    </div>

                </div> <!-- Row END -->
            </form>
            <!-- Filter bar END -->

            <div class="row mt-3">
                <!-- Main content START -->
                <div class="col-12">

                    <!-- Poliklinik Grid START -->
                    <div class="row g-3  justify-content-center">

                        <?php
                        $batas = 6;
                        $halaman = isset($_GET['halaman']) ? (int)$_GET['halaman'] : 1;
                        $halaman_awal = ($halaman > 1) ? ($halaman * $batas) - $batas : 0;

                        $previous = $halaman - 1;
                        $next = $halaman + 1;

                        $data = mysqli_query($conn, "SELECT * FROM tbl_poliklinik");
                        $jumlah_data = mysqli_num_rows($data);
                        $total_halaman = ceil($jumlah_data / $batas);

                        if ($_POST["search"]) {
                            $search = "AND nama_poliklinik LIKE '%" . $_POST["search"] . "%' OR admission LIKE '%" . $_POST["search"] . "%'";
                        }

                        $poliklinik = mysqli_query($conn, "SELECT * FROM tbl_poliklinik WHERE id_poliklinik " . $search . " ORDER BY nama_poliklinik ASC LIMIT $halaman_awal, $batas");

                        $show_data = mysqli_num_rows($poliklinik);

                        while ($row = mysqli_fetch_assoc($poliklinik)) {
                        ?>

                            <!-- Card item START -->
                            <div class="col-sm-7 col-md-5 col-xl-4">
                                <div class="card border mb-1 bg-transparent">
                                    <!-- Card image -->
                                    <img class="card-img-top" src="../assets/images/upload/poliklinik/<?= $row['poliklinik_picture']; ?>" alt="Card image">
                                    <!-- Card body -->
                                    <div class="card-body">
                                        <div class="d-flex justify-content-between align-items-center mt-n6 mb-3">
                                            <!-- Logo image -->
                                            <div class="bg-white p-2 rounded-2 shadow">
                                                <img class="rounded-1 h-60px" src="../assets/images/logo/logo.png" alt="Harapan PAPA logo">
                                            </div>
                                            <!-- Badge -->
                                            <div class="h5 mb-0">
                                                <?php
                                                if ($row['admission'] == 1) {
                                                    echo "<div class='badge bg-success text-white'>Admission Open</div>";
                                                } else {
                                                    echo "<div class='badge bg-danger text-white'>Admission Closed</div>";
                                                }
                                                ?>
                                            </div>
                                        </div>
                                        <!-- Badge and rating -->
                                        <div class="d-flex justify-content-between mb-3">
                                            <!-- Rating star -->
                                            <ul class="list-inline hstack mb-0">
                                                <li class="list-inline-item me-0 small"><i class="fas fa-star text-warning"></i>
                                                </li>
                                                <li class="list-inline-item me-0 small"><i class="fas fa-star text-warning"></i>
                                                </li>
                                                <li class="list-inline-item me-0 small"><i class="fas fa-star text-warning"></i>
                                                </li>
                                                <li class="list-inline-item me-0 small"><i class="fas fa-star text-warning"></i>
                                                </li>
                                                <li class="list-inline-item me-0 small"><i class="fas fa-star-half-alt text-warning"></i></li>
                                                <li class="list-inline-item ms-2 h6 fw-light mb-0">(4.5)</li>
                                            </ul>
                                        </div>
                                        <!-- Title -->
                                        <h5 class="card-title mb-3"><?= $row['nama_poliklinik']; ?></h5>
                                        <p class="mb-1">
                                            <?php
                                            $program = explode(',', $row['program_unggulan']);
                                            if (count($program) > 1) {
                                                echo "Program layanan unggulan";
                                            }
                                            ?>
                                        </p>
                                        <!-- Content -->
                                        <div class="row item-collapse">
                                            <div class="col-12">
                                                <ul class="list-group list-group-borderless p-2">
                                                    <?php
                                                    $program = explode(',', $row['program_unggulan']);
                                                    for ($i = 0; $i < count($program); $i++) {
                                                        if (count($program) > 1) {
                                                            echo "<li class='text-body py-1'>" . $program[$i] . "</li>";
                                                        }
                                                    }
                                                    ?>
                                                </ul>
                                            </div>
                                            <!-- Button -->
                                            <div class="mt-3 text-center">
                                                <a href="#" data-bs-toggle="modal" data-bs-placement="top" data-bs-target="#modalviewpoliklinik<?= $row['id_poliklinik'] ?>" title="View" class="btn btn-primary-soft mx-auto">View more</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Card item END -->
                            <!-- Modal View Poliklinik START -->
                            <div class="modal fade" id="modalviewpoliklinik<?= $row['id_poliklinik'] ?>" tabindex="-1" aria-labelledby="viewpolikliniklabel" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered modal-lg">
                                    <div class="modal-content">

                                        <!-- Modal header -->
                                        <div class="modal-header bg-dark">
                                            <h5 class="modal-title text-white" id="viewpolikliniklabel"><?= $row['nama_poliklinik'] ?> Detail</h5>
                                            <button type="button" class="btn btn-sm btn-light mb-0" data-bs-dismiss="modal" aria-label="Close"><i class="bi bi-x-lg"></i></button>
                                        </div>

                                        <!-- Modal body -->
                                        <div class="modal-body p-5">
                                            <!-- Upload image END -->
                                            <div class="position-relative">
                                                <img src="../assets/images/upload/poliklinik/<?= $row['poliklinik_picture']; ?>" class="rounded mb-3" alt="">
                                            </div>

                                            <!-- Nama Poli Klinik -->
                                            <span class="small">Nama Poli Klinik:</span>
                                            <h6 class="mb-3"><?= $row['nama_poliklinik'] ?></h6>

                                            <!-- Program Unggulan -->
                                            <span class="small">
                                                <?php
                                                $program = explode(',', $row['program_unggulan']);
                                                if (count($program) > 1) {
                                                    echo "Program layanan unggulan:";
                                                }
                                                ?>
                                            </span>
                                            <?php
                                            $program = explode(',', $row['program_unggulan']);
                                            for ($i = 0; $i < count($program); $i++) {
                                                if (count($program) > 1) {
                                                    echo "<h6><li>" . $program[$i] . "</li></h6>";
                                                }
                                            }
                                            ?>

                                            <!-- Link -->
                                            <span class="mt-3 small">Link:</span>
                                            <h6 class="mb-3"><a href="<?= $row['link'] ?>"><?= $row['link'] ?></a></h6>

                                            <!-- Summary -->
                                            <span class="small">Deskripsi:</span>
                                            <p class="text-dark mb-2"><?= $row['deskripsi'] ?></p>
                                        </div>

                                        <!-- Modal footer -->
                                        <div class="modal-footer">
                                            <?php
                                            if ($_SESSION['role'] == "") {
                                                echo '<a href="sign-up.php" class="btn btn-primary-soft my-0">Sign up</a>';
                                            } else {
                                                if ($row['admission'] == 1) {
                                                    echo "<a href='https://wa.me/" . $row['mobile_number'] . "'class='btn btn-success-soft my-0'>Pesan Poliklinik</a>";
                                                } else {
                                                    echo "<a href='https://wa.me/" . $row['mobile_number'] . "'class='btn btn-secondary-soft my-0' style='pointer-events: none;'>Pesan Poliklinik</a>";
                                                }
                                            } ?>
                                            <button type="button" class="btn btn-danger-soft my-0" data-bs-dismiss="modal">Close</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Modal View Poliklinik END -->

                        <?php } ?>

                    </div>
                    <!-- Poliklinik Grid END -->

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