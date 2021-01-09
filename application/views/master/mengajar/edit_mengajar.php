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
                <div class="card-body">
                    <form action="" method="post">
                        <div class="form-group">
                            <input type="hidden" name="kode" id="kode" value="<?= $dtajar['idmengajar']; ?>">
                            <label for="kodemapel">Nama Mapel</label>
                            <select name="kodemapel" id="kodemapel" class="form-control">
                                <?php foreach ($mapel as $m) : ?>
                                    <option value="<?= $m['kodemapel']; ?>" <?= ($dtajar['kodemapel'] == $m['kodemapel']) ? 'selected' : ''; ?>><?= $m['namamapel']; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="nip">Nama Guru</label>
                            <select name="nip" id="nip" class="form-control">
                                <?php foreach ($guru as $g) : ?>
                                    <option value="<?= $g['nip']; ?>" <?= ($dtajar['nip'] == $g['nip']) ? 'selected' : ''; ?>><?= $g['namaguru']; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="smstr">Semester</label>
                            <input type="text" name="smstr" id="smstr" class="form-control" value="<?= $dtajar['semester']; ?>">
                            <?= form_error('smstr', '<small class="text-danger">', '</small>'); ?>
                        </div>
                        <div class="form-group">
                            <label for="kodekls">Kelas</label>
                            <select name="kodekls" id="kodekls" class="form-control">
                                <?php foreach ($kelas as $k) : ?>
                                    <option value="<?= $k['kodekelas']; ?>" <?= ($dtajar['kodekelas'] == $k['kodekelas']) ? 'selected' : ''; ?>><?= $k['kodekelas']; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="periode">Periode Mengajar</label>
                            <input type="text" name="periode" id="periode" class="form-control" value="<?= $dtajar['periode_mengajar']; ?>">
                            <?= form_error('periode', '<small class="text-danger">', '</small>'); ?>
                        </div>
                        <div class="form-group">
                            <a href="<?= base_url('master/mengajar'); ?>" class="btn btn-secondary">Batal</a>
                            <button type="submit" class="btn btn-info bg-gradient-info float-right">Simpan</button>
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