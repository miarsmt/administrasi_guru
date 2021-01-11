<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>

    <div class="row">
        <div class="col-lg">
            <div class="card mb-4 py-3 border-left-info">
                <div class="card-body">
                    <dt>Rekapitulasi data ampu berdasarkan tingkatan</dt>
                    <dd>Pilih tingkatan yang akan di rekap data ampu nya, output yang akan dihasil-kan nantinya berupa file PDF</dd>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-5">
            <div class="card shadow">
                <div class="card-header">
                    <h6>Filter Rekapitulasi Data Ampu</h6>
                </div>
                <div class="card-body">
                    <form action="<?= base_url('laporan/report_ampu'); ?>" method="post" class="form-horizontal">
                        <div class="form-group">
                            <label for="tingkatan">Kelas</label>
                            <select name="tingkatan" id="tingkatan" class="form-control">
                                <option value="">- Pilih Tingkat -</option>
                                <option value="X">X</option>
                                <option value="XI">XI</option>
                                <option value="XII">XII</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="periode">Tahun Ajaran</label>
                            <input type="text" name="periode" id="periode" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="semester">Semester</label>
                            <select name="semester" id="semester" class="form-control">
                                <option value="">- Pilih Semester -</option>
                                <option value="1">1</option>
                                <option value="2">2</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-sm btn-outline-primary float-right">Cetak Data</button>
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