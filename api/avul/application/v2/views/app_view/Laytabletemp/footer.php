        <div class="sidenav-overlay"></div>
        <div class="drag-target"></div>
        <footer class="footer footer-static footer-light">
            <p class="clearfix mb-0">
                <span class="float-md-start d-block d-md-inline-block mt-25">COPYRIGHT &copy; <?php echo date('Y') ?> <a class="ms-25" href="Javascript:void()" target="_blank"><?php echo SITE_NAME; ?></a><span class="d-none d-sm-inline-block">, All rights Reserved</span>
                </span>
            </p>
        </footer>
        <button class="btn btn-primary btn-icon scroll-top" type="button">
        <i data-feather="arrow-up"></i>
        </button>
    <script src="<?php echo BASE_URL; ?>app-assets/vendors/js/vendors.min.js"></script>
    <script src="<?php echo BASE_URL; ?>app-assets/vendors/js/charts/apexcharts.min.js"></script>
    <script src="<?php echo BASE_URL; ?>app-assets/vendors/js/extensions/toastr.min.js"></script>
    <script src="<?php echo BASE_URL; ?>app-assets/js/core/app-menu.min.js"></script>
    <script src="<?php echo BASE_URL; ?>app-assets/js/core/app.min.js"></script>
    <script src="<?php echo BASE_URL; ?>app-assets/js/scripts/customizer.min.js"></script>
    <script src="<?php echo BASE_URL; ?>app-assets/js/scripts/pages/dashboard-ecommerce.min.js"></script>
    <script src="<?php echo BASE_URL; ?>app-assets/vendors/js/extensions/sweetalert2.all.min.js"></script>
    <script src="<?php echo BASE_URL; ?>app-assets/ajax/avul-common.js"></script>
    <script src="<?php echo BASE_URL; ?>app-assets/ajax/avul-crud.js"></script>
    <script src="<?php echo BASE_URL; ?>app-assets/js/scripts/ui/ui-feather.min.js"></script>
    <script src="<?php echo BASE_URL; ?>app-assets/vendors/js/forms/select/select2.full.min.js"></script>
    <script src="<?php echo BASE_URL; ?>app-assets/js/scripts/forms/form-select2.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/jquery-ui.min.js"></script>
    <script>
        $(window).on('load', function() {
            if (feather) {
                feather.replace({
                    width: 14,
                    height: 14
                });
            }
        })
    </script>
    </body>
</html>
