<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>

    <div class="row">
        <div class="col-lg-9">

            <!-- kalau error -->
            <?php if (validation_errors()) : ?>
                <div class="alert alert-danger alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
                    <?= validation_errors(); ?>
                </div>
            <?php endif; ?>

            <!-- kalau lolos -->
            <div class="flash-data" data-flashdata="<?= $this->session->flashdata('message'); ?>"></div>

            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <a href="" data-toggle="modal" data-target="#newKelasModal" class="btn btn-info btn-sm float-right bg-gradient-info"><i class="fas fa-plus-circle"></i> Tambah Kelas</a>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Kode Kelas</th>
                                    <th scope="col">Nama Kelas</th>
                                    <th scope="col">Jurusan</th>
                                    <th scope="col">Angkatan</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i = 1; ?>
                                <?php foreach ($kelas as $k) : ?>
                                    <?php if ($k['is_active'] == 1) {
                                        $active = 'Aktif';
                                    } else {
                                        $active = 'Tidak Aktif';
                                    } ?>
                                    <tr>
                                        <th scope="row"><?= $i; ?></th>
                                        <td><?= $k['kodekelas']; ?></td>
                                        <td><?= $k['kelas']; ?> <?= $k['namakelas']; ?></td>
                                        <td><?= $k['namajurusan']; ?></td>
                                        <td><?= $k['angkatankelas']; ?></td>
                                        <td><?= $active; ?></td>
                                        <td>
                                            <a href="<?= base_url(); ?>master/editkelas/<?= $k['kodekelas']; ?>" class="btn btn-outline-warning btn-circle btn-sm" title="Edit Data"><i class="fas fa-edit"></i></a>
                                            <a href="<?= base_url(); ?>master/deletekelas/<?= $k['kodekelas']; ?>" class="btn btn-outline-danger btn-circle btn-sm tombol-hapus" title="Hapus Data"><i class="fas fa-trash"></i></a>
                                        </td>
                                    </tr>
                                    <?php $i++; ?>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>
    </div>

</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->

<!-- Modal Add -->

<div class="modal fade" id="newKelasModal" tabindex="-1" aria-labelledby="newKelasModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="newKelasModalLabel">Tambah Kelas</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?= base_url('master/kelas'); ?>" method="post">
                <div class="modal-body">
                    <div class="form-group">
                        <input type="text" class="form-control" name="kodekls" id="kodekls" placeholder="Kode Kelas">
                    </div>
                    <div class="form-group">
                        <select name="kodejur" id="kodejur" class="form-control">
                            <option value="">-Jurusan-</option>
                            <?php foreach ($jurusan as $j) : ?>
                                <option value="<?= $j['kodejurusan']; ?>"><?= $j['namajurusan']; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" name="namakls" id="namakls" placeholder="Nama Kelas">
                    </div>
                    <div class="form-group">
                        <select name="kls" id="kls" class="form-control">
                            <option value="">-Kelas-</option>
                            <option value="X">X</option>
                            <option value="XI">XI</option>
                            <option value="XII">XII</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" name="angkatan" id="angkatan" placeholder="Angkatan Kelas">
                    </div>
                    <div class="form-group">
                        <div class="form-check">
                            <input type="checkbox" class="form-check-input" value="1" name="is_active" id="is_active" checked>
                            <label for="is_active" class="form-check-label">
                                Status?
                            </label>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>