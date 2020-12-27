<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>

    <div class="row">
        <div class="col-lg">

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
                    <a href="" data-toggle="modal" data-target="#newMapelModal" class="btn btn-info btn-sm float-right bg-gradient-info"><i class="fas fa-plus-circle"></i> Tambah Mata Pelajaran</a>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Kode Mapel</th>
                                    <th scope="col">Nama Mapel</th>
                                    <th scope="col">KKM</th>
                                    <th scope="col">Kelompok</th>
                                    <th scope="col">Jurusan</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i = 1; ?>
                                <?php foreach ($mapel as $mp) : ?>
                                    <?php if ($mp['kodejurusan'] == 'Semua Jurusan') {
                                        $jurusan = $mp['kodejurusan'];
                                    } else {
                                        $jurusan = $mp['namajurusan'];
                                    } ?>
                                    <tr>
                                        <th scope="row"><?= $i; ?></th>
                                        <td><?= $mp['kodemapel']; ?></td>
                                        <td><?= $mp['namamapel']; ?></td>
                                        <td><?= $mp['kkm']; ?></td>
                                        <td><?= $mp['kelompok']; ?></td>
                                        <td><?= $jurusan; ?></td>
                                        <td>
                                            <a href="<?= base_url(); ?>master/addkomp/<?= $mp['kodemapel']; ?>" class="btn btn-success btn-circle btn-sm bg-gradient-success" title="Tambah Komp Dasar"><i class="fas fa-tasks"></i></a>
                                            <a href="<?= base_url(); ?>master/editmapel/<?= $mp['kodemapel']; ?>" class="btn btn-warning btn-circle btn-sm bg-gradient-warning" title="Edit Data"><i class="fas fa-edit"></i></a>
                                            <a href="<?= base_url(); ?>master/deletemapel/<?= $mp['kodemapel']; ?>" class="btn btn-danger btn-circle btn-sm bg-gradient-danger tombol-hapus" title="Hapus Data"><i class="fas fa-trash"></i></a>
                                        </td>
                                    </tr>
                                    <?php $i++; ?>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                        <a href="" data-toggle="modal" data-target="#importMapel" class="btn btn-primary btn-sm"><i class="fas fa-fw fa-file-excel"></i> Import Data Mapel</a>
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

<div class="modal fade" id="newMapelModal" tabindex="-1" aria-labelledby="newMapelModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="newMapelModalLabel">Tambah Mata Pelajaran</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?= base_url('master/mapel'); ?>" method="post">
                <div class="modal-body">
                    <div class="form-group">
                        <input type="text" class="form-control" name="kodemp" id="kodemp" value="<?= $kodemp; ?>">
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" name="namamp" id="namamp" placeholder="Nama Mapel">
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" name="tingkatan" id="tingkatan" placeholder="Tingkatan">
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" name="kelompok" id="kelompok" placeholder="Kelompok Mapel">
                    </div>
                    <div class="form-group">
                        <select name="kodejur" id="kodejur" class="form-control">
                            <option value="">-- Jurusan --</option>
                            <option value="Semua Jurusan">Semua Jurusan</option>
                            <?php foreach ($jrsn as $jr) : ?>
                                <option value="<?= $jr['kodejurusan']; ?>"><?= $jr['namajurusan']; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" name="kkm" id="kkm" placeholder="KKM">
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

<!-- Modal Import -->

<div class="modal fade" id="importMapel" tabindex="-1" aria-labelledby="importMapelLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="importMapelLabel">Import Data Mapel</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?= base_url('import/uploadmapel'); ?>" method="post" enctype="multipart/form-data">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="file">Unggah File Excel</label>
                        <div class="custom-file">
                            <input type="file" name="berkas_excel" id="berkas" class="custom-file-input" accept=".xlsx, .xls">
                            <label for="berkas" class="custom-file-label">Choose file</label>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Upload</button>
                </div>
            </form>
        </div>
    </div>
</div>