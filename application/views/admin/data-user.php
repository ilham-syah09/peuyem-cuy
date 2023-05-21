<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>


    <div class="row">
        <div class="col-lg">
            <?php if (validation_errors()) : ?>
                <div class="alert alert-danger" role="alert">
                    <?= validation_errors(); ?>
                </div>
            <?php endif; ?>

            <?= $this->session->flashdata('message'); ?>

            <a href="" class="btn btn-primary mb-3" data-toggle="modal" data-target="#modaluserbaru">Tambah
                User</a>
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Nama</th>
                        <th scope="col">Username</th>
                        <th scope="col">Image</th>
                        <th scope="col">User Sejak</th>
                        <th scope="col">Hak Akses</th>
                        <th scope="col">Aksi</th>
                    </tr>
                </thead>
                <tbody class="table-group-divider">
                    <?php $i = 1; ?>
                    <?php foreach ($user as $u) : ?>
                        <tr>
                            <th scope="row"><?= $i; ?></th>
                            <td><?= $u['nama'] ?></td>
                            <td><?= $u['username'] ?></td>
                            <td>
                                <picture>
                                    <source srcset="" type="image/svg+xml">
                                    <img src="<?= base_url('assets/img/profile/') . $u['image']; ?>" class="img-fluid img-thumbnail" alt="..." style="width:80px;height:90px;">
                                </picture>
                            </td>
                            <td><?= date('d F Y', $u['date_created']); ?></td>
                            <td><?= $u['role'] ?></td>
                            <td>
                                <a href="<?= base_url('Admin/hapusUser/') . $u['id'] ?>" class="badge badge-danger" onclick="return confirm('Apakah yakin akan menghapus user?');">Delete</a>
                                <a href="<?= base_url('admin/resetPwd/') . $u['id'] ?>" class="badge badge-warning" onclick="return confirm('Apakah yakin akan mereset password?');">Reset</a>
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

<!-- Modal -->

<!-- Modal -->
<div class="modal fade" id="modaluserbaru" tabindex="-1" aria-labelledby="modaluserbaruLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="modaluserbaru">Tambah User</h1>
                <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="<?= base_url('admin/dataUser'); ?>" method="post">
                <div class="modal-body">
                    <div class="form-group">
                        <input type="text" name="nama" class="form-control" id="nama" placeholder="Nama Lengkap">
                    </div>

                    <div class="form-group">
                        <input type="text" name="username" class="form-control" id="username" placeholder="Username">
                    </div>
                    <div class="form-group">
                        <input type="password" name="password1" class="form-control" id="password1" placeholder="Password">
                    </div>
                    <div class="form-group">
                        <input type="password" name="password2" class="form-control" id="password2" placeholder="Ulangi Password">
                        <?php echo form_error('password2', '<small class="text-danger pl-3">', '</small>'); ?>
                    </div>
                    <div class="form-group">
                        <select name="role" id="role" class="form-control">
                            <option value="">Pilih Hak Akses</option>
                            <?php foreach ($role as $r) : ?>
                                <option value="<?= $r['id_role']; ?>"><?= $r['role']; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Tambah</button>
                </div>
            </form>
        </div>
    </div>
</div>