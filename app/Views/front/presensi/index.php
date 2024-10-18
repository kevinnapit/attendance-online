<?php $this->extend('front/layout/main') ?>
<?php $this->section('content') ?>
<div class="container mt-5">
    <!-- Attendance Card -->
    <div class="card">
        <div class="card-header text-center bg-primary text-white">
            <h3>Attendance</h3>
        </div>
        <div class="card-body">
            <form id="attendanceForm">
                <!-- Webcam -->
                <input type="hidden" name="id" value="<?php if (isset($detail['id'])) echo $detail['id']; ?>" />
                <div class="mb-3 text-center">
                    <div id="my_camera" class="border mb-3" style="width: 320px; height: 240px;"></div>
                    <button type="submit" id="btnAbsensi" class="btn btn-success">Absensi Masuk</button>
                    <input type="hidden" name="image" id="imageInput">
                </div>

                <!-- Location -->
                <div class="mb-3">
                    <label for="location" class="form-label">Location</label>
                    <input type="text" class="form-control" id="lokasi" readonly>
                </div>

                <!-- Map Preview -->
                <div id="map" style="height: 250px;" class="mb-3"></div>
            </form>
        </div>
    </div>
</div>
<?php $this->endSection() ?>
<?php $this->section('script') ?>
<script>
    $(document).ready(function() {
        // Inisialisasi kamera
        Webcam.set({
            width: 420,
            height: 340,
            image_format: 'jpeg',
            jpeg_quality: 90
        });
        Webcam.attach('my_camera');

        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(showPosition);
        } else {
            alert("Geolocation is not supported by this browser");
        }

        function showPosition(position) {
            var x = document.getElementById("lokasi");

            x.value = position.coords.latitude + "," + position.coords.longitude;

            // menanpikan map dan posisi karyawan
            var map = L.map('map').setView([position.coords.latitude, position.coords.longitude], 19);

            L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
            }).addTo(map);

            L.marker([position.coords.latitude, position.coords.longitude]).addTo(map)
            // radius kantor
            var circle = L.circle([<?= $lokasi['lokasi_kantor'] ?>], {
                color: 'red',
                fillColor: '#f03',
                fillOpacity: 0.5,
                radius: <?= $lokasi['radius'] ?> //====> Radius dalam meter


            }).addTo(map);
            // posisi kantor

            var kantoricon = L.icon({
                iconUrl: '<?= base_url('front/img/building.png') ?>',

                iconSize: [38, 95], // size of the icon
                shadowSize: [50, 64], // size of the shadow
                iconAnchor: [22, 94], // point of the icon which will correspond to marker's location
                popupAnchor: [-3, -76] // point from which the popup should open relative to the iconAnchor
            });
            L.marker([<?= $lokasi['lokasi_kantor'] ?>], {
                    icon: kantoricon
                }).addTo(map)
                .bindPopup("KOMINFO TOBA")
                .openPopup();

        }

    });
    $('#btnAbsensi').click(function(e) {
        e.preventDefault();

        Webcam.snap(function(uri) {
            var image = uri; // Ambil gambar dari webcam
            var lokasi = $("#lokasi").val(); // Ambil nilai lokasi

            $.ajax({
                type: 'POST',
                url: '<?= site_url('Presensi/submit') ?>',
                data: {
                    image: image, // Kirim gambar dalam format base64
                    lokasi: lokasi //kirim lokasi
                },
                cache: false,
                success: function(response) {
                    if (response.status === 'success') {
                        Swal.fire({
                            title: "Success",
                            text: response.message,
                            icon: "success"
                        }).then(() => {
                            // Redirect setelah berhasil absen
                            window.location.href = '<?= site_url('home') ?>';
                        });
                    } else {
                        Swal.fire({
                            title: "Error",
                            text: response.message,
                            icon: "error"
                        });
                    }
                },
                error: function(error) {
                    Swal.fire({
                        title: "Gagal",
                        text: "Silahkan Hubungi IT",
                        icon: "error"
                    });
                }
            });
        });
    });
</script>
<?php $this->endSection() ?>