<!DOCTYPE html>
<html lang="en-US" dir="ltr">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">


    <!-- ===============================================-->
    <!--    Document Title-->
    <!-- ===============================================-->
    <title>Falcon | Dashboard &amp; WebApp Template</title>


    <!-- ===============================================-->
    <!--    Favicons-->
    <!-- ===============================================-->
    <link rel="apple-touch-icon" sizes="180x180" href="<?= base_url() ?>assets/img/favicons/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="<?= base_url() ?>assets/img/favicons/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="<?= base_url() ?>assets/img/favicons/favicon-16x16.png">
    <link rel="shortcut icon" type="image/x-icon" href="<?= base_url() ?>assets/img/favicons/favicon.ico">
    <link rel="manifest" href="<?= base_url() ?>assets/img/favicons/manifest.json">
    <meta name="msapplication-TileImage" content="<?= base_url() ?>assets/img/favicons/mstile-150x150.png">
    <meta name="theme-color" content="#ffffff">


    <!-- ===============================================-->
    <!--    Stylesheets-->
    <!-- ===============================================-->
    <script src="<?= base_url() ?>assets/js/config.navbar-vertical.js"></script>
    <link rel="preconnect" href="https://fonts.gstatic.com/" crossorigin="">
    <link href="<?= base_url() ?>assets/lib/perfect-scrollbar/perfect-scrollbar.css" rel="stylesheet">
    <link href="<?= base_url() ?>assets/css/theme.css" rel="stylesheet">

</head>


<body class="bg-white">

    <!-- ===============================================-->
    <!--    Main Content-->
    <!-- ===============================================-->
    <main class="main" id="top">


        <div class="container-fluid">
            <div class="row min-vh-100 bg-100">
                <div class="col-6 d-none d-lg-block">
                    <div class="bg-holder" style="background-image:url(<?= base_url() ?>assets/img/generic/15.jpg);">
                    </div>
                    <!--/.bg-holder-->

                </div>
                <div class="col-sm-10 col-md-6 px-sm-0 align-self-center mx-auto py-5">
                    <div class="row justify-content-center no-gutters">
                        <div class="col-lg-9 col-xl-8 col-xxl-6">
                            <div class="card">
                                <div class="card-header bg-circle-shape text-center p-2"><a class="text-white text-sans-serif font-weight-extra-bold fs-4 z-index-1 position-relative" href="<?= base_url() ?>index.html">Attendance</a></div>
                                <div class="card-body p-4">
                                    <div class="d-flex align-items-center justify-content-between">
                                        <h3>Register</h3>
                                        <p class="mb-0 fs--1"><span class="font-weight-semi-bold">Already User? </span><a href="<?= site_url('admin2011/login') ?>">Login</a></p>
                                    </div>
                                    <form method="POST" action="<?= site_url('register/submit'); ?>">
                                        <div class="form-group">
                                            <label for="split-name">Name</label>
                                            <input class="form-control" type="text" id="split-name" name="name" required />
                                        </div>
                                        <div class="form-group">
                                            <label for="split-username">Username</label>
                                            <input class="form-control" type="text" id="split-username" name="username" required />
                                        </div>
                                        <div class="form-group">
                                            <label for="split-email">Email address</label>
                                            <input class="form-control" type="email" id="split-email" name="email" required />
                                        </div>
                                        <div class="form-row">
                                            <div class="form-group col-6">
                                                <label for="split-password">Password</label>
                                                <input class="form-control" type="password" id="split-password" name="password" required />
                                            </div>
                                            <div class="form-group col-6">
                                                <label for="split-confirm-password">Confirm Password</label>
                                                <input class="form-control" type="password" id="split-confirm-password" name="confirm_password" required />
                                            </div>
                                        </div>
                                        <div class="custom-control custom-checkbox">
                                            <input class="custom-control-input" type="checkbox" id="cover-register-checkbox" name="terms" required />
                                            <label class="custom-control-label" for="cover-register-checkbox">I accept the <a href="#!">terms </a>and <a href="#!">privacy policy</a></label>
                                        </div>
                                        <div class="form-group">
                                            <button class="btn btn-primary btn-block mt-3" type="submit" name="submit">Register</button>
                                        </div>
                                    </form>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <!-- ===============================================-->
    <!--    End of Main Content-->
    <!-- ===============================================-->




    <!-- ===============================================-->
    <!--    JavaScripts-->
    <!-- ===============================================-->
    <script src="<?= base_url() ?>assets/js/jquery.min.js"></script>
    <script src="<?= base_url() ?>assets/js/popper.min.js"></script>
    <script src="<?= base_url() ?>assets/js/bootstrap.min.js"></script>
    <script src="<?= base_url() ?>assets/lib/@fortawesome/all.min.js"></script>
    <script src="<?= base_url() ?>assets/lib/stickyfilljs/stickyfill.min.js"></script>
    <script src="<?= base_url() ?>assets/lib/sticky-kit/sticky-kit.min.js"></script>
    <script src="<?= base_url() ?>assets/lib/is_js/is.min.js"></script>
    <script src="<?= base_url() ?>assets/lib/lodash/lodash.min.js"></script>
    <script src="<?= base_url() ?>assets/lib/perfect-scrollbar/perfect-scrollbar.js"></script>
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,500,600,700%7cPoppins:100,200,300,400,500,600,700,800,900&amp;display=swap" rel="stylesheet">
    <script src="<?= base_url() ?>assets/js/theme.js"></script>

</body>

</html>