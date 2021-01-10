<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">
        <span><a href="#"><?= $title; ?></a></span>
        <span> / <?= $subtitle; ?></span>
    </h1>

    <div class="flash-data" data-flashdata="<?= $this->session->flashdata('message'); ?>"></div>

    <div class="row">

        <div class="col-lg-12">
            <div class="alert alert-warning bg-warning" style="color: #000; font-size: small;">
                <b>Petunjuk : </b><br>
                <ul>
                    <li>
                        Menu ini digunakan untuk menginput absensi siswa pada setiap masing-masing agenda kegiatan. Silakan klik tombol " <i class="fas fa-fw fa-edit"></i> " , dan akan muncul modal daftar siswa serta isian keterangan. Jangan lupa klik tombol <b><i>Simpan</i></b> di bagian bawah.</li>
                    </li>
                    <li>Apabila data pada tabel kosong, artinya data agenda kegiatan belum ditambahkan. Silahkan kembali ke menu agenda kegiatan lalu klik tombol <b><i>" Add Agenda "</i></b></li>
                </ul>
            </div>
        </div>

        <div class="col-lg-8">

            <div class="card shadow md-4">
                <div class="card-header py-3">
                    <dl class="row mb-0">
                        <dt class="col-sm-4">Mata Pelajaran</dt>
                        <dd class="col-sm-8"><?= $mapel['namamapel']; ?></dd>
                        <dt class="col-sm-4">Kelas</dt>
                        <dd class="col-sm-8"><?= $kelas['kelas']; ?> <?= $kelas['namakelas']; ?></dd>
                    </dl>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Tanggal</th>
                                    <th scope="col">Jam Ke</th>
                                    <th scope="col">Mata Pelajaran</th>
                                    <th scope="col">&nbsp;</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i = 1; ?>
                                <?php foreach ($agenda as $a) : ?>
                                    <tr>
                                        <th scope="row"><?= $i; ?></th>
                                        <td><?= format_indo($a['tanggal']); ?></td>
                                        <td><?= $a['jam_ke']; ?></td>
                                        <td><?= $a['namamapel']; ?></td>
                                        <td>
                                            <button type="button" data-toggle="modal" data-target="#modal-absen" data-kelas="<?= $a['kodekelas']; ?>" data-idagenda="<?= $a['idagenda']; ?>" class="btn btn-sm btn-circle btn-outline-info tombolTambahAbsen" title="Input Absen"><i class="fas fa-fw fa-edit"></i></button>
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

<!-- Modal -->
<div class="modal fade" id="modal-absen" tabindex="-1" aria-labelledby="modal-absenLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modal-absenLabel">Tambah Data Absensi</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?= base_url('guru/tambahabsen'); ?>" method="post">
                <div class="modal-body">
                    <table class="table table-bordered table-striped table-sm" id="mydata">
                        <thead>
                            <tr>
                                <th scope="col">Nama Siswa</th>
                                <th scope="col">Gender</th>
                                <th scope="col">Semester Aktif</th>
                                <th scope="col">Keterangan</th>
                            </tr>
                        </thead>
                        <tbody id="show_data">
                            <input type="text" style="visibility: hidden;" id="id_agenda" name="id_agenda" class="form-control form-control-sm">
                        </tbody>
                    </table>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>