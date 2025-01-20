<!-- home.php -->
<?php $this->extend('admin/layout/main') ?>

<?php $this->section('content') ?>
<div class="card mb-3">
    <div class="card-header">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item"><a href="#">Library</a></li>
                <li class="breadcrumb-item active" aria-current="page">Data</li>
            </ol>
        </nav>
    </div>
    <div class="card-body bg-light overflow-hidden">
        <div class="row">
            <div class="col-12">
            </div>

        </div>
    </div>
</div>
<?php $this->endsection() ?>
<?php $this->section('script') ?>

<script>
    function addpendidikan(id) {
        // Load the modal content
        $('#editor_add').load('<?= site_url('admin2011/pendidikan/addpendidikan/') ?>' + id, function() {
            // After loading, show the modal
            $('#add').modal({
                show: true
            });

            // Set the user ID to the hidden input field inside the modal
            $('#id_user').val(id);
        });
    }

    function addpeningkatan(id) {
        // Load the modal content
        $('#editor_add').load('<?= site_url('admin2011/pendidikan/addpeningkatan/') ?>' + id, function() {
            // After loading, show the modal
            $('#add').modal({
                show: true
            });

            // Set the user ID to the hidden input field inside the modal
            $('#id_user').val(id);
        });
    }

    function addpangkat(id) {
        // Load the modal content
        $('#editor_add').load('<?= site_url('admin2011/pangkat/add/') ?>' + id, function() {
            // After loading, show the modal
            $('#add').modal({
                show: true
            });

            // Set the user ID to the hidden input field inside the modal
            $('#id_user').val(id);
        });
    }

    function addmutasi(id) {
        // Load the modal content
        $('#editor_add').load('<?= site_url('admin2011/mutasi/add/') ?>' + id, function() {
            // After loading, show the modal
            $('#add').modal({
                show: true
            });

            // Set the user ID to the hidden input field inside the modal
            $('#id_user').val(id);
        });
    }

    function adddisiplin(id) {
        // Load the modal content
        $('#editor_add').load('<?= site_url('admin2011/disiplin/add/') ?>' + id, function() {
            // After loading, show the modal
            $('#add').modal({
                show: true
            });

            // Set the user ID to the hidden input field inside the modal
            $('#id_user').val(id);
        });
    }

    function addfolder(id) {
        // Load the modal content
        $('#editor_add').load('<?= site_url('admin2011/arsip/add_folder/') ?>' + id, function() {
            // After loading, show the modal
            $('#add').modal({
                show: true
            });

            // Set the user ID to the hidden input field inside the modal
            $('#id_user').val(id);
        });
    }

    function addfile(id) {
        // Load the modal content
        $('#editor_add').load('<?= site_url('admin2011/arsip/add_file/') ?>' + id, function() {
            // After loading, show the modal
            $('#add').modal({
                show: true
            });

            // Set the user ID to the hidden input field inside the modal
            $('#id_user').val(id);
        });
    }

    function editdata(iddata) {
        $.get("<?= site_url('admin2011/pendidikan/editpendidikan') ?>/" + iddata, function(data, status) {
            $("#editor_add").html(data);
            $('#add').modal('toggle');
        });
    }

    function editpeningkatan(iddata) {
        $.get("<?= site_url('admin2011/pendidikan/editpeningkatan') ?>/" + iddata, function(data, status) {
            $("#editor_add").html(data);
            $('#add').modal('toggle');
        });
    }

    function editpangkat(iddata) {
        $.get("<?= site_url('admin2011/pangkat/edit') ?>/" + iddata, function(data, status) {
            $("#editor_add").html(data);
            $('#add').modal('toggle');
        });
    }

    function editmutasi(iddata) {
        $.get("<?= site_url('admin2011/mutasi/edit') ?>/" + iddata, function(data, status) {
            $("#editor_add").html(data);
            $('#add').modal('toggle');
        });
    }

    function editdisiplin(iddata) {
        $.get("<?= site_url('admin2011/disiplin/edit') ?>/" + iddata, function(data, status) {
            $("#editor_add").html(data);
            $('#add').modal('toggle');
        });
    }

    function deletedata(iddata) {
        // Menampilkan modal konfirmasi
        $('#alert_modal').modal('show');

        // Jika tombol "Yes" diklik
        $("#click_yes").off("click").on("click", function() {
            $.ajax({
                type: 'DELETE',
                url: "<?= site_url('admin2011/pendidikan/deletependidikan') ?>/" + iddata,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(response) {
                    $('#alert_modal').modal('hide'); // Menutup modal
                    // Menampilkan pesan sukses
                    showToast('success', response.message);
                    // Me-refresh halaman setelah penghapusan data
                    location.reload(); // Menyegarkan halaman
                },
                error: function(xhr, status, error) {
                    // Tanggapan error
                    showToastError(error, xhr.responseJSON);
                }
            });
        });
    }

    function deletepeningkatan(iddata) {
        // Menampilkan modal konfirmasi
        $('#alert_modal').modal('show');

        // Jika tombol "Yes" diklik
        $("#click_yes").off("click").on("click", function() {
            $.ajax({
                type: 'DELETE',
                url: "<?= site_url('admin2011/pendidikan/deletepeningkatan') ?>/" + iddata,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(response) {
                    $('#alert_modal').modal('hide'); // Menutup modal
                    // Menampilkan pesan sukses
                    showToast('success', response.message);
                    // Me-refresh halaman setelah penghapusan data
                    location.reload(); // Menyegarkan halaman
                },
                error: function(xhr, status, error) {
                    // Tanggapan error
                    showToastError(error, xhr.responseJSON);
                }
            });
        });
    }

    function deletepangkat(iddata) {
        // Menampilkan modal konfirmasi
        $('#alert_modal').modal('show');

        // Jika tombol "Yes" diklik
        $("#click_yes").off("click").on("click", function() {
            $.ajax({
                type: 'DELETE',
                url: "<?= site_url('admin2011/pangkat/delete') ?>/" + iddata,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(response) {
                    $('#alert_modal').modal('hide'); // Menutup modal
                    // Menampilkan pesan sukses
                    showToast('success', response.message);
                    // Me-refresh halaman setelah penghapusan data
                    location.reload(); // Menyegarkan halaman
                },
                error: function(xhr, status, error) {
                    // Tanggapan error
                    showToastError(error, xhr.responseJSON);
                }
            });
        });
    }

    function deletemutasi(iddata) {
        // Menampilkan modal konfirmasi
        $('#alert_modal').modal('show');

        // Jika tombol "Yes" diklik
        $("#click_yes").off("click").on("click", function() {
            $.ajax({
                type: 'DELETE',
                url: "<?= site_url('admin2011/mutasi/delete') ?>/" + iddata,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(response) {
                    $('#alert_modal').modal('hide'); // Menutup modal
                    // Menampilkan pesan sukses
                    showToast('success', response.message);
                    // Me-refresh halaman setelah penghapusan data
                    location.reload(); // Menyegarkan halaman
                },
                error: function(xhr, status, error) {
                    // Tanggapan error
                    showToastError(error, xhr.responseJSON);
                }
            });
        });
    }

    function deletedisiplin(iddata) {
        // Menampilkan modal konfirmasi
        $('#alert_modal').modal('show');

        // Jika tombol "Yes" diklik
        $("#click_yes").off("click").on("click", function() {
            $.ajax({
                type: 'DELETE',
                url: "<?= site_url('admin2011/disiplin/delete') ?>/" + iddata,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(response) {
                    $('#alert_modal').modal('hide'); // Menutup modal
                    // Menampilkan pesan sukses
                    showToast('success', response.message);
                    // Me-refresh halaman setelah penghapusan data
                    location.reload(); // Menyegarkan halaman
                },
                error: function(xhr, status, error) {
                    // Tanggapan error
                    showToastError(error, xhr.responseJSON);
                }
            });
        });
    }

    function deletefolder(iddata) {
        // Menampilkan modal konfirmasi
        $('#alert_modal').modal('show');

        // Jika tombol "Yes" diklik
        $("#click_yes").off("click").on("click", function() {
            $.ajax({
                type: 'DELETE',
                url: "<?= site_url('admin2011/arsip/deletefolder') ?>/" + iddata,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(response) {
                    $('#alert_modal').modal('hide'); // Menutup modal
                    // Menampilkan pesan sukses
                    showToast('success', response.message);
                    // Me-refresh halaman setelah penghapusan data
                    location.reload(); // Menyegarkan halaman
                },
                error: function(xhr, status, error) {
                    // Tanggapan error
                    showToastError(error, xhr.responseJSON);
                }
            });
        });
    }

    function deletefile(iddata) {
        // Menampilkan modal konfirmasi
        $('#alert_modal').modal('show');

        // Jika tombol "Yes" diklik
        $("#click_yes").off("click").on("click", function() {
            $.ajax({
                type: 'DELETE',
                url: "<?= site_url('admin2011/arsip/deletefile') ?>/" + iddata,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(response) {
                    $('#alert_modal').modal('hide'); // Menutup modal
                    // Menampilkan pesan sukses
                    showToast('success', response.message);
                    // Me-refresh halaman setelah penghapusan data
                    location.reload(); // Menyegarkan halaman
                },
                error: function(xhr, status, error) {
                    // Tanggapan error
                    showToastError(error, xhr.responseJSON);
                }
            });
        });
    }
</script>

<?php $this->endsection() ?>