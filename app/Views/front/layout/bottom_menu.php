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
    <link rel="icon" type="image/png" href="<?= base_url() ?>/front/assets/img/favicon.png" sizes="32x32" />
    <link rel="apple-touch-icon" sizes="180x180" href="<?= base_url() ?>/front/assets/img/icon/192x192.png" />
    <link rel="stylesheet" href="<?= base_url() ?>/front/assets/css/inc/bootstrap/bootstrap.min.css" />
    <link rel="stylesheet" href="<?= base_url() ?>/front/assets/css/inc/owl-carousel/owl.carousel.min.css" />
    <link rel="stylesheet" href="<?= base_url() ?>/front/assets/css/inc/owl-carousel/owl.theme.default.css" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Inter:400,500,700&display=swap" />
    <link rel="stylesheet" href="<?= base_url() ?>/front/assets/fontawesome-free/css/all.min.css" />
    <link rel="stylesheet" href="<?= base_url() ?>/front/assets/css/style.css" />
    <!-- webcam -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/webcamjs/1.0.26/webcam.js" integrity="sha512-AQMSn1qO6KN85GOfvH6BWJk46LhlvepblftLHzAv1cdIyTWPBKHX+r+NOXVVw6+XQpeW4LJk/GTmoP48FLvblQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
</head>

<body>


    <!-- App Bottom Menu -->
    <div class="appBottomMenu">
        <a href="<?=base_url('home')?>" class="item">
            <div class="col">
                <i class="fas fa-home fa-3x"></i>
                <strong>Home</strong>
            </div>
        </a>
        <a href="#" class="item active">
            <div class="col">
                <i class="fas fa-calendar-alt fa-3x"></i>
                <strong>Calendar</strong>
            </div>
        </a>
        <a href="<?= base_url('presensi') ?>" class="item">
            <div class="col">
                <div class="action-button large label-dark">
                    <i class="fas fa-camera text-dark fa-3x"></i>
                </div>
            </div>
        </a>
        <a href="#" class="item">
            <div class="col">
                <i class="fas fa-file-alt fa-3x"></i>
                <strong>Docs</strong>
            </div>
        </a>
        <a href="javascript:;" class="item">
            <div class="col">
                <i class="fas fa-user-tie fa-3x"></i>
                <strong>Profile</strong>
            </div>
        </a>
    </div>
    <!-- * App Bottom Menu -->

</body>






<!-- ///////////// Js Files ////////////////////  -->
<!-- Jquery -->
<script src="<?= base_url() ?>/front/assets/js/lib/jquery-3.4.1.min.js"></script>
<!-- Bootstrap-->
<script src="<?= base_url() ?>/front/assets/js/lib/popper.min.js"></script>
<script src="<?= base_url() ?>/front/assets/js/lib/bootstrap.min.js"></script>
<!-- Chart JS -->
<script src="<?= base_url() ?>/front/assets/chart/dist/chart.js"></script>
<!-- <script src="https://cdn.jsdelivr.net/npm/chart.js"></script> -->
<!-- Owl Carousel -->
<script src="<?= base_url() ?>/front/assets/js/plugins/owl-carousel/owl.carousel.min.js"></script>
<!-- jQuery Circle Progress -->
<script src="<?= base_url() ?>/front/assets/js/plugins/jquery-circle-progress/circle-progress.min.js"></script>
<script src="https://cdn.amcharts.com/lib/4/core.js"></script>
<script src="https://cdn.amcharts.com/lib/4/charts.js"></script>
<script src="https://cdn.amcharts.com/lib/4/themes/animated.js"></script>
<!-- Base Js File -->
<script src="<?= base_url() ?>/front/assets/js/base.js"></script>

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