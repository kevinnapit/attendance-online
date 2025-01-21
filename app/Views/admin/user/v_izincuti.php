<?php $this->extend('front/layout/main') ?>

<?php $this->section('content') ?>

    <!-- Card Section -->
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="card-title mb-0">Izin dan Cuti</h5>
            <button class="btn btn-primary" data-bs-toggle="modal" onclick="adddata()" data-bs-target="#tambahModal">
                Tambah
            </button>
        </div>
        <div class="row list">
            <div class="col">
                <table id="table_index" width="100%" class="table mb-0 table-striped table-dashboard data-table border-bottom border-200">
                    <thead class="bg-200">
                        <tr>
                            <th><b>Name</b></th>
                            <th><b>Type</b></th>
                            <th><b>Start Date</b></th>
                            <th><b>End Date</b></th>
                            <th><b>Reason</b></th>
                            <th><b>Status</b></th>
                            <th data-orderable="false"><b>#</b></th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>

<?php $this->endSection() ?>

<?php $this->section('script') ?>
<script>
    function adddata() {
        $('#editor_add').load('<?= site_url('admin2011/CutiUsers/add') ?>', function() {
            $('#add').modal({
                show: true
            });
        });
    }

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
                'url': '<?= site_url('admin2011/CutiUsers/loaddata') ?>',
                'headers': {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            },
            'columns': [{
                    data: 'name',
                },
                {
                    data: 'type'
                },
                {
                    data: 'start_date'
                },
                {
                    data: 'end_date'
                },
                {
                    data: 'reason'
                },
                {
                    data: 'status',
                    render: function(data, type, row) {
                        let statusClass = '';
                        if (data === 'pending') {
                            statusClass = 'badge badge-warning';
                        } else if (data === 'approved') {
                            statusClass = 'badge badge-success';
                        } else if (data === 'rejected') {
                            statusClass = 'badge badge-danger';
                        }
                        return '<span class="' + statusClass + '">' + data + '</span>';
                    }
                },
                {
                    data: 'navButton',
                    render: function(data, type, row) {
                        if (row.username != 'admin')
                            return '<button onclick="editdata(' + row.id + ')" class="btn btn-sm btn-falcon-warning mb-1"><i class="fas fa-pen-square"></i></button>&nbsp;<button onclick="deletedata(' + row.id + ')" class="btn btn-sm btn-falcon-danger mb-1"><i class="fas fa-trash-alt"></i></button>';
                        else return "";
                    }
                },
            ],
            // 'dom':'Bfrtip',
            // 'buttons':[
            //   'copy','csv','excel','pdf','print'
            // ],	
            'order': [
                [2, 'asc']
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
</script>
<?php $this->endSection() ?>