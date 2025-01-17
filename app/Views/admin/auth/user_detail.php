<!-- home.php -->
<?php $this->extend('admin/layout/main') ?>

<?php $this->section('content') ?>
<div class="card mb-3">
    <div class="card-header">
        <h5 class="mb-1">Detail Informasi User - <?= esc($user['name']) ?></h5>

    </div>
    <div class="card-body bg-light overflow-hidden">
        <div class="row">
            <div class="col-12">
                <div class="fancy-tab">
                    <div class="nav-bar nav-bar-center">
                        <div class="nav-bar-item px-3 px-sm-4 active"><img src="<?= base_url() ?>assets/icon/graduation.png" style="width: 30px; height: 30px; display: block; margin: 0 auto;" />
                            <div class="mt-1">Pendidikan</div>
                        </div>
                        <div class="nav-bar-item px-3 px-sm-4 active"><img src="<?= base_url() ?>assets/icon/ranking.png" style="width: 30px; height: 30px; display: block; margin: 0 auto;" />
                            <div class="mt-1">Kepangkatan</div>
                        </div>
                        <div class="nav-bar-item px-3 px-sm-4 active"><img src="<?= base_url() ?>assets/icon/placement.png" style="width: 30px; height: 30px; display: block; margin: 0 auto;" />
                            <div class="mt-1">Penempatan</div>
                        </div>
                        <div class="nav-bar-item px-3 px-sm-4 active"><img src="<?= base_url() ?>assets/icon/discipline.png" style="width: 30px; height: 30px; display: block; margin: 0 auto;" />
                            <div class="mt-1">Disiplin</div>
                        </div>
                        <div class="nav-bar-item px-3 px-sm-4 active"><img src="<?= base_url() ?>assets/icon/family.png" style="width: 30px; height: 30px; display: block; margin: 0 auto;" />
                            <div class="mt-1">Keluarga</div>
                        </div>
                        <div class="nav-bar-item px-3 px-sm-4 active"><img src="<?= base_url() ?>assets/icon/digital-library.png" style="width: 30px; height: 30px; display: block; margin: 0 auto;" />
                            <div class="mt-1">Arsip Digital</div>
                        </div>
                    </div>
                    <div class="tab-contents">
                        <div class="tab-content active">
                            <h6 class="mt-4">Pendidikan Pengguna</h6>
                            <span class="badge badge-primary" style="cursor: pointer;" onclick="addpendidikan(<?= esc($user['id']) ?>)">
                                <i class="fas fa-plus-square"></i> Tambah Baru
                            </span>
                            <!-- Menampilkan pendidikan yang terkait dengan pengguna -->
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>Jenjang</th>
                                            <th>Pendidikan</th>
                                            <th>Institusi</th>
                                            <th>Nomor Ijazah</th>
                                            <th>Tanggal Lulus</th>
                                            <th>#</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php if (!empty($pendidikan)) : ?>
                                            <?php foreach ($pendidikan as $item) : ?>
                                                <tr>
                                                    <td><?= esc($item['jenjang']); ?></td>
                                                    <td><?= esc($item['pendidikan']); ?></td>
                                                    <td><?= esc($item['institusi']); ?></td>
                                                    <td><?= esc($item['nomor_ijazah']); ?></td>
                                                    <td><?= esc($item['lulus']); ?></td>
                                                    <td id="row-<?= $item['id']; ?>">
                                                        <!-- Tombol Edit -->
                                                        <button class="btn btn-sm btn-warning" onclick="editdata(<?= $item['id']; ?>)">
                                                            <i class="fas fa-pen-square"></i>
                                                        </button>
                                                        <!-- Tombol Hapus tanpa konfirmasi -->
                                                        <button class="btn btn-sm btn-danger" onclick="deletedata(<?= $item['id']; ?>)">
                                                            <i class="fas fa-trash-alt"></i>
                                                        </button>
                                                    </td>

                                                </tr>
                                            <?php endforeach; ?>
                                        <?php else : ?>
                                            <tr>
                                                <td colspan="5" class="text-center">Tidak ada data pendidikan.</td>
                                            </tr>
                                        <?php endif; ?>
                                    </tbody>
                                </table>
                            </div>
                            <h6 class="mt-4">Peningkatan Pendidikan (Izin Belajar / Tugas Belajar /Surat Keterangan)</h6>
                            <span class="badge badge-primary" style="cursor: pointer;" onclick="addpeningkatan(<?= esc($user['id']) ?>)">
                                <i class="fas fa-plus-square"></i> Tambah Baru
                            </span>
                            <!-- Menampilkan pendidikan yang terkait dengan pengguna -->
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>Jenjang</th>
                                            <th>Pendidikan</th>
                                            <th>Institusi</th>
                                            <th>Jenis Peningkatan</th>
                                            <th>Nomor SK</th>
                                            <th>Tanggal SK</th>
                                            <th>#</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php if (!empty($belajar)) : ?>
                                            <?php foreach ($belajar as $data) : ?>
                                                <tr>
                                                    <td><?= esc($data['jenjang']); ?></td>
                                                    <td><?= esc($data['pendidikan']); ?></td>
                                                    <td><?= esc($data['institusi']); ?></td>
                                                    <td><?= esc($data['jenis_peningkatan']); ?></td>
                                                    <td><?= esc($data['nomor_sk']); ?></td>
                                                    <td><?= esc($data['tanggal_sk']); ?></td>
                                                    <td id="row-<?= $data['id']; ?>">
                                                        <!-- Tombol Edit -->
                                                        <button class="btn btn-sm btn-warning" onclick="editpeningkatan(<?= $data['id']; ?>)">
                                                            <i class="fas fa-pen-square"></i>
                                                        </button>
                                                        <!-- Tombol Hapus tanpa konfirmasi -->
                                                        <button class="btn btn-sm btn-danger" onclick="deletepeningkatan(<?= $data['id']; ?>)">
                                                            <i class="fas fa-trash-alt"></i>
                                                        </button>
                                                    </td>

                                                </tr>
                                            <?php endforeach; ?>
                                        <?php else : ?>
                                            <tr>
                                                <td colspan="5" class="text-center">Tidak ada data pendidikan.</td>
                                            </tr>
                                        <?php endif; ?>
                                    </tbody>
                                </table>
                            </div>

                        </div>

                        <div class="tab-content">
                            <p class="lead">Nullam sed tempus mauris, vitae pretium nibh. Nam pretium diam id massa mollis pretium. Aenean lacus massa, tristique id mauris ac, sollicitudin auctor neque. Cras laoreet nunc nibh, ac tristique orci rutrum quis. Nam luctus, sapien ligula finibus turpis.</p>
                        </div>
                        <div class="tab-content">
                            <p class="lead">Vestibulum convallis diam id nibh tempus, ac scelerisque nulla congue. Cras laoreet nunc nibh, ac tristique orci rutrum quis. Sed eu tellus pharetra, scelerisque nulla in, vehicula libero. Curabitur interdum nec metus ante sed luctus.</p>
                        </div>
                        <div class="tab-content">
                            <p class="lead">Vestibulum convallis diam id nibh tempus, ac scelerisque nulla congue. Cras laoreet nunc nibh, ac tristique orci rutrum quis. Sed eu tellus pharetra, scelerisque nulla in, vehicula libero. Curabitur interdum nec metus ante sed luctus.</p>
                        </div>
                        <div class="tab-content">
                            <p class="lead">Vestibulum convallis diam id nibh tempus, ac scelerisque nulla congue. Cras laoreet nunc nibh, ac tristique orci rutrum quis. Sed eu tellus pharetra, scelerisque nulla in, vehicula libero. Curabitur interdum nec metus ante sed luctus.</p>
                        </div>
                        <div class="tab-content">
                            <p class="lead">Vestibulum convallis diam id nibh tempus, ac scelerisque nulla congue. Cras laoreet nunc nibh, ac tristique orci rutrum quis. Sed eu tellus pharetra, scelerisque nulla in, vehicula libero. Curabitur interdum nec metus ante sed luctus.</p>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
<?php $this->endsection() ?>
<?php $this->section('script') ?>

<script>
    function addpendidikan(id) {
        // Load the modal content
        $('#editor_add').load('<?= site_url('admin2011/pendidikan/addpendidikan/') ?>' + id, function() {
            // After loading, show the modal
            $('#add').modal({
                show: true
            });

            // Set the user ID to the hidden input field inside the modal
            $('#id_user').val(id);
        });
    }

    function addpeningkatan(id) {
        // Load the modal content
        $('#editor_add').load('<?= site_url('admin2011/pendidikan/addpeningkatan/') ?>' + id, function() {
            // After loading, show the modal
            $('#add').modal({
                show: true
            });

            // Set the user ID to the hidden input field inside the modal
            $('#id_user').val(id);
        });
    }

    function editdata(iddata) {
        $.get("<?= site_url('admin2011/pendidikan/editpendidikan') ?>/" + iddata, function(data, status) {
            $("#editor_add").html(data);
            $('#add').modal('toggle');
        });
    }

    function editpeningkatan(iddata) {
        $.get("<?= site_url('admin2011/pendidikan/editpeningkatan') ?>/" + iddata, function(data, status) {
            $("#editor_add").html(data);
            $('#add').modal('toggle');
        });
    }

    function deletedata(iddata) {
        // Menampilkan modal konfirmasi
        $('#alert_modal').modal('show');

        // Jika tombol "Yes" diklik
        $("#click_yes").off("click").on("click", function() {
            $.ajax({
                type: 'DELETE',
                url: "<?= site_url('admin2011/pendidikan/deletependidikan') ?>/" + iddata,
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

    function deletepeningkatan(iddata) {
        // Menampilkan modal konfirmasi
        $('#alert_modal').modal('show');

        // Jika tombol "Yes" diklik
        $("#click_yes").off("click").on("click", function() {
            $.ajax({
                type: 'DELETE',
                url: "<?= site_url('admin2011/pendidikan/deletepeningkatan') ?>/" + iddata,
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