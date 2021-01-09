<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>

    <div class="flash-data" data-flashdata="<?= $this->session->flashdata('message'); ?>"></div>

    <div class="row">
        <div class="col-lg-12">
            <div class="alert alert-warning bg-warning" style="color: #000; font-size: small;">
                <b>Petunjuk : </b><br>
                Menu ini digunakan untuk menginput nilai pada setiap masing-masing mata pelajaran diampu. Silakan klik menu <b><i>Nilai Pengetahuan</i></b> untuk menginput nilai pengetahuan, dan <b><i>Nilai Keterampilan</i></b> untuk menginput nilai keterampilan.
            </div>
        </div>

        <?php
        if (!empty($ampu)) {
            foreach ($ampu as $a) {
        ?>
                <div class="col-xl-4 col-md-6 mb-4">
                    <div class="card shadow">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-primary text-uppercase mb-1"><?= $a['namamapel']; ?></div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $a['kelas']; ?> <?= $a['namakelas']; ?></div>
                                </div>
                            </div>
                            <ul class="list-group mt-2">
                                <li class="list-group-item"><a href="<?= base_url('guru/n_pengetahuan/' . $a['idmengajar']); ?>"><i class="fas fa-fw fa-chevron-right"></i> Nilai Pengetahuan</a></li>
                                <li class="list-group-item"><a href="<?= base_url('guru/n_keterampilan/' . $a['idmengajar']); ?>"><i class="fas fa-fw fa-chevron-right"></i> Nilai Keterampilan</a></li>
                                <li class="list-group-item"><a href="<?= base_url('guru/n_pts/' . $a['idmengajar']); ?>"><i class="fas fa-fw fa-chevron-right"></i> Penilaian Tengah Semester</a></li>
                                <li class="list-group-item"><a href="<?= base_url('guru/n_pat/' . $a['idmengajar']); ?>"><i class="fas fa-fw fa-chevron-right"></i> Penilaian Akhir Tahun</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
        <?php
            }
        } else {
            echo '<div class="alert alert-info">Belum ada mapel yang diampu..</div>';
        }
        ?>

    </div>

</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->