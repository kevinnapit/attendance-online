<!-- home.php -->
<?php $this->extend('admin/layout/main') ?>

<?php $this->section('content') ?>
<!-- Page content goes here -->

<div class="card mb-3">
    <div class="bg-holder d-none d-lg-block bg-card" style="background-image:url(<?= base_url() ?>assets/img/illustrations/corner-4.png);">
    </div>
    <!--/.bg-holder-->
    <div class="card-body">
        <div class="row">
            <div class="col-lg-8">
                <h3 class="mb-0">List User</h3>
            </div>
        </div>
    </div>
</div>


<div class="card mb-3">
    <div class="card-header">
        <div class="row flex-between-center">
            <div class="col">
                <button class="btn btn-primary" onclick="adddata()"><i class="fas fa-plus-square"></i> Tambah User</button>
            </div>
        </div>
    </div>
    <div class="card-body bg-light">
        <div class="row list">
            <div class="col">
                <table id="table_index" width="100%" class="table mb-0 table-striped table-dashboard data-table border-bottom border-200">
                    <thead class="bg-200">
                        <tr>
                            <th><b>Name</b></th>
                            <th><b>Username</b></th>
                            <th><b>Email</b></th>
                            <th><b>isLogin</b></th>
                            <th data-orderable="false"><b>#</b></th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
</div>
<?php $this->endsection() ?>
<?php $this->section('script') ?>

<script>
    function dataindex() {
        $('#table_index').DataTable({
            'processing': true,
            'serverSide': true,
            'scrollX': true,
            'serverMethod': 'post',
            'searchDelay': '350',
            'responsive': false,
            'lengthChange': true,
            'autoWidth': true,
            'sWrapper': 'falcon-data-table-wrapper',

            'ajax': {
                'url': '<?= site_url('admin2011/admin/loaddata') ?>',
                'headers': {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            },
            'columns': [{
                    data: 'name',
                },
                {
                    data: 'username'
                },
                {
                    data: 'email'
                },
                {
                    data: 'isLogin',
                    render: function(data, type, row) {
                        // Create a switch button based on isLogin value (0 or 1)
                        return `
            <div class="custom-control custom-switch">
                <input class="custom-control-input" id="customSwitch${row.id}" type="checkbox" ${data == 1 ? 'checked' : ''} onchange="toggleIsLogin(${row.id}, this)">
                <label class="custom-control-label" for="customSwitch${row.id}" id="labelSwitch${row.id}">
                    ${data == 1 ? 'Diizinkan Login' : 'Tidak Diizinkan Login'}
                </label>
            </div>
        `;
                    }
                },
                {
                    data: 'navButton',
                    render: function(data, type, row) {
                        let buttons = '';

                        // Tambahkan tombol "eye" untuk melihat detail pengguna
                        buttons += '<button onclick="viewData(' + row.id + ')" class="btn btn-sm btn-falcon-info mb-1"><i class="fas fa-eye"></i></button>&nbsp;';
                        if (row.username != 'admin') {
                            buttons += '<button onclick="editdata(' + row.id + ')" class="btn btn-sm btn-falcon-warning mb-1"><i class="fas fa-pen-square"></i></button>&nbsp;';
                            buttons += '<button onclick="deletedata(' + row.id + ')" class="btn btn-sm btn-falcon-danger mb-1"><i class="fas fa-trash-alt"></i></button>';
                        }

                        return buttons;
                    }
                },
            ],
            // 'dom':'Bfrtip',
            // 'buttons':[
            //   'copy','csv','excel','pdf','print'
            // ],	
            'order': [
                [2, 'desc']
            ],
            'language': {
                'emptyTable': 'Belum ada data'
            },
            'destroy': true,
        });
    }

    $(document).ready(function() {
        $('#table_index').DataTable().columns.adjust();
        setTimeout(function() {
            dataindex();
        }, 100);
    });

    function viewData(id) {
        window.location.href = "<?= site_url('admin2011/admin/view') ?>/" + id;
    }


    function toggleIsLogin(id, checkbox) {
        let isLoginValue = checkbox.checked ? 1 : 0;
        let label = $(checkbox).next('label'); // Menangkap label terkait switch

        // Ubah teks label berdasarkan status checkbox
        if (checkbox.checked) {
            label.text('Diizinkan Login'); // Jika switch ON
        } else {
            label.text('Tidak Diizinkan Login'); // Jika switch OFF
        }

        // Kirim request AJAX untuk mengupdate status isLogin
        $.ajax({
            type: 'POST',
            url: "<?= site_url('admin2011/admin/updateIsLogin') ?>", // Pastikan URL yang sesuai
            data: {
                id: id,
                isLogin: isLoginValue,
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(response) {
                // Tanggapan sukses dari server (misalnya: tampilkan toast atau lakukan tindakan lain)
                showToast('success', response.message);
            },
            error: function(xhr, status, error) {
                // Jika ada kesalahan, kembalikan teks ke nilai semula dan tampilkan pesan error
                if (checkbox.checked) {
                    label.text('Tidak Diizinkan Login');
                } else {
                    label.text('Diizinkan Login');
                }
                showToastError(error, xhr.responseJSON);
            }
        });
    }


    function deletedata(iddata) {
        $('#alert_modal').modal('show');
        $("#click_yes").off("click").on("click", function() {
            $.ajax({
                type: 'DELETE',
                url: "<?= site_url('admin2011/admin/delete') ?>/" + iddata,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(response) {
                    $('#alert_modal').modal('hide');
                    // Tanggapan sukses
                    showToast('success', response.message);
                    // Refresh tabel setelah penghapusan data
                    dataindex();
                },
                error: function(xhr, status, error) {
                    // Tanggapan error
                    showToastError(error, xhr.responseJSON);
                }
            });
        });
    }

    function editdata(iddata) {
        $.get("<?= site_url('admin2011/admin/edit') ?>/" + iddata, function(data, status) {
            $("#editor_add").html(data);
            $('#add').modal('toggle');
        });
    }

    function adddata() {
        $('#editor_add').load('<?= site_url('admin2011/admin/add') ?>', function() {
            $('#add').modal({
                show: true
            });
        });
    }
</script>
<?php $this->endsection() ?>