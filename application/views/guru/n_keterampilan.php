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
                    <li>Menu ini digunakan untuk menginput nilai keterampilan pada mata pelajaran <b><i><?php echo $detil_mp['namamapel'] . ", kelas " . $detil_mp['kelas'] . " " . $detil_mp['namakelas']; ?>.</i></b> </li>
                    <li>Jika kompetensi dasar belum ada, silakan klik tombol <b><i>Tambah KD</i></b>. Untuk mengubah atau menghapus nama KD, silakan klik tombol "<i class="fas fa-fw fa-pencil-alt"></i>" atau "<i class="fas fa-fw fa-times"></i>". </li>
                    <li>Untuk mengisikan nilai keterampilan pada masing-masing KD, silakan pilih nama KD pada form input nilai. Nilai dalam <b><i>skala 1-100</i></b>. Jangan lupa klik tombol <b><i>Simpan</i></b> di sebelah bawah.</li>
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
                    <h6 class="m-0 text-gray-900">Nilai Keterampilan &raquo; <?php echo $detil_mp['namamapel'] . " - " . $detil_mp['kelas'] . " " . $detil_mp['namakelas']; ?></h6>
                </div>
                <div class="card-body">
                    <p>
                        <a href="#" onclick="return edit(0); " class="btn btn-outline-info"><i class="fa fa-plus-circle"></i> Tambah KD</a>
                    </p>
                    <ul class="list-group" id="list_kd">
                        <?php
                        if (!empty($ambil_kd)) {
                            foreach ($ambil_kd as $k) {
                        ?>
                                <li class="list-group-item">(<?= $k['kodekd']; ?>) <?= $k['namakd']; ?>
                                    <div class="pull-right">
                                        <a href="#" onclick="return edit(<?= $k['idkd']; ?>);" class="btn btn-sm btn-outline-success"><i class="fas fa-fw fa-pencil-alt"></i></a>
                                        <a href="#" onclick="return hapus(<?= $k['idkd']; ?>);" class="btn btn-sm btn-outline-danger tombol-hapus"><i class="fas fa-fw fa-times"></i></a>
                                    </div>
                                </li>
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
                    <h5 class="m-0 text-gray-900">Input Nilai</h5>
                </div>
                <div class="card-body">
                    <form method="post" action="<?= base_url('guru/simpan_nilaiket'); ?>">
                        <input type="hidden" name="idmengajar" id="idmengajar" value="<?= $detil_mp['idmengajar']; ?>">
                        <div class="form-group row mb-4">
                            <label for="idkd" class="col-sm-3 col-form-label-sm">Kompetensi Dasar</label>
                            <div class="col-sm-9">
                                <select name="idkd" id="idkd" class="form-control form-control-sm" required>
                                    <option value="">Pilih KD</option>
                                    <?php foreach ($ambil_kd as $k) : ?>
                                        <option value="<?= $k['idkd']; ?>"><?= $k['namakd']; ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                        <input type="hidden" name="jenis" id="jenis" value="">
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

<!-- Modal -->

<div class="modal fade" id="modal_data" tabindex="-1" aria-labelledby="modal_dataLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modal_dataLabel">Set KD</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="post" class="form-horizontal" id="f_setmapel" name="f_setmapel" onsubmit="return simpan_kd();">
                <input type="hidden" name="_id" id="_id" value="">
                <input type="hidden" name="_mode" id="_mode" value="">
                <input type="hidden" name="kodemapel" id="kodemapel" value="<?= $detil_mp['kodemapel']; ?>">
                <input type="hidden" name="jenis" id="jenis" value="K">
                <div class="modal-body">
                    <div class="form-group row">
                        <label for="kode" class="col-sm-3 col-form-label">Kode KD</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="kode" name="kode" autofocus required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="nama" class="col-sm-3 col-form-label">Nama KD</label>
                        <div class="col-sm-9">
                            <textarea name="nama" id="nama" rows="3" class="form-control" required></textarea>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="semester" class="col-sm-3 col-form-label">Semester</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="semester" name="semester" required>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-primary" id="tbSimpanKd">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    $(function() {
        id_mengajar = <?= $detil_mp['idmengajar'] ?>;
        jenis = "K";
        list_kd();

        $('#list_kd li').on('click', function() {
            $('li.active').removeClass('active');
            $(this).addClass('active');
        })

    });

    function edit(id) {
        if (id == 0) {
            $("#_mode").val('add');
        } else {
            $("#_mode").val('edit');
        }
        $("#kode").prop("readonly", true);
        $("#nama").prop("readonly", true);
        $("#semester").prop("readonly", true);
        // $("#tbSimpan").prop("disabled", true);
        $("#kode").val('');
        $("#nama").val('');
        $("#semester").val('');
        $("#modal_data").modal('show');
        $.ajax({
            type: "GET",
            url: "<?= base_url('guru/editkd/') ?>" + id,
            dataType: 'json',
            success: function(data) {
                $("#_id").val(data.data.idkd);
                $("#kodemapel").val(data.data.kodemapel);
                $("#kode").val(data.data.kodekd);
                $("#nama").val(data.data.namakd);
                $("#jenis").val(data.data.jenis);
                $("#semester").val(data.data.semester);
                $("#kode").prop("readonly", false);
                $("#nama").prop("readonly", false);
                $("#semester").prop("readonly", false);
                // $("#tbSimpan").prop("disabled", false);
            }
        });
        return false;
    }

    function simpan_kd() {
        var data = $("#f_setmapel").serialize();

        $.ajax({
            type: "POST",
            data: data,
            url: "<?= base_url('guru/simpankd/') ?>" + id_mengajar + "/" + jenis,
            dataType: 'json',
            beforeSend: function() {
                $("#tbSimpanKd").attr("disabled", true);
            },
            success: function(r) {
                $("#tbSimpanKd").attr("disabled", false);
                if (r.status == "gagal") {
                    noti("danger", r.data);
                } else {
                    $("#modal_data").modal('hide');
                    noti("success", r.data);
                    window.location.assign("<?= base_url('guru/n_keterampilan/'); ?>" + id_mengajar);
                }
            }
        });
        return false;
    }

    function hapus(id) {
        if (id == 0) {
            noti("danger", "Silakan pilih datanya..!");
        } else {
            if (confirm('Apakah anda yakin ingin menghapus data ini?')) {
                $.ajax({
                    type: "GET",
                    url: "<?= base_url('guru/hapuskd/') ?>" + id,
                    dataType: 'json',
                    success: function(data) {
                        noti("success", "Data KD berhasil di-hapus");
                        window.location.assign("<?= base_url('guru/n_keterampilan/'); ?>" + id_mengajar);
                    }
                });
            }
        }
        return false;
    }
</script>