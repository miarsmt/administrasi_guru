<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>

    <div class="flash-data" data-flashdata="<?= $this->session->flashdata('message'); ?>"></div>

    <div class="row">
        <div class="col-lg">
            <div class="card shadow md-4">
                <div class="card-header py-3">

                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Tahun</th>
                                    <th scope="col">Mata Pelajaran</th>
                                    <th scope="col">Kelas</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i = 1; ?>
                                <?php foreach ($riwayat as $r) : ?>
                                    <tr>
                                        <th scope="row"><?= $i; ?></th>
                                        <td><?= $r['periode_mengajar']; ?></td>
                                        <td><?= $r['namamapel']; ?></td>
                                        <td><?= $r['kelas']; ?> <?= $r['namakelas']; ?></td>
                                        <td>
                                            <a href="<?= base_url('guru/cetak/' . $r['idmengajar']); ?>" class="btn btn-sm btn-outline-info" target="_blank">Cetak NP</a>
                                            <a href="<?= base_url('guru/cetaknk/' . $r['kodemapel'] . '-' . $r['kodekelas']); ?>" class="btn btn-sm btn-outline-info" target="_blank">Cetak NK</a>
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