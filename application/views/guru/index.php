<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>

    <div class="flash-data" data-flashdata="<?= $this->session->flashdata('message'); ?>"></div>

    <p>Daftar Kelas</p>
    <!-- kalau error -->
    <?php if (validation_errors()) : ?>
        <div class="row">
            <div class="alert alert-danger alert-dismissible col-sm-6">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
                <?= validation_errors(); ?>
            </div>
        </div>
    <?php endif; ?>
    <div class="row">

        <div class="col-md-12">
            <div class="alert alert-warning bg-warning" style="color: #000; font-size: small;">
                <b>Petunjuk : </b><br>
                <ul>
                    <li>Menu ini digunakan untuk menginput agenda kegiatan pada setiap mata pelajaran yang diampu, klik tombol <b><i>Add Agenda</i></b> untuk menyimpan data agenda.</li>
                    <li>Pada menu ini juga terdapat menu kehadiran siswa tatap muka. Input absen dilakukan setelah menambahkan agenda kegiatan, apabila data agenda belum ada maka input absensi tidak dapat dilakukan. Silahkan klik tombol <b><i>Absensi Siswa</i></b> untuk menambahkan </li>
                    <li>Tabel di bawah berisi daftar agenda kegiatan yang telah disimpan. Apabila agenda kegiatan berupa tugas, maka untuk mengupload tugas tersedia apabila terdapat label tulisan <b><i>" Tugas "</i></b> </li>
                </ul>
            </div>
        </div>

        <?php foreach ($dtkelas as $row) : ?>
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-primary shadow">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1"><?= $row['namamapel']; ?></div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $row['kelas']; ?> <?= $row['namakelas']; ?></div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-calendar fa-2x text-gray-300"></i>
                            </div>
                        </div>
                        <a href="<?= base_url('guru/addagenda/' . $row['idmengajar']); ?>" class="btn btn-sm btn-block btn-outline-primary mt-2">Add Agenda</a>
                        <a href="<?= base_url('guru/absensi/' . $row['idmengajar']); ?>" class="btn btn-sm btn-block btn-outline-success mt-2">Absensi Siswa</a>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>

        <div class="col-lg-12">
            <div class="card shadow">
                <div class="card-header">
                    <h5 class="card-title">Data Agenda Kegiatan</h5>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Tanggal</th>
                                    <th scope="col">Jam Ke</th>
                                    <th scope="col">Kelas</th>
                                    <th scope="col">Mapel</th>
                                    <th scope="col">KD</th>
                                    <th scope="col">Keterangan</th>
                                    <th scope="col">&nbsp;</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i = 1; ?>
                                <?php foreach ($agenda as $ag) : ?>
                                    <tr>
                                        <th scope="row"><?= $i; ?></th>
                                        <td><?= format_indo($ag['tanggal']); ?></td>
                                        <td><?= $ag['jam_ke']; ?></td>
                                        <td><?= $ag['kelas']; ?> <?= $ag['namakelas']; ?></td>
                                        <td><?= $ag['namamapel']; ?></td>
                                        <td>
                                            <dd class="col-sm-3"><?= $ag['kodekd']; ?></dd>
                                            <dd class="col-sm-9"><?= $ag['namakd']; ?>
                                        </td>
                                        </dd>
                                        <td><?= $ag['keterangan']; ?></td>
                                        <td>
                                            <?php if ($ag['keterangan'] == 'Tugas' && $ag['status_tgs'] == 0) { ?>
                                                <a href="javascript:;" data-toggle="modal" data-target="#modal-tugas" data-id="<?= $ag['idagenda']; ?>" class="btn btn-sm btn-circle btn-outline-success tombolTambahTugas" title="Input Tugas"><i class="fas fa-fw fa-tasks"></i></a>
                                            <?php } else { ?>
                                                <a href="<?= base_url('guru/delete_agenda/' . $ag['idagenda']); ?>" class="btn btn-sm btn-outline-danger btn-circle tombol-hapus" title="Hapus Data"><i class="fas fa-fw fa-trash"></i></a>
                                            <?php } ?>
                                            <a href="<?= base_url('guru/editagenda/' . $ag['idagenda']); ?>" class="btn btn-sm btn-circle btn-outline-warning"><i class="fas fa-fw fa-pencil-alt"></i></a>
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
<div class="modal fade" id="modal-tugas" tabindex="-1" aria-labelledby="modal-tugasLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modal-tugasLabel">Add Tugas</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?= base_url('guru'); ?>" method="post" enctype="multipart/form-data">
                <div class="modal-body">
                    <input type="hidden" id="id_agenda" name="id_agenda" class="form-control">
                    <div class="form-group">
                        <label for="judul">Judul Tugas</label>
                        <input type="text" id="judul" name="judul" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="desk">Deskripsi</label>
                        <textarea name="desk" id="desk" cols="30" rows="6" class="form-control"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="file">Unggah File</label>
                        <div class="custom-file">
                            <input type="file" name="berkas_file" id="berkas" class="custom-file-input">
                            <label for="berkas" class="custom-file-label">Choose file</label>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="ket">Keterangan</label>
                        <input type="text" name="ket" id="ket" class="form-control">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>