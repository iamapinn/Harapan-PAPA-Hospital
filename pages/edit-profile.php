<?php require '../head_footer_pages/head.php' ?>

<!-- **************** MAIN CONTENT START **************** -->
<main>
	<!-- =======================
Page Banner START -->
	<section class="pt-0">
		<!-- Main banner background image -->
		<div class="container-fluid px-0">
			<div class="bg-blue h-100px h-md-200px rounded-0" style="background:url(../assets/images/pattern/04.png) no-repeat center center; background-size:cover;">
			</div>
		</div>
		<div class="container mt-n4">
			<div class="row">
				<!-- Profile banner START -->
				<div class="col-12">
					<div class="card bg-transparent card-body p-0">
						<div class="row d-flex justify-content-between">
							<!-- Avatar -->
							<div class="col-auto mt-4 mt-md-0">
								<div class="avatar avatar-xxl mt-n3">

									<?php if ($_SESSION["role"] == "2") { ?>
										<!-- EDIT PROFILE DOKTER -->
										<img class="avatar-img rounded-circle border border-white border-3 shadow" src="<?php
																														if ($row_dokter['profile_picture'] == "") {
																															echo "../assets/images/admin/no-preview-available.png";
																														} else if ($row_dokter['profile_picture'] != "") {
																															echo "../assets/images/upload/dokter/" . $row_dokter['profile_picture'];
																														}
																														?>" alt="">
									<?php } else if ($_SESSION["role"] == "3") { ?>
										<!-- EDIT PROFILE PERAWAT -->
										<img class="avatar-img rounded-circle border border-white border-3 shadow" src="<?php
																														if ($row_perawat['profile_picture'] == "") {
																															echo "../assets/images/admin/no-preview-available.png";
																														} else if ($row_perawat['profile_picture'] != "") {
																															echo "../assets/images/upload/perawat/" . $row_perawat['profile_picture'];
																														}
																														?>" alt="">
									<?php } else if ($_SESSION["role"] == "4") { ?>
										<!-- EDIT PROFILE PASIEN -->
										<img class="avatar-img rounded-circle border border-white border-3 shadow" src="<?php
																														if ($row_pasien['user_picture'] == "") {
																															echo "../assets/images/admin/no-preview-available.png";
																														} else if ($row_pasien['user_picture'] != "") {
																															echo "../assets/images/upload/pasien/" . $row_pasien['user_picture'];
																														}
																														?>" alt="">
									<?php } else if ($_SESSION["role"] == "1") { ?>
										<!-- EDIT PROFILE ADMIN -->
										<img class="avatar-img rounded-circle border border-white border-3 shadow" src="<?php
																														if ($row_admin['user_picture'] == "") {
																															echo "../assets/images/admin/no-preview-available.png";
																														} else if ($row_admin['user_picture'] != "") {
																															echo "../assets/images/upload/admin/" . $row_admin['user_picture'];
																														}
																														?>" alt="">
									<?php } ?>
								</div>
							</div>
							<!-- Profile info -->
							<div class="col d-md-flex justify-content-between align-items-center mt-4">
								<div>
									<?php if ($_SESSION["role"] == "2") { ?>
										<h1 class="my-1 fs-4"><?= $row_dokter['full_name']; ?><i class="bi bi-patch-check-fill text-info small"></i></h1>
									<?php } else if ($_SESSION["role"] == "3") { ?>
										<h1 class="my-1 fs-4"><?= $row_perawat['full_name']; ?><i class="bi bi-patch-check-fill text-info small"></i></h1>
									<?php } else if ($_SESSION["role"] == "4") { ?>
										<h1 class="my-1 fs-4"><?= $row_pasien['full_name']; ?></h1>
									<?php } else if ($_SESSION["role"] == "1") { ?>
										<h1 class="my-1 fs-4"><?= $row_admin['full_name']; ?><i class="bi bi-patch-check-fill text-info small"></i></i></h1>
									<?php } ?>
								</div>
							</div>
						</div>
					</div>
					<!-- Profile banner END -->

					<!-- Advanced filter responsive toggler START -->
					<!-- Divider -->
					<hr class="d-xl-none">
					<div class="col-12 col-xl-3 d-flex justify-content-between align-items-center">
						<a class="h6 mb-0 fw-bold d-xl-none" href="#">Menu</a>
						<button class="btn btn-primary d-xl-none" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar" aria-controls="offcanvasNavbar">
							<i class="fas fa-sliders-h"></i>
						</button>
					</div>
					<!-- Advanced filter responsive toggler END -->
				</div>
			</div>
		</div>
	</section>
	<!-- =======================
Page Banner END -->

	<!-- =======================
Page content START -->
	<section class="pt-0">
		<div class="container">
			<div class="row">

				<!-- Right sidebar START -->
				<div class="col-xl-3">
					<!-- Responsive offcanvas body START -->
					<nav class="navbar navbar-light navbar-expand-xl mx-0">
						<div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasNavbar" aria-labelledby="offcanvasNavbarLabel">
							<!-- Offcanvas header -->
							<div class="offcanvas-header bg-light">
								<h5 class="offcanvas-title" id="offcanvasNavbarLabel">My profile</h5>
								<button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
							</div>
							<!-- Offcanvas body -->
							<div class="offcanvas-body p-3 p-xl-0">
								<div class="bg-dark border rounded-3 pb-0 p-3 w-100">
									<!-- Dashboard menu -->
									<div class="list-group list-group-dark list-group-borderless">
										<a class="list-group-item active" href="edit-profile.php"><i class="bi bi-pencil-square fa-fw me-2"></i>Edit Profile</a>
										<a class="list-group-item" href="delete-account.php"><i class="bi bi-trash fa-fw me-2"></i>Delete Profile</a>
										<form action="../connection/function.php" method="POST" id="logoutInput">
											<input type="hidden" class="h5 mb-0 text-body" name="logout" value="Sign Out">
											<a class="list-group-item text-danger bg-danger-soft-hover" name="logout" href="#" onclick="document.getElementById('logoutInput').submit();"><i class="fas fa-sign-out-alt fa-fw me-2"></i>Sign Out</a>
										</form>
									</div>
								</div>
							</div>
						</div>
					</nav>
					<!-- Responsive offcanvas body END -->
				</div>
				<!-- Right sidebar END -->

				<!-- Main content START -->
				<div class="col-xl-9">

					<!-- Edit profile START -->
					<div class="card bg-transparent border rounded-3">
						<!-- Card header -->
						<div class="card-header bg-transparent border-bottom">
							<h3 class="card-header-title mb-0">Edit Profile</h3>
						</div>
						<!-- Card body START -->
						<div class="card-body">
							<!-- Form -->
							<form class="row g-4" method="POST" action="../connection/function.php" enctype="multipart/form-data">
								<?php if ($_SESSION["role"] == "2") { ?>
									<!-- EDIT PROFILE DOKTER -->
									<!-- Profile picture -->
									<div class="col-12 justify-content-center align-items-center">
										<label class="form-label">Profile picture</label>
										<div class="d-flex align-items-center">
											<label class="position-relative me-4" for="uploadfile-1" title="<?= $row_dokter['username'] ?>">
												<!-- Avatar place holder -->
												<span class="avatar avatar-xl">
													<img id="<?= $row_dokter['username']; ?>" class="avatar-img rounded-circle border border-white border-3 shadow" src="<?php
																																											if ($row_dokter['profile_picture'] == "") {
																																												echo "../assets/images/admin/no-preview-available.png";
																																											} else if ($row_dokter['profile_picture'] != "") {
																																												echo "../assets/images/upload/dokter/" . $row_dokter['profile_picture'];
																																											}
																																											?>" alt="">
												</span>

											</label>
											<!-- Upload button -->
											<label class="btn btn-primary-soft mb-0" for="uploadfile-1">Change</label>
											<input id="uploadfile-1" class="form-control d-none" type="file" name="profile_picture">
											<p class="small  mb-0">&nbsp;&nbsp;&nbsp;&nbsp;<b>Note:</b> Only JPG, JPEG and PNG. Our suggested
												dimensions are 200px * 200px.</p>
										</div>
									</div>

									<!-- Full name -->
									<div class="col-6">
										<label class="form-label">Nama lengkap</label>
										<div class="input-group">
											<input type="text" class="form-control" name="full_name" placeholder="Masukkan nama lengkap sesuai KTP" value="<?= $row_dokter['full_name']; ?>" required>
										</div>
									</div>

									<!-- Username -->
									<div class="col-md-6">
										<label class="form-label">Username</label>
										<div class="input-group">
											<input type="text" class="form-control" name="username" placeholder="Masukkan username" value="<?= $row_dokter['username']; ?>">
										</div>
									</div>

									<!-- Phone number -->
									<div class="col-md-6">
										<label class="form-label">Mobile Phone</label>
										<input type="text" class="form-control" name="mobile_number" id="mobile_number" placeholder="Masukkan mobile phone" data-inputmask="'mask': '+6299999999999'" value="<?= $row_dokter['mobile_number']; ?>">
									</div>

									<!-- Jenis kelamin -->
									<div class="col-md-6">
										<label class="form-label">Jenis Kelamin</label>
										<select class="form-select js-choice border-0 z-index-9 bg-transparent" aria-label=".form-select-sm" data-search-enabled="true" name="jenis_kelamin" required>
											<?php
											if ($row_dokter['jenis_kelamin'] == 1) {
												echo '<option value="">Select gender</option>';
												echo '<option value="1" selected>Laki-Laki</option>';
												echo '<option value="2">Perempuan</option>';
											} else if ($row_dokter['jenis_kelamin'] == 2) {
												echo '<option value="">Select gender</option>';
												echo '<option value="1">Laki-Laki</option>';
												echo '<option value="2" selected>Perempuan</option>';
											}
											?>
										</select>
									</div>

									<!-- Email -->
									<div class="col-md-6">
										<label class="form-label">Email</label>
										<input class="form-control" name="email" type="text" placeholder="Masukkan E-mail" value="<?= $row_dokter['email']; ?>">
									</div>


									<!-- Pendidikan -->
									<div class="col-md-6">
										<label class="form-label">Masukkan Pendidikan/Lulusan</label>
										<input class="form-control" name="pendidikan" type="text" placeholder="Masukkan Pendidikan/Lulusan" value="<?= $row_dokter['pendidikan']; ?>" required>
									</div>

									<!-- Adress -->
									<div class="col-md-6">
										<label class="form-label">Alamat</label>
										<textarea class="form-control" name="alamat" rows="2" placeholder="Masukkan Alamat"><?= $row_dokter['alamat']; ?></textarea>
									</div>

									<!-- Deskripsi -->
									<div class="col-md-12">
										<label class="form-label">Deskripsi</label>
										<textarea class="form-control" id="summernote" name="deskripsi" rows="10" placeholder="Masukkan Deskripsi"><?= $row_dokter['deskripsi']; ?></textarea>
									</div>

									<!-- Save button -->
									<div class="d-sm-flex justify-content-end">
										<input type="hidden" name="id_dokter" value="<?= $row_dokter['id_dokter'] ?>">
										<input type="submit" class="btn btn-primary mb-0 my-0" name="update_profile_dokter" value="Save changes">
									</div>

								<?php } else if ($_SESSION["role"] == "3") { ?>
									<!-- EDIT PROFILE PERAWAT -->
									<div class="col-12 justify-content-center align-items-center">
										<label class="form-label">Profile picture</label>
										<div class="d-flex align-items-center">
											<label class="position-relative me-4" for="uploadfile-1" title="<?= $row_perawat['username'] ?>">
												<!-- Avatar place holder -->
												<span class="avatar avatar-xl">
													<img id="<?= $row_perawat['username']; ?>" class="avatar-img rounded-circle border border-white border-3 shadow" src="<?php
																																											if ($row_perawat['profile_picture'] == "") {
																																												echo "../assets/images/admin/no-preview-available.png";
																																											} else if ($row_perawat['profile_picture'] != "") {
																																												echo "../assets/images/upload/perawat/" . $row_perawat['profile_picture'];
																																											}
																																											?>" alt="">
												</span>

											</label>
											<!-- Upload button -->
											<label class="btn btn-primary-soft mb-0" for="uploadfile-1">Change</label>
											<input id="uploadfile-1" class="form-control d-none" type="file" name="profile_picture">
											<p class="small  mb-0">&nbsp;&nbsp;&nbsp;&nbsp;<b>Note:</b> Only JPG, JPEG and PNG. Our suggested
												dimensions are 200px * 200px.</p>
										</div>
									</div>

									<!-- Full name -->
									<div class="col-6">
										<label class="form-label">Nama lengkap</label>
										<div class="input-group">
											<input type="text" class="form-control" name="full_name" placeholder="Masukkan nama lengkap sesuai KTP" value="<?= $row_perawat['full_name']; ?>" required>
										</div>
									</div>

									<!-- Username -->
									<div class="col-md-6">
										<label class="form-label">Username</label>
										<div class="input-group">
											<input type="text" class="form-control" name="username" placeholder="Masukkan username" value="<?= $row_perawat['username']; ?>">
										</div>
									</div>

									<!-- Phone number -->
									<div class="col-md-6">
										<label class="form-label">Mobile Phone</label>
										<input type="text" class="form-control" name="mobile_number" id="mobile_number" placeholder="Masukkan mobile phone" data-inputmask="'mask': '+6299999999999'" value="<?= $row_perawat['mobile_number']; ?>">
									</div>

									<!-- Jenis kelamin -->
									<div class="col-md-6">
										<label class="form-label">Jenis Kelamin</label>
										<select class="form-select js-choice border-0 z-index-9 bg-transparent" aria-label=".form-select-sm" data-search-enabled="true" name="jenis_kelamin" required>
											<?php
											if ($row_perawat['jenis_kelamin'] == 1) {
												echo '<option value="">Select gender</option>';
												echo '<option value="1" selected>Laki-Laki</option>';
												echo '<option value="2">Perempuan</option>';
											} else if ($row_perawat['jenis_kelamin'] == 2) {
												echo '<option value="">Select gender</option>';
												echo '<option value="1">Laki-Laki</option>';
												echo '<option value="2" selected>Perempuan</option>';
											}
											?>
										</select>
									</div>

									<!-- Email -->
									<div class="col-md-6">
										<label class="form-label">Email</label>
										<input class="form-control" name="email" type="text" placeholder="Masukkan E-mail" value="<?= $row_perawat['email']; ?>">
									</div>


									<!-- Pendidikan -->
									<div class="col-md-6">
										<label class="form-label">Masukkan Pendidikan/Lulusan</label>
										<input class="form-control" name="pendidikan" type="text" placeholder="Masukkan Pendidikan/Lulusan" value="<?= $row_perawat['pendidikan']; ?>" required>
									</div>

									<!-- Adress -->
									<div class="col-md-6">
										<label class="form-label">Alamat</label>
										<textarea class="form-control" name="alamat" rows="2" placeholder="Masukkan Alamat"><?= $row_perawat['alamat']; ?></textarea>
									</div>

									<!-- Deskripsi -->
									<div class="col-md-12">
										<label class="form-label">Deskripsi</label>
										<textarea class="form-control" id="summernote" name="deskripsi" rows="10" placeholder="Masukkan Deskripsi"><?= $row_perawat['deskripsi']; ?></textarea>
									</div>

									<!-- Save button -->
									<div class="d-sm-flex justify-content-end">
										<input type="hidden" name="id_perawat" value="<?= $row_perawat['id_perawat'] ?>">
										<input type="submit" class="btn btn-primary mb-0 my-0" name="update_profile_perawat" value="Save changes">
									</div>

								<?php } else if ($_SESSION["role"] == "4") { ?>
									<!-- EDIT PROFILE PASIEN -->
									<div class="col-12 justify-content-center align-items-center">
										<label class="form-label">Profile picture</label>
										<div class="d-flex align-items-center">
											<label class="position-relative me-4" for="uploadfile-1" title="<?= $row_pasien['username'] ?>">
												<!-- Avatar place holder -->
												<span class="avatar avatar-xl">
													<img id="<?= $row_pasien['username']; ?>" class="avatar-img rounded-circle border border-white border-3 shadow" src="<?php
																																											if ($row_pasien['user_picture'] == "") {
																																												echo "../assets/images/admin/no-preview-available.png";
																																											} else if ($row_pasien['user_picture'] != "") {
																																												echo "../assets/images/upload/pasien/" . $row_pasien['user_picture'];
																																											}
																																											?>" alt="">
												</span>

											</label>
											<!-- Upload button -->
											<label class="btn btn-primary-soft mb-0" for="uploadfile-1">Change</label>
											<input id="uploadfile-1" class="form-control d-none" type="file" name="user_picture">
											<p class="small  mb-0">&nbsp;&nbsp;&nbsp;&nbsp;<b>Note:</b> Only JPG, JPEG and PNG. Our suggested
												dimensions are 200px * 200px.</p>
										</div>
									</div>

									<!-- Full name -->
									<div class="col-6">
										<label class="form-label">Nama lengkap</label>
										<div class="input-group">
											<input type="text" class="form-control" name="full_name" placeholder="Masukkan nama lengkap sesuai KTP" value="<?= $row_pasien['full_name']; ?>" required>
										</div>
									</div>

									<!-- Username -->
									<div class="col-md-6">
										<label class="form-label">Username</label>
										<div class="input-group">
											<input type="text" class="form-control" name="username" placeholder="Masukkan username" value="<?= $row_pasien['username']; ?>">
										</div>
									</div>

									<!-- Phone number -->
									<div class="col-md-6">
										<label class="form-label">Mobile Phone</label>
										<input type="text" class="form-control" name="mobile_number" id="mobile_number" placeholder="Masukkan mobile phone" data-inputmask="'mask': '+6299999999999'" value="<?= $row_pasien['mobile_number']; ?>">
									</div>

									<!-- Email -->
									<div class="col-md-6">
										<label class="form-label">Email</label>
										<input class="form-control" name="email" type="text" placeholder="Masukkan E-mail" value="<?= $row_pasien['email']; ?>">
									</div>

									<!-- Tanggal Lahir -->
									<div class="col-md-6">
										<label class="form-label">Tanggal Lahir</label>
										<input class="form-control" name="tanggal_lahir" type="date" placeholder="Masukkan Tanggal Lahir" value="<?= $row_pasien['tanggal_lahir']; ?>" required>
									</div>

									<!-- Save button -->
									<div class="d-sm-flex justify-content-end">
										<input type="hidden" name="id_user" value="<?= $row_pasien['id_user'] ?>">
										<input type="submit" class="btn btn-primary mb-0 my-0" name="update_profile_user" value="Save changes">
									</div>

								<?php } else if ($_SESSION["role"] == "1") { ?>
									<!-- EDIT PROFILE ADMIN -->
									<div class="col-12 justify-content-center align-items-center">
										<label class="form-label">Profile picture</label>
										<div class="d-flex align-items-center">
											<label class="position-relative me-4" for="uploadfile-1" title="<?= $row_admin['username'] ?>">
												<!-- Avatar place holder -->
												<span class="avatar avatar-xl">
													<img id="<?= $row_admin['username']; ?>" class="avatar-img rounded-circle border border-white border-3 shadow" src="<?php
																																										if ($row_admin['user_picture'] == "") {
																																											echo "../assets/images/admin/no-preview-available.png";
																																										} else if ($row_admin['user_picture'] != "") {
																																											echo "../assets/images/upload/admin/" . $row_admin['user_picture'];
																																										}
																																										?>" alt="">
												</span>

											</label>
											<!-- Upload button -->
											<label class="btn btn-primary-soft mb-0" for="uploadfile-1">Change</label>
											<input id="uploadfile-1" class="form-control d-none" type="file" name="user_picture">
											<p class="small  mb-0">&nbsp;&nbsp;&nbsp;&nbsp;<b>Note:</b> Only JPG, JPEG and PNG. Our suggested
												dimensions are 200px * 200px.</p>
										</div>
									</div>

									<!-- Full name -->
									<div class="col-6">
										<label class="form-label">Nama lengkap</label>
										<div class="input-group">
											<input type="text" class="form-control" name="full_name" placeholder="Masukkan nama lengkap sesuai KTP" value="<?= $row_admin['full_name']; ?>" required>
										</div>
									</div>

									<!-- Username -->
									<div class="col-md-6">
										<label class="form-label">Username</label>
										<div class="input-group">
											<input type="text" class="form-control" name="username" placeholder="Masukkan username" value="<?= $row_admin['username']; ?>">
										</div>
									</div>

									<!-- Phone number -->
									<div class="col-md-6">
										<label class="form-label">Mobile Phone</label>
										<input type="text" class="form-control" name="mobile_number" id="mobile_number" placeholder="Masukkan mobile phone" data-inputmask="'mask': '+6299999999999'" value="<?= $row_admin['mobile_number']; ?>">
									</div>

									<!-- Email -->
									<div class="col-md-6">
										<label class="form-label">Email</label>
										<input class="form-control" name="email" type="text" placeholder="Masukkan E-mail" value="<?= $row_admin['email']; ?>" required>
									</div>

									<!-- Tanggal Lahir -->
									<div class="col-md-6">
										<label class="form-label">Tanggal Lahir</label>
										<input class="form-control" name="tanggal_lahir" type="date" placeholder="Masukkan Tanggal Lahir" value="<?= $row_admin['tanggal_lahir']; ?>" required>
									</div>

									<!-- Save button -->
									<div class="d-sm-flex justify-content-end">
										<input type="hidden" name="id_user" value="<?= $row_admin['id_user'] ?>">
										<input type="submit" class="btn btn-primary mb-0 my-0" name="update_profile_admin" value="Save changes">
									</div>
								<?php } ?>
							</form>
						</div>
						<!-- Card body END -->
					</div>
					<!-- Edit profile END -->

					<div class="row g-4 mt-3">
						<!-- Password change START -->
						<div class="col-lg-6">
							<div class="card border bg-transparent rounded-3">
								<!-- Card header -->
								<div class="card-header bg-transparent border-bottom">
									<h5 class="card-header-title mb-0">Update password</h5>
								</div>
								<form action="../connection/function.php" method="post">
									<!-- Card body START -->
									<div class="card-body">
										<!-- Current password -->
										<div class="mb-3">
											<label class="form-label">Current password</label>
											<input class="form-control" type="password" name="password" placeholder="Enter current password">
										</div>
										<!-- New password -->
										<div class="mb-3">
											<label class="form-label"> Enter new password</label>
											<div class="input-group">
												<input class="form-control" type="password" name="newPassword" placeholder="Enter new password">
												<span class="input-group-text p-0 bg-transparent">
													<i class="far fa-eye cursor-pointer p-2 w-40px"></i>
												</span>
											</div>
											<div class="rounded mt-1" id="psw-strength"></div>
										</div>
										<!-- Confirm password -->
										<div>
											<label class="form-label">Confirm new password</label>
											<input class="form-control" type="password" name="confirmPassword" placeholder="Enter new password">
										</div>
										<!-- Button -->
										<div class="d-flex justify-content-end mt-4">
											<?php if ($_SESSION["role"] == "2") { ?>
												<input type="hidden" name="id_dokter" value="<?= $row_dokter['id_dokter'] ?>">
											<?php } else if ($_SESSION["role"] == "3") { ?>
												<input type="hidden" name="id_perawat" value="<?= $row_perawat['id_perawat'] ?>">
											<?php } else if ($_SESSION["role"] == "4") { ?>
												<input type="hidden" name="id_user" value="<?= $row_pasien['id_user'] ?>">
											<?php } else if ($_SESSION["role"] == "1") { ?>
												<input type="hidden" name="id_user" value="<?= $row_admin['id_user'] ?>">
											<?php } ?>
											<input type="submit" class="btn btn-primary mb-0 my-0" name="update_password" value="Change password">
										</div>
									</div>
									<!-- Card body END -->
								</form>
							</div>
						</div>
						<!-- Password change end -->
					</div>
				</div>
				<!-- Main content END -->
			</div>
			<!-- Row END -->
		</div>
	</section>
	<!-- =======================
Page content END -->

</main>
<!-- **************** MAIN CONTENT END **************** -->

<?php require '../head_footer_pages/footer.php' ?>