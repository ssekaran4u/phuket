        <script src="<?php echo BASE_URL; ?>app-assets/vendors/js/vendors.min.js"></script>
        <!-- <script src="<?php echo BASE_URL; ?>app-assets/vendors/js/forms/validation/jquery.validate.min.js"></script> -->
        <script src="<?php echo BASE_URL; ?>app-assets/js/core/app-menu.min.js"></script>
        <script src="<?php echo BASE_URL; ?>app-assets/js/core/app.min.js"></script>
        <script src="<?php echo BASE_URL; ?>app-assets/js/scripts/pages/auth-login.js"></script>
        <script src="<?php echo BASE_URL; ?>app-assets/js/scripts/pages/auth-two-steps.min.js"></script>
        <script src="<?php echo BASE_URL; ?>app-assets/vendors/js/extensions/toastr.min.js"></script>
        <script src="<?php echo BASE_URL; ?>app-assets/ajax/avul-login.js"></script>
        <script src="<?php echo BASE_URL; ?>app-assets/vendors/js/extensions/sweetalert2.all.min.js"></script>
        <script src="<?php echo BASE_URL; ?>app-assets/vendors/js/extensions/polyfill.min.js"></script>
        <script>
            $(window).on('load',  function(){
              if (feather) {
                feather.replace({ width: 14, height: 14 });
              }
            });
        </script>
    </body>
</html>