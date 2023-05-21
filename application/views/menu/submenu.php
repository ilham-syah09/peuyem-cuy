<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800"><?= $title ?></h1>
    </div>

    <div class="row">
        <div class="col-lg">
            <?php if (validation_errors()) : ?>
            <div class="alert alert-danger" role="alert">
                <?= validation_errors(); ?>
            </div>
            <?php endif; ?>
            <?= $this->session->flashdata('message'); ?>

            <a href="" class="btn btn-primary mb-3" data-toggle="modal" data-target="#SubmenubaruModal">Tambah SubMenu
                Baru</a>

            <table class="table table-hover">
                <thead>
                    <tr>
                        <th scope="col">No</th>
                        <th scope="col">Nama SubMenu</th>
                        <th scope="col">Menu</th>
                        <th scope="col">Url</th>
                        <th scope="col">Icon</th>
                        <th scope="col">Keterangan</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i = 1; ?>
                    <?php foreach ($subMenu as $sm) : ?>
                    <tr>
                        <th scope="row"><?= $i; ?></th>
                        <td><?= $sm['title']; ?></td>
                        <td><?= $sm['menu']; ?></td>
                        <td><?= $sm['url']; ?></td>
                        <td><i class="<?= $sm['icon']; ?>"></i></td>
                        <td><?php if ($sm['is_active'] == 1) : ?>
                            Active
                            <?php else : ?>
                            Non Active
                            <?php endif; ?>
                        </td>
                        <td>
                            <a href="" class="badge badge-success" data-toggle="modal"
                                data-target="#EditModal<?= $sm['id']; ?>">edit</a>
                            <a href="" class="badge badge-danger" data-toggle="modal"
                                data-target="#deleteModal<?= $sm['id']; ?>">delete</a>
                        </td>
                    </tr>
                    <?php $i++; ?>
                    <?php endforeach; ?>
                </tbody>
            </table>

        </div>
    </div>

</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->

<!-- Modal delete menu -->
<?php foreach ($subMenu as $sm) { ?>
<div class="modal fade" id="deleteModal<?= $sm['id']; ?>" tabindex=" -1" role="dialog"
    aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Yakin submenu <?= $sm['title']; ?> mau dihapus?</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">Pilih "Hapus" bila ingin menghapus.</div>
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Kembali</button>
                <a class="btn btn-primary" href="<?= base_url('menu/hapussubmenu/') . $sm['id']; ?>">Hapus</a>
            </div>
        </div>
    </div>
</div>
<?php } ?>


<!-- Modal edit menu -->
<?php foreach ($subMenu as $sm) { ?>
<div class="modal fade" id="EditModal<?= $sm['id']; ?>" tabindex="-1" aria-labelledby="EditModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="EditModalLabel">Edit Sub Menu Baru</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?= base_url('menu/editsubmenu'); ?>" method="post">
                <div class="modal-body">
                    <div class="form-group">
                        <input type="hidden" name="id" id="id" value="<?= $sm['id']; ?>">
                        <input type="text" class="form-control" id="title" name="title" placeholder="Nama SubMenu"
                            value="<?= $sm['title']; ?>">
                    </div>
                    <div class="form-group">
                        <select name="menu_id" class="form-control" id="menu_id">
                            <?php foreach ($menu as $m) : ?>
                            <option value="<?= $m['id']; ?>" <?php if ($sm['menu_id'] == $m['id']) {
                                                                            echo "selected";
                                                                        } ?>><?= $m['menu']; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <input type="hidden" name="id" id="id" value="<?= $sm['id']; ?>">
                        <input type="text" class="form-control" id="url" name="url" placeholder="SubMenu url"
                            value="<?= $sm['url']; ?>">
                    </div>
                    <div class="form-group">
                        <input type="hidden" name="id" id="id" value="<?= $sm['id']; ?>">
                        <input type="text" class="form-control" id="icon" name="icon" placeholder="SubMenu icon"
                            value="<?= $sm['icon']; ?>">
                    </div>
                    <div class="form-group">
                        <div class="input-group mb-3">
                            <div class="form-check">
                                <input class="form-check-input" type="hidden" name="is_active" value="0">
                                <input class="form-check-input" type="checkbox" name="is_active" value="1"
                                    id="is_active" <?php if ($sm['is_active'] == 1) : ?> checked <?php else : ?>
                                    <?php endif; ?>>
                                <label class="form-check">
                                    Submenu Active?
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Kembali</button>
                    <button type="submit" class="btn btn-primary">Edit</button>
                </div>
            </form>
        </div>
    </div>
</div>
<?php } ?>

<!-- Modal -->
<div class="modal fade" id="SubmenubaruModal" tabindex="-1" aria-labelledby="SubmenubaruModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="SubmenubaruModalLabel">Tambah Sub Menu Baru</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?= base_url('menu/submenu'); ?>" method="post">
                <div class="modal-body">
                    <div class="form-group">
                        <input type="text" class="form-control" id="title" name="title" placeholder="Nama SubMenu">
                    </div>
                    <div class="form-group">
                        <select name="menu_id" class="form-control" id="menu_id">
                            <option value="">Pilih Menu</option>
                            <?php foreach ($menu as $m) : ?>
                            <option value="<?= $m['id']; ?>"><?= $m['menu']; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" id="url" name="url" placeholder="SubMenu url">
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" id="icon" name="icon" placeholder="SubMenu icon">
                    </div>
                    <div class="form-group">
                        <div class="input-group mb-3">
                            <div class="form-check">
                                <input class="form-check-input" type="hidden" name="is_active" value="0">
                                <input class="form-check-input" type="checkbox" value="1" name="is_active"
                                    id="is_active" checked>
                                <label class="form-check">
                                    Submenu Active?
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Kembali</button>
                    <button type="submit" class="btn btn-primary">Tambah</button>
                </div>
            </form>
        </div>
    </div>
</div>