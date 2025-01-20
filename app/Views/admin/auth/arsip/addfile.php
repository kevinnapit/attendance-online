<div class="modal-header">
    <h5 class="modal-title"><?= $title ?></h5>
    <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span class="font-weight-light" aria-hidden="true">&times;</span></button>
</div>
<div class="modal-body text-left">
    <form id="add_file">
        <input type="hidden" name="action" value="<?= $action ?>" />
        <?php if ($action == 'update'): ?>
            <!-- This is an update -->
            <input type="hidden" name="id" value="<?= esc($detail['id']) ?>" />
        <?php else: ?>
            <!-- This is an add -->
            <input type="hidden" name="id_user" value="<?= esc($detail['id']) ?>" />
        <?php endif; ?>
        <input type="hidden" name="id_kategori" value="0" />

        <!-- Lampiran -->
        <div class="form-group">
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

    $('#add_file').submit(function(e) {
        e.preventDefault(); // Prevent the default form submission

        var form = $(this)[0]; // Get the raw HTML form element
        var formData = new FormData(form); // Create a new FormData object

        // Submit the form data via AJAX
        $.ajax({
            type: 'POST',
            url: "<?= site_url('admin2011/arsip/savefile') ?>",
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