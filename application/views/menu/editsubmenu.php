<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">
        <span><a href="#"><?= $title; ?></a></span>
        <span> / <?= $subtitle; ?></span>
    </h1>

    <div class="row">
        <div class="col-lg-6">

            <div class="card shadow mb-4">

                <div class="card-body">
                    <form action="" method="POST">
                        <input type="hidden" name="id" value="<?= $submenu['id']; ?>">
                        <div class="form-group">
                            <label for="title">Title</label>
                            <input type="text" class="form-control" id="title" name="title" value="<?= $submenu['title']; ?>">
                            <small class="form-text text-danger"><?= form_error('title'); ?></small>
                        </div>
                        <div class="form-group">
                            <label for="menu_id">Menu</label>
                            <select name="menu_id" id="menu_id" class="form-control">
                                <?php foreach ($menu as $m) : ?>
                                    <option value="<?= $m['id']; ?>" <?= ($m['id'] == $submenu['menu_id']) ? 'selected' : ''; ?>><?= $m['menu']; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="url">URL</label>
                            <input type="text" class="form-control" id="url" name="url" value="<?= $submenu['url']; ?>">
                            <small class="form-text text-danger"><?= form_error('url'); ?></small>
                        </div>
                        <div class="form-group">
                            <label for="icon">Icon</label>
                            <input type="text" class="form-control" id="icon" name="icon" value="<?= $submenu['icon']; ?>">
                            <small class="form-text text-danger"><?= form_error('icon'); ?></small>
                        </div>
                        <div class="form-group">
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" value="<?= $submenu['is_active']; ?>" name="is_active" id="is_active" <?= ($submenu['is_active'] == '1') ? 'checked' : ''; ?>>
                                <label for="is_active" class="form-check-label">
                                    Active?
                                </label>
                            </div>
                        </div>
                        <a href="<?= base_url('menu/submenu'); ?>" class="btn btn-secondary">Kembali</a>
                        <button type="submit" class="btn btn-info float-right bg-gradient-info">Ubah Data</button>
                    </form>
                </div>
            </div>

        </div>
    </div>

</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->