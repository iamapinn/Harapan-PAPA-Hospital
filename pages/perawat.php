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
                    <h2 class="mb-0">Cari Perawat</h2>
                    <p class="mb-0">Membuat janji temu dan konsultasi dengan Perawat</p>
                </div>
            </div>

            <!-- Filter bar START -->
            <form class="bg-light border p-4 rounded-3 my-4 z-index-9 position-relative" method="POST">
                <div class="row g-3 justify-content-center">
                    <!-- Input -->
                    <div class="col-xl-3 col-sm-6 col-md-3 pb-2 pb-md-0">
                        <input class="form-control me-1" type="search" name="search" placeholder="Cari Perawat" value="<?= $_POST["search"] ?>">
                    </div>

                </div> <!-- Row END -->
            </form>
            <!-- Filter bar END -->

            <div class="row mt-3">
                <!-- Main content START -->
                <div class="col-12">

                    <!-- Course Grid START -->
                    <div class="row g-4">

                        <?php
                        $batas = 8;
                        $halaman = isset($_GET['halaman']) ? (int)$_GET['halaman'] : 1;
                        $halaman_awal = ($halaman > 1) ? ($halaman * $batas) - $batas : 0;

                        $previous = $halaman - 1;
                        $next = $halaman + 1;

                        $data = mysqli_query($conn, "SELECT * FROM tbl_perawat");
                        $jumlah_data = mysqli_num_rows($data);
                        $total_halaman = ceil($jumlah_data / $batas);

                        if ($_POST["search"]) {
                            $search = "AND full_name LIKE '%" . $_POST["search"] . "%' OR nip_perawat LIKE '%" . $_POST["search"] . "%' OR nama_spesialis LIKE '%" . $_POST["search"] . "%'";
                        }

                        $perawat = mysqli_query($conn, "SELECT * FROM tbl_perawat JOIN tbl_spesialis ON tbl_perawat.id_spesialis = tbl_spesialis.id_spesialis WHERE id_perawat " . $search . " ORDER BY full_name ASC LIMIT $halaman_awal, $batas");

                        $show_data = mysqli_num_rows($perawat);

                        while ($row = mysqli_fetch_assoc($perawat)) {
                        ?>

                            <!-- Card item START -->
                            <div class="col-sm-6 col-lg-4 col-xl-3">
                                <div class="card shadow h-100">
                                    <div class="position-relative">
                                        <!-- Image -->
                                        <img src="<?php
                                                    if ($row['profile_picture'] == "") {
                                                        echo "../assets/images/admin/no-preview-available.png";
                                                    } else {
                                                        echo "../assets/images/upload/perawat/" . $row['profile_picture'];
                                                    }
                                                    ?>" class="card-img-top" alt="course image">
                                        <!-- Overlay -->
                                        <div class="card-img-overlay d-flex align-items-start flex-column p-3">
                                            <div class="w-100 mt-auto">
                                                <!-- Category -->
                                                <div class="badge text-dark bg-white fs-6 rounded-1"><i class="bi bi-briefcase-fill me-2"></i></i><?= floor((time() - strtotime($row['joining_date'])) / (60 * 60 * 24 * 365)) . ' Tahun' ?></div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Card body -->
                                    <div class="card-body pb-0 text-center">
                                        <!-- Title -->
                                        <h5 class="card-title mb-0"><a href="#"><?= $row['full_name']; ?></a></h5>
                                        <p class="small mb-2 mb-sm-0"><?= $row['nama_spesialis']; ?></p>
                                    </div>
                                    <!-- Card footer -->
                                    <div class="card-footer pt-0 pb-3">
                                        <hr>
                                        <!-- Address and button -->
                                        <div class="d-flex justify-content-center align-items-center">
                                            <a href="#" data-bs-toggle="modal" data-bs-placement="top" data-bs-target="#modalviewperawat<?= $row['id_perawat'] ?>" title="View" class="btn btn-sm btn-primary-soft mb-0">Selengkapnya</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Card item END -->

                            <!-- Modal View Perawat START -->
                            <div class="modal fade" id="modalviewperawat<?= $row['id_perawat'] ?>" tabindex="-1" aria-labelledby="viewdperawatlabel" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered modal-lg">
                                    <div class="modal-content">

                                        <!-- Modal header -->
                                        <div class="modal-header bg-dark">
                                            <h5 class="modal-title text-white" id="viewperawatlabel"><?= $row['full_name'] ?> Detail</h5>
                                            <button type="button" class="btn btn-sm btn-light mb-0" data-bs-dismiss="modal" aria-label="Close"><i class="bi bi-x-lg"></i></button>
                                        </div>

                                        <!-- Modal body -->
                                        <div class="modal-body p-5">
                                            <!-- Upload image END -->
                                            <div class="position-relative">
                                                <img src="<?php
                                                            if ($row['profile_picture'] == "") {
                                                                echo "../assets/images/admin/no-preview-available.png";
                                                            } else {
                                                                echo "../assets/images/upload/perawat/" . $row['profile_picture'];
                                                            }
                                                            ?>" class="rounded-circle mx-auto d-block mb-3 w-200px" alt="">
                                            </div>

                                            <!-- Nama Dokter -->
                                            <span class="small">Nama Dokter:</span>
                                            <h6 class="mb-3"><?= $row['full_name'] ?> ( <?= $row['nip_perawat'] ?>)</h6>

                                            <!-- Work -->
                                            <span class="small">Work:</span>
                                            <h6 class="mb-3"><i class="bi bi-briefcase-fill me-2 mb-3"><?= floor((time() - strtotime($row['joining_date'])) / (60 * 60 * 24 * 365)) . ' Tahun' ?></i></h6>

                                            <!-- Username -->
                                            <span class="small">Username:</span>
                                            <h6 class="mb-3"><?= $row['username'] ?></h6>

                                            <!-- Mobile Number -->
                                            <span class="small">Mobile number:</span>
                                            <h6 class="mb-3"><?= $row['mobile_number'] ?></h6>

                                            <!-- Spesialis -->
                                            <span class="small">Spesialis:</span>
                                            <h6 class="mb-3"><?= $row['nama_spesialis'] ?></h6>

                                            <!-- Jenis Kelamin -->
                                            <span class="small">Jenis Kelamin:</span>
                                            <?php
                                            if ($row['jenis_kelamin'] == 1) {
                                                echo '<h6 class="mb-3">Laki-Laki</h6>';
                                            } else {
                                                echo '<h6 class="mb-3">Perempuan</h6>';
                                            }
                                            ?>

                                            <!-- Email -->
                                            <span class="small">Email:</span>
                                            <h6 class="mb-3"><?= $row['email'] ?></h6>

                                            <!-- Joining Date -->
                                            <span class="small">Join date:</span>
                                            <h6 class="mb-3"><?= $row['joining_date'] ?></h6>

                                            <!-- Pendidikan -->
                                            <span class="small">Pendidikan:</span>
                                            <h6 class="mb-3"><?= $row['pendidikan'] ?></h6>

                                            <!-- Alamat -->
                                            <span class="small">Alamat:</span>
                                            <h6 class="mb-3"><?= $row['alamat'] ?></h6>

                                            <!-- Summary -->
                                            <span class="small">Deskripsi:</span>
                                            <p class="text-dark mb-2"><?= $row['deskripsi'] ?></p>
                                        </div>

                                        <!-- Modal footer -->
                                        <div class="modal-footer">
                                            <?php
                                            if ($_SESSION['role'] == "") {
                                                echo '<a href="sign-up.php" class="btn btn-success-soft my-0">Sign up</a>';
                                            } else {
                                                echo '<a href="https://wa.me/' . $row['mobile_number'] . '" class="btn btn-success-soft my-0">Buat Janji</a>';
                                            } ?>
                                            <button type="button" class="btn btn-danger-soft my-0" data-bs-dismiss="modal">Close</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Modal View Perawat END -->

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