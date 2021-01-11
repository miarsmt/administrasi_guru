<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>

    <div class="row">
        <div class="col-lg">
            <div class="card mb-4 py-3 border-left-info">
                <div class="card-body">
                    <dt>Rekapitulasi absensi siswa berdasarkan kelas</dt>
                    <dd>Pilih kelas yang akan di rekap data absensi nya, output yang akan dihasil-kan nantinya berupa file PDF</dd>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-5">
            <div class="card shadow">
                <div class="card-header">
                    <h6>Filter Rekapitulasi Absensi</h6>
                </div>
                <div class="card-body">
                    <form action="<?= base_url('laporan/report_absen'); ?>" method="post" class="form-horizontal">
                        <div class="form-group">
                            <label for="kelas">Kelas</label>
                            <select name="kelas" id="kelas" class="form-control">
                                <option value="">- Pilih Kelas -</option>
                                <?php foreach ($kelas as $k) : ?>
                                    <option value="<?= $k['kodekelas']; ?>"><?= $k['kelas']; ?> <?= $k['namakelas']; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="semester">Semester</label>
                            <select name="semester" id="semester" class="form-control">
                                <option value="">- Pilih Semester -</option>
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                                <option value="5">5</option>
                                <option value="6">6</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-sm btn-outline-primary float-right">Cetak Absen</button>
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