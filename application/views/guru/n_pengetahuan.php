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
                    <li>Menu ini digunakan untuk menginput nilai pengetahuan pada mata pelajaran <b><i><?php echo $detil_mp['namamapel'] . ", kelas " . $detil_mp['kelas'] . " " . $detil_mp['namakelas']; ?>.</i></b> </li>
                    <li>Jika kompetensi dasar belum ada, silakan klik tombol <b><i>Tambah KD</i></b>. Untuk mengubah atau menghapus nama KD, silakan klik tombol "<i class="fas fa-fw fa-pencil-alt"></i>" atau "<i class="fas fa-fw fa-times"></i>". </li>
                    <li>Untuk mengisikan nilai pengetahuan pada masing-masing KD, silakan pilih nama KD pada form input nilai. Nilai dalam <b><i>skala 1-100</i></b>. Jangan lupa klik tombol <b><i>Simpan</i></b> di sebelah bawah.</li>
                </ul>
            </div>
        </div>

        <div class="col-md-12">
            <div class="card shadow mb-4">
                <div class="card-body">
                    <a href="<?php echo base_url(); ?>guru/ampu" class="btn btn-outline-info"><i class="fa fa-arrow-left"></i> Kembali</a>
                    <a href="<?php echo base_url(); ?>guru/cetak/<?php echo $idmengajar; ?>" class="btn btn-outline-warning" target="_blank"><i class="fas fa-fw fa-print"></i> Cetak</a>
                </div>
            </div>
        </div>

        <div class="col-md-5">
            <div class="card shadow">
                <div class="card-header">
                    <h6 class="m-0 text-gray-900">Nilai Pengetahuan &raquo; <?php echo $detil_mp['namamapel'] . " - " . $detil_mp['kelas'] . " " . $detil_mp['namakelas']; ?></h6>
                </div>
                <div class="card-body">
                    <p>
                        <a href="#" onclick="return edit(0); " class="btn btn-outline-info"><i class="fa fa-plus-circle"></i> Tambah KD</a>
                    </p>
                    <ul class="list-group" id="list_kd">
                        <div id="list_kd_2" style="margin-bottom: 10px"></div>

                        <!-- <li class="list-group-item" onclick="return view_kd(<?= $detil_mp['kodemapel'] . ',' . $detil_mp['kodekelas']; ?>, 't');"><a href="#"><i class="fa fa-chevron-right"></i> PENILAIAN TENGAH SEMESTER</a></li>
                        <li class="list-group-item" onclick="return view_kd(<?= $detil_mp['kodemapel'] . ',' . $detil_mp['kodekelas']; ?>, 'a');"><a href="#"><i class="fa fa-chevron-right"></i> PENILAIAN AKHIR SEMESTER</a></li> -->
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
                    <form method="post" action="<?= base_url('guru/simpan_nilai'); ?>">
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
                        <input type="hidden" name="djenis" id="djenis" value="h">
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
                <input type="hidden" name="jenis" id="jenis" value="P">
                <div class="modal-body">
                    <div class="form-group row">
                        <label for="kode" class="col-sm-3 col-form-label">Kode KD</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="kode" name="kode" autofocus required>
                            <!-- <small class="text-danger">Dilarang memakai spasi, koma, strip. Contoh : K01</small> -->
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
                            <!-- <small class="text-danger">Disarankan untuk memakai pembilang. Contoh : 1 (Satu)</small> -->
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
        jenis = "P";
        // view_kd(0, 0);
        list_kd();

        $('#list_kd li').on('click', function() {
            $('li.active').removeClass('active');
            $(this).addClass('active');
        })

        // $("#f_input_nilai").on("submit", function() {
        //     var data = $(this).serialize();

        //     $.ajax({
        //         type: "POST",
        //         data: data,
        //         url: "<?= base_url('guru/simpan_nilai'); ?>",
        //         dataType: 'json',
        //         beforeSend: function() {
        //             $("#tbSimpan").attr("disabled", true);
        //         },
        //         success: function(r) {
        //             $("#tbSimpan").attr("disabled", false);
        //             if (r.status == "gagal") {
        //                 noti("danger", r.data);
        //             } else {
        //                 $("#modal_data").modal('hide');
        //                 noti("success", r.data);
        //                 // pagination("datatabel", base_url + "data_guru/datatable", []);
        //             }
        //         }
        //     });
        //     return false;
        // });

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
                    list_kd();
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
                        list_kd();
                    }
                });
            }
        }
        return false;
    }

    function list_kd() {
        $.ajax({
            type: "GET",
            url: "<?= base_url('guru/list_kd/') ?>" + id_mengajar,
            dataType: 'json',
            beforeSend: function() {
                $('#list_kd_2').html('<i class="fas fa-fw fa-spinner"></i> Loading');
            },
            success: function(data) {
                var h = '';
                if (data.length > 0) {
                    $.each(data, function(i, v) {
                        h += '<li class="list-group-item">(' + v.kodekd + ') ' + v.namakd + '</a>' +
                            '<div class="pull-right">' +
                            '<a href="#" onclick="return edit(' + v.idkd + ');" class="btn btn-sm btn-outline-success"><i class="fas fa-fw fa-pencil-alt"></i></a>' +
                            ' <a href="#" onclick="return hapus(' + v.idkd + ');" class="btn btn-sm btn-outline-danger tombol-hapus"><i class="fas fa-fw fa-times"></i></a>' +
                            '</div>' +
                            '</li>';
                    });
                } else {
                    h += '<div class="alert alert-info bg-info">KD Belum satupun di-input kan</div>';
                }

                $('#list_kd_2').html(h);
            }
        });
    }

    // function view_kd(kelas, id, jenis = 'h') {

    //     if (id == 0 && kelas == 0) {
    //         $("#load_nilai").html('<div class="alert alert-warning">Silakan pilih KD di samping</div>');
    //     } else {
    //         $("#idkd").val(id);
    //         $("#jenis").val(jenis);

    //         $("#load_nilai").html("Loading...");
    //         $.getJSON("<?= base_url(); ?>/guru/ambil_siswa/" + kelas + "/" + id + "/" + jenis, function(data) {
    //             $("#load_nilai").show('slow');
    //             html = '<table class="table table-condensed table-bordered table-hover">' +
    //                 '<thead>' +
    //                 '<tr>' +
    //                 '<th width="10%">No</th>' +
    //                 '<th width="60%">Nama</th>' +
    //                 '<th width="30%">Nilai</th>' +
    //                 '</tr>' +
    //                 '</thead>' +
    //                 '<tbody>';
    //             var i = 1;
    //             $.each(data.data, function(k, v) {
    //                 html += '<tr>' +
    //                     '<td>' + i + '</td>' +
    //                     '<td>' + v.namasiswa + '</td>' +
    //                     '<td>' +
    //                     '<input name="nis[]" type="hidden" value="' + v.nis + '">' +
    //                     '<input name="nilai[]" type="number" min="0" max="100" class="form-control form-control-sm" value="' + v.nilai + '" required>' +
    //                     '</td>' +
    //                     '</tr>';
    //                 i++;
    //             });
    //             html += '</tbody>' +
    //                 '</table>' +
    //                 '<p>' +
    //                 '<button type="submit" class="btn btn-outline-success" id="tbSimpan">' +
    //                 '<i class="fas fa-fw fa-check-circle"></i> Simpan</button> &nbsp; ' +
    //                 '<a href="#" class="btn btn-outline-warning" onclick="return view_kd(0, 0);">' +
    //                 '<i class="fas fa-fw fa-minus-circle"></i> Batal</a>' +
    //                 '</p>';
    //             $("#load_nilai").html(html);
    //         });

    //     }
    //     return false;
    // }
</script>