<?php $this->extend('admin/layout/main') ?>

<?php $this->section('content') ?>
<div class="row">
    <div class="col-12">
        <div class="card mb-3 btn-reveal-trigger">
            <div class="card-header position-relative min-vh-25 mb-8">
                <div class="cover-image">
                    <div class="bg-holder bg-primary rounded-soft rounded-bottom-0">
                    </div>
                    <!--/.bg-holder-->
                </div>
                <div class="avatar avatar-5xl avatar-profile shadow-sm img-thumbnail rounded-circle">
                    <div class="h-100 w-100 rounded-circle overflow-hidden position-relative"> <img src="<?php if (session()->get('admin_picture')) {
                                                                                                                echo base_url() . getenv('dir.upload.profile') . session()->get('admin_picture') ?><?php } else {
                                                                                                                                                                                                    echo base_url() ?>admin/assets/img/team/avatar.png<?php } ?>" width="200" alt="" data-dz-thumbnail id="profile-image-preview">
                        <!-- <form id="update_profile">
                            <input class="d-none" id="profile-image" name="picture" type="file">
                            <label class="mb-0 overlay-icon d-flex flex-center" for="profile-image"><span class="bg-holder overlay overlay-0"></span><span class="z-index-1 text-white text-center fs--1"><span class="fas fa-camera"></span><span class="d-block">Update</span></span></label>
                        </form> -->

                    </div>

                </div>

            </div>

            <div class="col-lg-8">
                <h4 class="mb-1"><span><?php echo session()->get('admin_name') ?></span><small class="fas fa-check-circle text-primary ml-1" data-toggle="tooltip" data-placement="right" title="Verified" data-fa-transform="shrink-4 down-2"></small>
                </h4>
                <h5 class="fs-0 font-weight-normal">Senior Software Engineer at Technext Limited</h5>
                <p class="text-500">New York, USA</p>
                <button class="btn btn-falcon-primary btn-sm px-3" type="button">Following</button>
                <button class="btn btn-falcon-default btn-sm px-3 ml-2" type="button">Message</button>
                <hr class="border-dashed my-4 d-lg-none" />
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-12">
        <div class="card mb-3 btn-reveal-trigger">
            <div class="card-header position-relative min-vh-25 mb-8">
                <div class="card-header">
                    <div class="row align-items-center justify-content-between">
                        <div class="col-6 col-sm-auto d-flex align-items-center pr-0">
                            <h2>Layanan</h2>
                        </div>
                    </div>
                </div>
                <div class="card-body pt-0">
                    <div class="container">
                        <div class="row">
                            <div class="col-4 col-sm-4 col-md-2">
                                <div style="border-radius: 10px; background-color: #86D293; padding: 5px; text-align: center;">
                                    <a href="<?= site_url('admin2011/absensi') ?>">
                                        <img src="<?= base_url() ?>assets/icon/absensi.png" style="width: 50px; height: 50px; display: block; margin: 0 auto;" />
                                    </a>
                                </div>
                                Absensi
                            </div>
                            <div class="col-4 col-sm-4 col-md-2">
                                <div style="border-radius: 10px; background-color: #C4D7FF; padding: 5px; text-align: center;">
                                    <a href="<?= site_url('admin2011/searching') ?>">
                                        <img src="<?= base_url() ?>assets/icon/permission.png" style="width: 50px; height: 50px; display: block; margin: 0 auto;" />
                                    </a>
                                </div>
                                Cuti Izin
                            </div>
                            <div class="col-4 col-sm-4 col-md-2">
                                <div style="border-radius: 10px; background-color: #117554; padding: 5px; text-align: center;">
                                    <a href="<?= site_url('admin2011/dashboard') ?>">
                                        <img src="<?= base_url() ?>assets/icon/out-of-home.png" style="width: 50px; height: 50px; display: block; margin: 0 auto;" />
                                    </a>
                                </div>
                                Dinas Luar
                            </div>
                            <div class="col-4 col-sm-4 col-md-2">
                                <div style="border-radius: 10px; background-color: #4379F2; padding: 5px; text-align: center;">
                                    <a href="<?= site_url('admin2011/searching') ?>">
                                        <img src="<?= base_url() ?>assets/icon/map.png" style="width: 50px; height: 50px; display: block; margin: 0 auto;" />
                                    </a>
                                </div>
                                Request Location
                            </div>
                            <div class="col-4 col-sm-4 col-md-2">
                                <div style="border-radius: 10px; background-color: #FFEB00; padding: 5px; text-align: center;">
                                    <a href="<?= site_url('admin2011/dpt') ?>">
                                        <img src="<?= base_url() ?>assets/icon/lock.png" style="width: 50px; height: 50px; display: block; margin: 0 auto;" />
                                    </a>
                                </div>
                                Change Password
                            </div>
                            <div class="col-4 col-sm-4 col-md-2">
                                <div style="border-radius: 10px; background-color: #ED3EF7; padding: 5px; text-align: center;">
                                    <a href="<?= site_url('admin2011/dpt') ?>">
                                        <img src="<?= base_url() ?>assets/icon/other.png" style="width: 50px; height: 50px; display: block; margin: 0 auto;" />
                                    </a>
                                </div>
                                Other
                            </div>
                        </div>
                    </div>



                </div>
            </div>
        </div>
    </div>
</div>
<?php $this->endSection() ?>