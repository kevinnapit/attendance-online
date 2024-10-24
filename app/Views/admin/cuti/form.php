<div class="modal-header">
    <h5 class="modal-title"><?= $title ?></h5>
    <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span class="font-weight-light" aria-hidden="true">&times;</span></button>
</div>
<div class="modal-body text-left">
    <form id="add_submit">
        <input type="hidden" name="action" value="<?= $action ?>" />
        <input type="hidden" name="id" value="<?php if (isset($detail['id'])) echo $detail['id']; ?>" />
        Type:<br />
        <select name="type" class="selectpicker form-control">
            <option <?php if (isset($detail['type']) && $detail['type'] == '') { ?>selected<?php } ?>>Jenis Permohonan</option>
            <option <?php if (isset($detail['type']) && $detail['type'] == 'izin') { ?>selected<?php } ?> value="izin">Izin</option>
            <option <?php if (isset($detail['type']) && $detail['type'] == 'cuti') { ?>selected<?php } ?> value="cuti">Cuti</option>
        </select>
        <br />
        Start Date:<br />
        <input type="date" name="start_date" value="<?php if (isset($detail['start_date'])) echo $detail['start_date']; ?>" class="form form-control form-50 datetimepicker" size="40" />
        <br />
        End Date:<br />
        <input type="date" name="end_date" value="<?php if (isset($detail['end_date'])) echo $detail['end_date']; ?>" class="form form-control form-50 datetimepicker" size="40" />
        <br />

        Alasan:<br />
        <textarea name="reason" class="form form-control form-50" rows="4" cols="50"><?php if (isset($detail['reason'])) echo $detail['reason']; ?></textarea>
        <br />
        <?php if (session()->get('admin_role') == 'superadmin') { ?>
            <select name="status" class="selectpicker form-control">
                <option>Pilih status</option>

                <option <?php if (isset($detail['status']) && $detail['status'] == 'pending') { ?>selected<?php } ?> value="pending">Terima</option>
                <option <?php if (isset($detail['status']) && $detail['status'] == 'approved') { ?>selected<?php } ?> value="approved">Terima</option>
                <option <?php if (isset($detail['status']) && $detail['status'] == 'rejected') { ?>selected<?php } ?> value="rejected">Tolak</option>
            </select>
        <?php } ?>
        <span id="report"></span>

        <input type="submit" name="" value="<?= $tombol ?>" class="btn btn-primary mt-3" />
    </form>
</div>
<script>
    utils.$document.ready(function() {
        var datetimepicker = $('.datetimepicker');
        datetimepicker.length && datetimepicker.each(function(index, value) {
            var $this = $(value);
            var options = $.extend({
                dateFormat: 'Y-m-d',
                enableTime: false,
                disableMobile: true
            }, $this.data('options'));
            $this.flatpickr(options);

            $this.on('change', function() {
                console.log($this.val()); // cek tanggal yang dipilih di console
            });
        });
    });

    utils.$document.ready(function() {
        $('.custom-file-input').on('change', function(e) {
            var $this = $(e.currentTarget);
            var fileName = $this.val().split('\\').pop();
            $this.next('.custom-file-label').addClass('selected').html(fileName);
        });
    });
    $(document).ready(function() {
        $('#add_submit').submit(function(e) {
            e.preventDefault();

            var form = $(this)[0];
            var formData = new FormData(form);

            $.ajax({
                type: 'POST',
                url: "<?= site_url('admin2011/cutiizin/submitdata') ?>",
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
                    var response = xhr.responseJSON;d
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