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
    <link rel="icon" type="image/png" href="<?= base_url() ?>/front/img/favicon.png" sizes="32x32" />
    <link rel="apple-touch-icon" sizes="180x180" href="<?= base_url() ?>/front/img/icon/192x192.png" />
    <link rel="stylesheet" href="<?= base_url() ?>/front/css/inc/bootstrap/bootstrap.min.css" />
    <link rel="stylesheet" href="<?= base_url() ?>/front/css/inc/owl-carousel/owl.carousel.min.css" />
    <link rel="stylesheet" href="<?= base_url() ?>/front/css/inc/owl-carousel/owl.theme.default.css" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Inter:400,500,700&display=swap" />
    <link rel="stylesheet" href="<?= base_url() ?>/front/fontawesome-free/css/all.min.css" />
    <link rel="stylesheet" href="<?= base_url() ?>/front/css/style.css" />
    <!-- calendar -->
    <link href="https://cdn.jsdelivr.net/npm/fullcalendar@3.2.0/dist/fullcalendar.min.css" rel="stylesheet">

    <!-- Leaflet CSS for map -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/webcamjs/1.0.26/webcam.min.js"></script>
    <!-- Leaflet.js for map -->
    <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link href="<?= base_url() ?>assets/lib/fullcalendar/main.min.css" rel="stylesheet" />

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>

    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">

    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>


    <style>
        video {
            clear: both;
            display: block;
            transform: rotateY(180deg);
            -webkit-transform: rotateY(180deg);
            -moz-transform: rotateY(180deg);
        }

        section {
            opacity: 1;
            transition: opacity 500ms ease-in-out;
        }

        header,
        footer {
            clear: both;
        }

        .removed {
            display: none;
        }

        .invisible {
            opacity: 0.2;
        }

        .note {
            font-style: italic;
            font-size: 130%;
        }

        .videoView,
        .detectOnClick,
        .blend-shapes {
            position: relative;
            float: left;
            width: 48%;
            margin: 2% 1%;
            cursor: pointer;
        }

        .videoView p,
        .detectOnClick p {
            position: absolute;
            padding: 5px;
            background-color: #007f8b;
            color: #fff;
            border: 1px dashed rgba(255, 255, 255, 0.7);
            z-index: 2;
            font-size: 12px;
            margin: 0;
        }

        .highlighter {
            background: rgba(0, 255, 0, 0.25);
            border: 1px dashed #fff;
            z-index: 1;
            position: absolute;
        }

        .canvas {
            z-index: 1;
            position: absolute;
            pointer-events: none;
        }

        .output_canvas {
            transform: rotateY(180deg);
            -webkit-transform: rotateY(180deg);
            -moz-transform: rotateY(180deg);
        }

        .detectOnClick {
            z-index: 0;
        }

        .detectOnClick img {
            width: 100%;
        }

        .blend-shapes-item {
            display: flex;
            align-items: center;
            height: 20px;
        }

        .blend-shapes-label {
            display: flex;
            width: 120px;
            justify-content: flex-end;
            align-items: center;
            margin-right: 4px;
        }

        .blend-shapes-value {
            display: flex;
            height: 16px;
            align-items: center;
            background-color: #007f8b;
        }
    </style>

    <style>
        /* Tambahkan style untuk memberikan jarak */
        .main {
            margin-top: 16px;
            /* Jarak dari atas */
            padding-top: 8px;
            /* Tambahan padding */
            background-color: #f8f9fa;
            /* Warna latar untuk visualisasi */
            min-height: 100vh;
            /* Pastikan konten memenuhi layar */
        }
    </style>
</head>

<body>

    <main class="main" id="top">


        <div class="container-fluid" data-layout="container">
           
            <div class="content">



                <?= $this->include('/front/layout/top_menu') ?>


                <?= $this->renderSection('content') ?>

                <?= $this->include('/front/layout/bottom_menu') ?>

                <?= $this->include('/front/layout/modal') ?>

            </div>

        </div>

    </main>


    <!-- link cdn mediapipe start -->

    <!-- <script src="<?= base_url() ?>/front/js/mediapipe.js"></script> -->
    <script src="https://cdn.jsdelivr.net/npm/@mediapipe/drawing_utils/drawing_utils.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@mediapipe/face_mesh"></script>
    <script src="https://cdn.jsdelivr.net/npm/@tensorflow/tfjs"></script>
    <script src="https://cdn.jsdelivr.net/npm/@mediapipe/camera_utils/camera_utils.js"></script>

    <!-- link cdn mediapipe end -->

    <script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>

    <!-- calendar -->
    <script src="<?= base_url() ?>assets/lib/fullcalendar/main.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@3.2.0/dist/fullcalendar.min.js"></script>
    <!-- Jquery -->
    <script src="<?= base_url() ?>/front/js/lib/jquery-3.4.1.min.js"></script>
    <!-- Bootstrap-->
    <script src="<?= base_url() ?>/front/js/lib/popper.min.js"></script>
    <script src="<?= base_url() ?>/front/js/lib/bootstrap.min.js"></script>

    <!-- jQuery Circle Progress -->
    <script src="<?= base_url() ?>/front/js/plugins/jquery-circle-progress/circle-progress.min.js"></script>
    <script src="https://cdn.amcharts.com/lib/4/core.js"></script>
    <script src="https://cdn.amcharts.com/lib/4/charts.js"></script>
    <script src="https://cdn.amcharts.com/lib/4/themes/animated.js"></script>
    <!-- Base Js File -->
    <script src="<?= base_url() ?>/front/js/base.js"></script>


    <?= $this->renderSection('script') ?>

</body>

</html>