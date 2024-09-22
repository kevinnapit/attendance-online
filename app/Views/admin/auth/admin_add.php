<div class="modal-header">
     <h5 class="modal-title"><?= $title ?></h5>
     <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span class="font-weight-light" aria-hidden="true">&times;</span></button>
 </div>
 <div class="modal-body text-left">
     <form id="add_submit">
         <input type="hidden" name="action" value="<?= $action ?>" />
         <input type="hidden" name="id" value="<?php if (isset($detail['id'])) echo $detail['id']; ?>" />
         Username:<br />
         <input type="text" name="username" value="<?php if (isset($detail['username'])) echo $detail['username']; ?>" class="form form-control form-50" size="40" />
         <br />

         Password:<br />
         <input type="password" name="password" class="form form-control form-50" size="40" />
         <i class="fs--1"><?= $alert ?></i>
         <br />

         Name:<br />
         <input type="text" name="name" value="<?php if (isset($detail['name'])) echo $detail['name']; ?>" class="form form-control form-50" size="40" />
         <br />

         Email:<br />
         <input type="text" name="email" value="<?php if (isset($detail['email'])) echo $detail['email']; ?>" class="form form-control form-50" size="40" />
         <br />
         Role: <br>
         <select name="role" class="selectpicker form-control">
             <option value="admin">Admin</option>
             <option <?php if (isset($detail['role']) && $detail['role'] == 'superadmin') { ?>selected<?php } ?> value="superadmin">Super Admin</option>
             <option <?php if (isset($detail['role']) && $detail['role'] == 'admin') { ?>selected<?php } ?> value="admin">Admin</option>
             <option <?php if (isset($detail['role']) && $detail['role'] == 'user') { ?>selected<?php } ?> value="user">User</option>
         </select>
         <br>
         Foto Profile:
         <div class="custom-file">
             <input class="custom-file-input" id="customFile" name="picture" type="file">
             <label class="custom-file-label" for="customFile">Choose file</label>
         </div>
         <br>
         <span id="report"></span>

         <input type="submit" name="" value="<?= $tombol ?>" class="btn btn-primary mt-3" />
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
                 url: "<?= site_url('admin2011/admin/submitdata') ?>",
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