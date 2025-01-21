<div class="modal-header">
    <h5 class="modal-title"><?= $title ?></h5>
    <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span class="font-weight-light" aria-hidden="true">&times;</span></button>
</div>
<div class="modal-body text-left">
    <form id="add_keluarga">
        <input type="hidden" name="action" value="<?= $action ?>" />
        <?php if ($action == 'update'): ?>
            <!-- This is an update -->
            <input type="hidden" name="id" value="<?= esc($detail['id']) ?>" />
        <?php else: ?>
            <!-- This is an add -->
            <input type="hidden" name="id_user" value="<?= esc($detail['id']) ?>" />
        <?php endif; ?>

        <!-- Nama Pasangan -->
        <div class="form-group">
            <label for="nama_pasangan">Nama Pasangan</label>
            <input type="text" name="nama_pasangan" class="form form-control form-50" value="<?= isset($detail['nama_pasangan']) ? esc($detail['nama_pasangan']) : '' ?>" size="40" required />
        </div>

        <!-- NIK Pasangan -->
        <div class="form-group">
            <label for="nik_pasangan">NIK Pasangan</label>
            <input type="text" name="nik_pasangan" class="form form-control form-50" value="<?= isset($detail['nik_pasangan']) ? esc($detail['nik_pasangan']) : '' ?>" size="40" required />
        </div>

        <!-- Status Hidup Pasangan -->
        <div class="form-group">
            <label for="status_hidup_pasangan">Status Hidup Pasangan</label>
            <select name="status_hidup_pasangan" class="form form-control form-50" required>
                <option value="Hidup" <?= (isset($detail['status_hidup_pasangan']) && $detail['status_hidup_pasangan'] == 'Hidup') ? 'selected' : ''; ?>>Hidup</option>
                <option value="Meninggal" <?= (isset($detail['status_hidup_pasangan']) && $detail['status_hidup_pasangan'] == 'Meninggal') ? 'selected' : ''; ?>>Meninggal</option>
                <option value="Cerai Hidup" <?= (isset($detail['status_hidup_pasangan']) && $detail['status_hidup_pasangan'] == 'Cerai Hidup') ? 'selected' : ''; ?>>Cerai Hidup</option>
                <option value="Cerai Meninggal" <?= (isset($detail['status_hidup_pasangan']) && $detail['status_hidup_pasangan'] == 'Cerai Meninggal') ? 'selected' : ''; ?>>Cerai Meninggal</option>
            </select>
        </div>

        <!-- Tanggal Lahir Pasangan -->
        <div class="form-group">
            <label for="tgl_lahir_pasangan">Tanggal Lahir Pasangan</label>
            <input type="date" name="tgl_lahir_pasangan" class="form form-control form-50" value="<?= isset($detail['tgl_lahir_pasangan']) ? esc($detail['tgl_lahir_pasangan']) : '' ?>" required />
        </div>

        <!-- Tanggal Kawin -->
        <div class="form-group">
            <label for="tgl_kawin">Tanggal Kawin</label>
            <input type="date" name="tgl_kawin" class="form form-control form-50" value="<?= isset($detail['tgl_kawin']) ? esc($detail['tgl_kawin']) : '' ?>" required />
        </div>

        <!-- Nama Mertua Laki-laki -->
        <div class="form-group">
            <label for="nama_mertua_lk">Nama Mertua Laki-laki</label>
            <input type="text" name="nama_mertua_lk" class="form form-control form-50" value="<?= isset($detail['nama_mertua_lk']) ? esc($detail['nama_mertua_lk']) : '' ?>" size="40" required />
        </div>

        <!-- NIK Mertua Laki-laki -->
        <div class="form-group">
            <label for="nik_mertua_lk">NIK Mertua Laki-laki</label>
            <input type="text" name="nik_mertua_lk" class="form form-control form-50" value="<?= isset($detail['nik_mertua_lk']) ? esc($detail['nik_mertua_lk']) : '' ?>" size="40" required />
        </div>

        <!-- Tanggal Lahir Mertua Laki-laki -->
        <div class="form-group">
            <label for="tgl_mertua_lk">Tanggal Lahir Mertua Laki-laki</label>
            <input type="date" name="tgl_mertua_lk" class="form form-control form-50" value="<?= isset($detail['tgl_mertua_lk']) ? esc($detail['tgl_mertua_lk']) : '' ?>" required />
        </div>

        <!-- Status Hidup Mertua Laki-laki -->
        <div class="form-group">
            <label for="status_hidup_mertua_lk">Status Hidup Mertua Laki-laki</label>
            <select name="status_hidup_mertua_lk" class="form form-control form-50" required>
                <option value="Hidup" <?= (isset($detail['status_hidup_mertua_lk']) && $detail['status_hidup_mertua_lk'] == 'Hidup') ? 'selected' : ''; ?>>Hidup</option>
                <option value="Meninggal" <?= (isset($detail['status_hidup_mertua_lk']) && $detail['status_hidup_mertua_lk'] == 'Meninggal') ? 'selected' : ''; ?>>Meninggal</option>
            </select>
        </div>

        <!-- Nama Mertua Perempuan -->
        <div class="form-group">
            <label for="nama_mertua_pr">Nama Mertua Perempuan</label>
            <input type="text" name="nama_mertua_pr" class="form form-control form-50" value="<?= isset($detail['nama_mertua_pr']) ? esc($detail['nama_mertua_pr']) : '' ?>" size="40" required />
        </div>

        <!-- NIK Mertua Perempuan -->
        <div class="form-group">
            <label for="nik_mertua_pr">NIK Mertua Perempuan</label>
            <input type="text" name="nik_mertua_pr" class="form form-control form-50" value="<?= isset($detail['nik_mertua_pr']) ? esc($detail['nik_mertua_pr']) : '' ?>" size="40" required />
        </div>

        <!-- Tanggal Lahir Mertua Perempuan -->
        <div class="form-group">
            <label for="tgl_mertua_pr">Tanggal Lahir Mertua Perempuan</label>
            <input type="date" name="tgl_mertua_pr" class="form form-control form-50" value="<?= isset($detail['tgl_mertua_pr']) ? esc($detail['tgl_mertua_pr']) : '' ?>" required />
        </div>

        <!-- Status Hidup Mertua Perempuan -->
        <div class="form-group">
            <label for="status_hidup_mertua_pr">Status Hidup Mertua Perempuan</label>
            <select name="status_hidup_mertua_pr" class="form form-control form-50" required>
                <option value="Hidup" <?= (isset($detail['status_hidup_mertua_pr']) && $detail['status_hidup_mertua_pr'] == 'Hidup') ? 'selected' : ''; ?>>Hidup</option>
                <option value="Meninggal" <?= (isset($detail['status_hidup_mertua_pr']) && $detail['status_hidup_mertua_pr'] == 'Meninggal') ? 'selected' : ''; ?>>Meninggal</option>
            </select>
        </div>

        <!-- Nomor Akta Kawin -->
        <div class="form-group">
            <label for="no_akta_kawin">Nomor Akta Kawin</label>
            <input type="text" name="no_akta_kawin" class="form form-control form-50" value="<?= isset($detail['no_akta_kawin']) ? esc($detail['no_akta_kawin']) : '' ?>" size="40" required />
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
    $('#add_keluarga').submit(function(e) {
        e.preventDefault(); // Prevent the default form submission

        var form = $(this)[0]; // Get the raw HTML form element
        var formData = new FormData(form); // Create a new FormData object

        // Submit the form data via AJAX
        $.ajax({
            type: 'POST',
            url: "<?= site_url('admin2011/keluarga/save') ?>",
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