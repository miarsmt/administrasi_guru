<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>

    <div class="row">
        <div class="col-lg">

            <!-- kalau lolos -->
            <div class="flash-data" data-flashdata="<?= $this->session->flashdata('message'); ?>"></div>

            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <a href="<?= base_url('master/addguru'); ?>" class="btn btn-outline-info btn-sm"><i class="fas fa-plus-circle"></i> Tambah Guru</a>
                    <div class="btn-group">
                        <a href="<?= base_url('master/download_formatguru'); ?>" class="btn btn-outline-success btn-sm"><i class="fas fa-fw fa-download"></i> Download Format Import</a>
                        <a href="" data-toggle="modal" data-target="#importGuru" class="btn btn-outline-success btn-sm"><i class="fas fa-fw fa-file-excel"></i> Import Data Guru</a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">NIP</th>
                                    <th scope="col">Nama Guru</th>
                                    <th scope="col">Tempat, Tgl Lahir</th>
                                    <th scope="col">Jurusan</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i = 1; ?>
                                <?php foreach ($guru as $gr) : ?>
                                    <?php if ($gr['is_active'] == 1) {
                                        $active = 'Aktif';
                                    } else {
                                        $active = 'Tidak Aktif';
                                    } ?>
                                    <tr>
                                        <th scope="row"><?= $i; ?></th>
                                        <td><?= $gr['nip']; ?></td>
                                        <td><?= $gr['namaguru']; ?></td>
                                        <td><?= $gr['tempatlahir']; ?>, <br><?= $gr['tgllahir']; ?></td>
                                        <td><?= $gr['namajurusan']; ?></td>
                                        <td><?= $active ?></td>
                                        <td>
                                            <a href="<?= base_url(); ?>master/editguru/<?= $gr['nip']; ?>" class="btn btn-outline-warning btn-sm btn-circle" title="Edit Data"><i class="fas fa-edit"></i></a>
                                            <a href="<?= base_url(); ?>master/deleteguru/<?= $gr['nip']; ?>" class="btn btn-outline-danger btn-sm btn-circle tombol-hapus" title="Hapus Data"><i class="fas fa-trash"></i></a>
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

<!-- Modal -->

<div class="modal fade" id="importGuru" tabindex="-1" aria-labelledby="importGuruLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body">
                <div class="card">
                    <div class="card-header"></div>
                    <div class="card-body text-center">
                        <p>Gunakan format file .xls, .xlxs untuk <br> mengunggah data guru</p>
                        <p class="mt-5">Unggah File</p>
                        <form action="<?= base_url('import/upload'); ?>" method="post" enctype="multipart/form-data">
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