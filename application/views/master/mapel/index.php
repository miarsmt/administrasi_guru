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
                    <a href="" data-toggle="modal" data-target="#newMapelModal" class="btn btn-outline-info btn-sm "><i class="fas fa-plus-circle"></i> Tambah Mata Pelajaran</a>
                    <div class="btn-group">
                        <a href="<?= base_url('master/download_formatmapel'); ?>" class="btn btn-outline-success btn-sm"><i class="fas fa-fw fa-download"></i> Download Format Import</a>
                        <a href="" data-toggle="modal" data-target="#importMapel" class="btn btn-outline-success btn-sm"><i class="fas fa-fw fa-file-excel"></i> Import Data Mapel</a>
                    </div>
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
                                        <td><?= $mp['namakelompokmapel']; ?></td>
                                        <td><?= $jurusan; ?></td>
                                        <td>
                                            <a href="<?= base_url(); ?>master/editmapel/<?= $mp['kodemapel']; ?>" class="btn btn-outline-warning btn-circle btn-sm " title="Edit Data"><i class="fas fa-edit"></i></a>
                                            <a href="<?= base_url(); ?>master/deletemapel/<?= $mp['kodemapel']; ?>" class="btn btn-outline-danger btn-circle btn-sm tombol-hapus" title="Hapus Data"><i class="fas fa-trash"></i></a>
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
                        <select name="kelompok" id="kelompok" class="form-control">
                            <option value="">- Pilih Kelompok -</option>
                            <?php foreach ($kelompok as $k) : ?>
                                <option value="<?= $k['idkelompokmapel']; ?>"><?= $k['namakelompokmapel']; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <select name="kodejur" id="kodejur" class="form-control">
                            <option value="">- Jurusan -</option>
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
            <div class="modal-body">
                <div class="card">
                    <div class="card-header"></div>
                    <div class="card-body text-center">
                        <p>Gunakan format file .xls, .xlxs untuk <br> mengunggah data guru</p>
                        <p class="mt-5">Unggah File</p>
                        <form action="<?= base_url('import/uploadmapel'); ?>" method="post" enctype="multipart/form-data">
                            <div class="custom-file col-sm-6">
                                <input type="file" name="berkas_excel" id="berkas" class="custom-file-input" accept=".xlsx, .xls">
                                <label for="berkas" class="custom-file-label text-left">Choose file</label>
                            </div>
                            <p>Khusus format file excel</p>
                            <button type="submit" class="btn btn-primary">Unggah</button>
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>