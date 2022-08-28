<?php require '../head_footer_admin/head.php' ?>


<!-- Page main content START -->
<div class="page-content-wrapper border">

    <!-- Title -->
    <div class="row">
        <div class="col-12">
            <h1 class="h3 mb-2 mb-sm-0">Users</h1>
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

                <!-- Create users buttons -->
                <div class="col-md-3">
                    <!-- Tabs START -->
                    <ul class="list-inline mb-0 nav nav-pills nav-pill-dark-soft border-0 justify-content-end" id="pills-tab" role="tablist">
                        <!-- Create users -->
                        <li class="nav-item">
                            <a href="#" class="btn btn-primary-soft me-1 mb-0" data-bs-toggle="modal" data-bs-target="#modalcreateusers">Tambah User</a>
                        </li>
                    </ul>
                    <!-- Create users end -->
                </div>

            </div>
            <!-- Search and Create users END -->
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
                            <th scope="col" class="border-0 rounded-start">Nama Users</th>
                            <th scope="col" class="border-0">Email</th>
                            <th scope="col" class="border-0">Username</th>
                            <th scope="col" class="border-0">role</th>
                            <th scope="col" class="border-0 rounded-end">Action</th>
                        </tr>
                    </thead>

                    <!-- Table body START -->
                    <tbody>
                        <?php
                        $batas = 10;
                        $halaman = isset($_GET['halaman']) ? (int)$_GET['halaman'] : 1;
                        $halaman_awal = ($halaman > 1) ? ($halaman * $batas) - $batas : 0;

                        $previous = $halaman - 1;
                        $next = $halaman + 1;

                        $data = mysqli_query($conn, "SELECT * FROM tbl_users");
                        $jumlah_data = mysqli_num_rows($data);
                        $total_halaman = ceil($jumlah_data / $batas);

                        if ($_POST["search"]) {
                            $search = "AND email LIKE '%" . $_POST["search"] . "%' OR username LIKE '%" . $_POST["search"] . "%' OR full_name LIKE '%" . $_POST["search"] . "%' OR role LIKE '%" . $_POST["search"] . "%'";
                        }

                        $users = mysqli_query($conn, "SELECT * FROM tbl_users WHERE id_user " . $search . " ORDER BY id_user DESC LIMIT $halaman_awal, $batas");

                        $show_data = mysqli_num_rows($users);

                        while ($row = mysqli_fetch_assoc($users)) {
                        ?>
                            <!-- Table row -->
                            <tr>
                                <!-- Table data -->
                                <td>
                                    <div class="d-flex align-items-center position-relative">
                                        <!-- Image -->
                                        <div class="w-60px">
                                            <img src="<?php
                                                        if ($row['user_picture'] == "") {
                                                            echo "../assets/images/admin/no-preview-available.png";
                                                        } else if ($row['id_dokter'] != "") {
                                                            echo "../assets/images/upload/dokter/" . $row['user_picture'];
                                                        } else if ($row['id_perawat'] != "") {
                                                            echo "../assets/images/upload/perawat/" . $row['user_picture'];
                                                        } else if ($row['user_picture'] != "") {
                                                            echo "../assets/images/upload/pasien/" . $row['user_picture'];
                                                        }
                                                        ?>" class="rounded" alt="">
                                        </div>
                                        <!-- Title -->
                                        <h6 class="mb-0 ms-2">
                                            <a href="#" class="stretched-link"><?= $row['full_name']; ?></a>
                                        </h6>
                                    </div>
                                </td>
                                <td><?= $row['email']; ?></td>
                                <td><?= $row['username']; ?></td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <?php
                                        if ($row['role'] == 1) {
                                            echo "<div class='badge bg-secondary bg-opacity-10 text-secondary'>Admin</div>";
                                        } else if ($row['role'] == 2) {
                                            echo "<div class='badge bg-secondary bg-opacity-10 text-secondary'>Dokter</div>";
                                        } else if ($row['role'] == 3) {
                                            echo "<div class='badge bg-secondary bg-opacity-10 text-secondary'>Perawat</div>";
                                        } else if ($row['role'] == 4) {
                                            echo "<div class='badge bg-secondary bg-opacity-10 text-secondary'>Pasien</div>";
                                        }
                                        ?>
                                    </div>
                                </td>

                                <!-- Table data -->
                                <td>
                                    <a href="#" class="btn btn-success-soft me-1 mb-0" data-bs-toggle="modal" data-bs-placement="top" data-bs-target="#modalupdateusers<?= $row['id_user'] ?>">Edit</a>
                                    <button class="btn btn-danger-soft me-1 mb-0" data-bs-toggle="modal" data-bs-placement="top" data-bs-target="#modaldeleteusers<?= $row['id_user'] ?>">Delete</button>
                                    </button>
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
                    <?= $show_data * ($next - 1) ?> of <?= $jumlah_data ?> Users</p>
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

<!-- Modal Tambah users START -->
<div class="modal fade" id="modalcreateusers" tabindex="-1" aria-labelledby="createuserslabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">

            <!-- Modal header -->
            <div class="modal-header bg-dark">
                <h5 class="modal-title text-white" id="createuserslabel">Tambah User</h5>
                <button type="button" class="btn btn-sm btn-light mb-0" data-bs-dismiss="modal" aria-label="Close"><i class="bi bi-x-lg"></i></button>
            </div>

            <form action="../connection/function.php" method="POST" enctype="multipart/form-data">
                <!-- Modal body -->
                <div class="modal-body p-5">
                    <div class="row g-4">
                        <div class="col-md-6">
                            <label class="form-label">Nama lengkap</label>
                            <input class="form-control" name="full_name" type="text" placeholder="Masukkan nama lengkap" autofocus required>
                        </div>
                        <div class=" col-md-6">
                            <label class="form-label">Username</label>
                            <input class="form-control" name="username" type="text" placeholder="Masukkan Username" required>
                        </div>
                        <div class=" col-md-6">
                            <label class="form-label">Email</label>
                            <input class="form-control" name="email" type="text" placeholder="Masukkan Email" required>
                        </div>
                        <div class=" col-md-6">
                            <label class="form-label">Password</label>
                            <input class="form-control" name="password" type="password" placeholder="Masukkan Password" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Role</label>
                            <select class="form-select js-choice border-0 z-index-9 bg-transparent" aria-label=".form-select-sm" data-search-enabled="true" name="role" required>
                                <option value="">Select role</option>
                                <option value="1">Admin</option>
                                <option value="4">Pasien</option>
                            </select>
                        </div>
                    </div>
                </div>
                <!-- Modal footer -->
                <div class="modal-footer">
                    <input type="submit" class="btn btn-success-soft my-0" name="create_user" value="Save">
                    <button type="button" class="btn btn-danger-soft my-0" data-bs-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- Modal Tambah users END -->

<?php
$users = mysqli_query($conn, "SELECT * FROM tbl_users");

while ($row = mysqli_fetch_assoc($users)) {
?>
    <!-- Modal Update users START -->
    <div class="modal fade" id="modalupdateusers<?= $row['id_user'] ?>" tabindex="-1" aria-labelledby="updateuserslabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">

                <!-- Modal header -->
                <div class="modal-header bg-dark">
                    <h5 class="modal-title text-white" id="updateuserslabel">Update User</h5>
                    <button type="button" class="btn btn-sm btn-light mb-0" data-bs-dismiss="modal" aria-label="Close"><i class="bi bi-x-lg"></i></button>
                </div>

                <form action="../connection/function.php" method="POST" enctype="multipart/form-data">
                    <!-- Modal body -->
                    <div class="modal-body p-5">
                        <div class="row g-4">
                            <div class="col-md-6">
                                <label class="form-label">Nama lengkap</label>
                                <input class="form-control" name="full_name" type="text" value="<?= $row['full_name']; ?>" placeholder="Masukkan nama lengkap" autofocus required>
                            </div>
                            <div class=" col-md-6">
                                <label class="form-label">Username</label>
                                <input class="form-control" name="username" type="text" value="<?= $row['username']; ?>" placeholder="Masukkan Username" required>
                            </div>
                            <div class=" col-md-6">
                                <label class="form-label">Email</label>
                                <input class="form-control" name="email" type="text" value="<?= $row['email']; ?>" placeholder="Masukkan Email" required>
                            </div>
                            <?php

                            if ($row['role'] == 1 || $row['role'] == 2 || $row['role'] == 3) {
                            ?>
                                <div class=" col-md-6">
                                    <label class="form-label">Password</label>
                                    <input class="form-control" name="password" type="password" placeholder="Masukkan Password">
                                </div>
                            <?php } ?>

                            <div class="col-md-6">
                                <label class="form-label">Role</label>
                                <select class="form-select js-choice border-0 z-index-9 bg-transparent" aria-label=".form-select-sm" data-search-enabled="true" name="role" required>
                                    <?php
                                    if ($row['role'] == 1) {
                                        echo '<option value="">Select Jenis</option>';
                                        echo '<option value="1" selected>Admin</option>';
                                        echo '<option value="2">Dokter</option>';
                                        echo '<option value="3">Perawat</option>';
                                        echo '<option value="4">Pasien</option>';
                                    } else if ($row['role'] == 2) {
                                        echo '<option value="">Select admission</option>';
                                        echo '<option value="1">Admin</option>';
                                        echo '<option value="2" selected>Dokter</option>';
                                        echo '<option value="3">Perawat</option>';
                                        echo '<option value="4">Pasien</option>';
                                    } else if ($row['role'] == 3) {
                                        echo '<option value="">Select admission</option>';
                                        echo '<option value="1">Admin</option>';
                                        echo '<option value="2">Dokter</option>';
                                        echo '<option value="3" selected>Perawat</option>';
                                        echo '<option value="4">Pasien</option>';
                                    } else if ($row['role'] == 4) {
                                        echo '<option value="">Select admission</option>';
                                        echo '<option value="1">Admin</option>';
                                        echo '<option value="2">Dokter</option>';
                                        echo '<option value="3">Perawat</option>';
                                        echo '<option value="4" selected>Pasien</option>';
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                    </div>
                    <!-- Modal footer -->
                    <div class="modal-footer">
                        <input type="hidden" name="id_user" value="<?= $row['id_user'] ?>">
                        <input type="hidden" name="id_dokter" value="<?= $row['id_dokter'] ?>">
                        <input type="hidden" name="id_perawat" value="<?= $row['id_perawat'] ?>">
                        <input type="submit" class="btn btn-success-soft my-0" name="update_user" value="Update">
                        <button type="button" class="btn btn-danger-soft my-0" data-bs-dismiss="modal">Close</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Modal Update users END -->

    <!-- Modal Delete users START -->
    <div class="modal fade" id="modaldeleteusers<?= $row['id_user'] ?>" tabindex="-1" aria-labelledby="deleteuserslabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">

                <!-- Modal header -->
                <div class="modal-header bg-dark">
                    <h5 class="modal-title text-white" id="deleteuserslabel">Data User akan terhapus</h5>
                    <button type="button" class="btn btn-sm btn-light mb-0" data-bs-dismiss="modal" aria-label="Close"><i class="bi bi-x-lg"></i></button>
                </div>

                <div class="modal-body text-center py-4">
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon mb-2 text-danger icon-lg" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                        <path d="M12 9v2m0 4v.01" />
                        <path d="M5 19h14a2 2 0 0 0 1.84 -2.75l-7.1 -12.25a2 2 0 0 0 -3.5 0l-7.1 12.25a2 2 0 0 0 1.75 2.75" />
                    </svg>
                    <h3>Are you sure?</h3>
                    <div class="text-muted">Apakah anda benar-benar ingin menghapus <span style="color:black; font-weight:bold;"><?= $row['full_name'] ?></span>? apa yang telah anda
                        lakukan tidak dapat dibatalkan.
                    </div>
                </div>

                <form action="../connection/function.php" method="POST">
                    <!-- Modal footer -->
                    <div class="modal-footer">
                        <input type="hidden" name="id_user" value="<?= $row['id_user'] ?>">
                        <input type="hidden" name="id_dokter" value="<?= $row['id_dokter'] ?>">
                        <input type="hidden" name="id_perawat" value="<?= $row['id_perawat'] ?>">
                        <input type="submit" class="btn btn-success-soft my-0" name="delete_user" value="Delete">
                        <button type="button" class="btn btn-danger-soft my-0" data-bs-dismiss="modal">Close</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Modal Delete obat END -->
<?php } ?>

<?php require '../head_footer_admin/footer.php' ?>