<div class="modal-header">
    <h5 class="modal-title"><?= $title ?></h5>
    <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span class="font-weight-light" aria-hidden="true">&times;</span></button>
</div>
<div class="modal-body text-left">
    <form id="add_mutasi">
        <input type="hidden" name="action" value="<?= $action ?>" />
        <?php if ($action == 'update'): ?>
            <!-- This is an update -->
            <input type="hidden" name="id" value="<?= esc($detail['id']) ?>" />
        <?php else: ?>
            <!-- This is an add -->
            <input type="hidden" name="id_user" value="<?= esc($detail['id']) ?>" />
        <?php endif; ?>

        <!-- TMT -->
        <div class="form-group">
            <label for="tmt">TMT</label>
            <input type="date" name="tmt" class="form form-control form-50" value="<?= isset($detail['tmt']) ? esc($detail['tmt']) : '' ?>" required />
        </div>

        <!-- Nomor SK -->
        <div class="form-group">
            <label for="nomor_sk">Nomor SK</label>
            <input type="text" name="nomor_sk" class="form form-control form-50" value="<?= isset($detail['nomor_sk']) ? esc($detail['nomor_sk']) : '' ?>" size="40" required />
        </div>

        <!-- Tanggal SK -->
        <div class="form-group">
            <label for="tanggal_sk">Tanggal SK</label>
            <input type="date" name="tanggal_sk" class="form form-control form-50" value="<?= isset($detail['tanggal_sk']) ? esc($detail['tanggal_sk']) : '' ?>" required />
        </div>

        <!-- Jabatan -->
        <div class="form-group">
            <label for="jabatan">Jabatan</label>
            <input type="text" name="jabatan" class="form form-control form-50" value="<?= isset($detail['jabatan']) ? esc($detail['jabatan']) : '' ?>" size="40" required />
        </div>

        <!-- Eselon -->
        <div class="form-group">
            <label for="eselon">Eselon</label>
            <input type="text" name="eselon" class="form form-control form-50" value="<?= isset($detail['eselon']) ? esc($detail['eselon']) : '' ?>" size="40" required />
        </div>

        <!-- Unit Kerja -->
        <div class="form-group">
            <label for="unit_kerja">Unit Kerja</label>
            <input type="text" name="unit_kerja" class="form form-control form-50" value="<?= isset($detail['unit_kerja']) ? esc($detail['unit_kerja']) : '' ?>" size="40" required />
        </div>

        <!-- Submit Button -->
        <input type="submit" name="submit" value="<?= $tombol ?>" class="btn btn-primary mt-3" />
    </form>

</div>

<script>
    utils.$document.ready(function() {
        $('.custom-file-input').on('change', function(e) {
            var $this = $(e.currentTarget);
            var fileName = $this.val().split('\\').pop();
            $this.next('.custom-file-label').addClass('selected').html(fileName);
        });
    });
    $('#add_mutasi').submit(function(e) {
        e.preventDefault(); // Prevent the default form submission

        var form = $(this)[0]; // Get the raw HTML form element
        var formData = new FormData(form); // Create a new FormData object

        // Submit the form data via AJAX
        $.ajax({
            type: 'POST',
            url: "<?= site_url('admin2011/mutasi/save') ?>",
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: formData, // Use the FormData object as the data
            processData: false, // Prevent jQuery from processing the data
            contentType: false, // Prevent jQuery from setting the content type
            success: function(response) {
                // Show a toast message for success
                showToast("success", response.message);

                // Close the modal
                $('#add').modal('hide');

                // Reload the page to reflect the changes
                location.reload(); // Alternatively, you can call a specific function like dataindex() if you're using a table
            },
            error: function(xhr, status, error) {
                var response = xhr.responseJSON;
                showToastError('Error', response);
            }
        });
    });

    $('#add').on('hidden.bs.modal', function() {
        dataindex();
        $('#report_edit').html('');
    });
</script>