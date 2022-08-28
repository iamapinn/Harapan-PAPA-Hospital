<!-- =======================
Footer START -->
<footer class="bg-dark p-3">
    <div class="container">
        <div class="row align-items-center">
            <!-- Widget -->
            <div class="col-md-4 text-center text-md-start mb-3 mb-md-0">
                <!-- Logo START -->
                <a href="index.html"> <img class="h-20px" src="../assets/images/logo/logo_navbar.svg" alt="logo"> </a>
            </div>

            <!-- Widget -->
            <div class="col-md-4 mb-3 mb-md-0">
                <div class="text-center text-white">
                    Copyrights ©2022 <a href="#" class="text-reset btn-link">Harapan PAPA Hospital</a>. All rights reserved.
                </div>
            </div>
            <!-- Widget -->
            <div class="col-md-4">
                <!-- Rating -->
                <ul class="list-inline mb-0 text-center text-md-end">
                    <li class="list-inline-item ms-2"><a href="#"><i class="text-white fab fa-facebook"></i></a></li>
                    <li class="list-inline-item ms-2"><a href="#"><i class="text-white fab fa-instagram"></i></a></li>
                    <li class="list-inline-item ms-2"><a href="#"><i class="text-white fab fa-linkedin-in"></i></a></li>
                    <li class="list-inline-item ms-2"><a href="#"><i class="text-white fab fa-twitter"></i></a></li>
                </ul>
            </div>
        </div>
    </div>
</footer>
<!-- =======================
Footer END -->

<!-- Back to top -->
<div class="back-top"><i class="bi bi-arrow-up-short position-absolute top-50 start-50 translate-middle"></i></div>

<!-- Bootstrap JS -->
<script src="../assets/vendor/bootstrap/dist/js/bootstrap.bundle.min.js"></script>

<!-- Vendors -->
<script src="../assets/vendor/tiny-slider/tiny-slider.js"></script>
<script src="../assets/vendor/glightbox/js/glightbox.js"></script>
<script src="../assets/vendor/purecounterjs/dist/purecounter_vanilla.js"></script>
<script src="../assets/vendor/choices/js/choices.min.js"></script>

<!-- include toastr -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>

<!-- info.php toastr -->
<?php require '../connection/info.php' ?>

<!-- include summernote css/js -->
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>

<!-- include inputmask -->
<script src="../assets/js/jquery.inputmask.min.js"></script>

<!-- Template Functions -->
<script src="../assets/js/functions.js"></script>
<script>
    $(document).ready(function() {
        $('#summernote').summernote({
            height: 300, // set editor height
            focus: true // set focus to editable area after initializing summernote
        });
        $("#mobile_number").inputmask();
    });
</script>

</body>

</html>