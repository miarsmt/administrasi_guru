<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>

    <div class="flash-data" data-flashdata="<?= $this->session->flashdata('message'); ?>"></div>

    <div class="row">
        <div class="col-lg-12">
            <div class="card mb-4 py-3 border-left-danger">
                <div class="card-body">
                    <dt>Cek terlebih dahulu kompetensi dasar masing-masing mata pelajaran</dt>
                    <dd>Apabila ada mata pelajaran yang belum di-input-kan kompetensi dasar nya, silahkan tambahkan terlebih dahulu supaya memudahkan dalam pengisian agenda kegiatan</dd>
                </div>
            </div>
        </div>
        <div class="col-lg-12">
            <div class="card shadow mb-4 py-3">
                <div class="card-body">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Mata Pelajaran</th>
                                <th scope="col">Semester</th>
                                <th scope="col">Kelas</th>
                                <th scope="col">Tahun Ajaran</th>
                                <th scope="col">&nbsp;</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i = 1; ?>
                            <?php foreach ($ampu as $am) : ?>
                                <tr>
                                    <th scope="row"><?= $i; ?></th>
                                    <td><?= $am['namamapel']; ?></td>
                                    <td><?= $am['semester']; ?></td>
                                    <td><?= $am['kelas']; ?> <?= $am['namakelas']; ?></td>
                                    <td><?= $am['periode_mengajar']; ?></td>
                                    <td>
                                        <a href="<?= base_url('guru/addkomp/' . $am['kodemapel']); ?>" class="badge badge-info">Cek KD</a>
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
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->