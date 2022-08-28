<script>
    toastr.options = {
        "closeButton": false,
        "debug": false,
        "newestOnTop": false,
        "progressBar": true,
        "positionClass": "toast-top-right",
        "preventDuplicates": false,
        "onclick": null,
        "showDuration": "300",
        "hideDuration": "1000",
        "timeOut": "5000",
        "extendedTimeOut": "1000",
        "showEasing": "swing",
        "hideEasing": "linear",
        "showMethod": "fadeIn",
        "hideMethod": "fadeOut"
    }
</script>

<?php
if ($_SESSION["error"]) { ?>
    <script type="text/javascript">
        toastr["error"]("<?= $_SESSION["error"]; ?>", "Error!!!")
    </script>
<?php } elseif ($_SESSION["success"]) { ?>
    <script type="text/javascript">
        toastr["success"]("<?= $_SESSION["success"]; ?>", "Success!!!")
    </script>
<?php } elseif ($_SESSION["warning"]) { ?>
    <script type="text/javascript">
        toastr["warning"]("<?= $_SESSION["warning"]; ?>", "Warning!!!")
    </script>
<?php } elseif ($_SESSION["info"]) { ?>
    <script type="text/javascript">
        toastr["info"]("<?= $_SESSION["info"]; ?>", "Info!!!")
    </script>
<?php }
unset($_SESSION["error"]);
unset($_SESSION["success"]);
unset($_SESSION["warning"]);
unset($_SESSION["info"]);
?>