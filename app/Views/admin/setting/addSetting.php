<div class="modal-header">
     <h5 class="modal-title"><?= $title ?></h5>
     <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span class="font-weight-light" aria-hidden="true">&times;</span></button>
 </div>
 <div class="modal-body text-left">
     <form id="add_submit">
         <input type="hidden" name="action" value="<?= $action ?>" />
         <input type="hidden" name="id" value="<?php if (isset($detail['id'])) echo $detail['id']; ?>" />
         Nama Kantor:<br />
         <input type="text" name="nama_kantor" value="<?php if (isset($detail['nama_kantor'])) echo $detail['nama_kantor']; ?>" class="form form-control form-50" size="40" />
         <br />

         Alamat:<br />
         <input type="password" name="alamat" class="form form-control form-50" size="40" />
         <i class="fs--1"><?= $alert ?></i>
         <br />

         Lokasi Kantor:<br />
         <input type="text" name="lokasi_kantor" value="<?php if (isset($detail['lokasi_kantor'])) echo $detail['lokasi_kantor']; ?>" class="form form-control form-50" size="40" />
         <br />

         Radius<br />
         <input type="text" name="radius" value="<?php if (isset($detail['radius'])) echo $detail['radius']; ?>" class="form form-control form-50" size="40" />
         <br />
         <span id="report"></span>

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
     $(document).ready(function() {
         $('#add_submit').submit(function(e) {
             e.preventDefault(); // Prevent the default form submission

             var form = $(this)[0]; // Get the raw HTML form element
             var formData = new FormData(form); // Create a new FormData object

             // Add any additional data to the FormData object if needed
             // Example: formData.append('key', 'value');

             $.ajax({
                 type: 'POST',
                 url: "<?= site_url('admin2011/setting/submitdata') ?>",
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