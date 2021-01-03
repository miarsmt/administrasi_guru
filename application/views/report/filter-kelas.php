<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>

    <div class="row">
        <div class="col-lg">
            <div class="card mb-4 py-3 border-left-info">
                <div class="card-body">
                    <dt>Rekapitulasi data kelas berdasarkan tingkatan</dt>
                    <dd>Pilih tingkatan yang akan di rekap data kelas nya, output yang akan dihasil-kan nantinya berupa file PDF</dd>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card shadow h-100">
                <div class="card-header">

                </div>
                <div class="card-body">
                    <h3 class="card-title pricing-card-title"> Kelas <small class="text-muted"> X</small></h3>
                    <a href="<?= base_url('laporan/reportkelas/X'); ?>" class="btn btn-block btn-outline-info">Cetak Data Kelas</a>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card shadow h-100">
                <div class="card-header">

                </div>
                <div class="card-body">
                    <h3 class="card-title pricing-card-title"> Kelas <small class="text-muted"> XI</small></h3>
                    <a href="<?= base_url('laporan/reportkelas/XI'); ?>" class="btn btn-block btn-outline-info">Cetak Data Kelas</a>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card shadow h-100">
                <div class="card-header">

                </div>
                <div class="card-body">
                    <h3 class="card-title pricing-card-title"> Kelas <small class="text-muted"> XII</small></h3>
                    <a href="<?= base_url('laporan/reportkelas/XII'); ?>" class="btn btn-block btn-outline-info">Cetak Data Kelas</a>
                </div>
            </div>
        </div>
    </div>

</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->