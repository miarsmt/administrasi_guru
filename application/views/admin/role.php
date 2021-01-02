<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>

    <div class="row">
        <div class="col-lg-7">

            <!-- kalau error -->
            <?= form_error('role', '<div class="alert alert-danger" role="alert">', '</div>') ?>

            <!-- kalau lolos -->
            <div class="flash-data" data-flashdata="<?= $this->session->flashdata('message'); ?>"></div>


            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <a href="" class="btn btn-info btn-sm float-right bg-gradient-info tombolTambahData" data-toggle="modal" data-target="#newRoleModal"><i class="fas fa-plus-circle"></i> Add New Role</a>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Role</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i = 1; ?>
                                <?php foreach ($role as $r) : ?>
                                    <tr>
                                        <th scope="row"><?= $i; ?></th>
                                        <td><?= $r['role']; ?></td>
                                        <td>
                                            <a href="<?= base_url('admin/roleAccess/' . $r['id']); ?>" class="btn btn-sm btn-outline-success btn-circle" title="Role Access"><i class="fas fa-check"></i></a>
                                            <a href="" data-toggle="modal" data-target="#editRoleModal<?= $r['id']; ?>" class="btn btn-outline-warning btn-sm btn-circle" title="Edit Data"><i class="fas fa-edit"></i></a>
                                            <a href="<?= base_url(); ?>admin/deleterole/<?= $r['id']; ?>" class="btn btn-outline-danger btn-sm btn-circle tombol-hapus" title="Hapus Data"><i class="fas fa-trash"></i></a>
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

<!-- Modal Add-->

<div class="modal fade" id="newRoleModal" tabindex="-1" role="dialog" aria-labelledby="newRoleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="newRoleModalLabel">Add New Role</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?= base_url('admin/role'); ?>" method="POST">
                <div class="modal-body">
                    <div class="form-group">
                        <input type="text" class="form-control" name="role" id="role" placeholder="Role name">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Add</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal Update -->

<?php foreach ($role as $row) : ?>
    <div class="modal fade" id="editRoleModal<?= $row['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="editRoleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editRoleModalLabel">Edit Role</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="<?= base_url('admin/editrole'); ?>" method="POST">
                    <div class="modal-body">
                        <div class="form-group">
                            <input type="hidden" name="id" id="id" value="<?= $row['id']; ?>">
                            <input type="text" class="form-control" name="role" id="role" value="<?= $row['role']; ?>">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
<?php endforeach; ?>