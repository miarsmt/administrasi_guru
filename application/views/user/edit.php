<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>

    <div class="row">
        <div class="col-lg-8">

            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">My Profile</h6>
                </div>
                <div class="card-body">
                    <?= form_open_multipart('user/edit'); ?>
                    <div class="form-group row">
                        <label for="namauser" class="col-sm-2 col-form-label">Username</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="namauser" name="namauser" value="<?= $user['namauser']; ?>" readonly>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="name" class="col-sm-2 col-form-label">Full name</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="name" name="name" value="<?= $user['namalengkapuser']; ?>">
                            <?= form_error('name', '<small class="text-danger pl-3">', '</small>'); ?>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="name" class="col-sm-2 col-form-label">Picture</label>
                        <div class="col-sm-10">
                            <div class="row">
                                <div class="col-sm-3">
                                    <?php if ($user['avataruser'] == null) : ?>
                                        <img src="<?= base_url('assets/img/profile/default.jpg'); ?>" class="img-thumbnail">
                                    <?php else : ?>
                                        <img src="<?= base_url('assets/img/profile/') . $user['avataruser']; ?>" class="img-thumbnail">
                                    <?php endif; ?>
                                </div>
                                <div class="col-sm-9">
                                    <div class="custom-file">
                                        <input type="file" name="image" id="image" class="custom-file-input">
                                        <label for="image" class="custom-file-label">Choose file</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row justify-content-end">
                        <div class="col-sm-10">
                            <button type="submit" class="btn btn-info bg-gradient-info">Save Changes</button>
                        </div>
                    </div>

                    <?= form_close(); ?>
                </div>
            </div>

        </div>
    </div>

</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->