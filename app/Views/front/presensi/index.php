<?php $this->extend('front/layout/main') ?>
<?php $this->section('content') ?>

<div class="card mb-3">
    <div class="card-body">
        <form id="add_submit">
            <input type="hidden" name="id" value="<?php if (isset($detail['id'])) echo $detail['id']; ?>" />
            <input class="form-control mb-4" id="lokasi" type="text" lokasi>
            <div style="text-align: center;">
                <video id="input_video" style="display:none;"></video>
                <canvas id="output_canvas" width="1280" height="720"></canvas>
            </div>
            <br>
            <br>
            <button type="button" class=" text-center btn btn-warning" id="startCameraButton" title="Start Camera"><i class="fa fa-camera"></i></button>
            <br>
            <br>
            <div class="text-center mt-3">
                <button type="button" class="btn btn-primary">Absensi Masuk</button>
            </div>

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
                iconUrl: '<?= base_url('front/img/sample/gedungg.png') ?>',

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
    document.getElementById("startCameraButton").addEventListener("click", function() {
        // Setelah tombol ditekan, jalankan inisialisasi kamera dan FaceMesh
        initializeFaceMesh();
    });

    function initializeFaceMesh() {
        const videoElement = document.getElementById("input_video");
        const canvasElement = document.getElementById("output_canvas");
        const canvasCtx = canvasElement.getContext("2d");

        // Initialize FaceMesh
        const faceMesh = new FaceMesh({
            locateFile: (file) =>
                `https://cdn.jsdelivr.net/npm/@mediapipe/face_mesh/${file}`,
        });
        faceMesh.setOptions({
            maxNumFaces: 1,
            refineLandmarks: true,
            minDetectionConfidence: 0.8,
            minTrackingConfidence: 0.8,
        });

        faceMesh.onResults(onResults);

        // Handle camera input
        const camera = new Camera(videoElement, {
            onFrame: async () => {
                await faceMesh.send({
                    image: videoElement
                });
            },
            width: 1280,
            height: 720,
        });

        camera.start();

        let blinkCount = 0; // Menghitung jumlah kedipan
        const targetBlinkCount = 9; // Jumlah kedipan yang diminta
        const eyeThreshold = 0.15; // Ambang batas untuk deteksi kedipan
        let alertShown = false; // Cegah alert muncul berulang kali

        function calculateEyeAspectRatio(eyeLandmarks) {
            const vertical1 = Math.hypot(
                eyeLandmarks[1].x - eyeLandmarks[5].x,
                eyeLandmarks[1].y - eyeLandmarks[5].y
            );
            const vertical2 = Math.hypot(
                eyeLandmarks[2].x - eyeLandmarks[4].x,
                eyeLandmarks[2].y - eyeLandmarks[4].y
            );
            const horizontal = Math.hypot(
                eyeLandmarks[0].x - eyeLandmarks[3].x,
                eyeLandmarks[0].y - eyeLandmarks[3].y
            );
            return (vertical1 + vertical2) / (2.0 * horizontal);
        }

        function onResults(results) {
            // Clear canvas
            canvasCtx.save();
            canvasCtx.clearRect(0, 0, canvasElement.width, canvasElement.height);

            // Draw image
            canvasCtx.drawImage(
                results.image,
                0,
                0,
                canvasElement.width,
                canvasElement.height
            );

            // Draw face landmarks and detect blinks
            if (results.multiFaceLandmarks) {
                for (const landmarks of results.multiFaceLandmarks) {
                    // Draw landmarks
                    drawConnectors(canvasCtx, landmarks, FACEMESH_TESSELATION, {
                        color: "#C0C0C070",
                        lineWidth: 1,
                    });

                    // Extract eye landmarks
                    const leftEyeLandmarks = [
                        landmarks[362],
                        landmarks[385],
                        landmarks[387],
                        landmarks[263],
                        landmarks[373],
                        landmarks[380],
                    ];
                    const rightEyeLandmarks = [
                        landmarks[33],
                        landmarks[160],
                        landmarks[158],
                        landmarks[133],
                        landmarks[153],
                        landmarks[144],
                    ];

                    // Calculate EAR for both eyes
                    const leftEAR = calculateEyeAspectRatio(leftEyeLandmarks);
                    const rightEAR = calculateEyeAspectRatio(rightEyeLandmarks);

                    // Detect blink
                    if (
                        leftEAR < eyeThreshold &&
                        rightEAR < eyeThreshold &&
                        !alertShown
                    ) {
                        blinkCount++;
                        console.log(`Kedipan terdeteksi! Jumlah kedipan: ${blinkCount}`);
                        if (blinkCount >= targetBlinkCount) {
                            alertShown = true;
                            alert("Berhasil!");
                        }
                    }
                }
            }
            canvasCtx.restore();

            // Continue the animation loop
            requestAnimationFrame(() => onResults(results));
        }
    }
</script>
<?php $this->endSection('script') ?>