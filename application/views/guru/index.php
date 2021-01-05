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
        <?php foreach ($dtkelas as $row) : ?>
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-primary shadow h-100 py-2">
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
                                            <dt class="col-sm-3"><?= $ag['kodekd']; ?></dt>
                                            <dd class="col-sm-9"><?= $ag['namakd']; ?>
                                        </td>
                                        </dd>
                                        <td><?= $ag['keterangan']; ?></td>
                                        <td>
                                            <?php if ($ag['keterangan'] == 'Tugas' && $ag['status_tgs'] == 0) { ?>
                                                <a href="javascript:;" data-toggle="modal" data-target="#modal-tugas" data-id="<?= $ag['idagenda']; ?>" class="badge badge-success tombolTambahTugas" title="Input Tugas">Tugas</a>
                                            <?php } else { ?>
                                                <a href="<?= base_url('guru/delete_agenda/' . $ag['idagenda']); ?>" class="badge badge-danger tombol-hapus" title="Hapus Data">Delete</a>
                                            <?php } ?>
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