<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>

    <div class="row">
        <div class="col-lg">
            <div class="card mb-4 py-3 border-left-info">
                <div class="card-body">
                    <dt>Rekapitulasi data siswa berdasarkan kelas</dt>
                    <dd>Pilih kelas yang akan di rekap data siswa nya, output yang akan dihasil-kan nantinya berupa file PDF</dd>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <?php foreach ($jurusan as $j) : ?>
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card shadow h-100">
                    <div class="card-header">

                    </div>
                    <div class="card-body">
                        <h3 class="card-title pricing-card-title"> <?= $j['namajurusan']; ?> </h3>
                        <a href="javascript:;" data-toggle="modal" data-target="#modal-report" data-id="<?= $j['kodejurusan']; ?>" class="btn btn-block btn-outline-info tombolFilterSiswa">Cetak Data Siswa</a>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>

</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->

<!-- Modal -->
<div class="modal fade" id="modal-report" tabindex="-1" aria-labelledby="modal-reportLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modal-reportLabel">Data Kelas Berdasarkan Jurusan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th scope="col">Kelas</th>
                            <th scope="col">Angkatan</th>
                            <th scope="col">&nbsp;</th>
                        </tr>
                    </thead>
                    <tbody id="show_kelas">

                    </tbody>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>