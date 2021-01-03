<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>

    <div class="row">
        <div class="col-lg-8">

            <div class="card shadow mb-4">
                <div class="card-header py-3">
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">ID Guru</th>
                                    <th scope="col">Nama Guru</th>
                                    <th scope="col">L/P</th>
                                    <th scope="col">&nbsp;</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i = 1; ?>
                                <?php foreach ($guru as $g) : ?>
                                    <?php if ($g['jeniskelamin'] == 'Laki-laki') {
                                        $gender = 'L';
                                    } else {
                                        $gender = 'P';
                                    } ?>
                                    <tr>
                                        <th scope="row"><?= $i; ?></th>
                                        <td><?= $g['kodeguru']; ?></td>
                                        <td><?= $g['namaguru']; ?></td>
                                        <td><?= $gender; ?></td>
                                        <td>
                                            <a href="<?= base_url('laporan/reportagenda/' . $g['nip']); ?>" class="btn btn-outline-info btn-sm">Cetak Agenda</a>
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