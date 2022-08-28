<?php require '../head_footer_admin/head.php' ?>

<!-- Page main content START -->
<div class="page-content-wrapper border">

    <!-- Title -->
    <div class="row">
        <div class="col-12">
            <h1 class="h3 mb-2 mb-sm-0">Fasilitas & Pelayanan</h1>
        </div>
    </div>

    <!-- Card START -->
    <div class="card bg-transparent">

        <!-- Card header START -->
        <div class="card-header bg-transparent border-bottom px-0">
            <!-- Search and select START -->
            <div class="row g-3 align-items-center justify-content-between">

                <!-- Search bar -->
                <div class="col-md-8">
                    <form class="rounded position-relative" method="POST" action="">
                        <input class="form-control bg-transparent" type="text" name="search" placeholder="Search" value="<?= $_POST["search"]; ?>" aria-label="Search">
                        <button class="btn bg-transparent px-2 py-0 position-absolute top-50 end-0 translate-middle-y" type="submit"><i class="fas fa-search fs-6 "></i></button>
                    </form>
                </div>

                <!-- Create fasilitas & pelayanan buttons -->
                <div class="col-md-3">
                    <!-- Tabs START -->
                    <ul class="list-inline mb-0 nav nav-pills nav-pill-dark-soft border-0 justify-content-end" id="pills-tab" role="tablist">
                        <!-- Create fasilitas & pelayanan -->
                        <li class="nav-item">
                            <a href="#" class="btn btn-primary-soft me-1 mb-0" data-bs-toggle="modal" data-bs-target="#modalcreatefp">Upload FP</a>
                        </li>
                    </ul>
                    <!-- Create fasilitas & pelayanan end -->
                </div>

            </div>
            <!-- Search and Create fasilitas & pelayanan END -->
        </div>
        <!-- Card header END -->

        <!-- Card body START -->
        <div class="card-body">
            <!-- Course table START -->
            <div class="table-responsive border-0 rounded-3">
                <!-- Table START -->
                <table class="table table-dark-gray align-middle p-4 mb-0 table-hover">
                    <!-- Table head -->
                    <thead>
                        <tr>
                            <th scope="col" class="border-0 rounded-start">Nama FP</th>
                            <th scope="col" class="border-0">status</th>
                            <th scope="col" class="border-0 rounded-end">Action</th>
                        </tr>
                    </thead>

                    <!-- Table body START -->
                    <tbody>
                        <?php
                        $batas = 5;
                        $halaman = isset($_GET['halaman']) ? (int)$_GET['halaman'] : 1;
                        $halaman_awal = ($halaman > 1) ? ($halaman * $batas) - $batas : 0;

                        $previous = $halaman - 1;
                        $next = $halaman + 1;

                        $data = mysqli_query($conn, "SELECT * FROM tbl_fp");
                        $jumlah_data = mysqli_num_rows($data);
                        $total_halaman = ceil($jumlah_data / $batas);

                        if ($_POST["search"]) {
                            $search = "AND nama_fp LIKE '%" . $_POST["search"] . "%' OR admission LIKE '%" . $_POST["search"] . "%'";
                        }

                        $fp = mysqli_query($conn, "SELECT * FROM tbl_fp WHERE id_fp " . $search . " ORDER BY id_fp DESC LIMIT $halaman_awal, $batas");

                        $show_data = mysqli_num_rows($fp);

                        while ($row = mysqli_fetch_assoc($fp)) {
                        ?>
                            <!-- Table row -->
                            <tr>
                                <!-- Table data -->
                                <td>
                                    <div class="d-flex align-items-center position-relative">
                                        <!-- Image -->
                                        <div class="w-60px">
                                            <img src="../assets/images/upload/fp/<?= $row['fp_picture']; ?>" class="rounded" alt="">
                                        </div>
                                        <!-- Title -->
                                        <h6 class="mb-0 ms-2">
                                            <?= $row['nama_fp']; ?>
                                        </h6>
                                    </div>
                                </td>

                                <!-- Table data -->
                                <td>
                                    <div class="d-flex align-items-center">
                                        <?php
                                        if ($row['admission'] == 1) {
                                            echo "<div class='badge bg-success bg-opacity-10 text-success'>Show</div>";
                                        } else {
                                            echo "<div class='badge bg-danger bg-opacity-10 text-danger'>Hide</div>";
                                        }
                                        ?>
                                    </div>
                                </td>

                                <!-- Table data -->
                                <td>
                                    <a href="#" class="btn btn-success-soft me-1 mb-0" data-bs-toggle="modal" data-bs-placement="top" data-bs-target="#modalupdatefp<?= $row['id_fp']; ?>">Edit</a>
                                    <button class="btn btn-danger-soft me-1 mb-0" data-bs-toggle="modal" data-bs-placement="top" data-bs-target="#modaldeletefp<?= $row['id_fp']; ?>">Delete</button>
                                    </button>
                                    <a href="#" class="btn btn-primary-soft me-1 mb-0" data-bs-toggle="modal" data-bs-target="#modalviewfp<?= $row['id_fp']; ?>">View</a>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                    <!-- Table body END -->
                </table>
                <!-- Table END -->
            </div>
            <!-- Course table END -->
        </div>
        <!-- Card body END -->

        <!-- Card footer START -->
        <div class="card-footer bg-transparent p-0">
            <!-- Pagination START -->
            <div class="d-sm-flex justify-content-sm-between align-items-sm-center">
                <!-- Content -->
                <p class="mb-0 text-center text-sm-start">Showing <?= $halaman_awal + 1 ?> to
                    <?= $show_data * ($next - 1) ?> of <?= $jumlah_data ?> Fasilitas & Pelayanan</p>
                <!-- Pagination -->
                <nav class="d-flex justify-content-center mb-0" aria-label="navigation">
                    <ul class="pagination pagination-sm pagination-primary-soft mb-0 pb-0">
                        <li class="page-item mb-0"><a class="page-link" <?php if ($halaman > 1) {
                                                                            echo "href='?halaman=$previous'";
                                                                        } ?>><i class="fas fa-angle-left"></i></a></li>
                        <?php
                        for ($x = 1; $x <= $total_halaman; $x++) {

                            if ($halaman == $x) {
                        ?>
                                <li class="page-item mb-0 active"><a class="page-link" href="?halaman=<?php echo $x ?>"><?php echo $x; ?></a></li>
                            <?php
                            } else {
                            ?>
                                <li class="page-item mb-0"><a class="page-link" href="?halaman=<?php echo $x ?>"><?php echo $x; ?></a></li>
                        <?php }
                        } ?>
                        <li class="page-item mb-0"><a class="page-link" <?php if ($halaman < $total_halaman) {
                                                                            echo "href='?halaman=$next'";
                                                                        } ?>><i class="fas fa-angle-right"></i></a></li>
                    </ul>
                </nav>
            </div>
            <!-- Pagination END -->
        </div>
        <!-- Card footer END -->
    </div>
    <!-- Card END -->
</div>
<!-- Page main content END -->

</div>
<!-- Page content END -->

</main>
<!-- **************** MAIN CONTENT END **************** -->

<!-- Modal Upload Fasilitas & Pelayanan START -->
<div class="modal fade" id="modalcreatefp" tabindex="-1" aria-labelledby="createfplabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">

            <!-- Modal header -->
            <div class="modal-header bg-dark">
                <h5 class="modal-title text-white" id="createfplabel">Upload FP</h5>
                <button type="button" class="btn btn-sm btn-light mb-0" data-bs-dismiss="modal" aria-label="Close"><i class="bi bi-x-lg"></i></button>
            </div>

            <form action="../connection/function.php" method="POST" enctype="multipart/form-data">
                <!-- Modal body -->
                <div class="modal-body p-5">
                    <div class="row g-4">
                        <div class="col-md-6">
                            <label class="form-label">Nama FP</label>
                            <input class="form-control" name="nama_fp" type="text" placeholder="Masukkan nama FP" autofocus required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Status</label>
                            <select class="form-select js-choice border-0 z-index-9 bg-transparent" aria-label=".form-select-sm" data-search-enabled="true" name="admission" required>
                                <option value="">Select status</option>
                                <option value="1">Show</option>
                                <option value="2">Hide</option>
                            </select>
                        </div>
                        <div class="col-md-12">
                            <label class="form-label">Deskripsi Short</label>
                            <textarea class="form-control" name="deskripsi_short" rows="3" placeholder="Masukkan Deskripsi Short"></textarea>
                        </div>
                        <!-- Upload image START -->
                        <div class="col-12">
                            <div class="text-center justify-content-center align-items-center p-4 p-sm-5 border border-2 border-dashed position-relative rounded-3">
                                <!-- Image -->
                                <img src="../assets/images/element/gallery.svg" class="h-50px" alt="">
                                <div>
                                    <h6 class="my-2">Upload Fp Picture</a></h6>
                                    <label style="cursor:pointer;">
                                        <span>
                                            <input class="form-control stretched-link" type="file" name="fp_picture" id="image" />
                                        </span>
                                    </label>
                                    <p class="small mb-0 mt-2"><b>Note:</b> Only JPG, JPEG and PNG. Our suggested
                                        dimensions are 600px * 525px.</p>
                                </div>
                            </div>
                        </div>
                        <!-- Upload image END -->
                    </div>
                </div>
                <!-- Modal footer -->
                <div class="modal-footer">
                    <input type="submit" class="btn btn-success-soft my-0" name="create_fp" value="Save">
                    <button type="button" class="btn btn-danger-soft my-0" data-bs-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- Modal Upload Fasilitas & Pelayanan END -->

<?php
$fp = mysqli_query($conn, "SELECT * FROM tbl_fp");

while ($row = mysqli_fetch_assoc($fp)) {
?>
    <!-- Modal Update Fasilitas & Pelayanan START -->
    <div class="modal fade" id="modalupdatefp<?= $row['id_fp']; ?>" tabindex="-1" aria-labelledby="updatefplabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">

                <!-- Modal header -->
                <div class="modal-header bg-dark">
                    <h5 class="modal-title text-white" id="updatefplabel">Update FP</h5>
                    <button type="button" class="btn btn-sm btn-light mb-0" data-bs-dismiss="modal" aria-label="Close"><i class="bi bi-x-lg"></i></button>
                </div>

                <form action="../connection/function.php" method="POST" enctype="multipart/form-data">
                    <!-- Modal body -->
                    <div class="modal-body p-5">
                        <div class="row g-4">
                            <div class="col-md-6">
                                <label class="form-label">Nama FP</label>
                                <input class="form-control" name="nama_fp" type="text" value="<?= $row['nama_fp']; ?>" placeholder="Masukkan nama FP" autofocus required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Status</label>
                                <select class="form-select js-choice border-0 z-index-9 bg-transparent" aria-label=".form-select-sm" data-search-enabled="true" name="admission" required>
                                    <?php
                                    if ($row['admission'] == 1) {
                                        echo '<option value="">Select status</option>';
                                        echo '<option value="1" selected>Show</option>';
                                        echo '<option value="2">Hide</option>';
                                    } else if ($row['admission'] == 2) {
                                        echo '<option value="">Select status</option>';
                                        echo '<option value="1">Show</option>';
                                        echo '<option value="2" selected>Hide</option>';
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="col-md-12">
                                <label class="form-label">Deskripsi Short</label>
                                <textarea class="form-control" name="deskripsi_short" rows="3" placeholder="Masukkan Deskripsi Short"><?= $row['deskripsi_short']; ?></textarea>
                            </div>
                            <!-- Upload image START -->
                            <div class="col-12">
                                <div class="text-center justify-content-center align-items-center p-4 p-sm-5 border border-2 border-dashed position-relative rounded-3">
                                    <!-- Image -->
                                    <img src="../assets/images/element/gallery.svg" class="h-50px" alt="">
                                    <div>
                                        <h6 class="my-2">Upload Fp Picture</a></h6>
                                        <label style="cursor:pointer;">
                                            <span>
                                                <input class="form-control stretched-link" type="file" name="fp_picture" id="image" />
                                            </span>
                                        </label>
                                        <p class="small mb-0 mt-2"><b>Note:</b> Only JPG, JPEG and PNG. Our suggested
                                            dimensions are 600px * 525px.</p>
                                    </div>
                                </div>
                            </div>
                            <!-- Upload image END -->
                            <h5 class="mt-4">Fp Picture</h5>
                            <div class="position-relative">
                                <img src="../assets/images/upload/fp/<?= $row['fp_picture']; ?>" class="rounded" alt="">
                            </div>
                        </div>
                    </div>
                    <!-- Modal footer -->
                    <div class="modal-footer">
                        <input type="hidden" name="id_fp" value="<?= $row['id_fp']; ?>">
                        <input type="submit" class="btn btn-success-soft my-0" name="update_fp" value="Update">
                        <button type="button" class="btn btn-danger-soft my-0" data-bs-dismiss="modal">Close</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Modal Update Fasilitas & Pelayanan END -->

    <!-- Modal Delete Fasilitas & Pelayanan START -->
    <div class="modal fade" id="modaldeletefp<?= $row['id_fp']; ?>" tabindex="-1" aria-labelledby="deletefplabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">

                <!-- Modal header -->
                <div class="modal-header bg-dark">
                    <h5 class="modal-title text-white" id="deletefplabel">Fp akan terhapus</h5>
                    <button type="button" class="btn btn-sm btn-light mb-0" data-bs-dismiss="modal" aria-label="Close"><i class="bi bi-x-lg"></i></button>
                </div>

                <div class="modal-body text-center py-4">
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon mb-2 text-danger icon-lg" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                        <path d="M12 9v2m0 4v.01" />
                        <path d="M5 19h14a2 2 0 0 0 1.84 -2.75l-7.1 -12.25a2 2 0 0 0 -3.5 0l-7.1 12.25a2 2 0 0 0 1.75 2.75" />
                    </svg>
                    <h3>Are you sure?</h3>
                    <div class="text-muted">Apakah anda benar-benar ingin menghapus Fasilitas & Pelayanan <span style="color:black; font-weight:bold;"><?= $row['nama_fp']; ?></span>? apa yang telah anda
                        lakukan tidak dapat dibatalkan.
                    </div>
                </div>

                <form action="../connection/function.php" method="POST">
                    <!-- Modal footer -->
                    <div class="modal-footer">
                        <input type="hidden" name="id_fp" value="<?= $row['id_fp']; ?>">
                        <input type="submit" class="btn btn-success-soft my-0" name="delete_fp" value="Delete">
                        <button type="button" class="btn btn-danger-soft my-0" data-bs-dismiss="modal">Close</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Modal Delete Fasilitas & Pelayanan END -->

    <!-- Modal View Fasilitas & Pelayanan START -->
    <div class="modal fade" id="modalviewfp<?= $row['id_fp']; ?>" tabindex="-1" aria-labelledby="viewfplabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">

                <!-- Modal header -->
                <div class="modal-header bg-dark">
                    <h5 class="modal-title text-white" id="viewfplabel"><?= $row['judul_fp']; ?> Detail</h5>
                    <button type="button" class="btn btn-sm btn-light mb-0" data-bs-dismiss="modal" aria-label="Close"><i class="bi bi-x-lg"></i></button>
                </div>

                <!-- Modal body -->
                <div class="modal-body p-5">
                    <!-- Upload image END -->
                    <div class="position-relative">
                        <img src="../assets/images/upload/fp/<?= $row['fp_picture']; ?>" class="rounded mb-3" alt="">
                    </div>

                    <!-- Judul Artikel -->
                    <span class="small">Nama FP:</span>
                    <h6><?= $row['nama_fp']; ?></h6>
                    <span class="small mb-3"></span>

                    <!-- Summary -->
                    <span class="small">Deskripsi:</span>
                    <p class="text-dark mb-2"><?= $row['deskripsi_short']; ?></p>

                </div>

                <!-- Modal footer -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger-soft my-0" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal View Fasilitas & Pelayanan END -->
<?php } ?>

<?php require '../head_footer_admin/footer.php' ?>