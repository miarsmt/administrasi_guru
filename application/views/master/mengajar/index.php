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
                    <a href="" data-toggle="modal" data-target="#newMengajarModal" class="btn btn-info btn-sm float-right bg-gradient-info"><i class="fas fa-plus-circle"></i> Tambah Data Mengajar</a>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Nama Mapel</th>
                                    <th scope="col">Nama Guru</th>
                                    <th scope="col">Semester</th>
                                    <th scope="col">Kelas</th>
                                    <th scope="col">Tahun Ajaran</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i = 1; ?>
                                <?php foreach ($ajar as $aj) : ?>
                                    <tr>
                                        <th scope="row"><?= $i; ?></th>
                                        <td><?= $aj['namamapel']; ?></td>
                                        <td><?= $aj['namaguru']; ?></td>
                                        <td><?= $aj['semester']; ?></td>
                                        <td><?= $aj['kelas']; ?> <?= $aj['namakelas']; ?></td>
                                        <td><?= $aj['periode_mengajar']; ?></td>
                                        <td>
                                            <a href="<?= base_url(); ?>master/editajar/<?= $aj['idmengajar']; ?>" class="btn btn-outline-warning btn-circle btn-sm" title="Edit Data"><i class="fas fa-edit"></i></a>
                                            <a href="<?= base_url(); ?>master/deleteajar/<?= $aj['idmengajar']; ?>" class="btn btn-outline-danger btn-circle btn-sm tombol-hapus" title="Hapus Data"><i class="fas fa-trash"></i></a>
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

<div class="modal fade" id="newMengajarModal" tabindex="-1" aria-labelledby="newMengajarModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="newMengajarModalLabel">Tambah Data Mengajar</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?= base_url('master/mengajar'); ?>" method="post">
                <div class="modal-body">
                    <div class="form-group">
                        <select name="kodemapel" id="kodemapel" class="form-control">
                            <option value="">- Pilih Mapel -</option>
                            <?php foreach ($mapel as $m) : ?>
                                <option value="<?= $m['kodemapel']; ?>"><?= $m['namamapel']; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <select name="nip" id="nip" class="form-control">
                            <option value="">- Pilih Guru -</option>
                            <?php foreach ($guru as $g) : ?>
                                <option value="<?= $g['nip']; ?>"><?= $g['namaguru']; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" name="smstr" id="smstr" placeholder="Semester">
                    </div>
                    <div class="form-group">
                        <select name="kodekls" id="kodekls" class="form-control">
                            <option value="">- Pilih Kelas -</option>
                            <?php foreach ($kelas as $k) : ?>
                                <option value="<?= $k['kodekelas']; ?>"><?= $k['kodekelas']; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" name="periode" id="periode" placeholder="Periode Mengajar">
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