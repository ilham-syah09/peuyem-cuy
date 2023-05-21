<!-- Content Wrapper -->
<div id="content-wrapper" class="d-flex flex-column">

    <!-- Main Content -->
    <div id="content">

        <!-- Topbar -->
        <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

            <!-- Sidebar Toggle (Topbar) -->
            <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                <i class="fa fa-bars"></i>
            </button>
            <!-- Topbar Navbar -->
            <ul class="navbar-nav ml-auto">
                <!-- Nav Item - Alerts -->
                <li class="nav-item dropdown no-arrow mx-1">
                    <a class="nav-link dropdown-toggle" href="#" id="alertsDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fas fa-bell fa-fw"></i>
                        <!-- Counter - Alerts -->
                        <span class="badge badge-danger badge-counter">
                            <?= $this->Data_model->jmldata(['status' => 1])->num_rows(); ?>
                        </span>
                    </a>

                    <!-- Query Ambil data monitoring untuk notif -->
                    <?php
                    $nyoba = $this->Data_model->ambildibaca();
                    ?>
                    <!-- End Query -->

                    <!-- Dropdown - Alerts -->
                    <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="alertsDropdown">
                        <h6 class="dropdown-header">
                            Notif Fermentasi
                        </h6>
                        <?php foreach ($nyoba as $n) : ?>
                            <a class="dropdown-item d-flex align-items-center" href="">
                                <div class="mr-3">
                                    <div class="icon-circle bg-dark">
                                        <i class="fas fa-file-alt text-white"></i>
                                    </div>
                                </div>
                                <?php if ($n['status'] == 1) : ?>
                                    <div class="font-weight-bold">
                                        <div class="text-truncate">Alkohol <?= $n['alkohol']; ?> %</div>
                                        <div>
                                            <?php
                                            if ($n['alkohol'] >= '4') {
                                                echo '<span class="badge badge-success">Tape Sudah Matang</span>';
                                            } else {
                                                echo '<span class="badge badge-danger">Tape Belum Matang</span>';
                                            }
                                            ?>
                                        </div>
                                        <div class="small text-gray-500"><?= $n['dibuat']; ?></div>
                                    </div>
                                <?php else : ?>
                                    <div class="font-weight">
                                        <div class="text-truncate">Alkohol <?= $n['alkohol']; ?> %</div>
                                        <div>
                                            <?php
                                            if ($n['alkohol'] >= '4') {
                                                echo '<span class="badge badge-success">Tape Sudah Matang</span>';
                                            } else {
                                                echo '<span class="badge badge-danger">Tape Belum Matang</span>';
                                            }
                                            ?>
                                        </div>
                                        <div class="small text-gray-500"><?= $n['dibuat']; ?></div>
                                    </div>
                                <?php endif; ?>
                            </a>
                        <?php endforeach; ?>
                        <a class="dropdown-item d-flex align-items-center" href="<?= base_url('admin/dibaca'); ?>">
                            Tandai semua telah dibaca
                        </a>
                    </div>
                </li>
                <!-- Nav Item - User Information -->
                <li class="nav-item dropdown no-arrow">
                    <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <span class="mr-2 d-none d-lg-inline text-gray-600 small"><?= $tbl_user['nama']; ?></span>
                        <img class="img-profile rounded-circle" src="<?= base_url('assets/img/profile/') . $tbl_user['image']; ?>">
                    </a>
                    <!-- Dropdown - User Information -->
                    <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                        <a class="dropdown-item" href="<?= base_url('admin/profile'); ?>">
                            <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                            Profile
                        </a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="<?= base_url('autentifikasi/logout'); ?>" data-toggle="modal" data-target="#logoutModal">
                            <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                            Logout
                        </a>
                    </div>
                </li>

            </ul>

        </nav>
        <!-- End of Topbar -->