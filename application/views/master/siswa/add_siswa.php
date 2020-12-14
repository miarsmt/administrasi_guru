<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>

    <div class="row">
        <div class="col-lg">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Form Tambah </h6>
                </div>
                <div class="card-body">
                    <?= form_open('', ['class' => 'form-horizontal']); ?>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label for="nis" class="col-sm-3 col-form-label">NIS</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" name="nis" id="nis" autofocus value="<?= set_value('nis'); ?>">
                                    <?= form_error('nis', '<small class="text-danger">', '</small>'); ?>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="namasiswa" class="col-sm-3 col-form-label">Nama siswa</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" name="namasiswa" id="namasiswa" value="<?= set_value('namasiswa'); ?>">
                                    <?= form_error('namasiswa', '<small class="text-danger">', '</small>'); ?>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="nisn" class="col-sm-3 col-form-label">NISN</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" name="nisn" id="nisn" value="<?= set_value('nisn'); ?>">
                                    <?= form_error('nisn', '<small class="text-danger">', '</small>'); ?>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="jenkel" class="col-sm-3 col-form-label">Jenis Kelamin</label>
                                <div class="col-sm-9">
                                    <select name="jenkel" id="jenkel" class="form-control">
                                        <option value="">-Pilih-</option>
                                        <option value="Laki-laki">Laki-laki</option>
                                        <option value="Perempuan">Perempuan</option>
                                    </select>
                                    <?= form_error('jenkel', '<small class="text-danger">', '</small>'); ?>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="tempat" class="col-sm-3 col-form-label">Tempat Lahir</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" name="tempat" id="tempat" value="<?= set_value('tempat'); ?>">
                                    <?= form_error('tempat', '<small class="text-danger">', '</small>'); ?>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="tgl" class="col-sm-3 col-form-label">Tanggal Lahir</label>
                                <div class="col-sm-9">
                                    <input type="date" class="form-control" name="tgl" id="tgl" value="<?= set_value('tgl'); ?>">
                                    <?= form_error('tgl', '<small class="text-danger">', '</small>'); ?>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="alamat" class="col-sm-3 col-form-label">Alamat</label>
                                <div class="col-sm-9">
                                    <textarea name="alamat" id="alamat" cols="30" rows="5" class="form-control"><?= set_value('alamat'); ?></textarea>
                                    <?= form_error('alamat', '<small class="text-danger">', '</small>'); ?>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label for="notelp" class="col-sm-3 col-form-label">No. Telp Seluler</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" name="notelp" id="notelp" value="<?= set_value('notelp'); ?>">
                                    <?= form_error('notelp', '<small class="text-danger">', '</small>'); ?>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="email" class="col-sm-3 col-form-label">Email</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" name="email" id="email" value="<?= set_value('email'); ?>">
                                    <?= form_error('email', '<small class="text-danger">', '</small>'); ?>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="asal" class="col-sm-3 col-form-label">Asal Sekolah</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" name="asal" id="asal" value="<?= set_value('asal'); ?>">
                                    <?= form_error('asal', '<small class="text-danger">', '</small>'); ?>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="tgmasuk" class="col-sm-3 col-form-label">Tanggal Masuk</label>
                                <div class="col-sm-9">
                                    <input type="date" class="form-control" name="tgmasuk" id="tgmasuk" value="<?= set_value('tgmasuk'); ?>">
                                    <?= form_error('tgmasuk', '<small class="text-danger">', '</small>'); ?>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="ayah" class="col-sm-3 col-form-label">Nama Ayah</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" name="ayah" id="ayah" value="<?= set_value('ayah'); ?>">
                                    <?= form_error('ayah', '<small class="text-danger">', '</small>'); ?>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="ibu" class="col-sm-3 col-form-label">Nama Ibu</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" name="ibu" id="ibu" value="<?= set_value('ibu'); ?>">
                                    <?= form_error('ibu', '<small class="text-danger">', '</small>'); ?>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="kodekls" class="col-sm-3 col-form-label">Kelas</label>
                                <div class="col-sm-9">
                                    <select name="kodekls" id="kodekls" class="form-control">
                                        <option value="">-Pilih Kelas-</option>
                                        <?php foreach ($kelas as $k) : ?>
                                            <option value="<?= $k['kodekelas']; ?>"><?= $k['kelas']; ?> <?= $k['namakelas']; ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                    <?= form_error('kodekls', '<small class="text-danger">', '</small>'); ?>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="kodejur" class="col-sm-3 col-form-label">Jurusan</label>
                                <div class="col-sm-9">
                                    <select name="kodejur" id="kodejur" class="form-control">
                                        <option value="">-Pilih Jurusan-</option>
                                        <?php foreach ($jurusan as $j) : ?>
                                            <option value="<?= $j['kodejurusan']; ?>"><?= $j['namajurusan']; ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                    <?= form_error('kodejur', '<small class="text-danger">', '</small>'); ?>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="semester" class="col-sm-3 col-form-label">Semester</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" name="semester" id="semester" value="<?= set_value('semester'); ?>">
                                    <?= form_error('semester', '<small class="text-danger">', '</small>'); ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <a href="<?= base_url('master/siswa'); ?>" class="btn btn-secondary">Batal</a>
                    <button type="submit" class="btn btn-primary float-right">Simpan</button>
                    <?= form_close(); ?>
                </div>
            </div>

        </div>
    </div>

</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->