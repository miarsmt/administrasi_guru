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
                    <a href="<?= base_url('master/addguru'); ?>" class="btn btn-info btn-sm float-right bg-gradient-info"><i class="fas fa-plus-circle"></i> Tambah Guru</a>
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
                                        <td><?= $gr['tempatlahir']; ?>, <br><?= format_indo($gr['tgllahir']); ?></td>
                                        <td><?= $gr['kodejurusan']; ?></td>
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