<?php require '../head_footer_admin/head.php' ?>

<!-- Page main content START -->
<div class="page-content-wrapper border">

    <!-- Title -->
    <div class="row">
        <div class="col-12">
            <h1 class="h3 mb-2 mb-sm-0">Poli Klinik</h1>
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

                <!-- Create poliklinik buttons -->
                <div class="col-md-3">
                    <!-- Tabs START -->
                    <ul class="list-inline mb-0 nav nav-pills nav-pill-dark-soft border-0 justify-content-end" id="pills-tab" role="tablist">
                        <!-- Create poliklinik -->
                        <li class="nav-item">
                            <a href="#" class="btn btn-primary-soft me-1 mb-0" data-bs-toggle="modal" data-bs-target="#modalcreatepoliklinik">Tambah Poli Klinik</a>
                        </li>
                    </ul>
                    <!-- Create poliklinik end -->
                </div>

            </div>
            <!-- Search and Create poliklinik END -->
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
                            <th scope="col" class="border-0 rounded-start">Nama Poli Klinik</th>
                            <th scope="col" class="border-0">Admission</th>
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
                            <!-- Table row -->
                            <tr>
                                <!-- Table data -->
                                <td>
                                    <div class="d-flex align-items-center position-relative">
                                        <!-- Image -->
                                        <div class="w-60px">
                                            <img src="../assets/images/upload/poliklinik/<?= $row['poliklinik_picture']; ?>" class="rounded" alt="">
                                        </div>
                                        <!-- Title -->
                                        <h6 class="mb-0 ms-2">
                                            <a href="#" class="stretched-link"><?= $row['nama_poliklinik']; ?></a>
                                        </h6>
                                    </div>
                                </td>

                                <!-- Table data -->
                                <td>
                                    <div class="d-flex align-items-center">
                                        <?php
                                        if ($row['admission'] == 1) {
                                            echo "<div class='badge bg-success bg-opacity-10 text-success'>Admission Open</div>";
                                        } else {
                                            echo "<div class='badge bg-danger bg-opacity-10 text-danger'>Admission Closed</div>";
                                        }
                                        ?>
                                    </div>
                                </td>

                                <!-- Table data -->
                                <td>
                                    <a href="#" class="btn btn-success-soft me-1 mb-0" data-bs-toggle="modal" data-bs-placement="top" data-bs-target="#modalupdatepoliklinik<?= $row['id_poliklinik'] ?>">Edit</a>
                                    <button class="btn btn-danger-soft me-1 mb-0" data-bs-toggle="modal" data-bs-placement="top" data-bs-target="#modaldeletepoliklinik<?= $row['id_poliklinik'] ?>">Delete</button>
                                    </button>
                                    <a href="#" class="btn btn-primary-soft me-1 mb-0" data-bs-toggle="modal" data-bs-target="#modalviewpoliklinik<?= $row['id_poliklinik'] ?>">View</a>
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
                    <?= $show_data * ($next - 1) ?> of <?= $jumlah_data ?> Poli Klinik</p>
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

<!-- Modal Tambah poliklinik START -->
<div class="modal fade" id="modalcreatepoliklinik" tabindex="-1" aria-labelledby="createpolikliniklabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">

            <!-- Modal header -->
            <div class="modal-header bg-dark">
                <h5 class="modal-title text-white" id="createpolikliniklabel">Tambah Poli Klinik</h5>
                <button type="button" class="btn btn-sm btn-light mb-0" data-bs-dismiss="modal" aria-label="Close"><i class="bi bi-x-lg"></i></button>
            </div>

            <form action="../connection/function.php" method="POST" enctype="multipart/form-data">
                <!-- Modal body -->
                <div class="modal-body p-5">
                    <div class="row g-4">
                        <div class="col-md-6">
                            <label class="form-label">Nama Poli Klinik</label>
                            <input class="form-control" name="nama_poliklinik" type="text" placeholder="Masukkan nama poli klinik" autofocus required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Admission</label>
                            <select class="form-select js-choice border-0 z-index-9 bg-transparent" aria-label=".form-select-sm" data-search-enabled="true" name="admission" required>
                                <option value="">Select admission</option>
                                <option value="1">Admission Open</option>
                                <option value="2">Admission Close</option>
                            </select>
                        </div>
                        <div class="col-md-12">
                            <label class="form-label">Link</label>
                            <input class="form-control" name="link" type="text" placeholder="Masukkan link poli klinik" autofocus required>
                        </div>
                        <!-- Tags START -->
                        <div class="col-12">
                            <div class="bg-light border rounded p-4">
                                <h5 class="mb-0">Program Unggulan</h5>
                                <!-- Comment -->
                                <div class="mt-3">
                                    <input type="text" class="form-control js-choice mb-0" data-placeholder="true" name="program_unggulan" data-placeholder-Val="Masukkan Program Unggulan" data-max-item-count="10" data-remove-item-button="true">
                                    <span class="small">Maximum 10 Program Unggulan</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <label class="form-label">Deskripsi</label>
                            <textarea class="form-control" id="summernote" name="deskripsi" rows="10" placeholder="Masukkan deskripsi" required></textarea>
                        </div>
                        <!-- Upload image START -->
                        <div class="col-12">
                            <div class="text-center justify-content-center align-items-center p-4 p-sm-5 border border-2 border-dashed position-relative rounded-3">
                                <!-- Image -->
                                <img src="../assets/images/element/gallery.svg" class="h-50px" alt="">
                                <div>
                                    <h6 class="my-2">Upload Poli Klinik Picture</a></h6>
                                    <label style="cursor:pointer;">
                                        <span>
                                            <input class="form-control stretched-link" type="file" name="poliklinik_picture" id="image" />
                                        </span>
                                    </label>
                                    <p class="small mb-0 mt-2"><b>Note:</b> Only JPG, JPEG and PNG. Our suggested
                                        dimensions are 1280px * 813px.</p>
                                </div>
                            </div>
                        </div>
                        <!-- Upload image END -->
                    </div>
                </div>
                <!-- Modal footer -->
                <div class="modal-footer">
                    <input type="submit" class="btn btn-success-soft my-0" name="create_poliklinik" value="Save">
                    <button type="button" class="btn btn-danger-soft my-0" data-bs-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- Modal Tambah poliklinik END -->

<?php
$poliklinik = mysqli_query($conn, "SELECT * FROM tbl_poliklinik ORDER BY nama_poliklinik ASC");

while ($row = mysqli_fetch_assoc($poliklinik)) {
?>
    <!-- Modal Update poliklinik START -->
    <div class="modal fade" id="modalupdatepoliklinik<?= $row['id_poliklinik'] ?>" tabindex="-1" aria-labelledby="updatepolikliniklabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">

                <!-- Modal header -->
                <div class="modal-header bg-dark">
                    <h5 class="modal-title text-white" id="updatepolikliniklabel">Update Poli Klinik</h5>
                    <button type="button" class="btn btn-sm btn-light mb-0" data-bs-dismiss="modal" aria-label="Close"><i class="bi bi-x-lg"></i></button>
                </div>

                <form action="../connection/function.php" method="POST" enctype="multipart/form-data">
                    <!-- Modal body -->
                    <div class="modal-body p-5">
                        <div class="row g-4">
                            <div class="col-md-6">
                                <label class="form-label">Nama Poli Klinik</label>
                                <input class="form-control" name="nama_poliklinik" type="text" value="<?= $row['nama_poliklinik']; ?>" placeholder="Masukkan nama poli klinik" autofocus required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Admission</label>
                                <select class="form-select js-choice border-0 z-index-9 bg-transparent" aria-label=".form-select-sm" data-search-enabled="true" name="admission" required>
                                    <?php
                                    if ($row['admission'] == 1) {
                                        echo '<option value="">Select admission</option>';
                                        echo '<option value="1" selected>Admission Open</option>';
                                        echo '<option value="2">Admission Close</option>';
                                    } else if ($row['admission'] == 2) {
                                        echo '<option value="">Select admission</option>';
                                        echo '<option value="1">Admission Open</option>';
                                        echo '<option value="2" selected>Admission Close</option>';
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="col-md-12">
                                <label class="form-label">Link</label>
                                <input class="form-control" name="link" type="text" value="<?= $row['link']; ?>" placeholder="Masukkan link poli klinik" required>
                            </div>
                            <!-- Tags START -->
                            <div class="col-12">
                                <div class="bg-light border rounded p-4">
                                    <h5 class="mb-0">Program Unggulan</h5>
                                    <!-- Comment -->
                                    <div class="mt-3">
                                        <input type="text" class="form-control js-choice mb-0" data-placeholder="true" value="<?= $row['program_unggulan']; ?>" name="program_unggulan" data-placeholder-Val="Masukkan Program Unggulan" data-max-item-count="10" data-remove-item-button="true">
                                        <span class="small">Maximum 10 Program Unggulan</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <label class="form-label">Deskripsi</label>
                                <textarea class="form-control" id="summernoteupdate<?= $row['id_poliklinik'] ?>" name="deskripsi" rows="10" placeholder="Masukkan deskripsi" required><?= $row['deskripsi'] ?></textarea>
                            </div>
                            <!-- Upload image START -->
                            <div class="col-12">
                                <div class="text-center justify-content-center align-items-center p-4 p-sm-5 border border-2 border-dashed position-relative rounded-3">
                                    <!-- Image -->
                                    <img src="../assets/images/element/gallery.svg" class="h-50px" alt="">
                                    <div>
                                        <h6 class="my-2">Upload Poli Klinik Picture</a></h6>
                                        <label style="cursor:pointer;">
                                            <span>
                                                <input class="form-control stretched-link" type="file" name="poliklinik_picture" id="image" />
                                            </span>
                                        </label>
                                        <p class="small mb-0 mt-2"><b>Note:</b> Only JPG, JPEG and PNG. Our suggested
                                            dimensions are 1280px * 813px.</p>
                                    </div>
                                </div>
                            </div>
                            <!-- Upload image END -->
                            <h5 class="mt-4">Poliklink Picture</h5>
                            <div class="position-relative">
                                <img src="../assets/images/upload/poliklinik/<?= $row['poliklinik_picture']; ?>" class="rounded" alt="">
                            </div>
                        </div>
                    </div>
                    <!-- Modal footer -->
                    <div class="modal-footer">
                        <input type="hidden" name="id_poliklinik" value="<?= $row['id_poliklinik'] ?>">
                        <input type="submit" class="btn btn-success-soft my-0" name="update_poliklinik" value="Update">
                        <button type="button" class="btn btn-danger-soft my-0" data-bs-dismiss="modal">Close</button>
                    </div>
                </form>
            </div>
        </div>
        <script>
            $(document).ready(function() {
                $('#summernoteupdate<?= $row['id_poliklinik'] ?>').summernote({
                    height: 300, // set editor height
                    focus: true // set focus to editable area after initializing summernote
                });
            });
        </script>
    </div>
    <!-- Modal Update poliklinik END -->

    <!-- Modal Delete poliklinik START -->
    <div class="modal fade" id="modaldeletepoliklinik<?= $row['id_poliklinik'] ?>" tabindex="-1" aria-labelledby="deletepolikliniklabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">

                <!-- Modal header -->
                <div class="modal-header bg-dark">
                    <h5 class="modal-title text-white" id="deletepolikliniklabel">Data Poli Klinik akan terhapus</h5>
                    <button type="button" class="btn btn-sm btn-light mb-0" data-bs-dismiss="modal" aria-label="Close"><i class="bi bi-x-lg"></i></button>
                </div>

                <div class="modal-body text-center py-4">
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon mb-2 text-danger icon-lg" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                        <path d="M12 9v2m0 4v.01" />
                        <path d="M5 19h14a2 2 0 0 0 1.84 -2.75l-7.1 -12.25a2 2 0 0 0 -3.5 0l-7.1 12.25a2 2 0 0 0 1.75 2.75" />
                    </svg>
                    <h3>Are you sure?</h3>
                    <div class="text-muted">Apakah anda benar-benar ingin menghapus <span style="color:black; font-weight:bold;"><?= $row['nama_poliklinik'] ?></span>? apa yang telah anda
                        lakukan tidak dapat dibatalkan.
                    </div>
                </div>

                <form action="../connection/function.php" method="POST">
                    <!-- Modal footer -->
                    <div class="modal-footer">
                        <input type="hidden" name="id_poliklinik" value="<?= $row['id_poliklinik'] ?>">
                        <input type="submit" class="btn btn-success-soft my-0" name="delete_poliklinik" value="Delete">
                        <button type="button" class="btn btn-danger-soft my-0" data-bs-dismiss="modal">Close</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Modal Delete poliklinik END -->

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
                    <button type="button" class="btn btn-danger-soft my-0" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal View Poliklinik END -->
<?php } ?>

<?php require '../head_footer_admin/footer.php' ?>