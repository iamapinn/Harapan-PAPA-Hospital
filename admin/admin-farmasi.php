<?php require '../head_footer_admin/head.php' ?>


<!-- Page main content START -->
<div class="page-content-wrapper border">

    <!-- Title -->
    <div class="row">
        <div class="col-12">
            <h1 class="h3 mb-2 mb-sm-0">Farmasi</h1>
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
                        <input class="form-control bg-transparent" type="text" name="search" placeholder="Search" value="<?= $_POST["search"] ?>" aria-label="Search">
                        <button class="btn bg-transparent px-2 py-0 position-absolute top-50 end-0 translate-middle-y" type="submit"><i class="fas fa-search fs-6 "></i></button>
                    </form>
                </div>

                <!-- Create farmasi buttons -->
                <div class="col-md-3">
                    <!-- Tabs START -->
                    <ul class="list-inline mb-0 nav nav-pills nav-pill-dark-soft border-0 justify-content-end" id="pills-tab" role="tablist">
                        <!-- Create farmasi -->
                        <li class="nav-item">
                            <a href="#" class="btn btn-primary-soft me-1 mb-0" data-bs-toggle="modal" data-bs-target="#modalcreateobat">Tambah Obat</a>
                        </li>
                    </ul>
                    <!-- Create farmasi end -->
                </div>

            </div>
            <!-- Search and Create farmasi END -->
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
                            <th scope="col" class="border-0 rounded-start">Nama Obat</th>
                            <th scope="col" class="border-0">Kategori</th>
                            <th scope="col" class="border-0">Jenis</th>
                            <th scope="col" class="border-0">Harga</th>
                            <th scope="col" class="border-0">status</th>
                            <th scope="col" class="border-0 rounded-end">Action</th>
                        </tr>
                    </thead>

                    <!-- Table body START -->
                    <tbody>
                        <?php
                        $batas = 20;
                        $halaman = isset($_GET['halaman']) ? (int)$_GET['halaman'] : 1;
                        $halaman_awal = ($halaman > 1) ? ($halaman * $batas) - $batas : 0;

                        $previous = $halaman - 1;
                        $next = $halaman + 1;

                        $data = mysqli_query($conn, "SELECT * FROM tbl_farmasi");
                        $jumlah_data = mysqli_num_rows($data);
                        $total_halaman = ceil($jumlah_data / $batas);

                        if ($_POST["search"]) {
                            $search = "AND nama_obat LIKE '%" . $_POST["search"] . "%' OR nama_obat LIKE '%" . $_POST["search"] . "%'";
                        }

                        $farmasi = mysqli_query($conn, "SELECT * FROM tbl_farmasi JOIN tbl_obat ON tbl_farmasi.id_kategori_obat = tbl_obat.id_kategori_obat WHERE id_farmasi " . $search . " ORDER BY nama_obat ASC LIMIT $halaman_awal, $batas");

                        $show_data = mysqli_num_rows($farmasi);

                        while ($row = mysqli_fetch_assoc($farmasi)) {
                        ?>
                            <!-- Table row -->
                            <tr>
                                <!-- Table data -->
                                <td>
                                    <div class="d-flex align-items-center position-relative">
                                        <!-- Image -->
                                        <div class="w-60px">
                                            <img src="../assets/images/upload/farmasi/<?= $row['obat_picture']; ?>" class="rounded" alt="">
                                        </div>
                                        <!-- Title -->
                                        <h6 class="mb-0 ms-2">
                                            <a href="#" class="stretched-link"><?= $row['nama_obat']; ?></a>
                                        </h6>
                                    </div>
                                </td>

                                <!-- Table data -->
                                <td class="text-center text-sm-start">
                                    <?php
                                    if ($row['kategori_obat'] == 1) {
                                        echo "<h6 class'mb-0'>" . $row['nama_kategori'] . "</h6>";
                                    } ?>
                                </td>

                                <!-- Table data -->
                                <td>
                                    <div class="d-flex align-items-center">
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
                                    </div>
                                </td>

                                <!-- Table data -->
                                <td>Rp. <?= $row['harga']; ?></td>

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
                                    <a href="#" class="btn btn-success-soft me-1 mb-0" data-bs-toggle="modal" data-bs-placement="top" data-bs-target="#modalupdateobat<?= $row['id_farmasi'] ?>">Edit</a>
                                    <button class="btn btn-danger-soft me-1 mb-0" data-bs-toggle="modal" data-bs-placement="top" data-bs-target="#modaldeleteobat<?= $row['id_farmasi'] ?>">Delete</button>
                                    </button>
                                    <a href="#" class="btn btn-primary-soft me-1 mb-0" data-bs-toggle="modal" data-bs-target="#modalviewobat<?= $row['id_farmasi'] ?>">View</a>
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
                    <?= $show_data * ($next - 1) ?> of <?= $jumlah_data ?> Obat</p>
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

<!-- Modal Tambah obat START -->
<div class="modal fade" id="modalcreateobat" tabindex="-1" aria-labelledby="createobatlabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">

            <!-- Modal header -->
            <div class="modal-header bg-dark">
                <h5 class="modal-title text-white" id="createobatlabel">Tambah Obat</h5>
                <button type="button" class="btn btn-sm btn-light mb-0" data-bs-dismiss="modal" aria-label="Close"><i class="bi bi-x-lg"></i></button>
            </div>

            <form action="../connection/function.php" method="POST" enctype="multipart/form-data">
                <!-- Modal body -->
                <div class="modal-body p-5">
                    <div class="row g-4">
                        <div class="col-md-6">
                            <label class="form-label">Nama Obat</label>
                            <input class="form-control" name="nama_obat" type="text" placeholder="Masukkan nama obat" autofocus required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Status</label>
                            <select class="form-select js-choice border-0 z-index-9 bg-transparent" aria-label=".form-select-sm" data-search-enabled="true" name="admission" required>
                                <option value="">Select status</option>
                                <option value="1">Show</option>
                                <option value="2">Hide</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Jenis</label>
                            <select class="form-select js-choice border-0 z-index-9 bg-transparent" aria-label=".form-select-sm" data-search-enabled="true" name="jenis" required>
                                <option value="">Select Jenis</option>
                                <option value="1">Per Strip</option>
                                <option value="2">Per Botol</option>
                                <option value="3">Per Pack</option>
                                <option value="4">Per Box</option>
                            </select>
                        </div>
                        <div class=" col-md-6">
                            <label class="form-label">Harga</label>
                            <input class="form-control" name="harga" type="text" placeholder="Masukkan harga" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Kategori Obat</label>
                            <select class="form-select js-choice border-0 z-index-9 bg-transparent" aria-label=".form-select-sm" data-search-enabled="true" name="id_kategori_obat" required>
                                <option value="">Select category</option>
                                <?php
                                $kategori_obatt = mysqli_query($conn, "SELECT * FROM tbl_obat WHERE kategori_obat=1 ORDER BY nama_kategori ASC");
                                while ($dataa = mysqli_fetch_assoc($kategori_obatt)) {
                                    echo '<option value="' . $dataa['id_kategori_obat'] . '">' . $dataa['nama_kategori'] . '</option>';
                                }
                                ?>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Link</label>
                            <input class="form-control" name="link" type="text" placeholder="Masukkan link obat" required>
                        </div>
                        <div class="col-md-12">
                            <label class="form-label">Deskripsi</label>
                            <textarea class="form-control" name="deskripsi" id="summernote" rows="10" placeholder="Masukkan Deskripsi" required></textarea>
                        </div>
                        <!-- Upload image START -->
                        <div class="col-12">
                            <div class="text-center justify-content-center align-items-center p-4 p-sm-5 border border-2 border-dashed position-relative rounded-3">
                                <!-- Image -->
                                <img src="../assets/images/element/gallery.svg" class="h-50px" alt="">
                                <div>
                                    <h6 class="my-2">Upload Obat Picture</a></h6>
                                    <label style="cursor:pointer;">
                                        <span>
                                            <input class="form-control stretched-link" type="file" name="obat_picture" id="image" />
                                        </span>
                                    </label>
                                    <p class="small mb-0 mt-2"><b>Note:</b> Only JPG, JPEG and PNG. Our suggested
                                        dimensions are 365px * 365px.</p>
                                </div>
                            </div>
                        </div>
                        <!-- Upload image END -->
                    </div>
                </div>
                <!-- Modal footer -->
                <div class="modal-footer">
                    <input type="submit" class="btn btn-success-soft my-0" name="create_obat" value="Save">
                    <button type="button" class="btn btn-danger-soft my-0" data-bs-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- Modal Tambah obat END -->

<?php
$farmasi = mysqli_query($conn, "SELECT * FROM tbl_farmasi ORDER BY nama_obat ASC");

while ($row = mysqli_fetch_assoc($farmasi)) {
?>
    <!-- Modal Update obat START -->
    <div class="modal fade" id="modalupdateobat<?= $row['id_farmasi'] ?>" tabindex="-1" aria-labelledby="updateobatlabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">

                <!-- Modal header -->
                <div class="modal-header bg-dark">
                    <h5 class="modal-title text-white" id="updateobatlabel">Update Obat</h5>
                    <button type="button" class="btn btn-sm btn-light mb-0" data-bs-dismiss="modal" aria-label="Close"><i class="bi bi-x-lg"></i></button>
                </div>

                <form action="../connection/function.php" method="POST" enctype="multipart/form-data">
                    <!-- Modal body -->
                    <div class="modal-body p-5">
                        <div class="row g-4">
                            <div class="col-md-6">
                                <label class="form-label">Nama Obat</label>
                                <input class="form-control" name="nama_obat" type="text" value="<?= $row['nama_obat']; ?>" placeholder="Masukkan nama obat" autofocus required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Jenis</label>
                                <select class="form-select js-choice border-0 z-index-9 bg-transparent" aria-label=".form-select-sm" data-search-enabled="true" name="jenis" required>
                                    <?php
                                    if ($row['jenis'] == 1) {
                                        echo '<option value="">Select Jenis</option>';
                                        echo '<option value="1" selected>Per Strip</option>';
                                        echo '<option value="2">Per Botol</option>';
                                        echo '<option value="3">Per Pack</option>';
                                        echo '<option value="4">Per Box</option>';
                                    } else if ($row['jenis'] == 2) {
                                        echo '<option value="">Select admission</option>';
                                        echo '<option value="1">Per Strip</option>';
                                        echo '<option value="2" selected>Per Botol</option>';
                                        echo '<option value="3">Per Pack</option>';
                                        echo '<option value="4">Per Box</option>';
                                    } else if ($row['jenis'] == 3) {
                                        echo '<option value="">Select admission</option>';
                                        echo '<option value="1">Per Strip</option>';
                                        echo '<option value="2">Per Botol</option>';
                                        echo '<option value="3" selected>Per Pack</option>';
                                        echo '<option value="4">Per Box</option>';
                                    } else if ($row['jenis'] == 4) {
                                        echo '<option value="">Select admission</option>';
                                        echo '<option value="1">Per Strip</option>';
                                        echo '<option value="2">Per Botol</option>';
                                        echo '<option value="3">Per Pack</option>';
                                        echo '<option value="4" selected>Per Box</option>';
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class=" col-md-6">
                                <label class="form-label">Harga</label>
                                <input class="form-control" name="harga" type="text" placeholder="Masukkan harga" value="<?= $row['harga']; ?>" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Kategori Obat</label>
                                <select class="form-select js-choice border-0 z-index-9 bg-transparent" aria-label=".form-select-sm" data-search-enabled="true" name="id_kategori_obat" required>
                                    <option value="">Select category</option>
                                    <?php
                                    $kategori_obatt = mysqli_query($conn, "SELECT * FROM tbl_obat WHERE kategori_obat=1 ORDER BY nama_kategori ASC");
                                    while ($dataa = mysqli_fetch_assoc($kategori_obatt)) {
                                        echo '<option value="' . $dataa['id_kategori_obat'] . '" ' . ($dataa['id_kategori_obat'] == $row['id_kategori_obat'] ? 'selected' : '') . '>' . $dataa['nama_kategori'] . '</option>';
                                    } ?>
                                </select>
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
                            <div class="col-md-6">
                                <label class="form-label">Link</label>
                                <input class="form-control" name="link" type="text" value="<?= $row['link']; ?>" placeholder="Masukkan link obat" required>
                            </div>
                            <div class="col-md-12">
                                <label class="form-label">Deskripsi</label>
                                <textarea class="form-control" id="summernoteupdate<?= $row['id_farmasi'] ?>" name="deskripsi" rows="10" placeholder="Masukkan Deskripsi" required><?= $row['deskripsi']; ?></textarea>
                            </div>
                            <!-- Upload image START -->
                            <div class="col-12">
                                <div class="text-center justify-content-center align-items-center p-4 p-sm-5 border border-2 border-dashed position-relative rounded-3">
                                    <!-- Image -->
                                    <img src="../assets/images/element/gallery.svg" class="h-50px" alt="">
                                    <div>
                                        <h6 class="my-2">Upload Obat Picture</a></h6>
                                        <label style="cursor:pointer;">
                                            <span>
                                                <input class="form-control stretched-link" type="file" name="obat_picture" id="image" />
                                            </span>
                                        </label>
                                        <p class="small mb-0 mt-2"><b>Note:</b> Only JPG, JPEG and PNG. Our suggested
                                            dimensions are 346px * 346px.</p>
                                    </div>
                                </div>
                            </div>
                            <!-- Upload image END -->
                            <h5 class="mt-4">Obat Picture</h5>
                            <div class="position-relative">
                                <img src="../assets/images/upload/farmasi/<?= $row['obat_picture']; ?>" class="rounded mx-auto d-block" alt="">
                            </div>
                        </div>
                    </div>
                    <!-- Modal footer -->
                    <div class="modal-footer">
                        <input type="hidden" name="id_farmasi" value="<?= $row['id_farmasi'] ?>">
                        <input type="submit" class="btn btn-success-soft my-0" name="update_obat" value="Update">
                        <button type="button" class="btn btn-danger-soft my-0" data-bs-dismiss="modal">Close</button>
                    </div>
                </form>
            </div>
        </div>
        <script>
            $(document).ready(function() {
                $('#summernoteupdate<?= $row['id_farmasi'] ?>').summernote({
                    height: 300, // set editor height
                    focus: true // set focus to editable area after initializing summernote
                });
            });
        </script>
    </div>
    <!-- Modal Update obat END -->

    <!-- Modal Delete obat START -->
    <div class="modal fade" id="modaldeleteobat<?= $row['id_farmasi'] ?>" tabindex="-1" aria-labelledby="deleteobatlabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">

                <!-- Modal header -->
                <div class="modal-header bg-dark">
                    <h5 class="modal-title text-white" id="deleteobatlabel">Data Obat akan terhapus</h5>
                    <button type="button" class="btn btn-sm btn-light mb-0" data-bs-dismiss="modal" aria-label="Close"><i class="bi bi-x-lg"></i></button>
                </div>

                <div class="modal-body text-center py-4">
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon mb-2 text-danger icon-lg" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                        <path d="M12 9v2m0 4v.01" />
                        <path d="M5 19h14a2 2 0 0 0 1.84 -2.75l-7.1 -12.25a2 2 0 0 0 -3.5 0l-7.1 12.25a2 2 0 0 0 1.75 2.75" />
                    </svg>
                    <h3>Are you sure?</h3>
                    <div class="text-muted">Apakah anda benar-benar ingin menghapus <span style="color:black; font-weight:bold;"><?= $row['nama_obat'] ?></span>? apa yang telah anda
                        lakukan tidak dapat dibatalkan.
                    </div>
                </div>

                <form action="../connection/function.php" method="POST">
                    <!-- Modal footer -->
                    <div class="modal-footer">
                        <input type="hidden" name="id_farmasi" value="<?= $row['id_farmasi'] ?>">
                        <input type="submit" class="btn btn-success-soft my-0" name="delete_obat" value="Delete">
                        <button type="button" class="btn btn-danger-soft my-0" data-bs-dismiss="modal">Close</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Modal Delete obat END -->

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
                    <div class="position-relative">
                        <img src="../assets/images/upload/farmasi/<?= $row['obat_picture']; ?>" class="rounded mb-3" alt="">
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
                    <button type="button" class="btn btn-danger-soft my-0" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal View obat END -->
<?php } ?>

<?php require '../head_footer_admin/footer.php' ?>