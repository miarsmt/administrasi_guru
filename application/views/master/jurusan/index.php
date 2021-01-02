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
                    <a href="" data-toggle="modal" data-target="#newJurusanModal" class="btn btn-info btn-sm float-right bg-gradient-info"><i class="fas fa-plus-circle"></i> Tambah Jurusan</a>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Kode Jurusan</th>
                                    <th scope="col">Nama Jurusan</th>
                                    <th scope="col">Ketua Program</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i = 1; ?>
                                <?php foreach ($jurusan as $j) : ?>
                                    <tr>
                                        <th scope="row"><?= $i; ?></th>
                                        <td><?= $j['kodejurusan']; ?></td>
                                        <td><?= $j['namajurusan']; ?></td>
                                        <td><?= $j['namaguru']; ?></td>
                                        <td>
                                            <a href="<?= base_url(); ?>master/editjurusan/<?= $j['kodejurusan']; ?>" class="btn btn-outline-warning btn-circle btn-sm" title="Edit Data"><i class="fas fa-edit"></i></a>
                                            <a href="<?= base_url(); ?>master/deletejurusan/<?= $j['kodejurusan']; ?>" class="btn btn-outline-danger btn-circle btn-sm tombol-hapus" title="Hapus Data"><i class="fas fa-trash"></i></a>
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

<div class="modal fade" id="newJurusanModal" tabindex="-1" aria-labelledby="newJurusanModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="newJurusanModalLabel">Tambah Jurusan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?= base_url('master/jurusan'); ?>" method="post">
                <div class="modal-body">
                    <div class="form-group">
                        <input type="text" class="form-control" name="kodejur" id="kodejur" placeholder="Kode Jurusan">
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" name="namajur" id="namajur" placeholder="Nama Jurusan">
                    </div>
                    <div class="form-group">
                        <select name="nip" id="nip" class="form-control">
                            <option value="">-Ketua Jurusan-</option>
                            <?php foreach ($guru as $g) : ?>
                                <option value="<?= $g['nip']; ?>"><?= $g['namaguru']; ?></option>
                            <?php endforeach; ?>
                        </select>
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