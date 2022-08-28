<?php require '../head_footer_admin/head.php' ?>

<!-- Page main content START -->
<div class="page-content-wrapper border">

	<!-- Title -->
	<div class="row">
		<div class="col-12 mb-3">
			<h1 class="h3 mb-2 mb-sm-0">Dashboard</h1>
		</div>
	</div>

	<!-- Counter boxes START -->
	<div class="row g-4 mb-4">
		<!-- Counter item -->
		<div class="col-md-6 col-xxl-3">
			<div class="card card-body bg-warning bg-opacity-15 p-4 h-100">
				<div class="d-flex justify-content-between align-items-center">
					<!-- Digit -->
					<div>
						<?php
						$dokter = mysqli_query($conn, "SELECT * FROM tbl_dokter");
						$jumlah_dokter = mysqli_num_rows($dokter);
						?>
						<h2 class="purecounter mb-0 fw-bold" data-purecounter-start="0" data-purecounter-end="<?= $jumlah_dokter ?>" data-purecounter-delay="200">0</h2>
						<span class="mb-0 h6 fw-light">Total Dokter</span>
					</div>
					<!-- Icon -->
					<div class="icon-lg rounded-circle bg-warning text-white mb-0"><i class="fa-solid fa-user-doctor"></i></div>
				</div>
			</div>
		</div>

		<!-- Counter item -->
		<div class="col-md-6 col-xxl-3">
			<div class="card card-body bg-purple bg-opacity-10 p-4 h-100">
				<div class="d-flex justify-content-between align-items-center">
					<!-- Digit -->
					<div>
						<?php
						$perawat = mysqli_query($conn, "SELECT * FROM tbl_perawat");
						$jumlah_perawat = mysqli_num_rows($perawat);
						?>
						<h2 class="purecounter mb-0 fw-bold" data-purecounter-start="0" data-purecounter-end="<?= $jumlah_perawat ?>" data-purecounter-delay="200">0</h2>
						<span class="mb-0 h6 fw-light">Total Perawat</span>
					</div>
					<!-- Icon -->
					<div class="icon-lg rounded-circle bg-purple text-white mb-0"><i class="fas fa-user-nurse fa-fw"></i></div>
				</div>
			</div>
		</div>

		<!-- Counter item -->
		<div class="col-md-6 col-xxl-3">
			<div class="card card-body bg-primary bg-opacity-10 p-4 h-100">
				<div class="d-flex justify-content-between align-items-center">
					<!-- Digit -->
					<div>
						<?php
						$pasien = mysqli_query($conn, "SELECT * FROM tbl_users WHERE role='4'");
						$jumlah_pasien = mysqli_num_rows($pasien);
						?>
						<h2 class="purecounter mb-0 fw-bold" data-purecounter-start="0" data-purecounter-end="<?= $jumlah_pasien ?>" data-purecounter-delay="200">0</h2>
						<span class="mb-0 h6 fw-light">Total Pasien</span>
					</div>
					<!-- Icon -->
					<div class="icon-lg rounded-circle bg-primary text-white mb-0"><i class="fa-solid fa-hospital-user"></i></div>
				</div>
			</div>
		</div>

		<!-- Counter item -->
		<div class="col-md-6 col-xxl-3">
			<div class="card card-body bg-success bg-opacity-10 p-4 h-100">
				<div class="d-flex justify-content-between align-items-center">
					<!-- Digit -->
					<div>
						<div class="d-flex">
							<?php
							$poliklinik = mysqli_query($conn, "SELECT * FROM tbl_poliklinik");
							$jumlah_poliklinik = mysqli_num_rows($poliklinik);
							?>
							<h2 class="purecounter mb-0 fw-bold" data-purecounter-start="0" data-purecounter-end="<?= $jumlah_poliklinik ?>" data-purecounter-delay="200">0</h2>
						</div>
						<span class="mb-0 h6 fw-light">Total Poli Klinik</span>
					</div>
					<!-- Icon -->
					<div class="icon-lg rounded-circle bg-success text-white mb-0"><i class="fa-solid fa-house-chimney-medical"></i></i></div>
				</div>
			</div>
		</div>
	</div>
	<!-- Counter boxes END -->

</div>
<!-- Page main content END -->
</div>
<!-- Page content END -->

</main>
<!-- **************** MAIN CONTENT END **************** -->


<?php require '../head_footer_admin/footer.php' ?>