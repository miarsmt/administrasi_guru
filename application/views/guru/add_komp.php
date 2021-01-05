<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>

    <div class="row">
        <div class="col-lg-12">

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
                    <a href="" data-toggle="modal" data-target="#newKDModal" class="btn btn-info btn-sm float-right bg-gradient-info"><i class="fas fa-plus-circle"></i> Tambah KD</a>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Kode KD</th>
                                    <th scope="col">Nama KD</th>
                                    <th scope="col">Keterangan</th>
                                    <th scope="col">Semester</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i = 1; ?>
                                <?php foreach ($kompdasar as $kd) : ?>
                                    <tr>
                                        <th scope="row"><?= $i; ?></th>
                                        <td><?= $kd['kodekd']; ?></td>
                                        <td><?= $kd['namakd']; ?></td>
                                        <td><?= $kd['keterangankd']; ?></td>
                                        <td><?= $kd['semester']; ?></td>
                                        <td>
                                            <a href="<?= base_url(); ?>guru/deletekomp/<?= $kd['idkd']; ?>" class="btn btn-outline-danger btn-circle btn-sm tombol-hapus" title="Hapus Data"><i class="fas fa-trash"></i></a>
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

<div class="modal fade" id="newKDModal" tabindex="-1" aria-labelledby="newKDModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="newKDModalLabel">Add Kompeternsi Dasar</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?= base_url('guru/addkomp'); ?>" method="post">
                <div class="modal-body">
                    <input type="hidden" name="kodemapel" id="kodemapel" value="<?= $mapel['kodemapel']; ?>">
                    <div class="form-group">
                        <input type="text" class="form-control" name="kodekd" id="kodekd" placeholder="Kode KD">
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" name="namakd" id="namakd" placeholder="Nama KD">
                    </div>
                    <div class="form-group">
                        <textarea name="ket" id="ket" rows="5" class="form-control" placeholder="Keterangan"></textarea>
                    </div>
                    <div class="form-group">
                        <input type="text" name="semester" id="semester" class="form-control" placeholder="Semester">
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