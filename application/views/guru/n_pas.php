<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->

    <h1 class="h3 mb-4 text-gray-800">
        <span><a href="#"><?= $title; ?></a></span>
        <span> / <?= $subtitle; ?></span>
    </h1>

    <div class="flash-data" data-flashdata="<?= $this->session->flashdata('message'); ?>"></div>

    <div class="row">
        <div class="col-md-12">
            <div class="alert alert-warning bg-warning" style="color: #000; font-size: small;">
                <b>Petunjuk : </b><br>
                <ul>
                    <li>Menu ini digunakan untuk menginput nilai penilaian akhir semester pada mata pelajaran <b><i><?php echo $detil_mp['namamapel'] . ", kelas " . $detil_mp['kelas'] . " " . $detil_mp['namakelas']; ?>.</i></b> </li>
                    <li>Dari <b><i>skala 1-100</i></b> untuk mengisikan nilai pas. Jangan lupa klik tombol <b><i>Simpan</i></b> di sebelah bawah.</li>
                </ul>
            </div>
        </div>

        <div class="col-md-12">
            <div class="card shadow mb-4">
                <div class="card-body">
                    <a href="<?php echo base_url(); ?>guru/ampu" class="btn btn-outline-info"><i class="fa fa-arrow-left"></i> Kembali</a>
                </div>
            </div>
        </div>

        <div class="col-md-5">
            <div class="card shadow">
                <div class="card-header">
                    <h6 class="m-0 text-gray-900">Nilai PAS &raquo; <?php echo $detil_mp['namamapel'] . " - " . $detil_mp['kelas'] . " " . $detil_mp['namakelas']; ?></h6>
                </div>
                <div class="card-body">
                    <p class="mb-0">KD Pengetahuan</p>
                    <ul class="list-group" id="list_kd">
                        <?php
                        if (!empty($ambil_kdp)) {
                            foreach ($ambil_kdp as $k) {
                        ?>
                                <li class="list-group-item">(<?= $k['kodekd']; ?>) <?= $k['namakd']; ?></li>
                        <?php
                            }
                        } else {
                            echo '<div class="alert alert-info bg-info">Belum ada KD diinputkan</div>';
                        }
                        ?>

                    </ul>
                    <p class="mb-0 mt-3">KD Keterampilan</p>
                    <ul class="list-group" id="list_kd">
                        <?php
                        if (!empty($ambil_kdk)) {
                            foreach ($ambil_kdk as $k) {
                        ?>
                                <li class="list-group-item">(<?= $k['kodekd']; ?>) <?= $k['namakd']; ?></li>
                        <?php
                            }
                        } else {
                            echo '<div class="alert alert-info bg-info">Belum ada KD diinputkan</div>';
                        }
                        ?>

                    </ul>
                </div>
            </div>
        </div>

        <div class="col-md-7">
            <div class="card shadow">
                <div class="card-header">
                    <h5 class="m-0 text-gray-900">Input Nilai PAS</h5>
                </div>
                <div class="card-body">
                    <form method="post" action="<?= base_url('guru/simpan_nilai'); ?>">
                        <input type="hidden" name="idmengajar" id="idmengajar" value="<?= $detil_mp['idmengajar']; ?>">
                        <input type="hidden" name="idkd" id="idkd" value="">
                        <input type="hidden" name="djenis" id="djenis" value="a">
                        <table class="table table-condensed table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th width="10%">No</th>
                                    <th width="60%">Nama</th>
                                    <th width="30%">Nilai</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i = 1; ?>
                                <?php foreach ($ambil_siswa as $v) : ?>
                                    <tr>
                                        <td><?= $i; ?></td>
                                        <td><?= $v['namasiswa']; ?></td>
                                        <td>
                                            <input name="nis[]" type="hidden" value="<?= $v['nis']; ?>">
                                            <input name="nilai[]" type="number" min="0" max="100" class="form-control form-control-sm" value="<?= $v['namasiswa']; ?>" required>
                                        </td>
                                    </tr>
                                    <?php $i++; ?>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                        <p>
                            <button type="submit" class="btn btn-outline-success"><i class="fas fa-fw fa-check-circle"></i> Simpan</button> &nbsp;
                            <a href="#" class="btn btn-outline-warning"><i class="fas fa-fw fa-minus-circle"></i> Batal</a>
                        </p>
                    </form>
                </div>
            </div>
        </div>

    </div>

</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->