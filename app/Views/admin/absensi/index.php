<?php $this->extend('admin/layout/main') ?>

<?php $this->section('content') ?>
<div class="card mb-3">
    <div class="bg-holder d-none d-lg-block bg-card" style="background-image:url(<?= base_url() ?>assets/img/illustrations/corner-4.png);">
    </div>
    <!--/.bg-holder-->
    <div class="card-body">
        <div class="row">
            <div class="col-lg-8">
                <h3 class="mb-0">Attendance</h3>
            </div>
        </div>
    </div>
</div>
<div class="card mb-3">
    <div class="bg-holder d-none d-lg-block bg-card" style="background-image:url(<?= base_url() ?>assets/img/illustrations/corner-4.png);">
    </div>
    <!--/.bg-holder-->
    <div class="card-body">
        <div class="row">
            <div class="col-lg-8">
            <input class="form-control" id="readonly" type="text" placeholder="Readonly input here…" readonly="">
                <div class="row" style="margin-top: 70px;">
                    <div class="col">
                        <style>
                            .my_camera,
                            .my_camera video {
                                display: inline-block;
                                width: 100% !important;
                                margin: auto;
                                height: auto !important;
                                border-radius: 15px;
                            }
                        </style>
                        <div class="my_camera">
                        </div>
                    </div>

                </div>
                <button class="btn btn-success mr-1 mb-1 " type="button">Absensi
                </button>
            </div>
        </div>
    </div>
</div>
<div class="card mb-3">
    <div class="bg-holder d-none d-lg-block bg-card" style="background-image:url(<?= base_url() ?>assets/img/illustrations/corner-4.png);">
    </div>
    <!--/.bg-holder-->
    <div class="card-body">
        <div class="row">
            <div class="col-lg-8" id="lokasi">
                <div id="map" style="width: 100%; height: 250px;">
                </div>
            </div>
        </div>
    </div>
</div>
<?php $this->endSection() ?>
<?php $this->section('script') ?>
<script>
    Webcam.set({
        width: 420,
        height: 340,
        image_format: 'jpeg',
        jpeg_quality: 90,
    });

    // Attach camera here
    Webcam.attach('.my_camera');

    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(showPosition);
    } else {
        alert("Geolocation is not supported by this browser");
        // document.getElementById("demo").innerHTML =
        //     "Geolocation is not supported by this browser.";
    }


    function showPosition(position) {
        var x = document.getElementById("lokasi");

        x.value = position.coords.latitude + "," + position.coords.longitude;

        // menampilkan map dan posisi karyawan
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
</script>
<?php $this->endSection() ?>