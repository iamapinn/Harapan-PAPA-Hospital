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

					<!-- Advanced filter responsive toider START -->
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
										<a class="list-group-item" href="edit-profile.php"><i class="bi bi-pencil-square fa-fw me-2"></i>Edit Profile</a>
										<a class="list-group-item active" href="delete-account.php"><i class="bi bi-trash fa-fw me-2"></i>Delete Profile</a>
										<a class="list-group-item text-danger bg-danger-soft-hover" href="sign-in.html"><i class="fas fa-sign-out-alt fa-fw me-2"></i>Sign Out</a>
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
					<form action="../connection/function.php" method="POST">
						<!-- Title and select START -->
						<div class="card border bg-transparent rounded-3 mb-0">
							<!-- Card header -->
							<div class="card-header bg-transparent border-bottom">
								<h3 class="card-header-title mb-0">Deactivate Account</h3>
							</div>
							<!-- Card body -->
							<div class="card-body">
								<h6>Before you go...</h6>
								<ul>
									<li>If you delete your account, you will lose your all data.</li>
								</ul>

								<div class="form-check form-check-md my-4">
									<input class="form-check-input" name="agree" type="checkbox" id="deleteaccountCheck">
									<label class="form-check-label" for="deleteaccountCheck">Yes, I'd like to delete my account</label>
								</div>
								<input type="hidden" name="id_user" value="<?= $_COOKIE['id_user']; ?>">
								<input type="hidden" name="id_dokter" value="<?= $_COOKIE['id_dokter']; ?>">
								<input type="hidden" name="id_perawat" value="<?= $_COOKIE['id_perawat']; ?>">
								<input type="submit" name="delete_account" class="btn btn-danger mb-0" value="Delete my account">

							</div>
						</div>
						<!-- Title and select END -->
					</form>
				</div>
				<!-- Main content END -->
			</div>
		</div>
	</section>
	<!-- =======================
Page content END -->

</main>
<!-- **************** MAIN CONTENT END **************** -->
<?php require '../head_footer_pages/footer.php' ?>