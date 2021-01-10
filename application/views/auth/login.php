<div class="container">

    <!-- Outer Row -->
    <div class="row justify-content-center">

        <div class="col-lg-6">

            <div class="card-login o-hidden border-0 shadow-lg my-5">
                <div class="card-body p-0">
                    <!-- Nested Row within Card Body -->
                    <div class="row">
                        <!-- <div class="col-lg-6 d-none d-lg-block bg-login-image"></div> -->
                        <div class="col-lg">
                            <div class="p-5">
                                <div class="text-center">
                                    <h1 class="h4 text-light">SIADMINGUR</h1>
                                    <p class="text-light mb-4">Sistem Informasi Administrasi Guru SMK PASIM Plus</p>
                                    <?= $this->session->flashdata('message'); ?>
                                </div>
                                <div class="row">
                                    <div class="col-md-3">
                                        <img src="<?= base_url('assets/img/logo.png'); ?>" class="card-img pt-1" height="120px">
                                    </div>
                                    <div class="col-md-9">
                                        <form class="user" method="POST" action="<?= base_url('auth'); ?>">
                                            <div class="form-group">
                                                <input type="text" class="form-control form-control-user fm-input" id="username" name="username" value="<?= set_value('username'); ?>" placeholder="Username">
                                                <?= form_error('username', '<small class="text-danger pl-3">', '</small>'); ?>
                                            </div>
                                            <div class="form-group">
                                                <input type="password" class="form-control form-control-user fm-input" id="password" name="password" placeholder="Password">
                                                <?= form_error('password', '<small class="text-danger pl-3">', '</small>'); ?>
                                            </div>
                                            <button type="submit" class="btn btn-primary btn-user btn-block bg-gradient-primary">
                                                Login
                                            </button>
                                        </form>
                                    </div>
                                </div>

                                <hr>
                                <div class="text-center text-muted small">
                                    Copyright &copy; 2020. <a href="#">SMK PASIM Plus Kota Sukabumi</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>

    </div>

</div>