<?php $this->extend('front/layout/main') ?>
<?php $this->section('content') ?>

<div class="card mb-3">
    <div class="card-body">
        <form id="add_submit">
            <input type="hidden" name="id" value="<?php if (isset($detail['id'])) echo $detail['id']; ?>" />
            <div style="text-align: center;">
                <video id="input_video" style="display:none;"></video>
                <canvas id="output_canvas" width="1280" height="720"></canvas>
            </div>
            <button type="button" class="btn btn-success" id="startCameraButton">Start Camera</button>
            <?php if ($status > 0) { ?>
                <button class="btn btn-danger" id="btnAbsensi">Absensi Pulang</button>
            <?php } else { ?>
                <button class="btn btn-primary" id="btnAbsensi">Absensi Masuk</button>
            <?php } ?>
        </form>
    </div>
</div>


<div class="card mb-3">
    <div class="card-body">
        <div id="map" style="width: 100%; height: 250px;"></div>
    </div>
</div>


<?php $this->endSection() ?>
<?php $this->Section('script') ?>
<!-- <script>
    $(document).ready(function() {
        // Inisialisasi kamera
        Webcam.set({
            width: 420,
            height: 340,
            image_format: 'jpeg',
            jpeg_quality: 90
        });
        Webcam.attach('.my_camera');

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
                url: '<?= site_url('admin2011/absensi/submit') ?>',
                data: {
                    image: image, // Kirim gambar dalam format base64
                    lokasi: lokasi // Kirim lokasi
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
                            window.location.href = '<?= site_url('admin2011/user') ?>';
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
</script> -->

<script>
    const videoElement = document.getElementById('input_video');
    const canvasElement = document.getElementById('output_canvas');
    const canvasCtx = canvasElement.getContext('2d');

    // Initialize FaceMesh
    const faceMesh = new FaceMesh({
        locateFile: (file) => `https://cdn.jsdelivr.net/npm/@mediapipe/face_mesh/${file}`,
    });
    faceMesh.setOptions({
        maxNumFaces: 1,
        refineLandmarks: true,
        minDetectionConfidence: 0.5,
        minTrackingConfidence: 0.5,
    });

    faceMesh.onResults(onResults);

    // Handle camera input
    const camera = new Camera(videoElement, {
        onFrame: async () => {
            await faceMesh.send({
                image: videoElement
            });
        },
        width: 720,
        height: 320,
    });
    camera.start();

    function onResults(results) {
        // Clear canvas
        canvasCtx.save();
        canvasCtx.clearRect(0, 0, canvasElement.width, canvasElement.height);

        // Draw image
        canvasCtx.drawImage(results.image, 0, 0, canvasElement.width, canvasElement.height);

        // Draw face landmarks with grid
        if (results.multiFaceLandmarks) {
            for (const landmarks of results.multiFaceLandmarks) {
                drawConnectors(canvasCtx, landmarks, FACEMESH_TESSELATION, {
                    color: '#C0C0C070',
                    lineWidth: 1
                });
                drawConnectors(canvasCtx, landmarks, FACEMESH_RIGHT_EYE, {
                    color: '#FF3030',
                    lineWidth: 1
                });
                drawConnectors(canvasCtx, landmarks, FACEMESH_RIGHT_EYEBROW, {
                    color: '#FF3030',
                    lineWidth: 1
                });
                drawConnectors(canvasCtx, landmarks, FACEMESH_LEFT_EYE, {
                    color: '#30FF30',
                    lineWidth: 1
                });
                drawConnectors(canvasCtx, landmarks, FACEMESH_LEFT_EYEBROW, {
                    color: '#30FF30',
                    lineWidth: 1
                });
                drawConnectors(canvasCtx, landmarks, FACEMESH_FACE_OVAL, {
                    color: '#E0E0E0',
                    lineWidth: 1
                });
                drawConnectors(canvasCtx, landmarks, FACEMESH_LIPS, {
                    color: '#E0E0E0',
                    lineWidth: 1
                });
            }
        }
        canvasCtx.restore();
    }
</script>
<?php $this->endSection('script') ?>