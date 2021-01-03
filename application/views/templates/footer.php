<!-- Footer -->
<footer class="sticky-footer bg-white">
    <div class="container my-auto">
        <div class="copyright text-center my-auto">
            <span>Copyright &copy; She Kang Ngoding <?= date('Y'); ?></span>
        </div>
    </div>
</footer>
<!-- End of Footer -->

</div>
<!-- End of Content Wrapper -->

</div>
<!-- End of Page Wrapper -->

<!-- Scroll to Top Button-->
<a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
</a>

<!-- Logout Modal-->
<div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                <a class="btn btn-primary" href="<?= base_url('auth/logout'); ?>">Logout</a>
            </div>
        </div>
    </div>
</div>

<!-- Bootstrap core JavaScript-->
<script src="<?= base_url('assets/'); ?>vendor/jquery/jquery.min.js"></script>
<script src="<?= base_url('assets/'); ?>vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

<!-- Core plugin JavaScript-->
<script src="<?= base_url('assets/'); ?>vendor/jquery-easing/jquery.easing.min.js"></script>

<!-- Custom scripts for all pages-->
<script src="<?= base_url('assets/'); ?>js/sb-admin-2.min.js"></script>

<!-- Sweetalert2 -->
<script src="<?= base_url('assets/'); ?>js/sweetalert2.all.min.js"></script>

<!-- My Script -->
<script src="<?= base_url('assets/'); ?>js/myscript.js"></script>

<!-- Page level plugins -->
<script src="<?= base_url('assets/'); ?>vendor/datatables/jquery.dataTables.min.js"></script>
<script src="<?= base_url('assets/'); ?>vendor/datatables/dataTables.bootstrap4.min.js"></script>

<!-- Page level custom scripts -->
<script src="<?= base_url('assets/'); ?>js/demo/datatables-demo.js"></script>

<script>
    $(function() {
        $('.tombolTambahTugas').on('click', function() {
            const id = $(this).data('id');
            $('#id_agenda').val(id);
        });

        // ajax menampilkan data siswa dari data agenda yg dipilih
        $('.tombolTambahAbsen').on('click', function() {
            const kelas = $(this).data('kelas');
            const id = $(this).data('idagenda');

            $('#id_agenda').val(id);

            $.ajax({
                url: "<?= base_url('guru/getsiswa') ?>",
                data: {
                    kelas: kelas
                },
                method: 'post',
                dataType: 'json',
                success: function(data) {
                    var html = '';
                    var i;
                    for (i = 0; i < data.length; i++) {
                        html += '<tr>' +
                            '<input type="hidden" name="nis[]" id="nis[]" class="form-control" value="' + data[i].nis + '">' +
                            '<td>' + data[i].namasiswa + '</td>' +
                            '<td>' + data[i].jeniskelamin + '</td>' +
                            '<td>' + data[i].semester_aktif + '</td>' +
                            '<input type="hidden" name="semester[]" id="semester[]" class="form-control" value="' + data[i].semester_aktif + '">' +
                            '<td style="text-align:right;">' +
                            '<select name="keterangan[]" id="keterangan[]" class="form-control">' +
                            '<option value="A">Alfa</option>' +
                            '<option value="H">Hadir</option>' +
                            '<option value="S">Sakit</option>' +
                            '<option value="I">Izin</option>' +
                            '</select>' +
                            '</td>' +
                            '</tr>';
                    }
                    $('#show_data').html(html);
                }
            });

        });

        // ajax menampilkan data kelas berdasarkan jurusan untuk rekap data siswa
        $('.tombolFilterSiswa').on('click', function() {
            const id = $(this).data('id');

            $.ajax({
                url: "<?= base_url('laporan/getkelas'); ?>",
                data: {
                    id: id
                },
                method: 'post',
                dataType: 'json',
                success: function(data) {
                    var html = '';
                    var i;

                    for (i = 0; i < data.length; i++) {
                        html += '<tr>' +
                            '<td>' + data[i].kelas + ' ' + data[i].namakelas + '</td>' +
                            '<td>' + data[i].angkatankelas + '</td>' +
                            '<td>' +
                            '<a href="<?= base_url(); ?>/laporan/reportsiswa/' + data[i].kodekelas + '" class="badge badge-success">Cetak</a>' +
                            '</td>' +
                            '</tr>';
                    }
                    $('#show_kelas').html(html);
                }
            });
        });
    });

    $('.custom-file-input').on('change', function() {
        let filename = $(this).val().split('\\').pop();
        $(this).next('.custom-file-label').addClass("selected").html(filename);
    })


    $('.form-check-input').on('click', function() {
        const menuId = $(this).data('menu');
        const roleId = $(this).data('role');

        $.ajax({
            url: "<?= base_url('admin/changeAccess'); ?>",
            type: 'post',
            data: {
                menuId: menuId,
                roleId: roleId
            },
            success: function() {
                document.location.href = "<?= base_url('admin/roleAccess/'); ?>" + roleId;
            }
        });

    });
</script>

</body>

</html>