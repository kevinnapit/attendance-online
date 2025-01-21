<div class="modal-header">
    <h4 class="modal-title"><?= $title ?></h4>
    <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span class="font-weight-light" aria-hidden="true">&times;</span></button>
</div>
<div class="modal-body text-left">
    <form id="add_submit">
        <input type="hidden" name="action" value="<?= $action ?>" />
        <input type="hidden" name="id" value="<?php if (isset($detail['id'])) echo $detail['id']; ?>" />
        Type:<br />
        <select name="type" class="form-control">
            <option>Jenis Permohonan</option>
            <option <?php if (isset($detail['type']) && $detail['type'] == 'izin') { ?>selected<?php } ?> value="izin">Izin</option>
            <option <?php if (isset($detail['type']) && $detail['type'] == 'cuti') { ?>selected<?php } ?> value="cuti">Cuti</option>
        </select>
        <br />
        Start Date:<br />
        <input type="date" name="start_date" id="datetime" value="<?php if (isset($detail['start_date'])) echo $detail['start_date']; ?>" class="form form-control form-50 datetimepicker" size="40" />
        <br />
        End Date:<br />
        <input type="date" name="end_date" id="datetime" value="<?php if (isset($detail['end_date'])) echo $detail['end_date']; ?>" class="form form-control form-50 datetimepicker" size="40" />
        <br />

        Alasan:<br />
        <textarea name="reason" class="form form-control form-50" rows="4" cols="50"><?php if (isset($detail['reason'])) echo $detail['reason']; ?></textarea>
        <br />
        <input type="submit" name="submit" value="<?= $tombol ?>" class="btn btn-primary mt-3" />
    </form>
</div>

<script>
    flatpickr("#datetime", {
        dateFormat: "Y-m-d",
        disableMobile: "true"
    });

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

    $(document).ready(function() {
        $('#add_submit').submit(function(e) {
            e.preventDefault();

            var form = $(this)[0];
            var formData = new FormData(form);

            $.ajax({
                type: 'POST',
                url: "<?= site_url('admin2011/CutiUsers/submitdata') ?>",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: formData, // Use the FormData object as the data
                processData: false, // Prevent jQuery from processing the data
                contentType: false, // Prevent jQuery from setting the content type
                success: function(response) {
                    $('#add_submit input[type="text"]').val('');
                    $('#add_submit textarea').val('');
                    $('#add').modal('hide');
                    dataindex();
                    showToast("success", response.message);
                },
                error: function(xhr, status, error) {
                    var response = xhr.responseJSON;
                    d
                    showToastError('Error', response);
                }
            });
        });
    });
    $('#add').on('hidden.bs.modal', function() {
        dataindex();
        $('#report_edit').html('');
    });
</script>