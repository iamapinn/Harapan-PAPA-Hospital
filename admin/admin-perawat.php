<?php require '../head_footer_admin/head.php' ?>

<!-- Page main content START -->
<div class="page-content-wrapper border">

    <!-- Title -->
    <div class="row">
        <div class="col-12">
            <h1 class="h3 mb-2 mb-sm-0">Perawat</h1>
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
                <?php if ($_SESSION["role"] == "1") { ?>
                    <!-- Create perawat buttons -->
                    <div class="col-md-3">
                        <!-- Tabs START -->
                        <ul class="list-inline mb-0 nav nav-pills nav-pill-dark-soft border-0 justify-content-end" id="pills-tab" role="tablist">
                            <!-- Create perawat -->
                            <li class="nav-item">
                                <a href="#" class="btn btn-primary-soft me-1 mb-0" data-bs-toggle="modal" data-bs-target="#modalcreateperawat">Tambah Perawat</a>
                            </li>
                        </ul>
                        <!-- Create perawat end -->
                    </div>
                <?php } ?>

            </div>
            <!-- Search and Create perawat END -->
        </div>
        <!-- Card header END -->

        <!-- Card body START -->
        <div class="card-body px-0">
            <!-- Tabs content START -->
            <div class="tab-content">

                <!-- Tabs content item START -->
                <div class="tab-pane fade show active" id="nav-html-tab-1">
                    <!-- Table START -->
                    <div class="table-responsive border-0">
                        <table class="table table-dark-gray align-middle p-4 mb-0 table-hover">
                            <!-- Table head -->
                            <thead>
                                <tr>
                                    <th scope="col" class="border-0 rounded-start">Nama Perawat</th>
                                    <th scope="col" class="border-0">NIP</th>
                                    <th scope="col" class="border-0">Spesialis</th>
                                    <th scope="col" class="border-0">Total Pasien</th>
                                    <th scope="col" class="border-0">Bergabung</th>
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
                                    <!-- Table row -->
                                    <tr>
                                        <!-- Table data -->
                                        <td>
                                            <div class="d-flex align-items-center position-relative">
                                                <!-- Image -->
                                                <div class="avatar avatar-md">
                                                    <img src="../assets/images/upload/perawat/<?= $row['profile_picture']; ?>" class="rounded-circle" alt="">
                                                </div>
                                                <div class="mb-0 ms-2">
                                                    <!-- Title -->
                                                    <h6 class="mb-0"><a href="#" class="stretched-link"><?= $row['full_name']; ?></a>
                                                    </h6>
                                                </div>
                                            </div>
                                        </td>

                                        <td><?= $row['nip_perawat']; ?></td>

                                        <!-- Table data -->
                                        <td class="text-center text-sm-start">
                                            <?php
                                            if ($row['kategori_spesialis'] == 2) {
                                                echo "<h6 class='mb-0'>" . $row['nama_spesialis'] . "</h6>";
                                            } ?>
                                        </td>

                                        <!-- Table data -->
                                        <td>Null</td>

                                        <!-- Table data -->
                                        <td><?= $row['joining_date']; ?></td>

                                        <!-- Table data -->
                                        <td>
                                            <a href="#" class="btn btn-light btn-round me-1 mb-1 mb-md-0" data-bs-toggle="modal" data-bs-placement="top" data-bs-target="#modalviewperawat<?= $row['id_perawat'] ?>" title="View">
                                                <i class="bi bi-eye"></i>
                                            </a>
                                            <a href="mailto:<?= $row['email']; ?>" class="btn btn-info-soft btn-round me-1 mb-1 mb-md-0" data-bs-toggle="tooltip" data-bs-placement="top" title="Message">
                                                <i class="bi bi-envelope"></i>
                                            </a>
                                            <?php if ($_SESSION["role"] == "1") { ?>
                                                <a href="#" class="btn btn-success-soft btn-round me-1 mb-1 mb-md-0" data-bs-toggle="modal" data-bs-placement="top" data-bs-target="#modalupdateperawat<?= $row['id_perawat'] ?>" title="Edit">
                                                    <i class="bi bi-pencil-square"></i>
                                                </a>
                                                <button class="btn btn-danger-soft btn-round mb-0" data-bs-toggle="modal" data-bs-placement="top" data-bs-target="#modaldeleteperawat<?= $row['id_perawat'] ?>" title="Delete">
                                                    <i class="bi bi-trash"></i>
                                                </button>
                                            <?php } ?>
                                        </td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                            <!-- Table body END -->
                        </table>
                    </div>
                    <!-- Table END -->
                </div>
                <!-- Tabs content item END -->

            </div>
            <!-- Tabs content END -->
        </div>
        <!-- Card body END -->

        <!-- Card footer START -->
        <div class="card-footer bg-transparent p-0">
            <!-- Pagination START -->
            <div class="d-sm-flex justify-content-sm-between align-items-sm-center">
                <!-- Content -->
                <p class="mb-0 text-center text-sm-start">Showing <?= $halaman_awal + 1 ?> to
                    <?= $show_data * ($next - 1) ?> of <?= $jumlah_data ?> Perawat</p>
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

<!-- Modal Tambah perawat START -->
<div class="modal fade" id="modalcreateperawat" tabindex="-1" aria-labelledby="createperawatlabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">

            <!-- Modal header -->
            <div class="modal-header bg-dark">
                <h5 class="modal-title text-white" id="createperawatlabel">Tambah Perawat</h5>
                <button type="button" class="btn btn-sm btn-light mb-0" data-bs-dismiss="modal" aria-label="Close"><i class="bi bi-x-lg"></i></button>
            </div>

            <form action="../connection/function.php" method="POST" enctype="multipart/form-data">
                <!-- Modal body -->
                <div class="modal-body p-5">
                    <div class="row g-4">
                        <div class="col-md-6">
                            <label class="form-label">Full name</label>
                            <input class="form-control" name="fullname" type="text" placeholder="Masukkan nama lengkap" autofocus required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Username</label>
                            <input class="form-control" name="username" type="text" placeholder="Masukkan username" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">NIP</label>
                            <input class="form-control" name="nip_perawat" data-inputmask="'mask': '999999'" id="nip" type="text" placeholder="Masukkan NIP" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Mobile Number</label>
                            <input class="form-control" data-inputmask="'mask': '+6299999999999'" name="mobile_number" id="mobile_number" type="text" placeholder="Masukkan mobile number" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Spesialis</label>
                            <select class="form-select js-choice border-0 z-index-9 bg-transparent" aria-label=".form-select-sm" data-search-enabled="true" name="id_spesialis" required>
                                <option value="">Select category</option>
                                <?php
                                $selectspesialis = mysqli_query($conn, "SELECT * FROM tbl_spesialis WHERE kategori_spesialis=2 ORDER BY nama_spesialis ASC");
                                while ($dataa = mysqli_fetch_assoc($selectspesialis)) {
                                    echo '<option value="' . $dataa['id_spesialis'] . '">' . $dataa['nama_spesialis'] . '</option>';
                                }
                                ?>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Email</label>
                            <input class="form-control" name="email" type="text" placeholder="Masukkan E-mail" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Jenis Kelamin</label>
                            <select class="form-select js-choice border-0 z-index-9 bg-transparent" aria-label=".form-select-sm" data-search-enabled="true" name="jenis_kelamin" required>
                                <option value="">Select status</option>
                                <option value="1">Laki-Laki</option>
                                <option value="2">Perempuan</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Joining Date</label>
                            <input class="form-control" name="join_date" type="date" placeholder="Masukkan Tanggal Bergabung" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Alamat</label>
                            <textarea class="form-control" name="alamat" rows="2" placeholder="Masukkan Alamat" required></textarea>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Pendidikan</label>
                            <input class="form-control" name="pendidikan" type="text" placeholder="Masukkan Pendidikan/Lulusan" required>
                        </div>
                        <div class="col-md-12">
                            <label class="form-label">Deskripsi</label>
                            <textarea class="form-control" name="deskripsi" id="summernote" rows="10" placeholder="Masukkan Deskripsi"></textarea>
                        </div>
                        <!-- Upload image START -->
                        <div class="col-12">
                            <div class="text-center justify-content-center align-items-center p-4 p-sm-5 border border-2 border-dashed position-relative rounded-3">
                                <!-- Image -->
                                <img src="../assets/images/element/gallery.svg" class="h-50px" alt="">
                                <div>
                                    <h6 class="my-2">Upload Profile Picture</a></h6>
                                    <label style="cursor:pointer;">
                                        <span>
                                            <input class="form-control stretched-link" type="file" name="profile_picture" id="image" />
                                        </span>
                                    </label>
                                    <p class="small mb-0 mt-2"><b>Note:</b> Only JPG, JPEG and PNG. Our suggested
                                        dimensions are 200px * 200px.</p>
                                </div>
                            </div>
                        </div>
                        <!-- Upload image END -->
                    </div>
                </div>
                <!-- Modal footer -->
                <div class="modal-footer">
                    <input type="submit" class="btn btn-success-soft my-0" name="create_perawat" value="Save">
                    <button type="button" class="btn btn-danger-soft my-0" data-bs-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- Modal Tambah perawat END -->

<?php
$perawat = mysqli_query($conn, "SELECT * FROM tbl_perawat JOIN tbl_spesialis ON tbl_perawat.id_spesialis = tbl_spesialis.id_spesialis ORDER BY full_name ASC");

while ($row = mysqli_fetch_assoc($perawat)) {
?>
    <!-- Modal Update perawat START -->
    <div class="modal fade" id="modalupdateperawat<?= $row['id_perawat'] ?>" tabindex="-1" aria-labelledby="updateperawatlabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">

                <!-- Modal header -->
                <div class="modal-header bg-dark">
                    <h5 class="modal-title text-white" id="updateperawatlabel">Update Perawat</h5>
                    <button type="button" class="btn btn-sm btn-light mb-0" data-bs-dismiss="modal" aria-label="Close"><i class="bi bi-x-lg"></i></button>
                </div>

                <form action="../connection/function.php" method="POST" enctype="multipart/form-data">
                    <!-- Modal body -->
                    <div class="modal-body p-5">
                        <div class="row g-4">
                            <div class="col-md-6">
                                <label class="form-label">Full name</label>
                                <input class="form-control" name="fullname" type="text" placeholder="Masukkan nama lengkap" value="<?= $row['full_name']; ?>" required autofocus>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Username</label>
                                <input class="form-control" name="username" type="text" placeholder="Masukkan username" value="<?= $row['username']; ?>" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Mobile Number</label>
                                <input class="form-control" data-inputmask="'mask': '+6299999999999'" id="mobile_number<?= $row['id_perawat'] ?>" name="mobile_number" type="text" placeholder="Masukkan mobile number" value="<?= $row['mobile_number']; ?>" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Spesialis</label>
                                <select class="form-select js-choice border-0 z-index-9 bg-transparent" aria-label=".form-select-sm" data-search-enabled="true" name="id_spesialis" required>
                                    <option value="">Select category</option>
                                    <?php
                                    $selectspesialis = mysqli_query($conn, "SELECT * FROM tbl_spesialis WHERE kategori_spesialis=2 ORDER BY nama_spesialis ASC");
                                    while ($dataa = mysqli_fetch_assoc($selectspesialis)) {
                                        echo '<option value="' . $dataa['id_spesialis'] . '" ' . ($dataa['id_spesialis'] == $row['id_spesialis'] ? 'selected' : '') . '>' . $dataa['nama_spesialis'] . '</option>';
                                    } ?>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Email</label>
                                <input class="form-control" name="email" type="text" placeholder="Masukkan E-mail" value="<?= $row['email']; ?>" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Jenis Kelamin</label>
                                <select class="form-select js-choice border-0 z-index-9 bg-transparent" aria-label=".form-select-sm" data-search-enabled="true" name="jenis_kelamin" required>
                                    <?php
                                    if ($row['jenis_kelamin'] == 1) {
                                        echo '<option value="">Select admission</option>';
                                        echo '<option value="1" selected>Laki-Laki</option>';
                                        echo '<option value="2">Perempuan</option>';
                                    } else if ($row['jenis_kelamin'] == 2) {
                                        echo '<option value="">Select admission</option>';
                                        echo '<option value="1">Laki-Laki</option>';
                                        echo '<option value="2" selected>Perempuan</option>';
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Joining Date</label>
                                <input class="form-control" name="join_date" type="date" placeholder="Masukkan Tanggal Bergabung" value="<?= $row['joining_date']; ?>" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Alamat</label>
                                <textarea class="form-control" name="alamat" rows="2" placeholder="Masukkan Alamat" required><?= $row['username']; ?></textarea>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Pendidikan</label>
                                <input class="form-control" name="pendidikan" type="text" placeholder="Masukkan Pendidikan/Lulusan" value="<?= $row['pendidikan']; ?>" required>
                            </div>
                            <div class="col-md-12">
                                <label class="form-label">Deskripsi</label>
                                <textarea class="form-control" id="summernoteupdate<?= $row['id_perawat'] ?>" name="deskripsi" rows="10" placeholder="Masukkan Deskripsi"><?= $row['deskripsi']; ?></textarea>
                            </div>
                            <!-- Upload image START -->
                            <div class="col-12">
                                <div class="text-center justify-content-center align-items-center p-4 p-sm-5 border border-2 border-dashed position-relative rounded-3">
                                    <!-- Image -->
                                    <img src="../assets/images/element/gallery.svg" class="h-50px" alt="">
                                    <div>
                                        <h6 class="my-2">Upload Profile Picture</a></h6>
                                        <label style="cursor:pointer;">
                                            <span>
                                                <input class="form-control stretched-link" type="file" name="profile_picture" id="image" />
                                            </span>
                                        </label>
                                        <p class="small mb-0 mt-2"><b>Note:</b> Only JPG, JPEG and PNG. Our suggested
                                            dimensions are 200px * 200px.</p>
                                    </div>
                                </div>
                            </div>
                            <!-- Upload image END -->
                        </div>
                    </div>
                    <!-- Modal footer -->
                    <div class="modal-footer">
                        <input type="hidden" name="id_perawat" value="<?= $row['id_perawat'] ?>">
                        <input type="hidden" name="nip_perawat" value="<?= $row['nip_perawat'] ?>">
                        <input type="submit" class="btn btn-success-soft my-0" name="update_perawat" value="Update">
                        <button type="button" class="btn btn-danger-soft my-0" data-bs-dismiss="modal">Close</button>
                    </div>
                </form>
            </div>
        </div>
        <script>
            $(document).ready(function() {
                $('#summernoteupdate<?= $row['id_perawat'] ?>').summernote({
                    height: 300, // set editor height
                    focus: true // set focus to editable area after initializing summernote
                });
                $("#mobile_number<?= $row['id_perawat']; ?>").inputmask();
            });
        </script>
    </div>
    <!-- Modal Update perawat END -->

    <!-- Modal Delete perawat START -->
    <div class="modal fade" id="modaldeleteperawat<?= $row['id_perawat'] ?>" tabindex="-1" aria-labelledby="deleteperawatlabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">

                <!-- Modal header -->
                <div class="modal-header bg-dark">
                    <h5 class="modal-title text-white" id="deleteperawatlabel">Data Perawat akan terhapus</h5>
                    <button type="button" class="btn btn-sm btn-light mb-0" data-bs-dismiss="modal" aria-label="Close"><i class="bi bi-x-lg"></i></button>
                </div>

                <div class="modal-body text-center py-4">
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon mb-2 text-danger icon-lg" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                        <path d="M12 9v2m0 4v.01" />
                        <path d="M5 19h14a2 2 0 0 0 1.84 -2.75l-7.1 -12.25a2 2 0 0 0 -3.5 0l-7.1 12.25a2 2 0 0 0 1.75 2.75" />
                    </svg>
                    <h3>Are you sure?</h3>
                    <div class="text-muted">Apakah anda benar-benar ingin menghapus Perawat <span style="color:black; font-weight:bold;"><?= $row['full_name'] ?></span>? apa yang telah anda
                        lakukan tidak dapat dibatalkan.
                    </div>
                </div>

                <form action="../connection/function.php" method="POST">
                    <!-- Modal footer -->
                    <div class="modal-footer">
                        <input type="hidden" name="id_perawat" value="<?= $row['id_perawat'] ?>">
                        <input type="hidden" name="nip_perawat" value="<?= $row['nip_perawat'] ?>">
                        <input type="submit" class="btn btn-success-soft my-0" name="delete_perawat" value="Delete">
                        <button type="button" class="btn btn-danger-soft my-0" data-bs-dismiss="modal">Close</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Modal Delete perawat END -->

    <!-- Modal View Perawat START -->
    <div class="modal fade" id="modalviewperawat<?= $row['id_perawat'] ?>" tabindex="-1" aria-labelledby="viewperawatlabel" aria-hidden="true">
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
                        <img src="../assets/images/upload/perawat/<?= $row['profile_picture']; ?>" class="rounded-circle mx-auto d-block mb-3 w-200px" alt="">
                    </div>

                    <!-- Nama Dokter -->
                    <span class="small">Nama Dokter:</span>
                    <h6 class="mb-3"><?= $row['full_name'] ?> ( <?= $row['nip_perawat'] ?>)</h6>

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
                    <button type="button" class="btn btn-danger-soft my-0" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal View Perawat END -->
<?php } ?>


<?php require '../head_footer_admin/footer.php' ?>