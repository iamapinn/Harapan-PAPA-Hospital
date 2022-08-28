<?php require '../head_footer_pages/head.php' ?>

<!-- **************** MAIN CONTENT START **************** -->
<main>

    <!-- =======================
About Visi & Misi START -->
    <section class="pt-0 pt-md-5">
        <div class="container">
            <!-- Title -->
            <div class="row mb-5">
                <div class="col-lg-12 text-center">
                    <h2>Visi & Misi</h2>
                    <p class="mb-0">Rumah Sakit Harapan Papa adalah institusi pelayanan kesehatan yang
                        menyelenggarakan pelayanan kesehatan perorangan secara paripurna yang menyediakan pelayanan
                        rawat inap, rawat jalan,
                        dan gawat darurat. Rumah Sakit Harapan Papa adalah Rumah Sakit yang memberikan pelayanan
                        kesehatan pada semua bidang dan jenis penyakit.</p>
                </div>
            </div>

            <div class="row align-items-center">
                <div class="col-lg-4 position-relative">

                    <!-- Image -->
                    <img src="<?php
                                if ("../assets/images/element/visi_pict.jpg" == "") {
                                    echo "../assets/images/admin/no-preview-available.png";
                                } else {
                                    echo "../assets/images/element/visi_pict.jpg";
                                }
                                ?>" class="rounded img-fluid" alt="">
                </div>

                <div class="col-lg-6 mt-4 mt-lg-0">
                    <!-- Title -->
                    <h4 class="mb-1">Visi :</h4>

                    <!-- Info -->
                    <ul class="list-group list-group-borderless mt-2">
                        <li class="list-group-item d-flex">
                            <i class="bi bi-patch-check-fill text-success me-2"></i> Harapapan Papa Hospital
                            manjadi rumah sakit pendidikan berkelas dunia pada tahun 2022
                        </li>
                    </ul>

                    <!-- Title -->
                    <h4 class="mb-1 mt-3">Misi :</h4>

                    <!-- Info -->
                    <ul class="list-group list-group-borderless mt-2">
                        <li class="list-group-item d-flex">
                            <i class="bi bi-patch-check-fill text-success me-2"></i> Menyelenggarkan pelayanan
                            kesehatan yang paripurna
                        </li>
                        <li class="list-group-item d-flex">
                            <i class="bi bi-patch-check-fill text-success me-2"></i> Menyelenggarakan pendidikan
                            interprofesional bidang kesehatan yang komprehensif
                        </li>
                        <li class="list-group-item d-flex">
                            <i class="bi bi-patch-check-fill text-success me-2"></i>Mengembangkan pusat pendidikan
                            riset klinik yang terintegrasi dengan AHS Harapan Papa
                        </li>
                        <li class="list-group-item d-flex">
                            <i class="bi bi-patch-check-fill text-success me-2"></i>Menyelenggarakan manajemen yang
                            professional dan akuntabel, serta mampu mencapai kemandirian finansial
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </section>
    <!-- =======================
About Visi & Misi END -->

</main>
<!-- **************** MAIN CONTENT END **************** -->

<?php require '../head_footer_pages/footer.php' ?>