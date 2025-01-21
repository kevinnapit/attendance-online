<!-- home.php -->
<?php $this->extend('admin/layout/main') ?>

<?php $this->section('content') ?>
<div class="card mb-3">
    <div class="card-header">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <!-- Link untuk kembali ke halaman sebelumnya -->
                <li class="breadcrumb-item"><a href="<?= site_url('admin2011/admin/view/' . esc($user['id'])) ?>">Back</a></li>
                <li class="breadcrumb-item active" aria-current="page"><?= esc($folder['kategori']) ?></li>
            </ol>
        </nav>
        <span class="badge badge-danger" style="cursor: pointer;" onclick="addfile(<?= esc($user['id']) ?>, <?= esc($folder['id']) ?>)">
            <i class="fas fa-upload"></i> Tambah File
        </span>

    </div>
    <div class="card-body bg-light overflow-hidden">
        <div class="row">
            <div class="col-12">
                <?php if (!empty($file)) : ?>
                    <?php foreach ($file as $data) : ?>
                        <div class="col-md-2 col-sm-3 mb-4">
                            <div class="text-center">
                                <!-- Gambar dan nama file -->
                                <a href="<?= base_url() ?>uploads/file/<?= esc($data['attachments']); ?>" target="_blank">
                                    <img class="mr-2" src="<?= base_url() ?>uploads/file/file.png" alt="File Icon" height="60" />
                                </a>

                                <!-- Tombol Hapus -->
                                <small class="mt-2"><?= esc($data['attachments']); ?></small><!-- Menampilkan nama file -->
                                <button class="btn btn-link p-0" onclick="deletefile(<?= $data['id']; ?>)">
                                    <i class="fas fa-trash-alt" style="font-size: 12px;"></i>
                                </button>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php else : ?>
                    <div class="col-12">
                        <p class="text-center">Tidak ada file ditemukan.</p>
                    </div>
                <?php endif; ?>

            </div>
        </div>
    </div>
</div>
<?php $this->endsection() ?>
<?php $this->section('script') ?>

<script>
    function addfile(id, id_kategori) {
        // Load the modal content with both user id and category id
        $('#editor_add').load('<?= site_url('admin2011/arsip/add_file/') ?>' + id + '/' + id_kategori, function() {
            // After loading, show the modal
            $('#add').modal({
                show: true
            });

            // Set the user ID to the hidden input field inside the modal
            $('#id_user').val(id);
            $('#id_kategori').val(id_kategori); // Set the id_kategori to the hidden input field
        });
    }


    function deletefile(iddata) {
        // Menampilkan modal konfirmasi
        $('#alert_modal').modal('show');

        // Jika tombol "Yes" diklik
        $("#click_yes").off("click").on("click", function() {
            $.ajax({
                type: 'DELETE',
                url: "<?= site_url('admin2011/arsip/deletefile') ?>/" + iddata,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(response) {
                    $('#alert_modal').modal('hide'); // Menutup modal
                    // Menampilkan pesan sukses
                    showToast('success', response.message);
                    // Me-refresh halaman setelah penghapusan data
                    location.reload(); // Menyegarkan halaman
                },
                error: function(xhr, status, error) {
                    // Tanggapan error
                    showToastError(error, xhr.responseJSON);
                }
            });
        });
    }
</script>

<?php $this->endsection() ?>