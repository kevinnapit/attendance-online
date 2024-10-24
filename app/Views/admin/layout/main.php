<!DOCTYPE html>
<html lang="en-US" dir="ltr">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- ===============================================-->
    <!--    Document Title-->
    <!-- ===============================================-->
    <title>Attendance</title>

    <!-- ===============================================-->
    <!--    Favicons-->
    <!-- ===============================================-->
    <link rel="apple-touch-icon" sizes="180x180" href="<?= base_url() ?>favicon/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="<?= base_url() ?>favicon/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="<?= base_url() ?>favicon/favicon-16x16.png">
    <link rel="manifest" href="<?= base_url() ?>favicon/site.webmanifest">
    <meta name="theme-color" content="#ffffff">
    <!-- ===============================================-->
    <!--    Stylesheets-->
    <!-- ===============================================-->
    <link href="<?= base_url() ?>assets/lib/flatpickr/flatpickr.min.css" rel="stylesheet">

    <script src="<?= base_url() ?>assets/js/config.navbar-vertical.js"></script>
    <link rel="preconnect" href="https://fonts.gstatic.com/" crossorigin="">
    <link href="<?= base_url() ?>assets/lib/perfect-scrollbar/perfect-scrollbar.css" rel="stylesheet">
    <link href="<?= base_url() ?>assets/lib/prismjs/prism-okaidia.css" rel="stylesheet">
    <link href="<?= base_url() ?>assets/lib/datatables-bs4/dataTables.bootstrap4.min.css" rel="stylesheet">
    <link href="<?= base_url() ?>assets/lib/datatables.net-responsive-bs4/responsive.bootstrap4.css" rel="stylesheet">
    <link href="<?= base_url() ?>assets/lib/fancybox/jquery.fancybox.min.css" rel="stylesheet">
    <link href="<?= base_url() ?>assets/lib/select2/select2.min.css" rel="stylesheet">
    <link href="<?= base_url() ?>assets/lib/emojionearea/emojionearea.min.css" rel="stylesheet">
    <link href="<?= base_url() ?>assets/lib/toastr/toastr.min.css" rel="stylesheet">
    <link href="<?= base_url() ?>assets/css/theme.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="<?= base_url() ?>assets/js/jquery.min.js"></script>
    <script src="<?= base_url() ?>assets/lib/datatables/js/jquery.dataTables.min.js"></script>

    <!-- checkbox -->
    <!-- <link type="text/css" href="https://gyrocode.github.io/jquery-datatables-checkboxes/1.2.12/css/dataTables.checkboxes.css" rel="stylesheet" />
    <script type="text/javascript" src="https://gyrocode.github.io/jquery-datatables-checkboxes/1.2.12/js/dataTables.checkboxes.min.js"></script> -->
    <!-- webcam -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/webcamjs/1.0.26/webcam.js" integrity="sha512-AQMSn1qO6KN85GOfvH6BWJk46LhlvepblftLHzAv1cdIyTWPBKHX+r+NOXVVw6+XQpeW4LJk/GTmoP48FLvblQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="" />
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

</head>

<body>

    <!-- ===============================================-->
    <!--    Main Content-->
    <!-- ===============================================-->
    <main class="main" id="top">

        <div class="container-fluid" data-layout="container">
            <?= $this->include('admin/layout/left_menu') ?>
            <div class="content">

                <?= $this->include('admin/layout/top_menu') ?>
                <!-- Render the content section -->
                <?= $this->renderSection('content') ?>

                <?= $this->include('admin/layout/modal_lg') ?>
                <?= $this->include('admin/layout/modal') ?>
            </div>
        </div>
    </main>
    <!-- ===============================================-->
    <!--    End of Main Content-->
    <!-- ===============================================-->

    <!-- ===============================================-->
    <!--    JavaScripts-->
    <!-- ===============================================-->
    <script src="https://js.pusher.com/8.2.0/pusher.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="<?= base_url() ?>assets/js/popper.min.js"></script>
    <script src="<?= base_url() ?>assets/js/bootstrap.min.js"></script>
    <script src="<?= base_url() ?>assets/lib/@fortawesome/all.min.js"></script>
    <script src="<?= base_url() ?>assets/lib/stickyfilljs/stickyfill.min.js"></script>
    <script src="<?= base_url() ?>assets/lib/sticky-kit/sticky-kit.min.js"></script>
    <script src="<?= base_url() ?>assets/lib/is_js/is.min.js"></script>
    <script src="<?= base_url() ?>assets/lib/lodash/lodash.min.js"></script>
    <script src="<?= base_url() ?>assets/lib/perfect-scrollbar/perfect-scrollbar.js"></script>
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,500,600,700%7cPoppins:100,200,300,400,500,600,700,800,900&amp;display=swap" rel="stylesheet">
    <script src="<?= base_url() ?>assets/lib/prismjs/prism.js"></script>

    <script src="<?= base_url() ?>assets/lib/datatables-bs4/dataTables.bootstrap4.min.js"></script>
    <script src="<?= base_url() ?>assets/lib/datatables.net-responsive/dataTables.responsive.js"></script>
    <script src="<?= base_url() ?>assets/lib/datatables.net-responsive-bs4/responsive.bootstrap4.js"></script>
    <script src="<?= base_url() ?>assets/lib/flatpickr/flatpickr.min.js"></script>
    <script src="<?= base_url() ?>assets/lib/fancybox/jquery.fancybox.min.js"></script>
    <script src="<?= base_url() ?>assets/lib/select2/select2.min.js"></script>
    <script src="<?= base_url() ?>assets/lib/tinymce/tinymce.min.js"></script>
    <script src="<?= base_url() ?>assets/lib/toastr/toastr.min.js"></script>
    <script src="<?= base_url() ?>assets/lib/emojionearea/emojionearea.min.js"></script>
    <script src="<?= base_url() ?>assets/js/theme.js"></script>
    <script src="<?= base_url() ?>assets/lib/echarts/echarts.min.js"></script>
    <script src="<?= base_url() ?>assets/lib/chart.js/Chart.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        function showToast(type, message, title = null) {
            var defaultOptions = {
                closeButton: true,
                newestOnTop: false,
                positionClass: 'toast-bottom-right'
            };
            var vTitle = (title != null) ? title : type;
            toastr.options = defaultOptions;

            switch (type) {
                case 'success':
                    toastr.success(message, vTitle);
                    break;

                case 'warning':
                    toastr.warning(message, vTitle);
                    break;

                case 'error':
                    toastr.error(message, vTitle);
                    break;

                default:
                    toastr.info(message, vTitle);
                    break;
            }
        }

        function showToastError(error, eJson = null) {
            var defaultOptions = {
                closeButton: true,
                newestOnTop: false,
                positionClass: 'toast-bottom-right'
            };
            toastr.options = defaultOptions;

            if (eJson && eJson.errors) {
                // Menggunakan for...in loop
                for (var key in eJson.errors) {
                    toastr.error(eJson.errors[key], key);
                }
            } else {
                toastr.error(error, "Error");
            }
        }
    </script>
    <script>
        // Enable Pusher logging - don't include this in production
        Pusher.logToConsole = true;

        var pusher = new Pusher('bd956035076f87400396', {
            cluster: 'ap1'
        });
        var userRole = "<?php echo session()->get('admin_role'); ?>"; // PHP menambahkan role pengguna

        var adminId = "<?php echo session()->get('admin_id'); ?>";

        // Subscribe ke channel yang sesuai dengan admin_id
        var izinChannel = pusher.subscribe('izin-channel' + adminId);

        izinChannel.bind('izin-added', function(data) {
            // Tambahkan notifikasi ke dalam dropdown hanya untuk admin yang sesuai
            var notificationHtml = '<div class="notification-item">' +
                '<a href="/admin2011/notifikasi/index" style="text-decoration: none; color: inherit;">' +
                data.message +
                '</a></div>';
            document.getElementById('notification-container').insertAdjacentHTML('beforeend', notificationHtml);

            // Perbarui angka notifikasi
            var notificationCountElem = document.getElementById('notification-count');
            var currentCount = parseInt(notificationCountElem.textContent) || 0;
            notificationCountElem.textContent = currentCount + 1;

            // Opsi tambahan: Tampilkan alert menggunakan SweetAlert
            Swal.fire({
                icon: 'warning',
                title: 'Notifikasi Izin untuk Admin',
                text: data.message,
                showConfirmButton: true,
                confirmButtonText: '<a href="/admin2011/cutiizin/index" style="color:white;">Lihat Permohonan</a>',
                confirmButtonColor: '#3085d6',
                showCloseButton: true
            });
        });
        var izinUserChannel = pusher.subscribe('izin-channel-user-' + userId);


        // untuk notifikasi ketika update

        // Ambil ID user dan role dari session (misal disimpan dalam session atau meta tag di HTML)
        var userId = "<?php echo session()->get('admin_id'); ?>";
        var userRole = "<?php echo session()->get('admin_role'); ?>"; // 'superadmin' atau 'user'

        if (userRole === 'superadmin') {
            var adminChannel = pusher.subscribe('izin-channel-admin-' + userId);

            adminChannel.bind('izin-added', function(data) {
                Swal.fire({
                    icon: 'info',
                    title: 'Notifikasi Izin Baru',
                    text: data.message, // Pesan izin baru
                    showConfirmButton: true,
                    confirmButtonText: '<a href="/admin2011/cutiizin/index" style="color:white;">Lihat Permohonan</a>',
                    confirmButtonColor: '#3085d6',
                    showCloseButton: true
                });
            });
        }

        // Jika user adalah user biasa yang mengajukan izin, subscribe ke channel mereka sendiri
        // Untuk User yang mengajukan izin
        if (userRole === 'user') {
            var userChannel = pusher.subscribe('izin-channel-user-' + userId);
            userChannel.bind('izin-status-updated', function(data) {
                Swal.fire({
                    icon: 'info',
                    title: 'Status Izin',
                    text: data.message, // Pesan status izin
                    showConfirmButton: true,
                    confirmButtonText: '<a href="/admin2011/cutiizin/index" style="color:white;">Lihat Status Izin</a>',
                    confirmButtonColor: '#3085d6',
                    showCloseButton: true
                });
            });
        }
    </script>
    <?= $this->renderSection('script') ?>
</body>

</html>