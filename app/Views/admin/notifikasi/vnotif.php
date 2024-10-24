<?php $this->extend('admin/layout/main') ?>
<?php $this->section('content') ?>
<div class="card overflow-hidden mb-3">
    <div class="card-header bg-light">
        <div class="row justify-content-between align-items-center">
            <div class="col-sm-auto">
                <h5 class="mb-1 mb-md-0">Your Notifications</h5>
            </div>
            <div class="col-sm-auto fs--1"><a class="text-sans-serif" href="#!">Mark all as read</a><a class="text-sans-serif ml-2 ml-sm-3" href="#notification-settings-modal" data-toggle="modal">Notification settings</a></div>
        </div>
    </div>
    <div class="card-body fs--1 p-0" id="notification-list">
        <?php if (!empty($notifications)) : ?>
            <?php foreach ($notifications as $notif) : ?>
                <a class="border-bottom-0 notification rounded-0 border-x-0 border-300" href="<?= base_url('admin2011/cutiizin/index/' . $notif['id']) ?>">
                    <div class="notification-avatar">
                        <div class="avatar avatar-xl mr-3">
                            <img class="rounded-circle" src="../assets/img/team/1.jpg" alt="">
                        </div>
                    </div>
                    <div class="notification-body">
                        <p class="mb-1"><?= $notif['message']; ?></p>
                        <span class="notification-time"><?= $notif['created_at']; ?></span>
                    </div>
                </a>
            <?php endforeach; ?>
        <?php else : ?>
            <p class="text-center">No new notifications</p>
        <?php endif; ?>
    </div>
</div>
<?php $this->endSection() ?>
<?php $this->section('script') ?>
<script>
    function loadNotifications() {
        $.ajax({
            url: '<?= site_url("admin2011/notifikasi/index") ?>',
            method: 'GET',
            dataType: 'json',
            success: function(data) {
                console.log(data); // Cek data yang diterima

                var html = '';
                if (data.length > 0) {
                    $.each(data, function(index, item) {
                        html += `
                    <a class="border-bottom-0 notification rounded-0 border-x-0 border-300" href="<?= base_url('admin2011/cutiizin/index') ?>">
                        <div class="notification-avatar">
                            <div class="avatar avatar-xl mr-3">
                                <img class="rounded-circle" src="../assets/img/team/1.jpg" alt="">
                            </div>
                        </div>
                        <div class="notification-body">
                            <p class="mb-1">${item.message}</p>
                            <span class="notification-time">${item.created_at}</span>
                        </div>
                    </a>`;
                    });
                    // Setelah menampilkan notifikasi, panggil AJAX untuk mark as read
                    markNotificationsAsRead();
                } else {
                    html = '<p class="text-center">No new notifications</p>';
                }
                $('#notification-list').html(html);
            },
            error: function(xhr, status, error) {
                console.error("Failed to fetch notifications:", error);
            }
        });
    }

    $('.text-sans-serif').click(function() {
        $.ajax({
            url: '<?= site_url("admin2011/notifikasi/markAsRead") ?>',
            method: 'POST',
            success: function() {
                alert('Semua notifikasi telah ditandai sebagai dibaca.');
                location.reload(); // Reload halaman setelah berhasil menandai notifikasi
            },
            error: function(xhr, status, error) {
                console.error("Failed to mark notifications as read:", error);
            }
        });
    });
</script>
<?php $this->endSection('script') ?>