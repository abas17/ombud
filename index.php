<!DOCTYPE html>
<html class="loading" lang="en">
<?php include 'database/database.php'; ?>
<?php include 'partials/header.php'; ?>


<body class="vertical-layout page-header-light vertical-menu-collapsible vertical-gradient-menu preload-transitions 2-columns   " data-open="click" data-menu="vertical-gradient-menu" data-col="2-columns">

    <?php include 'partials/nav.php'; ?>

    <?php include 'partials/sidebar.php'; ?>

    <!-- BEGIN: Page Main-->
    <div id="main">
        <div class="row">
            <div class="col s12">
                <div class="container">
                    <?php include 'routes.php'; ?>
                </div>
                <div class="content-overlay"></div>
            </div>
        </div>
    </div>
    <!-- END: Page Main-->


    <?php include 'partials/footer.php'; ?>

</body>

</html>