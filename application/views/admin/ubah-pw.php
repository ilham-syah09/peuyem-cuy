<!-- Begin Page Content -->
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12">
            <?php if (validation_errors()) : ?>
                <div class="alert alert-danger" role="alert">
                    <?= validation_errors(); ?>
                </div>
            <?php endif; ?>
            <?= $this->session->flashdata('message'); ?>
            <div class="row">
                <div class="col-lg">
                    <div class="card shadow-lg">
                        <div class="card-body">
                            <span class="d-block p-2 mb-4 bg-primary text-white text-center shadow rounded">--
                                <?= $title; ?></h1>
                                --</span>
                            <?= form_open_multipart('admin/ubahpw'); ?>
                            <div class="form-group row">
                                <label for="username" class="col-sm-3 col-form-label">Username</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" id="username" name="username" value="<?= $tbl_user['username']; ?>" readonly>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="username" class="col-sm-3 col-form-label">Password Lama</label>
                                <div class="col-sm-9">
                                    <input type="password" placeholder="Masukan Password Lama" class="form-control" id="password_lama" name="password_lama">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="nama" class="col-sm-3 col-form-label">Password Baru</label>
                                <div class="col-sm-9">
                                    <input type="password" placeholder="Masukan Password Baru" class="form-control" id="password_baru1" name="password_baru1">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="nama" class="col-sm-3 col-form-label">Ketik Ulang</label>
                                <div class="col-sm-9">
                                    <input type="password" placeholder="Masukan Ulang Password Baru" class="form-control" id="password_baru2" name="password_baru2">
                                </div>
                            </div>
                        </div>
                        <div class="form-group row justify-content-end">
                            <div class="col-sm-9">
                                <button class="btn btn-primary" href="<?= base_url('admin/ubah-pw'); ?>">Ubah</button>
                                <a href="<?= base_url('admin/profile'); ?>" class="btn btn-dark">Kembali</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->