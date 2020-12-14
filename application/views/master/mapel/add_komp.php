<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>

    <!-- kalau lolos -->

    <div class="row">
        <div class="col-lg-6">
            <div class="card shadow mb-4">
                <div class="card-header">
                    <h5 class="card-title">Mata Pelajaran : <?= $mapel['namamapel']; ?></h5>
                </div>
                <div class="card-body">
                    <form action="" method="post">
                        <div class="form-group">
                            <label for="kodekd">Kode Kompetensi Dasar</label>
                            <input type="text" name="kodekd" id="kodekd" class="form-control" value="<?= set_value('kodekd'); ?>">
                            <?= form_error('kodekd', '<small class="text-danger">', '</small>'); ?>
                        </div>
                        <div class="form-group">
                            <label for="namakd">Nama Kompetensi Dasar</label>
                            <input type="text" name="namakd" id="namakd" class="form-control" value="<?= set_value('namakd'); ?>">
                            <?= form_error('namakd', '<small class="text-danger">', '</small>'); ?>
                        </div>
                        <div class="form-group">
                            <label for="semester">Semester</label>
                            <input type="text" name="semester" id="semester" class="form-control" value="<?= set_value('semester'); ?>">
                            <?= form_error('semester', '<small class="text-danger">', '</small>'); ?>
                        </div>
                        <div class="form-group">
                            <label for="kkm">KKM</label>
                            <input type="text" name="kkm" id="kkm" class="form-control" value="<?= set_value('kkm'); ?>">
                            <?= form_error('kkm', '<small class="text-danger">', '</small>'); ?>
                        </div>
                        <div class="form-group">
                            <a href="<?= base_url('master/mapel'); ?>" class="btn btn-secondary">Batal</a>
                            <button type="submit" class="btn btn-info bg-gradient-info float-right">Tambah</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="card shadow">
                <div class="card-header">
                    <h5 class="card-title">Kompetensi Dasar</h5>
                </div>
                <div class="card-body">
                    <dl class="row">
                        <?php if ($kompdasar) { ?>
                            <?php foreach ($kompdasar as $kd) : ?>
                                <dt class="col-sm-3"><?= $kd['kodekd']; ?></dt>
                                <dd class="col-sm-9"><?= $kd['namakd']; ?></dd>
                            <?php endforeach; ?>
                        <?php } else { ?>
                            <dd class="col-md-9 offset-3">Belum ada kompetensi dasar</dd>
                        <?php } ?>
                    </dl>
                </div>
            </div>
        </div>
    </div>

</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->