<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">
        <span><a href="#"><?= $title; ?></a></span>
        <span> / <?= $subtitle; ?></span>
    </h1>

    <!-- kalau lolos -->

    <div class="row">
        <div class="col-lg-6">
            <div class="card shadow mb-4">
                <div class="card-header">

                </div>
                <div class="card-body">
                    <form action="" method="post">
                        <input type="hidden" name="agenda_id" id="agenda_id" value="<?= $agenda['idagenda']; ?>">
                        <div class="form-group">
                            <label for="tgl">Tanggal</label>
                            <input type="date" name="tgl" id="tgl" class="form-control" value="<?= $agenda['tanggal'] ?>">
                            <?= form_error('tgl', '<small class="text-danger">', '</small>'); ?>
                        </div>
                        <div class="form-group">
                            <label for="jamke">Jam Ke</label>
                            <input type="text" name="jamke" id="jamke" class="form-control" value="<?= $agenda['jam_ke']; ?>">
                            <?= form_error('jamke', '<small class="text-danger">', '</small>'); ?>
                        </div>
                        <div class="form-group">
                            <label for="kompdsr">Kompetensi Dasar</label>
                            <select name="kompdsr" id="kompdsr" class="form-control">
                                <?php foreach ($kompdasar as $kd) : ?>
                                    <option value="<?= $kd['idkd']; ?>" <?= ($agenda['idkd'] == $kd['idkd']) ? 'selected' : ''; ?>><?= $kd['kodekd']; ?> <?= $kd['namakd']; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="ket">Keterangan</label>
                            <input type="text" id="ket" name="ket" class="form-control" value="<?= $agenda['keterangan']; ?>">
                            <?= form_error('ket', '<small class="text-danger">', '</small>'); ?>
                        </div>
                        <div class="form-group">
                            <a href="<?= base_url('guru'); ?>" class="btn btn-secondary">Batal</a>
                            <button type="submit" class="btn btn-info bg-gradient-info float-right">Ubah</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->