<div class="modal-header">
    <h5 class="modal-title"><?= $title ?></h5>
    <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span class="font-weight-light" aria-hidden="true">&times;</span></button>
</div>
<div class="modal-body text-left">
    <form id="add_anak">
        <input type="hidden" name="action" value="<?= $action ?>" />
        <?php if ($action == 'update'): ?>
            <!-- This is an update -->
            <input type="hidden" name="id" value="<?= esc($detail['id']) ?>" />
        <?php else: ?>
            <!-- This is an add -->
            <input type="hidden" name="id_user" value="<?= esc($detail['id']) ?>" />
        <?php endif; ?>

        <!-- Nama Anak -->
        <div class="form-group">
            <label for="nama_anak">Nama Anak</label>
            <input type="text" name="nama_anak" class="form form-control form-50" value="<?= isset($detail['nama_anak']) ? esc($detail['nama_anak']) : '' ?>" size="40" required />
        </div>

        <!-- NIK -->
        <div class="form-group">
            <label for="nik">NIK</label>
            <input type="text" name="nik" class="form form-control form-50" value="<?= isset($detail['nik']) ? esc($detail['nik']) : '' ?>" size="40" required />
        </div>

        <!-- Tanggal Lahir -->
        <div class="form-group">
            <label for="tgl_lahir">Tanggal Lahir</label>
            <input type="date" name="tgl_lahir" class="form form-control form-50" value="<?= isset($detail['tgl_lahir']) ? esc($detail['tgl_lahir']) : '' ?>" required />
        </div>

        <!-- Anak Ke -->
        <div class="form-group">
            <label for="anak_ke">Anak Ke</label>
            <input type="number" name="anak_ke" class="form form-control form-50" value="<?= isset($detail['anak_ke']) ? esc($detail['anak_ke']) : '' ?>" size="40" required />
        </div>

        <!-- Nomor Akta -->
        <div class="form-group">
            <label for="nomor_akta">Nomor Akta</label>
            <input type="text" name="nomor_akta" class="form form-control form-50" value="<?= isset($detail['nomor_akta']) ? esc($detail['nomor_akta']) : '' ?>" size="40" required />
        </div>

        <!-- Tanggal Akta -->
        <div class="form-group">
            <label for="tgl_akta">Tanggal Akta</label>
            <input type="date" name="tgl_akta" class="form form-control form-50" value="<?= isset($detail['tgl_akta']) ? esc($detail['tgl_akta']) : '' ?>" required />
        </div>

        <!-- Lampiran -->
        <div class="form-group">
            <label for="attachment">Lampiran</label>
            <input type="file" name="attachment" class="form form-control form-50" />
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
    $('#add_anak').submit(function(e) {
        e.preventDefault(); // Prevent the default form submission

        var form = $(this)[0]; // Get the raw HTML form element
        var formData = new FormData(form); // Create a new FormData object

        // Submit the form data via AJAX
        $.ajax({
            type: 'POST',
            url: "<?= site_url('admin2011/keluarga/saveanak') ?>",
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