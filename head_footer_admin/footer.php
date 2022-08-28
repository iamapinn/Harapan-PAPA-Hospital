</div>
<!-- Page content END -->

</main>
<!-- **************** MAIN CONTENT END **************** -->

<!-- Back to top -->
<div class="back-top"><i class="bi bi-arrow-up-short position-absolute top-50 start-50 translate-middle"></i></div>

<!-- Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
<script src="../assets/vendor/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
<script src="../assets/vendor/overlay-scrollbar/js/OverlayScrollbars.min.js"></script>

<!-- Vendors -->
<script src="../assets/vendor/purecounterjs/dist/purecounter_vanilla.js"></script>
<script src="../assets/vendor/apexcharts/js/apexcharts.min.js"></script>
<script src="../assets/vendor/overlay-scrollbar/js/OverlayScrollbars.min.js"></script>
<script src="../assets/vendor/choices/js/choices.min.js"></script>
<script src="../assets/vendor/aos/aos.js"></script>
<script src="../assets/vendor/glightbox/js/glightbox.js"></script>
<script src="../assets/vendor/quill/js/quill.min.js"></script>
<script src="../assets/vendor/stepper/js/bs-stepper.min.js"></script>

<!-- include summernote css/js -->
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>

<!-- include inputmask -->
<script src="../assets/js/jquery.inputmask.min.js"></script>

<!-- include toastr -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>

<!-- info.php toastr -->
<?php require '../connection/info.php' ?>

<!-- Template Functions -->
<script src="../assets/js/functions.js"></script>
<script>
    $(document).ready(function() {
        $('#summernote').summernote({
            height: 300, // set editor height
            focus: true // set focus to editable area after initializing summernote
        });
        $("#nip").inputmask();
        $("#mobile_number").inputmask();
    });
</script>


</body>

</html>