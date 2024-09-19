<!doctype html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1, viewport-fit=cover" />
    <meta name="apple-mobile-web-app-capable" content="yes" />
    <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">
    <meta name="theme-color" content="#000000">
    <title>Absensi</title>
    <meta name="description" content="Mobilekit HTML Mobile UI Kit">
    <meta name="keywords" content="bootstrap 4, mobile template, cordova, phonegap, mobile, html" />
    <link rel="stylesheet" href="<?= base_url() ?>/front/assets/css/inc/bootstrap/bootstrap.min.css" />
    <link rel="stylesheet" href="<?= base_url() ?>/front/assets/css/inc/owl-carousel/owl.carousel.min.css" />
    <link rel="stylesheet" href="<?= base_url() ?>/front/assets/css/inc/owl-carousel/owl.theme.default.css" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Inter:400,500,700&display=swap" />
    <link rel="stylesheet" href="<?= base_url() ?>/front/assets/fontawesome-free/css/all.min.css" />
    <link rel="stylesheet" href="<?= base_url() ?>/front/assets/css/style.css" />

</head>

<body class="bg-white">

    <!-- loader -->
    <div id="loader">
        <div class="spinner-border text-primary" role="status"></div>
    </div>
    <!-- * loader -->


    <!-- App Capsule -->
    <div id="appCapsule" class="pt-0">

        <div class="login-form mt-1">
            <div class="section">
                <img src="<?= base_url() ?>/front/img/salam.jpg" alt="image" class="form-image">
            </div>
            <div class="section mt-1">
                <h1>Login</h1>

            </div>
            <div class="section mt-1 mb-5">
                <?php
                $errors = validation_errors();

                if (session()->get('pesan')) {
                    echo '<div class="alert alert-danger">';
                    echo session()->get('pesan');
                    echo '</div>';
                }

                ?>
                <?php echo form_open('auth/ceklogin_karyawan') ?>

                <div class="form-group boxed">
                    <div class="input-wrapper">
                        <input type="text" class="form-control" id="username" name="username" placeholder="Username">
                        <i class="fas fa-times-circle clear-input"></i>
                    </div>
                    <p class="text text-danger"><?= isset($errors['username']) == isset($errors['username']) ? validation_show_error('username') : '' ?></p>
                </div>

                <div class="form-group boxed">
                    <div class="input-wrapper">
                        <input type="password" class="form-control" id="password1" name="password" placeholder="Password">
                        <i class="fas fa-times-circle clear-input"></i>
                    </div>
                    <p class="text text-danger"><?= isset($errors['password']) == isset($errors['password']) ? validation_show_error('password') : '' ?></p>
                </div>

                <div class="form-links mt-2">
                    <div>
                        <a href="page-register.html">Daftar</a>
                    </div>
                    <div><a href="page-forgot-password.html" class="text-muted">Forgot Password?</a></div>
                </div>

                <div class="form-button-group">
                    <button type="submit" class="btn btn-primary btn-block btn-lg">Log in</button>
                </div>


                <?php echo form_close() ?>
            </div>
        </div>


    </div>
    <!-- * App Capsule -->



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


</body>

</html>