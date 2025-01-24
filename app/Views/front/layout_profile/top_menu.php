<nav class="navbar navbar-light navbar-glass navbar-top sticky-kit navbar-expand">

  <button class="btn navbar-toggler-humburger-icon navbar-toggler mr-1 mr-sm-3" type="button" data-toggle="collapse" data-target="#navbarVerticalCollapse" aria-controls="navbarVerticalCollapse" aria-expanded="false" aria-label="Toggle Navigation"><span class="navbar-toggle-icon"><span class="toggle-line"></span></span></button>
  <a class="navbar-brand mr-1 mr-sm-3" href="<?php echo site_url("user/dashboard") ?>">
    <div class="d-flex align-items-center"><img class="mr-2" src="<?= base_url() ?>assets/img/logos/logo.svg" alt="" height="40" /></div>
  </a>
  <ul class="navbar-nav align-items-center d-none d-lg-block">
    <li class="nav-item">
      <div class="search-box">
        <form class="position-relative" data-toggle="search" data-display="static">

          <input class="form-control search-input" type="search" placeholder="Search..." aria-label="Search" />
          <span class="fas fa-search search-box-icon"></span>

        </form>
      </div>
    </li>
  </ul>

  <ul class="navbar-nav navbar-nav-icons ml-auto flex-row align-items-center">

    <!-- navbar untuk notifikasi -->
    <li class="nav-item dropdown dropdown-on-hover">
      <a class="nav-link notification-indicator notification-indicator-primary px-0 icon-indicator" id="navbarDropdownNotification" href="<?= base_url('admin2011/cuti_izin/index') ?>" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
        <svg class="svg-inline--fa fa-bell fa-w-14 fs-4" data-fa-transform="shrink-6" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="bell" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" data-fa-i2svg="" style="transform-origin: 0.4375em 0.5em;">
          <g transform="translate(224 256)">
            <g transform="translate(0, 0) scale(0.625, 0.625) rotate(0 0 0)">
              <path fill="currentColor" d="M224 512c35.32 0 63.97-28.65 63.97-64H160.03c0 35.35 28.65 64 63.97 64zm215.39-149.71c-19.32-20.76-55.47-51.99-55.47-154.29 0-77.7-54.48-139.9-127.94-155.16V32c0-17.67-14.32-32-31.98-32s-31.98 14.33-31.98 32v20.84C118.56 68.1 64.08 130.3 64.08 208c0 102.3-36.15 133.53-55.47 154.29-6 6.45-8.66 14.16-8.61 21.71.11 16.4 12.98 32 32.1 32h383.8c19.12 0 32-15.6 32.1-32 .05-7.55-2.61-15.27-8.61-21.71z" transform="translate(-224 -256)"></path>
            </g>
          </g>
        </svg>
        <span id="notification-count" class="notification-count"></span>
      </a>
      <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownNotification">
        <div id="notification-container" class="bg-white rounded-soft py-2">
          <!-- Notifications will be appended here -->

        </div>
      </div>
    </li>


    <!-- navbar untuk profile -->
    <li class="nav-item dropdown dropdown-on-hover">

      <a class="nav-link pr-0" id="navbarDropdownUser" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        <div class="avatar avatar-xl">
          <img class="rounded-circle" src="<?php if (session()->get('user_picture')) {
                                              echo base_url() . getenv('dir.upload.upload') . session()->get('user_picture') ?><?php } else {
                                                                                                                                echo base_url() ?>assets/img/team/avatar.png<?php } ?>" alt="Image" id="photo_profile_in_top_menu" />
        </div>
      </a>
      <div class="dropdown-menu dropdown-menu-right py-0" aria-labelledby="navbarDropdownUser">
        <div class="bg-white rounded-soft py-2">
          <a class="dropdown-item font-weight-bold text-warning" href="<?php echo site_url("user/profile") ?>"><span class="fas fa-user mr-1"></span><span><?php echo session()->get('user_name') ?></span></a>
          <div class="dropdown-divider"></div>
          <a class="dropdown-item" href="<?php echo site_url("user/profile") ?>">Setting Profile</a>
          <a class="dropdown-item" href="<?php echo site_url("user/logout") ?>">Logout</a>
        </div>
      </div>
    </li>
  </ul>
</nav>

<script>
  $(document).ready(function() {
    function fetchNotifications() {
      $.ajax({
        url: '<?= base_url('user/cuti_izin/getUnreadNotifications') ?>', // Endpoint untuk mengambil data
        method: 'GET',
        dataType: 'json',
        success: function(response) {
          // Perbarui notification count
          $('#notification-count').text(response.count);

          // Tambahkan notifikasi ke dropdown
          var notificationContainer = $('#notification-container');
          notificationContainer.empty(); // Kosongkan container terlebih dahulu

          if (response.notifications.length > 0) {
            response.notifications.forEach(function(notification) {
              var notificationHtml = `
                            <div class="notification-item">
                                <a href="/admin/notifikasi/index" style="text-decoration: none; color: inherit;">
                                    ${notification.message}
                                </a>
                            </div>`;
              notificationContainer.append(notificationHtml);
            });
          } else {
            notificationContainer.append('<p class="text-center">Tidak ada notifikasi baru.</p>');
          }
        },
        error: function(xhr, status, error) {
          console.error('Error fetching notifications:', error);
        },
      });
    }

    // Panggil fungsi fetchNotifications saat halaman dimuat
    fetchNotifications();

    // Refresh notifikasi setiap 30 detik (opsional)
    setInterval(fetchNotifications, 30000);
  });
</script>