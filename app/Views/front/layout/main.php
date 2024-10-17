<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate" />
    <meta http-equiv="Pragma" content="no-cache" />
    <meta http-equiv="Expires" content="0" />
    <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1, viewport-fit=cover" />
    <meta name="apple-mobile-web-app-capable" content="yes" />
    <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent" />
    <meta name="theme-color" content="#000000" />
    <title>Mobilekit Mobile UI Kit</title>
    <meta name="description" content="Mobilekit HTML Mobile UI Kit" />
    <meta name="keywords" content="bootstrap 4, mobile template, cordova, phonegap, mobile, html" />
    <link rel="icon" type="image/png" href="<?= base_url() ?>/front/img/favicon.png" sizes="32x32" />
    <link rel="apple-touch-icon" sizes="180x180" href="<?= base_url() ?>/front/img/icon/192x192.png" />
    <link rel="stylesheet" href="<?= base_url() ?>/front/css/inc/bootstrap/bootstrap.min.css" />
    <link rel="stylesheet" href="<?= base_url() ?>/front/css/inc/owl-carousel/owl.carousel.min.css" />
    <link rel="stylesheet" href="<?= base_url() ?>/front/css/inc/owl-carousel/owl.theme.default.css" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Inter:400,500,700&display=swap" />
    <link rel="stylesheet" href="<?= base_url() ?>/front/fontawesome-free/css/all.min.css" />
    <link rel="stylesheet" href="<?= base_url() ?>/front/css/style.css" />
    <!-- webcam -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/webcamjs/1.0.26/webcam.js" integrity="sha512-AQMSn1qO6KN85GOfvH6BWJk46LhlvepblftLHzAv1cdIyTWPBKHX+r+NOXVVw6+XQpeW4LJk/GTmoP48FLvblQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="" />
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    </style>
</head>

<body>

    <main class="main" id="top">

        <div class="container-fluid" data-layout="container">
            <div class="content">
                <?= $this->include('front/layout/top_menu') ?>

                <!-- Render the content section -->
                <?= $this->include('front/layout/bottom_menu') ?>


                <?= $this->renderSection('content') ?>

            </div>
        </div>
    </main>
</body>






<!-- ///////////// Js Files ////////////////////  -->
<!-- Jquery -->
<script src="<?= base_url() ?>/front/js/lib/jquery-3.4.1.min.js"></script>
<!-- Bootstrap-->
<script src="<?= base_url() ?>/front/js/lib/popper.min.js"></script>
<script src="<?= base_url() ?>/front/js/lib/bootstrap.min.js"></script>
<!-- Chart JS -->
<script src="<?= base_url() ?>/front/chart/dist/chart.js"></script>
<!-- <script src="https://cdn.jsdelivr.net/npm/chart.js"></script> -->
<!-- Owl Carousel -->
<script src="<?= base_url() ?>/front/js/plugins/owl-carousel/owl.carousel.min.js"></script>
<!-- jQuery Circle Progress -->
<script src="<?= base_url() ?>/front/js/plugins/jquery-circle-progress/circle-progress.min.js"></script>
<script src="https://cdn.amcharts.com/lib/4/core.js"></script>
<script src="https://cdn.amcharts.com/lib/4/charts.js"></script>
<script src="https://cdn.amcharts.com/lib/4/themes/animated.js"></script>
<!-- Base Js File -->
<script src="<?= base_url() ?>/front/js/base.js"></script>

<script>
    const ctx = document.getElementById('myChart');

    new Chart(ctx, {
        type: 'pie',
        data: {
            labels: ['Red', 'Blue', 'Yellow', 'Green', 'Purple', 'Orange'],
            datasets: [{
                label: '# of Votes',
                data: [12, 19, 3, 5, 2, 3],
                borderWidth: 1
            }]
        }
    });
</script>
</body>

</html>