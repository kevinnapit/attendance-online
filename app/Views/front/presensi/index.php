<?php $this->extend('front/layout/main') ?>

<?php $this->section('content') ?>

<div class="container my-4">
    <!-- Form Absensi -->
    <div class="card shadow-sm mb-4">
        <div class="card-header bg-primary text-white">
            <h5 class="mb-0">Form Absensi</h5>
        </div>
        <div class="card-body">
            <form id="add_submit">
                <!-- Hidden ID -->
                <input type="hidden" name="id" value="<?php if (isset($detail['id'])) echo $detail['id']; ?>" />

                <!-- Lokasi Input -->
                <div class="form-group mb-3">
                    <label for="lokasi" class="form-label">Lokasi</label>
                    <input class="form-control" id="lokasi" type="text" name="lokasi" placeholder="Masukkan lokasi" readonly />
                </div>

                <!-- Camera Section -->
                <div class="my_camera mb-3 border rounded p-3 bg-light text-center">
                    <p>Kamera di sini</p>
                </div>

                <!-- Absensi Button -->
                <div class="d-grid gap-2">
                    <?php if ($status > 0) { ?>
                        <button class="btn btn-danger text-center" id="btnAbsensi">Absensi Pulang</button>
                    <?php } else { ?>
                        <button class="btn btn-primary text-center" id="btnAbsensi">Absensi Masuk</button>
                    <?php } ?>
                </div>
            </form>
        </div>
    </div>

    <!-- Map Section -->
    <div class="card shadow-sm">
        <div class="card-header bg-secondary text-white">
            <h5 class="mb-0">Lokasi Absensi</h5>
        </div>
        <div class="card-body p-0">
            <div id="map" style="width: 100%; height: 250px;"></div>
        </div>
    </div>
</div>

<?php $this->endSection() ?>
<?php $this->section('script') ?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/webcamjs/1.0.26/webcam.min.js"></script>
<script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"></script>
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" />

<script>
    // Inisialisasi Kamera
    Webcam.set({
        width: 320,
        height: 240,
        image_format: 'jpeg',
        jpeg_quality: 90
    });

    Webcam.attach('.my_camera');

    // Inisialisasi Geolocation
    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(showPosition, showError);
    } else {
        alert("Geolocation is not supported by this browser.");
    }

    function showPosition(position) {
        var lokasiField = document.getElementById("lokasi");
        lokasiField.value = position.coords.latitude + ", " + position.coords.longitude;

        // Tampilkan peta
        var map = L.map('map').setView([position.coords.latitude, position.coords.longitude], 15);
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
        }).addTo(map);

        L.marker([position.coords.latitude, position.coords.longitude]).addTo(map)
            .bindPopup('Lokasi Anda').openPopup();
    }

    function showError(error) {
        switch (error.code) {
            case error.PERMISSION_DENIED:
                alert("User denied the request for Geolocation.");
                break;
            case error.POSITION_UNAVAILABLE:
                alert("Location information is unavailable.");
                break;
            case error.TIMEOUT:
                alert("The request to get user location timed out.");
                break;
            case error.UNKNOWN_ERROR:
                alert("An unknown error occurred.");
                break;
        }
    }
</script>
<?php $this->endSection() ?>