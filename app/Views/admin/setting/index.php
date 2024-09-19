<?php $this->extend('admin/layout/main') ?>

<?php $this->section('content') ?>
<div class="card mb-3">
    <div class="bg-holder d-none d-lg-block bg-card" style="background-image:url(<?= base_url() ?>assets/img/illustrations/corner-4.png);">
    </div>
    <!--/.bg-holder-->
    <div class="card-body">
        <div class="row">
            <div class="col-lg-8">
                <h3 class="mb-0">Setting</h3>
            </div>
        </div>
    </div>
</div>


<div class="card mb-3">
    <?= form_open('admin2011/setting/updateSetting'); ?>
    <div class="card-body bg-light">
        <?php
        if (session()->get('pesan')) {
            echo '<div class="alert alert-success">';
            echo session()->get('pesan');
            echo '</div>';
        }
        ?>
        <div class="row list">
            <div class="col">
                <form id="formdata">
                    <div class="form-group">
                        <label for="name">Nama Kantor</label>
                        <input class="form-control" id="name" name="nama_kantor" type="text" value="<?= $setting['nama_kantor'] ?>" placeholder="Name" required>
                    </div>
                    <div class="form-group">
                        <label for="alamat">Alamat</label>
                        <input class="form-control" id="alamat" type="text" name="alamat" value="<?= $setting['alamat'] ?>" placeholder="Alamat Kantor" required>
                    </div>
                    <div class="form-group">
                        <label for="lokasi_kantor">Radius</label>
                        <input class="form-control" id="lokasi_kantor" type="text" name="radius" value="<?= $setting['radius'] ?>" placeholder="Lokasi Kantor" required>
                    </div>
                    <div class="form-group">
                        <label for="lokasi_kantor">Lokasi Kantor</label>
                        <input class="form-control" id="lokasi_kantor" type="text" name="lokasi_kantor" value="<?= $setting['lokasi_kantor'] ?>" placeholder="Lokasi Kantor" required>
                    </div>
                    <div id="map" style="width: 100%; height: 250px;">
                    </div>
                </form>
                <button class="btn btn-primary mb-3" type="submit">Save</button>

            </div>
        </div>
    </div>
    <? form_close(); ?>
</div>
<?php $this->endSection() ?>
<?php $this->section('script') ?>

<script>
    var map = L.map('map').setView([<?= $setting['lokasi_kantor'] ?>], 13);

    L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
    }).addTo(map);
    L.marker([<?= $setting['lokasi_kantor'] ?>, -0.09]).addTo(map)
        .bindPopup('<?= $setting['nama_kantor'] ?>')
        .openPopup('');
    L.circle([<?= $setting['lokasi_kantor'] ?>, -0.11], {
        color: 'red',
        fillColor: '#f03',
        fillOpacity: 0.5,
        radius: <?= $setting['radius'] ?>
    }).addTo(map);
</script>
<?php $this->endsection() ?>