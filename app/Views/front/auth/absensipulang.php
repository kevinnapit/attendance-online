<body>
    <div class="appHeader bg-primary text-light">
        <div class="left">
            <a href="<?= base_url('home') ?>" class="headerButton goBack">
                <i class="fas fa-arrow-left fa-2x"></i>
            </a>
        </div>
        <div class="pageTitle">Pulang</div>
        <div class="right"></div>
    </div>
    <button class="btn btn-warning btn-block"><i class="fas fa-camera"></i>&nbsp;Absen Keluar</button>

    <input type="text" name="lokasi" id="lokasi">
    <div class="" id="map" style="width: 100%; height:400px"></div>

    <!-- App Bottom Menu -->
    <div class="appBottomMenu">
        <a href="#" class="item">
            <div class="col">
                <i class="fas fa-home fa-3x"></i>
                <strong>Home</strong>
            </div>
        </a>
        <a href="#" class="item active">
            <div class="col">
                <i class="fas fa-calendar-alt fa-3x"></i>
                <strong>Calendar</strong>
            </div>
        </a>
        <a href="<?= base_url('presensi') ?>" class="item">
            <div class="col">
                <div class="action-button large label-dark">
                    <i class="fas fa-camera text-white fa-3x"></i>
                </div>
            </div>
        </a>
        <a href="#" class="item">
            <div class="col">
                <i class="fas fa-file-alt fa-3x"></i>
                <strong>Docs</strong>
            </div>
        </a>
        <a href="javascript:;" class="item">
            <div class="col">
                <i class="fas fa-user-tie fa-3x"></i>
                <strong>Profile</strong>
            </div>
        </a>
    </div>
    <!-- * App Bottom Menu -->

</body>

<!-- ///////////// Js Files ////////////////////  -->
<!-- Jquery -->
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

        // menanpikan map dan posisi karyawan
        var map = L.map('map').setView([position.coords.latitude, position.coords.longitude], 19);

        L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
        }).addTo(map);

        L.marker([position.coords.latitude, position.coords.longitude]).addTo(map)
        // radius kantor
        var circle = L.circle([<?= $kantor['lokasi_kantor'] ?>], {
            color: 'red',
            fillColor: '#f03',
            fillOpacity: 0.5,
            radius: <?= $kantor['radius'] ?> //====> Radius dalam meter


        }).addTo(map);
        // posisi kantor

        var kantoricon = L.icon({
            iconUrl: '<?= base_url('front/img/building.png') ?>',

            iconSize: [38, 95], // size of the icon
            shadowSize: [50, 64], // size of the shadow
            iconAnchor: [22, 94], // point of the icon which will correspond to marker's location
            popupAnchor: [-3, -76] // point from which the popup should open relative to the iconAnchor
        });
        L.marker([<?= $kantor['lokasi_kantor'] ?>], {
                icon: kantoricon
            }).addTo(map)
            .bindPopup("KOMINFO TOBA")
            .openPopup();

    }
</script>