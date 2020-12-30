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
                    <a href="<?= base_url('master/addguru'); ?>" class="btn btn-info btn-sm bg-gradient-info"><i class="fas fa-plus-circle"></i> Tambah Guru</a>
                    <a href="" data-toggle="modal" data-target="#importGuru" class="btn btn-success btn-sm"><i class="fas fa-fw fa-file-excel"></i> Import Data Guru</a>
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
                                    <th scope="col">Active</th>
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
                                            <a href="<?= base_url(); ?>master/editguru/<?= $gr['nip']; ?>" class="btn btn-warning btn-circle btn-sm bg-gradient-warning" title="Edit Data"><i class="fas fa-edit"></i></a>
                                            <a href="<?= base_url(); ?>master/deleteguru/<?= $gr['nip']; ?>" class="btn btn-danger btn-circle btn-sm bg-gradient-danger tombol-hapus" title="Hapus Data"><i class="fas fa-trash"></i></a>
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
            <div class="modal-header">
                <h5 class="modal-title" id="importGuruLabel">Import Data Guru</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?= base_url('import/upload'); ?>" method="post" enctype="multipart/form-data">
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