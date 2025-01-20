<div class="modal-header">
    <h5 class="modal-title"><?= $title ?></h5>
    <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span class="font-weight-light" aria-hidden="true">&times;</span></button>
</div>
<div class="modal-body text-left">
    <form id="add_pangkat">
        <input type="hidden" name="action" value="<?= $action ?>" />
        <?php if ($action == 'update'): ?>
            <!-- This is an update -->
            <input type="hidden" name="id" value="<?= esc($detail['id']) ?>" />
        <?php else: ?>
            <!-- This is an add -->
            <input type="hidden" name="id_user" value="<?= esc($detail['id']) ?>" />
        <?php endif; ?>

        <!-- Jenis KP -->
        <div class="form-group">
            <label for="jenis_kp">Jenis KP</label>
            <input type="text" name="jenis_kp" class="form form-control form-50" value="<?= isset($detail['jenis_kp']) ? esc($detail['jenis_kp']) : '' ?>" size="40" required />
        </div>

        <!-- TMT -->
        <div class="form-group">
            <label for="tmt">TMT</label>
            <input type="date" name="tmt" class="form form-control form-50" value="<?= isset($detail['tmt']) ? esc($detail['tmt']) : '' ?>" required />
        </div>

        <div class="form-group">
            <label for="golongan">Golongan</label>
            <select name="golongan" class="form form-control form-50" required>
                <!-- Pilihan golongan -->
                <option value="">Pilih Golongan</option>
                <option value="IA" <?= (isset($detail['golongan']) && $detail['golongan'] == 'IA') ? 'selected' : ''; ?>>IA</option>
                <option value="IB" <?= (isset($detail['golongan']) && $detail['golongan'] == 'IB') ? 'selected' : ''; ?>>IB</option>
                <option value="IC" <?= (isset($detail['golongan']) && $detail['golongan'] == 'IC') ? 'selected' : ''; ?>>IC</option>
                <option value="ID" <?= (isset($detail['golongan']) && $detail['golongan'] == 'ID') ? 'selected' : ''; ?>>ID</option>
                <option value="IIA" <?= (isset($detail['golongan']) && $detail['golongan'] == 'IIA') ? 'selected' : ''; ?>>IIA</option>
                <option value="IIB" <?= (isset($detail['golongan']) && $detail['golongan'] == 'IIB') ? 'selected' : ''; ?>>IIB</option>
                <option value="IIC" <?= (isset($detail['golongan']) && $detail['golongan'] == 'IIC') ? 'selected' : ''; ?>>IIC</option>
                <option value="IID" <?= (isset($detail['golongan']) && $detail['golongan'] == 'IID') ? 'selected' : ''; ?>>IID</option>
                <option value="IIIA" <?= (isset($detail['golongan']) && $detail['golongan'] == 'IIIA') ? 'selected' : ''; ?>>IIIA</option>
                <option value="IIIB" <?= (isset($detail['golongan']) && $detail['golongan'] == 'IIIB') ? 'selected' : ''; ?>>IIIB</option>
                <option value="IIIC" <?= (isset($detail['golongan']) && $detail['golongan'] == 'IIIC') ? 'selected' : ''; ?>>IIIC</option>
                <option value="IVA" <?= (isset($detail['golongan']) && $detail['golongan'] == 'IVA') ? 'selected' : ''; ?>>IVA</option>
                <option value="IVB" <?= (isset($detail['golongan']) && $detail['golongan'] == 'IVB') ? 'selected' : ''; ?>>IVB</option>
                <option value="IVC" <?= (isset($detail['golongan']) && $detail['golongan'] == 'IVC') ? 'selected' : ''; ?>>IVC</option>
                <option value="IVD" <?= (isset($detail['golongan']) && $detail['golongan'] == 'IVD') ? 'selected' : ''; ?>>IVD</option>
                <option value="IVE" <?= (isset($detail['golongan']) && $detail['golongan'] == 'IVE') ? 'selected' : ''; ?>>IVE</option>
            </select>
        </div>


        <!-- Masa Kerja (Thn) -->
        <div class="form-group">
            <label for="mkg_thn">Masa Kerja (Thn)</label>
            <input type="number" name="mkg_thn" class="form form-control form-50" value="<?= isset($detail['mkg_thn']) ? esc($detail['mkg_thn']) : '' ?>" size="40" required />
        </div>

        <!-- Masa Kerja (Bln) -->
        <div class="form-group">
            <label for="mkg_bln">Masa Kerja (Bln)</label>
            <input type="number" name="mkg_bln" class="form form-control form-50" value="<?= isset($detail['mkg_bln']) ? esc($detail['mkg_bln']) : '' ?>" size="40" required />
        </div>

        <!-- Angka Kredit -->
        <div class="form-group">
            <label for="angka_kredit">Angka Kredit</label>
            <input type="number" name="angka_kredit" class="form form-control form-50" value="<?= isset($detail['angka_kredit']) ? esc($detail['angka_kredit']) : '' ?>" size="40" required />
        </div>

        <!-- Nomor NP BKN -->
        <div class="form-group">
            <label for="nomor_np_bkn">Nomor NP BKN</label>
            <input type="text" name="nomor_np_bkn" class="form form-control form-50" value="<?= isset($detail['nomor_np_bkn']) ? esc($detail['nomor_np_bkn']) : '' ?>" size="40" required />
        </div>

        <!-- Tanggal NP BKN -->
        <div class="form-group">
            <label for="tanggal_np_bkn">Tanggal NP BKN</label>
            <input type="date" name="tanggal_np_bkn" class="form form-control form-50" value="<?= isset($detail['tanggal_np_bkn']) ? esc($detail['tanggal_np_bkn']) : '' ?>" required />
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

        <!-- Lampiran -->
        <div class="form-group">
            <label for="attachments">Lampiran</label>
            <input type="file" name="attachments" class="form form-control form-50" />
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
    $('#add_pangkat').submit(function(e) {
        e.preventDefault(); // Prevent the default form submission

        var form = $(this)[0]; // Get the raw HTML form element
        var formData = new FormData(form); // Create a new FormData object

        // Submit the form data via AJAX
        $.ajax({
            type: 'POST',
            url: "<?= site_url('admin2011/pangkat/save') ?>",
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