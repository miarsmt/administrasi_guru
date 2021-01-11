<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">
        <?= $title; ?>
    </h1>

    <div class="flash-data" data-flashdata="<?= $this->session->flashdata('message'); ?>"></div>

    <div class="row">

        <div class="col-lg-7">

            <div class="card shadow md-4">
                <div class="card-header py-3">
                </div>
                <div class="card-body">
                    <form action="<?= base_url('guru/update_absen'); ?>" method="post">
                        <div class="table-responsive p-0">
                            <table class="table table-hover text-nowrap">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">NIS</th>
                                        <th scope="col">Nama</th>
                                        <th scope="col">Keterangan</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $i = 1; ?>
                                    <?php foreach ($ambil as $a) : ?>
                                        <tr>
                                            <th scope="row"><?= $i; ?></th>
                                            <td><?= $a->nis; ?></td>
                                            <td><?= $a->namasiswa; ?></td>
                                            <td>
                                                <input name="nis[]" type="hidden" value="<?= $a->nis; ?>">
                                                <select name="ket[]" id="ket[]" class="form-control form-control-sm">
                                                    <option value="A" <?= ($a->keterangan == 'A') ? 'selected' : ''; ?>>Alpha</option>
                                                    <option value="H" <?= ($a->keterangan == 'H') ? 'selected' : ''; ?>>Hadir</option>
                                                    <option value="S" <?= ($a->keterangan == 'S') ? 'selected' : ''; ?>>Sakit</option>
                                                    <option value="I" <?= ($a->keterangan == 'I') ? 'selected' : ''; ?>>Izin</option>
                                                </select>
                                            </td>
                                        </tr>
                                        <?php $i++; ?>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                            <p>
                                <button type="submit" class="btn btn-outline-success"><i class="fas fa-fw fa-check-circle"></i> Simpan</button>
                            </p>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->