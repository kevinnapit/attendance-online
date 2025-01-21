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
                            <h6 class="mt-4">Data Kenaikan Pangkat</h6>
                            <span class="badge badge-primary" style="cursor: pointer;" onclick="addpangkat(<?= esc($user['id']) ?>)">
                                <i class="fas fa-plus-square"></i> Tambah Baru
                            </span>
                            <!-- Menampilkan pendidikan yang terkait dengan pengguna -->
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>Jenis KP</th>
                                            <th>TMT</th>
                                            <th>Golongan</th>
                                            <th>Mkg (Thn)</th>
                                            <th>Mkg (Bln)</th>
                                            <th>Angka Kredit</th>
                                            <th>Nomor NP BKN</th>
                                            <th>Tanggal NP BKN</th>
                                            <th>Nomor SK</th>
                                            <th>Tanggal SK</th>
                                            <th>Attachments</th>
                                            <th>#</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php if (!empty($pangkat)) : ?>
                                            <?php foreach ($pangkat as $pangkats) : ?>
                                                <tr>
                                                    <td><?= esc($pangkats['jenis_kp']); ?></td>
                                                    <td><?= esc($pangkats['tmt']); ?></td>
                                                    <td><?= esc($pangkats['golongan']); ?></td>
                                                    <td><?= esc($pangkats['mkg_thn']); ?></td>
                                                    <td><?= esc($pangkats['mkg_bln']); ?></td>
                                                    <td><?= esc($pangkats['angka_kredit']); ?></td>
                                                    <td><?= esc($pangkats['nomor_np_bkn']); ?></td>
                                                    <td><?= esc($pangkats['tanggal_np_bkn']); ?></td>
                                                    <td><?= esc($pangkats['nomor_sk']); ?></td>
                                                    <td><?= esc($pangkats['tanggal_sk']); ?></td>
                                                    <td>
                                                        <!-- Jika ada lampiran, tampilkan sebagai link -->
                                                        <?php if (!empty($pangkats['attachments'])) : ?>
                                                            <a href="<?= base_url('uploads/filepangkat/' . esc($pangkats['attachments'])); ?>" target="_blank">
                                                                <button class="btn btn-info btn-sm mr-1"><i class="fas fa-eye"></i> Lampiran</button>
                                                            </a>
                                                        <?php else : ?>
                                                            <span>Tidak ada lampiran</span>
                                                        <?php endif; ?>


                                                    </td>
                                                    <td id="row-<?= $pangkats['id']; ?>">
                                                        <!-- Tombol Edit -->
                                                        <button class="btn btn-sm btn-warning" onclick="editpangkat(<?= $pangkats['id']; ?>)">
                                                            <i class="fas fa-pen-square"></i>
                                                        </button>
                                                        <!-- Tombol Hapus tanpa konfirmasi -->
                                                        <button class="btn btn-sm btn-danger" onclick="deletepangkat(<?= $pangkats['id']; ?>)">
                                                            <i class="fas fa-trash-alt"></i>
                                                        </button>
                                                    </td>
                                                </tr>
                                            <?php endforeach; ?>
                                        <?php else : ?>
                                            <tr>
                                                <td colspan="12" class="text-center">Tidak ada data pangkat.</td>
                                            </tr>
                                        <?php endif; ?>
                                    </tbody>
                                </table>

                            </div>
                        </div>
                        <div class="tab-content">
                            <h6 class="mt-4">Data Mutasi</h6>
                            <span class="badge badge-primary" style="cursor: pointer;" onclick="addmutasi(<?= esc($user['id']) ?>)">
                                <i class="fas fa-plus-square"></i> Tambah Baru
                            </span>
                            <!-- Menampilkan pendidikan yang terkait dengan pengguna -->
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>TMT</th>
                                            <th>Nomor SK</th>
                                            <th>Tanggal SK</th>
                                            <th>Jabatan</th>
                                            <th>Eselon</th>
                                            <th>Unit Kerja</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php if (!empty($mutasi)) : ?>
                                            <?php foreach ($mutasi as $item) : ?>
                                                <tr>
                                                    <td><?= esc($item['tmt']); ?></td>
                                                    <td><?= esc($item['nomor_sk']); ?></td>
                                                    <td><?= esc($item['tanggal_sk']); ?></td>
                                                    <td><?= esc($item['jabatan']); ?></td>
                                                    <td><?= esc($item['eselon']); ?></td>
                                                    <td><?= esc($item['unit_kerja']); ?></td>
                                                    <td>
                                                        <!-- Tombol Edit -->
                                                        <button class="btn btn-sm btn-warning" onclick="editmutasi(<?= $item['id']; ?>)">
                                                            <i class="fas fa-pen-square"></i>
                                                        </button>
                                                        <!-- Tombol Hapus -->
                                                        <button class="btn btn-sm btn-danger" onclick="deletemutasi(<?= $item['id']; ?>)">
                                                            <i class="fas fa-trash-alt"></i>
                                                        </button>
                                                    </td>
                                                </tr>
                                            <?php endforeach; ?>
                                        <?php else : ?>
                                            <tr>
                                                <td colspan="8" class="text-center">Tidak ada data mutasi.</td>
                                            </tr>
                                        <?php endif; ?>
                                    </tbody>
                                </table>

                            </div>
                        </div>
                        <div class="tab-content">
                            <h6 class="mt-4">Data Utama</h6>
                            <span class="badge badge-primary" style="cursor: pointer;" onclick="adddisiplin(<?= esc($user['id']) ?>)">
                                <i class="fas fa-plus-square"></i> Tambah Baru
                            </span>
                            <!-- Menampilkan pendidikan yang terkait dengan pengguna -->
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>Jenis Hukuman</th>
                                            <th>Tanggal Mulai</th>
                                            <th>Tanggal Selesai</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php if (!empty($disiplin)) : ?>
                                            <?php foreach ($disiplin as $data) : ?>
                                                <tr>
                                                    <td><?= esc($data['jenis_hukuman']); ?></td>
                                                    <td><?= esc($data['tanggal_mulai']); ?></td>
                                                    <td><?= esc($data['tanggal_selesai']); ?></td>
                                                    <td>
                                                        <!-- Tombol Edit -->
                                                        <button class="btn btn-sm btn-warning" onclick="editdisiplin(<?= $data['id']; ?>)">
                                                            <i class="fas fa-pen-square"></i>
                                                        </button>
                                                        <!-- Tombol Hapus -->
                                                        <button class="btn btn-sm btn-danger" onclick="deletedisiplin(<?= $data['id']; ?>)">
                                                            <i class="fas fa-trash-alt"></i>
                                                        </button>
                                                    </td>
                                                </tr>
                                            <?php endforeach; ?>
                                        <?php else : ?>
                                            <tr>
                                                <td colspan="4" class="text-center">Tidak ada data hukuman.</td>
                                            </tr>
                                        <?php endif; ?>
                                    </tbody>
                                </table>


                            </div>
                        </div>
                        <div class="tab-content">
                            <h6 class="mt-4">Data Keluarga</h6>
                            <span class="badge badge-primary" style="cursor: pointer;" onclick="addkeluarga(<?= esc($user['id']) ?>)">
                                <i class="fas fa-plus-square"></i> Tambah Baru
                            </span>
                            <!-- Menampilkan pendidikan yang terkait dengan pengguna -->
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Nama Pasangan</th>
                                            <th>NIK Pasangan</th>
                                            <th>No Akta Kawin</th>
                                            <th>Nama Mertua Laki-laki</th>
                                            <th>NIK Mertua Laki-laki</th>
                                            <th>Nama Mertua Perempuan</th>
                                            <th>NIK Mertua Perempuan</th>
                                            <th>Attachment</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php if (!empty($keluarga)) : ?>
                                            <?php foreach ($keluarga as $index => $item) : ?>
                                                <tr>
                                                    <td><?= $index + 1 ?></td>
                                                    <td><?= esc($item['nama_pasangan']) ?></td>
                                                    <td><?= esc($item['nik_pasangan']) ?></td>
                                                    <td><?= esc($item['no_akta_kawin']) ?></td>
                                                    <td><?= esc($item['nama_mertua_lk']) ?></td>
                                                    <td><?= esc($item['nik_mertua_lk']) ?></td>
                                                    <td><?= esc($item['nama_mertua_pr']) ?></td>
                                                    <td><?= esc($item['nik_mertua_pr']) ?></td>
                                                    <td>
                                                        <?php if (!empty($item['attachment'])) : ?>
                                                            <a href="<?= base_url('uploads/file/' . esc($item['attachment'])); ?>" target="_blank">
                                                                <button class="btn btn-info btn-sm mr-1"><i class="fas fa-eye"></i></button>
                                                            </a>
                                                        <?php else : ?>
                                                            <span>Tidak ada lampiran</span>
                                                        <?php endif; ?>
                                                    </td>
                                                    <td>
                                                        <!-- Tombol Edit -->
                                                        <button class="btn btn-sm btn-warning" onclick="editkeluarga(<?= $item['id']; ?>)">
                                                            <i class="fas fa-pen-square"></i>
                                                        </button>
                                                        <!-- Tombol Hapus -->
                                                        <button class="btn btn-sm btn-danger" onclick="deletekeluarga(<?= $item['id']; ?>)">
                                                            <i class="fas fa-trash-alt"></i>
                                                        </button>
                                                    </td>
                                                </tr>
                                            <?php endforeach; ?>
                                        <?php else : ?>
                                            <tr>
                                                <td colspan="9" class="text-center">Tidak ada data keluarga.</td>
                                            </tr>
                                        <?php endif; ?>
                                    </tbody>
                                </table>
                            </div>

                            <h6 class="mt-4">Data Anak</h6>
                            <span class="badge badge-primary" style="cursor: pointer;" onclick="addanak(<?= esc($user['id']) ?>)">
                                <i class="fas fa-plus-square"></i> Tambah Baru
                            </span>
                            <!-- Menampilkan pendidikan yang terkait dengan pengguna -->
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Nama Anak</th>
                                            <th>NIK</th>
                                            <th>Nomor Akta</th>
                                            <th>Tanggal Akta</th>
                                            <th>Attachment</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php if (!empty($anak)) : ?>
                                            <?php foreach ($anak as $index => $data) : ?>
                                                <tr>
                                                    <td><?= $index + 1 ?></td>
                                                    <td><?= esc($data['nama_anak']) ?></td>
                                                    <td><?= esc($data['nik']) ?></td>
                                                    <td><?= esc($data['nomor_akta']) ?></td>
                                                    <td><?= esc($data['tgl_akta']) ?></td>
                                                    <td>
                                                        <?php if (!empty($data['attachment'])) : ?>
                                                            <a href="<?= base_url('uploads/file/' . esc($data['attachment'])); ?>" target="_blank">
                                                                <button class="btn btn-info btn-sm mr-1"><i class="fas fa-eye"></i> Lampiran</button>
                                                            </a>
                                                        <?php else : ?>
                                                            <span>Tidak ada lampiran</span>
                                                        <?php endif; ?>
                                                    </td>
                                                    <td>
                                                        <!-- Tombol Edit -->
                                                        <button class="btn btn-sm btn-warning" onclick="editanak(<?= $data['id']; ?>)">
                                                            <i class="fas fa-pen-square"></i>
                                                        </button>
                                                        <!-- Tombol Hapus -->
                                                        <button class="btn btn-sm btn-danger" onclick="deleteanak(<?= $data['id']; ?>)">
                                                            <i class="fas fa-trash-alt"></i>
                                                        </button>
                                                    </td>
                                                </tr>
                                            <?php endforeach; ?>
                                        <?php else : ?>
                                            <tr>
                                                <td colspan="6" class="text-center">Tidak ada data Anak.</td>
                                            </tr>
                                        <?php endif; ?>
                                    </tbody>
                                </table>
                            </div>

                        </div>
                        <div class="tab-content">
                            <span class="badge badge-primary" style="cursor: pointer;" onclick="addfolder(<?= esc($user['id']) ?>)">
                                <i class="fas fa-plus-square"></i> Buat Folder
                            </span>

                            <span class="badge badge-danger" style="cursor: pointer;" onclick="addfile(<?= esc($user['id']) ?>)">
                                <i class="fas fa-upload"></i> Tambah File
                            </span>


                            <div class="row mt-3">
                                <?php if (!empty($folder)) : ?>
                                    <?php foreach ($folder as $data) : ?>
                                        <div class="col-md-2 col-sm-3 mb-4">
                                            <!-- Folder Grid -->
                                            <div class="text-center">
                                                <!-- Folder Icon (Gambar Folder) -->
                                                <?php
                                                // Cek apakah folder memiliki attachment
                                                $folderImage = $data['attachment'] ? 'uploads/folder/' . $data['attachment'] : 'uploads/folder/folder.png';
                                                ?>
                                                <a href="<?= site_url('admin2011/arsip/detail/' . esc($user['id']) . '/' . $data['id']) ?>" class="folder-link">
                                                    <img src="<?= base_url($folderImage) ?>" alt="Folder Icon" class="img-fluid" style="width: 60px; height: 60px;">
                                                </a>


                                                <!-- Kategori Folder dan Tombol Hapus -->
                                                <div class="d-flex justify-content-center align-items-center mt-2">
                                                    <!-- Kategori Folder -->
                                                    <h5 class="mr-2" style="font-size: 12px;"><?= esc($data['kategori']); ?></h5>
                                                    <!-- Tombol Hapus (Ikon Tong Sampah) -->
                                                    <button class="btn btn-link p-0" onclick="deletefolder(<?= $data['id']; ?>)">
                                                        <i class="fas fa-trash-alt" style="font-size: 12px;"></i>
                                                    </button>

                                                </div>
                                            </div>
                                        </div>
                                    <?php endforeach; ?>
                                <?php else : ?>
                                    <div class="col-12">
                                        <p class="text-center"></p>
                                    </div>
                                <?php endif; ?>
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
                                        <p class="text-center"></p>
                                    </div>
                                <?php endif; ?>
                            </div>
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

    function addpangkat(id) {
        // Load the modal content
        $('#editor_add').load('<?= site_url('admin2011/pangkat/add/') ?>' + id, function() {
            // After loading, show the modal
            $('#add').modal({
                show: true
            });

            // Set the user ID to the hidden input field inside the modal
            $('#id_user').val(id);
        });
    }

    function addmutasi(id) {
        // Load the modal content
        $('#editor_add').load('<?= site_url('admin2011/mutasi/add/') ?>' + id, function() {
            // After loading, show the modal
            $('#add').modal({
                show: true
            });

            // Set the user ID to the hidden input field inside the modal
            $('#id_user').val(id);
        });
    }

    function adddisiplin(id) {
        // Load the modal content
        $('#editor_add').load('<?= site_url('admin2011/disiplin/add/') ?>' + id, function() {
            // After loading, show the modal
            $('#add').modal({
                show: true
            });

            // Set the user ID to the hidden input field inside the modal
            $('#id_user').val(id);
        });
    }

    function addfolder(id) {
        // Load the modal content
        $('#editor_add').load('<?= site_url('admin2011/arsip/add_folder/') ?>' + id, function() {
            // After loading, show the modal
            $('#add').modal({
                show: true
            });

            // Set the user ID to the hidden input field inside the modal
            $('#id_user').val(id);
        });
    }

    function addfile(id) {
        // Load the modal content
        $('#editor_add').load('<?= site_url('admin2011/arsip/add_file/') ?>' + id, function() {
            // After loading, show the modal
            $('#add').modal({
                show: true
            });

            // Set the user ID to the hidden input field inside the modal
            $('#id_user').val(id);
        });
    }

    function addkeluarga(id) {
        // Load the modal content
        $('#editor_add').load('<?= site_url('admin2011/keluarga/add/') ?>' + id, function() {
            // After loading, show the modal
            $('#add').modal({
                show: true
            });

            // Set the user ID to the hidden input field inside the modal
            $('#id_user').val(id);
        });
    }

    function addanak(id) {
        // Load the modal content
        $('#editor_add').load('<?= site_url('admin2011/keluarga/addanak/') ?>' + id, function() {
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

    function editpangkat(iddata) {
        $.get("<?= site_url('admin2011/pangkat/edit') ?>/" + iddata, function(data, status) {
            $("#editor_add").html(data);
            $('#add').modal('toggle');
        });
    }

    function editmutasi(iddata) {
        $.get("<?= site_url('admin2011/mutasi/edit') ?>/" + iddata, function(data, status) {
            $("#editor_add").html(data);
            $('#add').modal('toggle');
        });
    }

    function editdisiplin(iddata) {
        $.get("<?= site_url('admin2011/disiplin/edit') ?>/" + iddata, function(data, status) {
            $("#editor_add").html(data);
            $('#add').modal('toggle');
        });
    }

    function editkeluarga(iddata) {
        $.get("<?= site_url('admin2011/keluarga/edit') ?>/" + iddata, function(data, status) {
            $("#editor_add").html(data);
            $('#add').modal('toggle');
        });
    }

    function editanak(iddata) {
        $.get("<?= site_url('admin2011/keluarga/editanak') ?>/" + iddata, function(data, status) {
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

    function deletepangkat(iddata) {
        // Menampilkan modal konfirmasi
        $('#alert_modal').modal('show');

        // Jika tombol "Yes" diklik
        $("#click_yes").off("click").on("click", function() {
            $.ajax({
                type: 'DELETE',
                url: "<?= site_url('admin2011/pangkat/delete') ?>/" + iddata,
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

    function deletemutasi(iddata) {
        // Menampilkan modal konfirmasi
        $('#alert_modal').modal('show');

        // Jika tombol "Yes" diklik
        $("#click_yes").off("click").on("click", function() {
            $.ajax({
                type: 'DELETE',
                url: "<?= site_url('admin2011/mutasi/delete') ?>/" + iddata,
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

    function deletedisiplin(iddata) {
        // Menampilkan modal konfirmasi
        $('#alert_modal').modal('show');

        // Jika tombol "Yes" diklik
        $("#click_yes").off("click").on("click", function() {
            $.ajax({
                type: 'DELETE',
                url: "<?= site_url('admin2011/disiplin/delete') ?>/" + iddata,
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

    function deletefolder(iddata) {
        // Menampilkan modal konfirmasi
        $('#alert_modal').modal('show');

        // Jika tombol "Yes" diklik
        $("#click_yes").off("click").on("click", function() {
            $.ajax({
                type: 'DELETE',
                url: "<?= site_url('admin2011/arsip/deletefolder') ?>/" + iddata,
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

    function deletekeluarga(iddata) {
        // Menampilkan modal konfirmasi
        $('#alert_modal').modal('show');

        // Jika tombol "Yes" diklik
        $("#click_yes").off("click").on("click", function() {
            $.ajax({
                type: 'DELETE',
                url: "<?= site_url('admin2011/keluarga/delete') ?>/" + iddata,
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

    function deleteanak(iddata) {
        // Menampilkan modal konfirmasi
        $('#alert_modal').modal('show');

        // Jika tombol "Yes" diklik
        $("#click_yes").off("click").on("click", function() {
            $.ajax({
                type: 'DELETE',
                url: "<?= site_url('admin2011/keluarga/deleteanak') ?>/" + iddata,
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