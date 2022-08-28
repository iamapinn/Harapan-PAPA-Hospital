<?php require '../head_footer_pages/head.php' ?>

<!-- **************** MAIN CONTENT START **************** -->
<main>
    <section class="py-0">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="bg-light p-4 rounded-3 position-relative overflow-hidden">

                        <!-- Svg decoration -->
                        <figure class="position-absolute top-0 end-0 mt-5">
                            <svg width="566.3px" height="353.7px" viewBox="0 0 566.3 353.7">
                                <path stroke="#17a2b8" fill="none" d="M525.1,4c8.1,0.7,14.9,7.2,17.9,14.8c3,7.6,3,16,2.1,24.1c-4.7,44.3-32.1,84.7-69.4,108.9 c-37.4,24.2-83.7,32.8-127.9,27.6c-32.3-3.8-63.5-14.5-95.9-16.6c-21.6-1.4-45.6,2.1-60.1,18.3c-7.7,8.5-11.8,19.6-14.8,30.7 c-7.9,29.5-9,60.8-19.7,89.5c-5.5,14.8-14,29.1-27.1,38c-15.6,10.5-35.6,12-54.2,9.5c-18.6-2.5-36.5-8.6-55-12.1" />
                                <path stroke="#F99D2B" fill="none" d="M560.7,0.2c10,18.3,3.7,41.1-5,60.1c-11.8,25.9-28,50.3-50.2,68.2c-29,23.3-66.3,34-103.2,38.6 c-36.9,4.6-74.3,3.8-111.3,7.2c-22.3,2-45.3,5.9-63.5,19c-26.8,19.2-39,55.3-68.3,70.4c-38.2,19.6-89.7-4.9-125.6,18.8 c-22.6,15-30.7,44.2-33.3,71.2" />
                            </svg>
                        </figure>

                        <div class="row position-relative align-items-center">

                            <!-- Content -->
                            <div class="col-md-6 px-md-5">
                                <!-- Title -->
                                <h1 class="mb-3">Welcome to our online farmasi store!</h1>
                                <p class="mb-3">Expand knowledge by reading book Two before narrow not relied on how
                                    except moment myself Dejection assurance. </p>

                                <!-- Search -->
                                <form class="bg-body rounded p-2" method="POST">
                                    <div class="input-group">
                                        <input class="form-control border-0 me-1" type="search" name="search" placeholder="Search farmasi" value="<?= $_POST["search"] ?>">
                                    </div>
                                </form>
                            </div>

                            <!-- Image -->
                            <div class="col-md-6 text-center">
                                <img src="assets/images/book/book-bg.svg" alt="">
                            </div>
                        </div> <!-- Row END -->
                    </div>
                </div>
            </div> <!-- Row END -->
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
                <div class="col-12">

                    <!-- Search option START -->
                    <div class="row mb-4 align-items-center">

                        <!-- Title -->
                        <div class="col-md-8">
                            <h5 class="mb-0">All Listed Farmasi or Vitamin</h5>
                        </div>
                    </div>
                    <!-- Search option END -->

                    <!-- Book Grid START -->
                    <div class="row g-4">
                        <?php
                        $batas = 18;
                        $halaman = isset($_GET['halaman']) ? (int)$_GET['halaman'] : 1;
                        $halaman_awal = ($halaman > 1) ? ($halaman * $batas) - $batas : 0;

                        $previous = $halaman - 1;
                        $next = $halaman + 1;

                        $data = mysqli_query($conn, "SELECT * FROM tbl_farmasi WHERE admission = 1");
                        $jumlah_data = mysqli_num_rows($data);
                        $total_halaman = ceil($jumlah_data / $batas);

                        if ($_POST["search"]) {
                            $search = "AND nama_obat LIKE '%" . $_POST["search"] . "%' OR nama_kategori LIKE '%" . $_POST["search"] . "%'";
                        }

                        $farmasi = mysqli_query($conn, "SELECT * FROM tbl_farmasi JOIN tbl_obat ON tbl_farmasi.id_kategori_obat = tbl_obat.id_kategori_obat WHERE admission = 1 AND id_farmasi " . $search . " ORDER BY nama_obat ASC LIMIT $halaman_awal, $batas");

                        $show_data = mysqli_num_rows($farmasi);

                        while ($row = mysqli_fetch_assoc($farmasi)) {
                        ?>
                            <!-- Card item START -->
                            <div class="col-sm-4 col-lg-4 col-xl-2">
                                <div class="card shadow h-100">
                                    <div class="position-relative">
                                        <!-- Image -->
                                        <img src="<?php
                                                    if ($row['obat_picture'] == "") {
                                                        echo "../assets/images/admin/no-preview-available.png";
                                                    } else {
                                                        echo "../assets/images/upload/farmasi/" . $row['obat_picture'];
                                                    }
                                                    ?>" class="card-img-top" alt="<?= $row['nama_obat']; ?>">
                                        <!-- Overlay -->
                                    </div>

                                    <!-- Card body -->
                                    <div class="card-body px-3">
                                        <!-- Title -->
                                        <h6 class="card-title mb-0">
                                            <a href="#" class="stretched-link" data-bs-toggle="modal" data-bs-target="#modalviewobat<?= $row['id_farmasi'] ?>"><?= $row['nama_obat']; ?></a>
                                        </h6>
                                    </div>

                                    <!-- Card footer -->
                                    <div class="card-footer pt-0 px-3">
                                        <div class="justify-content-center align-items-center text-center">
                                            <span class="h6 fw-light mb-0">
                                                <div class="badge text-black"><?= $row['nama_kategori']; ?>
                                                </div> <br>
                                                <?php
                                                if ($row['jenis'] == 1) {
                                                    echo "<div class='badge bg-secondary bg-opacity-10 text-secondary'>Per Strip</div>";
                                                } else if ($row['jenis'] == 2) {
                                                    echo "<div class='badge bg-secondary bg-opacity-10 text-secondary'>Per Botol</div>";
                                                } else if ($row['jenis'] == 3) {
                                                    echo "<div class='badge bg-secondary bg-opacity-10 text-secondary'>Per Pack</div>";
                                                } else if ($row['jenis'] == 4) {
                                                    echo "<div class='badge bg-secondary bg-opacity-10 text-secondary'>Per Box</div>";
                                                }
                                                ?>
                                            </span> <br>
                                            <!-- Price -->
                                            <h8 class="text-success mb-0">
                                                Rp. <?= $row['harga']; ?>
                                            </h8>
                                        </div>
                                    </div>
                                    <a href="#" class="btn btn-sm btn-primary mb-0" style="border-radius: 0 0 10px 10px" data-bs-toggle="modal" data-bs-target="#modalviewobat<?= $row['id_farmasi'] ?>">View Product</a>
                                </div>
                            </div>
                            <!-- Card item END -->
                            <!-- Modal View obat START -->
                            <div class="modal fade" id="modalviewobat<?= $row['id_farmasi'] ?>" tabindex="-1" aria-labelledby="viewobatlabel" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered modal-lg">
                                    <div class="modal-content">

                                        <!-- Modal header -->
                                        <div class="modal-header bg-dark">
                                            <h5 class="modal-title text-white" id="viewobatlabel"><?= $row['nama_obat'] ?> Detail</h5>
                                            <button type="button" class="btn btn-sm btn-light mb-0" data-bs-dismiss="modal" aria-label="Close"><i class="bi bi-x-lg"></i></button>
                                        </div>

                                        <!-- Modal body -->
                                        <div class="modal-body p-5">
                                            <!-- Upload image END -->
                                            <div class="position-relative rounded-circle mx-auto w-200px">
                                                <img src="<?php
                                                            if ($row['obat_picture'] == "") {
                                                                echo "../assets/images/admin/no-preview-available.png";
                                                            } else {
                                                                echo "../assets/images/upload/farmasi/" . $row['obat_picture'];
                                                            }
                                                            ?>" class="card-img-top" alt="<?= $row['nama_obat']; ?>" class="mb-3" alt="">
                                            </div>

                                            <!-- Nama Obat -->
                                            <span class="small">Nama Obat:</span>
                                            <h6 class="mb-3"><?= $row['nama_obat'] ?></h6>

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
                                                echo '<a href="' . $row['link'] . '" class="btn btn-success-soft my-0">Beli</a>';
                                            } ?>
                                            <button type="button" class="btn btn-danger-soft my-0" data-bs-dismiss="modal">Close</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Modal View obat END -->

                        <?php } ?>

                    </div>
                    <!-- Book Grid END -->

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
Gallery START -->
    <section class="bg-light position-relative">

        <div class="container">
            <!-- Gallery START -->
            <div class="row g-4 align-items-center justify-content-between">
                <!-- Content -->
                <div class="col-md-6 col-xl-4">
                    <h2 class="fs-1">Galeri</h2>
                </div>

                <!-- Gallery START -->
                <div class="col-md-6 col-xl-8">
                    <div class="row">
                        <!-- Slider START -->
                        <div class="tiny-slider arrow-round arrow-blur">
                            <div class="tiny-slider-inner" data-autoplay="2000" data-edge="2" data-arrow="true" data-dots="false" data-items-lg="1" data-items-xl="2">

                                <!-- Card item START -->
                                <div>
                                    <div class="card p-2">
                                        <div class="position-relative">
                                            <!-- Image -->
                                            <img src="../assets/images/farmasi/1.jpg" class="card-img rounded-2" alt="Card image">
                                            <div class="card-img-overlay">
                                                <div class="position-absolute top-50 start-50 translate-middle">

                                                    <!-- Full screen button -->
                                                    <a class="card-element-hover position-absolute top-50 start-50 translate-middle bg-dark rounded-3 p-2 lh-1" data-glightbox="" data-gallery="galeri-igd" href="assets/images/farmasi/1.jpg">
                                                        <i class="bi bi-fullscreen fa-fw fs-6 text-white"></i>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- Card item END -->
                                <!-- Card item START -->
                                <div>
                                    <div class="card p-2">
                                        <div class="position-relative">
                                            <!-- Image -->
                                            <img src="../assets/images/farmasi/2.jpg" class="card-img rounded-2" alt="Card image">
                                            <div class="card-img-overlay">
                                                <div class="position-absolute top-50 start-50 translate-middle">

                                                    <!-- Full screen button -->
                                                    <a class="card-element-hover position-absolute top-50 start-50 translate-middle bg-dark rounded-3 p-2 lh-1" data-glightbox="" data-gallery="galeri-igd" href="assets/images/farmasi/2.jpg">
                                                        <i class="bi bi-fullscreen fa-fw fs-6 text-white"></i>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- Card item END -->
                                <!-- Card item START -->
                                <div>
                                    <div class="card p-2">
                                        <div class="position-relative">
                                            <!-- Image -->
                                            <img src="../assets/images/farmasi/3.jpg" class="card-img rounded-2" alt="Card image">
                                            <div class="card-img-overlay">
                                                <div class="position-absolute top-50 start-50 translate-middle">

                                                    <!-- Full screen button -->
                                                    <a class="card-element-hover position-absolute top-50 start-50 translate-middle bg-dark rounded-3 p-2 lh-1" data-glightbox="" data-gallery="galeri-igd" href="assets/images/farmasi/3.jpg">
                                                        <i class="bi bi-fullscreen fa-fw fs-6 text-white"></i>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- Card item END -->
                                <!-- Card item START -->
                                <div>
                                    <div class="card p-2">
                                        <div class="position-relative">
                                            <!-- Image -->
                                            <img src="../assets/images/farmasi/4.jpg" class="card-img rounded-2" alt="Card image">
                                            <div class="card-img-overlay">
                                                <div class="position-absolute top-50 start-50 translate-middle">

                                                    <!-- Full screen button -->
                                                    <a class="card-element-hover position-absolute top-50 start-50 translate-middle bg-dark rounded-3 p-2 lh-1" data-glightbox="" data-gallery="galeri-igd" href="assets/images/farmasi/4.jpg">
                                                        <i class="bi bi-fullscreen fa-fw fs-6 text-white"></i>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- Card item END -->
                                <!-- Card item START -->
                                <div>
                                    <div class="card p-2">
                                        <div class="position-relative">
                                            <!-- Image -->
                                            <img src="../assets/images/farmasi/5.jpg" class="card-img rounded-2" alt="Card image">
                                            <div class="card-img-overlay">
                                                <div class="position-absolute top-50 start-50 translate-middle">

                                                    <!-- Full screen button -->
                                                    <a class="card-element-hover position-absolute top-50 start-50 translate-middle bg-dark rounded-3 p-2 lh-1" data-glightbox="" data-gallery="galeri-igd" href="assets/images/farmasi/5.jpg">
                                                        <i class="bi bi-fullscreen fa-fw fs-6 text-white"></i>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- Card item END -->
                                <!-- Card item START -->
                                <div>
                                    <div class="card p-2">
                                        <div class="position-relative">
                                            <!-- Image -->
                                            <img src="../assets/images/farmasi/6.jpg" class="card-img rounded-2" alt="Card image">
                                            <div class="card-img-overlay">
                                                <div class="position-absolute top-50 start-50 translate-middle">

                                                    <!-- Full screen button -->
                                                    <a class="card-element-hover position-absolute top-50 start-50 translate-middle bg-dark rounded-3 p-2 lh-1" data-glightbox="" data-gallery="galeri-igd" href="assets/images/farmasi/6.jpg">
                                                        <i class="bi bi-fullscreen fa-fw fs-6 text-white"></i>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- Card item END -->

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
Gallery END -->

</main>
<!-- **************** MAIN CONTENT END **************** -->

<?php require '../head_footer_pages/footer.php' ?>