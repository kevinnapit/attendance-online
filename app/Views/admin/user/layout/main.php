<!doctype html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport"
        content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1, viewport-fit=cover" />
    <meta name="apple-mobile-web-app-capable" content="yes" />
    <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">
    <meta name="theme-color" content="#000000">
    <title>Mobilekit Mobile UI Kit</title>
    <meta name="description" content="Mobilekit HTML Mobile UI Kit">
    <meta name="keywords" content="bootstrap 4, mobile template, cordova, phonegap, mobile, html" />
    <link rel="icon" type="image/png" href="<?= base_url() ?>front/img/favicon.png" sizes="32x32" />
    <link rel="apple-touch-icon" sizes="180x180" href="<?= base_url() ?>front/img/icon/192x192.png" />
    <link rel="stylesheet" href="<?= base_url() ?>front/css/inc/bootstrap/bootstrap.min.css" />
    <link rel="stylesheet" href="<?= base_url() ?>front/css/inc/owl-carousel/owl.carousel.min.css" />
    <link rel="stylesheet" href="<?= base_url() ?>front/css/inc/owl-carousel/owl.theme.default.css" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Inter:400,500,700&display=swap" />
    <link rel="stylesheet" href="<?= base_url() ?>front/fontawesome-free/css/all.min.css" />
    <link rel="stylesheet" href="<?= base_url() ?>front/css/style.css" />
</head>

<body>

    <!-- loader -->
    <div id="loader">
        <div class="spinner-border text-primary" role="status"></div>
    </div>
    <!-- * loader -->

    <!-- App Header -->
    <?= $this->include('admin/user/layout/top_menu') ?>
    <!-- * App Header -->

    <!-- App Capsule -->
    <div id="appCapsule">


        <div class="section full mt-2">
            <div class="section-title">Title</div>
            <div class="wide-block pt-2 pb-2">
                <?= $this->renderSection('content') ?>
            </div>

        </div>



    </div>
    <!-- * App Capsule -->

    <?= $this->include('admin//user/layout/footer') ?>



    <!-- Jquery -->
    <script src="<?= base_url() ?>front/js/lib/jquery-3.4.1.min.js"></script>
    <!-- Bootstrap-->
    <script src="<?= base_url() ?>front/js/lib/popper.min.js"></script>
    <script src="<?= base_url() ?>front/js/lib/bootstrap.min.js"></script>

    <!-- jQuery Circle Progress -->
    <script src="<?= base_url() ?>front/js/plugins/jquery-circle-progress/circle-progress.min.js"></script>
    <script src="https://cdn.amcharts.com/lib/4/core.js"></script>
    <script src="https://cdn.amcharts.com/lib/4/charts.js"></script>
    <script src="https://cdn.amcharts.com/lib/4/themes/animated.js"></script>
    <!-- Base Js File -->
    <script src="<?= base_url() ?>front/js/base.js"></script>



</body>

</html>