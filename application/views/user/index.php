<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>

    <!-- kalau lolos -->
    <div class="flash-data" data-flashdata="<?= $this->session->flashdata('message'); ?>"></div>

    <div class="card shadow mb-3" style="max-width: 540px;">
        <div class="row no-gutters">
            <?php if ($user['avataruser'] == null) : ?>
                <div class="col-md-4">
                    <img src="<?= base_url('assets/img/profile/default.jpg'); ?>" class="card-img">
                </div>
            <?php else : ?>
                <div class="col-md-4">
                    <img src="<?= base_url('assets/img/profile/') . $user['avataruser']; ?>" class="card-img">
                </div>
            <?php endif; ?>
            <div class="col-md-8">
                <div class="card-body">
                    <h5 class="card-title"><?= $user['namalengkapuser']; ?></h5>
                    <p class="card-text"><?= $user['namauser']; ?></p>
                    <p class="card-text"><small class="text-muted">Member Since <?= format_indo($user['tglbuat']); ?></small></p>
                </div>
            </div>
        </div>
    </div>

</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->