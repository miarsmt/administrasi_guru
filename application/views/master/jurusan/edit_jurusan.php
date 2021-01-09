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
                            <input type="hidden" name="kode" id="kode" value="<?= $dtjurusan['kodejurusan']; ?>">
                            <label for="kodejur">Kode Jurusan</label>
                            <input type="text" name="kodejur" id="kodejur" class="form-control" value="<?= $dtjurusan['kodejurusan']; ?>" readonly>
                        </div>
                        <div class="form-group">
                            <label for="namajur">Nama Jurusan</label>
                            <input type="text" name="namajur" id="namajur" class="form-control" value="<?= $dtjurusan['namajurusan']; ?>">
                            <?= form_error('namajur', '<small class="text-danger">', '</small>'); ?>
                        </div>
                        <div class="form-group">
                            <label for="nip">Ketua Program</label>
                            <select name="nip" id="nip" class="form-control">
                                <?php foreach ($guru as $g) : ?>
                                    <option value="<?= $g['nip']; ?>" <?= ($dtjurusan['nip'] == $g['nip']) ? 'selected' : ''; ?>><?= $g['namaguru']; ?></option>
                                <?php endforeach; ?>
                            </select>
                            <?= form_error('nip', '<small class="text-danger">', '</small>'); ?>
                        </div>
                        <div class="form-group">
                            <a href="<?= base_url('master/jurusan'); ?>" class="btn btn-secondary">Batal</a>
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