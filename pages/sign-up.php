<?php require '../head_footer_pages/head.php' ?>

<!-- **************** MAIN CONTENT START **************** -->
<main>
	<section class="p-0 d-flex align-items-center position-relative overflow-hidden">

		<div class="container-fluid">
			<div class="row">
				<!-- left -->
				<div class="col-12 col-lg-6 d-md-flex align-items-center justify-content-center bg-primary bg-opacity-10 vh-lg-100">
					<div class="p-3 p-lg-5">
						<!-- Title -->
						<div class="text-center">
							<h2 class="fw-bold">Selamat Datang di Rumah Sakit Harapan PAPA</h2>
							<p class="mb-0 h6 fw-light">Kesehatan Anda adalah prioritas kami!</p>
						</div>
						<!-- SVG Image -->
						<img src="../assets/images/RSHarapanPAPA.jpg" class="mt-4 rounded-4" alt="">
						<!-- Info -->
						<div class="d-sm-flex mt-4 align-items-center justify-content-center">
							<!-- Avatar group -->
							<ul class="avatar-group mb-2 mb-sm-0">
								<li class="avatar avatar-sm">
									<img class="avatar-img rounded-circle" src="../assets/images/avatar/01.jpg" alt="avatar">
								</li>
								<li class="avatar avatar-sm">
									<img class="avatar-img rounded-circle" src="../assets/images/avatar/02.jpg" alt="avatar">
								</li>
								<li class="avatar avatar-sm">
									<img class="avatar-img rounded-circle" src="../assets/images/avatar/03.jpg" alt="avatar">
								</li>
								<li class="avatar avatar-sm">
									<img class="avatar-img rounded-circle" src="../assets/images/avatar/04.jpg" alt="avatar">
								</li>
							</ul>
							<!-- Content -->
							<p class="mb-0 h6 fw-light ms-0 ms-sm-3">NaN Pasien bergabung dengan kami, sekarang
								giliran kamu.</p>
						</div>
					</div>
				</div>

				<!-- Right -->
				<div class="col-12 col-lg-6 m-auto">
					<div class="row my-5">
						<div class="col-sm-10 col-xl-8 m-auto">
							<!-- Title -->
							<img class="light-mode-item h-50px" src="../assets/images/logo/logo.png" alt="logo rs">
							<h1 class="fs-2">Sign up Rumah Sakit Harapan PAPA!</h1>
							<p class="lead mb-4">Senang bertemu Anda! Silakan daftar dengan akun Anda.</p>

							<!-- Form START -->
							<form action="../connection/function.php" method="POST">
								<!-- Email -->
								<div class="mb-4">
									<label for="exampleInputEmail1" class="form-label">Email address *</label>
									<div class="input-group input-group-lg">
										<span class="input-group-text bg-light rounded-start border-0 text-secondary px-3"><i class="bi bi-envelope-fill"></i></span>
										<input type="email" name="email" class="form-control border-0 bg-light rounded-end ps-1" placeholder="E-mail" id="exampleInputEmail1">
									</div>
								</div>
								<!-- Password -->
								<div class="mb-4">
									<label for="inputPassword5" class="form-label">Password *</label>
									<div class="input-group input-group-lg">
										<span class="input-group-text bg-light rounded-start border-0 text-secondary px-3"><i class="fas fa-lock"></i></span>
										<input type="password" name="password" class="form-control border-0 bg-light rounded-end ps-1" placeholder="*********" id="inputPassword5">
									</div>
								</div>
								<!-- Confirm Password -->
								<div class="mb-4">
									<label for="inputPassword6" class="form-label">Confirm Password *</label>
									<div class="input-group input-group-lg">
										<span class="input-group-text bg-light rounded-start border-0 text-secondary px-3"><i class="fas fa-lock"></i></span>
										<input type="password" name="confirmPassword" class="form-control border-0 bg-light rounded-end ps-1" placeholder="*********" id="inputPassword6">
									</div>
								</div>
								<!-- Check box -->
								<div class="mb-4">
									<div class="form-check">
										<input type="checkbox" name="agree" class="form-check-input" id="checkbox-1">
										<label class="form-check-label" for="checkbox-1">By signing up, you agree to
											the<a href="#"> terms of service</a></label>
									</div>
								</div>
								<!-- Button -->
								<div class="align-items-center mt-0">
									<div class="d-grid">
										<input type="submit" class="btn btn-primary mb-0" name="register" value="Daftar">
									</div>
								</div>
							</form>
							<!-- Form END -->

							<!-- Sign up link -->
							<div class="mt-4 text-center">
								<span>Sudah punya akun?<a href="sign-in.php"> Login</a></span>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
</main>
<!-- **************** MAIN CONTENT END **************** -->

<?php require '../head_footer_pages/footer.php' ?>