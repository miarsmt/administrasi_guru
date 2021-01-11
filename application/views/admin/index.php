<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>

    <h1 class="h2 pt-4 text-gray-900 text-center text-uppercase">Selamat Datang di Si Admingur</h1>
    <img src="<?= base_url('assets/img/logo.png') ?>" alt="logo.png" width="240px" style="display: block; margin: auto;">
    <h1 class="h4 mb-5 text-gray-900 text-center">Sistem Informasi Administrasi Guru SMK PASIM Plus Sukabumi</h1>

    <div class="row">

        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Guru Aktif</div>
                            <?php
                            $this->db->where('is_active', 1);
                            $guru = $this->db->count_all_results('tb_guru');
                            ?>
                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $guru ?></div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-user-graduate fa-2x text-gray-300"></i>
                        </div>
                        <a href="<?= base_url('master/guru'); ?>" class="btn btn-sm btn-block btn-outline-primary mt-3">Lihat Selengkapnya <i class="fas fa-fw fa-arrow-alt-circle-right"></i></a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Siswa Aktif</div>
                            <?php
                            $this->db->where('is_active', 1);
                            $siswa = $this->db->count_all_results('tb_siswa');
                            ?>
                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $siswa; ?></div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-users fa-2x text-gray-300"></i>
                        </div>
                        <a href="<?= base_url('master/siswa'); ?>" class="btn btn-sm btn-block btn-outline-success mt-3">Lihat Selengkapnya <i class="fas fa-fw fa-arrow-alt-circle-right"></i></a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Kelas</div>
                            <?php
                            $this->db->where('is_active', 1);
                            $kelas = $this->db->count_all_results('tb_kelas');
                            ?>
                            <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800"><?= $kelas; ?></div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-chalkboard-teacher fa-2x text-gray-300"></i>
                        </div>
                        <a href="<?= base_url('master/kelas'); ?>" class="btn btn-sm btn-block btn-outline-info mt-3">Lihat Selengkapnya <i class="fas fa-fw fa-arrow-alt-circle-right"></i></a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Pending Requests Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Mata Pelajaran</div>
                            <?php
                            $mapel = $this->db->count_all_results('tb_mapel');
                            ?>
                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $mapel; ?></div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-book fa-2x text-gray-300"></i>
                        </div>
                        <a href="<?= base_url('master/mapel'); ?>" class="btn btn-sm btn-block btn-outline-warning mt-3">Lihat Selengkapnya <i class="fas fa-fw fa-arrow-alt-circle-right"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->