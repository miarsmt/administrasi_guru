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
                    <a href="<?= base_url('master/addsiswa'); ?>" class="btn btn-info btn-sm float-right bg-gradient-info"><i class="fas fa-plus-circle"></i> Tambah Siswa</a>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">NIS</th>
                                    <th scope="col">Nama Siswa</th>
                                    <th scope="col">Tempat, Tgl Lahir</th>
                                    <th scope="col">Jurusan</th>
                                    <th scope="col">Kelas</th>
                                    <th scope="col">Semester</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i = 1; ?>
                                <?php foreach ($siswa as $sw) : ?>
                                    <tr>
                                        <th scope="row"><?= $i; ?></th>
                                        <td><?= $sw['nis']; ?></td>
                                        <td><?= $sw['namasiswa']; ?></td>
                                        <td><?= $sw['tempatlahir']; ?>, <br><?= format_indo($sw['tgllahir']); ?></td>
                                        <td><?= $sw['namajurusan']; ?></td>
                                        <td><?= $sw['kelas']; ?> <?= $sw['namakelas']; ?></td>
                                        <td><?= $sw['semester_aktif'] ?></td>
                                        <td>
                                            <a href="<?= base_url(); ?>master/editsiswa/<?= $sw['nis']; ?>" class="btn btn-warning btn-circle btn-sm bg-gradient-warning" title="Edit Data"><i class="fas fa-edit"></i></a>
                                            <a href="<?= base_url(); ?>master/deletesiswa/<?= $sw['nis']; ?>" class="btn btn-danger btn-circle btn-sm bg-gradient-danger tombol-hapus" title="Hapus Data"><i class="fas fa-trash"></i></a>
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