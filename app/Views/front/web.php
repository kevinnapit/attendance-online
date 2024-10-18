<?php $this->extend('front/layout/main') ?>

<?php $this->section('content') ?>
<!-- App Capsule -->
<div id="appCapsule">
    <div class="section bg-primary" id="user-section">
        <div id="user-detail">
            <div class="avatar">
                <img src="assets/img/sample/avatar/avatar1.jpg" alt="avatar" class="imaged w64 rounded" />
            </div>
            <div id="user-info">
                <h2 id="user-name">Admin Mobile</h2>
                <span id="user-role">Programmer</span>
            </div>
        </div>
    </div>

    <div class="section" id="menu-section">
        <div class="card">
            <div class="card-body text-center">
                <div class="list-menu">
                    <div class="item-menu text-center">
                        <div class="menu-icon">
                            <a href="" class="green" style="font-size: 40px"><i class="fas fa-user"></i>
                            </a>
                        </div>
                        <div class="menu-name">
                            <span class="text-center">Profil</span>
                        </div>
                    </div>
                    <div class="item-menu text-center">
                        <div class="menu-icon">
                            <a href="" class="danger" style="font-size: 40px">
                                <i class="fas fa-calendar-alt"></i>
                            </a>
                        </div>
                        <div class="menu-name">
                            <span class="text-center">Cuti</span>
                        </div>
                    </div>
                    <div class="item-menu text-center">
                        <div class="menu-icon">
                            <a href="" class="warning" style="font-size: 40px">
                                <i class="fas fa-file-alt"></i>
                            </a>
                        </div>
                        <div class="menu-name">
                            <span class="text-center">Histori</span>
                        </div>
                    </div>
                    <div class="item-menu text-center">
                        <div class="menu-icon">
                            <a href="" class="orange" style="font-size: 40px">
                                <i class="fas fa-map-marker-alt"></i>
                            </a>
                        </div>
                        <div class="menu-name">Lokasi</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="section mt-2" id="presence-section">
        <div class="todaypresence">
            <div class="row">
                <div class="col-6">
                    <div class="card bg-success">
                        <div class="card-body">
                            <div class="presencecontent">
                                <div class="iconpresence">
                                    <i class="fas fa-clock"></i>
                                </div>
                                <div class="presencedetail">
                                    <h4 class="presencetitle">Masuk</h4>
                                    <span>07:00</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-6">
                    <div class="card bg-danger">
                        <div class="card-body">
                            <div class="presencecontent">
                                <div class="iconpresence">
                                    <i class="fas fa-clock"></i>
                                </div>
                                <div class="presencedetail">
                                    <h4 class="presencetitle">Pulang</h4>
                                    <span>12:00</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="rekappresence mt-1">
            <div class="col">
                <canvas id="myChart" style="min-height: 460px; height: 460px; max-height: 460px; max-width: 100%;"></canvas>
            </div>
        </div>

        <div class="rekappresence mt-1">

            <div class="row">
                <div class="col-6">
                    <div class="card">
                        <div class="card-body">
                            <div class="presencecontent">
                                <div class="iconpresence primary">
                                    <i class="fas fa-check"></i>
                                </div>
                                <div class="presencedetail">
                                    <h4 class="rekappresencetitle">Hadir</h4>
                                    <span class="rekappresencedetail">0 Hari</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-6">
                    <div class="card">
                        <div class="card-body">
                            <div class="presencecontent">
                                <div class="iconpresence green">
                                    <i class="fas fa-info"></i>
                                </div>
                                <div class="presencedetail">
                                    <h4 class="rekappresencetitle">Izin</h4>
                                    <span class="rekappresencedetail">0 Hari</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row mt-1">
                <div class="col-6">
                    <div class="card">
                        <div class="card-body">
                            <div class="presencecontent">
                                <div class="iconpresence danger">
                                    <i class="fas fa-sad-tear"></i>
                                </div>
                                <div class="presencedetail">
                                    <h4 class="rekappresencetitle">Sakit</h4>
                                    <span class="rekappresencedetail">0 Hari</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-6">
                    <div class="card">
                        <div class="card-body">
                            <div class="presencecontent">
                                <div class="iconpresence warning">
                                    <i class="fa fa-clock"></i>
                                </div>
                                <div class="presencedetail">
                                    <h4 class="rekappresencetitle">Terlambat</h4>
                                    <span class="rekappresencedetail">0 Hari</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="presencetab mt-2">
            <div class="tab-pane fade show active" id="pilled" role="tabpanel">
                <ul class="nav nav-tabs style1" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" data-toggle="tab" href="#home" role="tab">
                            Bulan Ini
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#profile" role="tab">
                            Leaderboard
                        </a>
                    </li>
                </ul>
            </div>
            <div class="tab-content mt-2" style="margin-bottom: 100px">
                <div class="tab-pane fade show active" id="home" role="tabpanel">
                    <ul class="listview image-listview">
                        <li>
                            <div class="item">
                                <div class="icon-box bg-primary">
                                    <i class="fas fa-image"></i>
                                </div>
                                <div class="in">
                                    <div>Photos</div>
                                    <span class="badge badge-danger">10</span>
                                </div>
                            </div>
                        </li>
                        <li>
                            <div class="item">
                                <div class="icon-box bg-secondary">
                                    <i class="fas fa-photo-video"></i>
                                </div>
                                <div class="in">
                                    <div>Videos</div>
                                    <span class="text-muted">None</span>
                                </div>
                            </div>
                        </li>
                        <li>
                            <div class="item">
                                <div class="icon-box bg-danger">
                                    <i class="fas fa-music"></i>
                                </div>
                                <div class="in">
                                    <div>Music</div>
                                </div>
                            </div>
                        </li>


                    </ul>
                </div>
                <div class="tab-pane fade" id="profile" role="tabpanel">
                    <ul class="listview image-listview">
                        <li>
                            <div class="item">
                                <img src="assets/img/sample/avatar/avatar1.jpg" alt="image" class="image" />
                                <div class="in">
                                    <div>Edward Lindgren</div>
                                    <span class="text-muted">Designer</span>
                                </div>
                            </div>
                        </li>
                        <li>
                            <div class="item">
                                <img src="assets/img/sample/avatar/avatar1.jpg" alt="image" class="image" />
                                <div class="in">
                                    <div>Emelda Scandroot</div>
                                    <span class="badge badge-primary">3</span>
                                </div>
                            </div>
                        </li>
                        <li>
                            <div class="item">
                                <img src="assets/img/sample/avatar/avatar1.jpg" alt="image" class="image" />
                                <div class="in">
                                    <div>Henry Bove</div>
                                </div>
                            </div>
                        </li>
                        <li>
                            <div class="item">
                                <img src="assets/img/sample/avatar/avatar1.jpg" alt="image" class="image" />
                                <div class="in">
                                    <div>Henry Bove</div>
                                </div>
                            </div>
                        </li>
                        <li>
                            <div class="item">
                                <img src="assets/img/sample/avatar/avatar1.jpg" alt="image" class="image" />
                                <div class="in">
                                    <div>Henry Bove</div>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- * App Capsule -->
<?php $this->endSection() ?>
<?php $this->Section('script') ?>
<script>
    // Function to start camera
    function startCamera() {
        const videoElement = document.getElementById('videoElement');
        const cameraPreview = document.getElementById('cameraPreview');
        cameraPreview.innerHTML = '';
        videoElement.style.display = 'block';

        if (navigator.mediaDevices && navigator.mediaDevices.getUserMedia) {
            navigator.mediaDevices.getUserMedia({
                video: true
            }).then(function(stream) {
                videoElement.srcObject = stream;
            });
        }
    }

    // Function to get location
    function getLocation() {
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(showPosition, showError);
        } else {
            alert("Geolocation tidak didukung oleh browser ini.");
        }
    }

    function showPosition(position) {
        const mapIframe = document.getElementById('mapIframe');
        const locationPreview = document.getElementById('locationPreview');
        const lat = position.coords.latitude;
        const lon = position.coords.longitude;

        locationPreview.innerHTML = ''; // Clear previous icon
        mapIframe.style.display = 'block';
        mapIframe.src = `https://www.google.com/maps?q=${lat},${lon}&hl=es;z=14&output=embed`;
    }

    function showError(error) {
        var locationErrorModal = new bootstrap.Modal(document.getElementById('locationErrorModal'));
        locationErrorModal.show();
    }

    // Function to submit attendance
    function submitAttendance() {
        alert("Absensi berhasil!");
    }
</script>
<?php $this->endSection('script') ?>