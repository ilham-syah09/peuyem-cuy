<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>


    <!-- Content Row -->
    <div class="row">

        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                Suhu</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800" id="suhu">

                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-thermometer-three-quarters fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
                <div class="card-footer text-muted text-center">
                    <a href="<?= base_url('admin/suhu/'); ?>">Lihat Data</a>
                </div>
            </div>
        </div>

        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                Kelembaban</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800" id="udara">
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-temperature-high fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
                <div class="card-footer text-muted text-center">
                    <a href="<?= base_url('admin/kelembaban/'); ?>">Lihat Data</a>
                </div>
            </div>
        </div>

        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Berat
                            </div>
                            <div class="row no-gutters align-items-center">
                                <div class="col-auto">
                                    <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800" id="berat">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-weight fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
                <div class="card-footer text-muted text-center">
                    <a href="<?= base_url('admin/berat/'); ?>">Lihat Data</a>
                </div>
            </div>
        </div>

        <!-- Pending Requests Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                Kadar Alkohol</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800" id="alkohol"></div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-vial fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
                <div class="card-footer text-muted text-center">
                    <a href="<?= base_url('admin/alkohol/'); ?>">Lihat Data</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Content Row -->

    <div class="row">

        <!-- Area Chart -->
        <div class="col-xl-8">
            <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Data Monitoring</h6>
                </div>
                <!-- Card Body -->
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="example" class="table mt-2">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Suhu</th>
                                    <th>Kelembaban</th>
                                    <th>Alkohol</th>
                                    <th>Berat</th>
                                    <th>Penyusutan</th>
                                    <th>Kondisi</th>
                                    <th>Data Masuk</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i = 1; ?>
                                <?php foreach ($monitoring as $m) : ?>
                                    <tr>
                                        <td><?= $i++; ?></td>
                                        <td><?= $m['suhu']; ?> <sup style="font-size: 15px"> o</sup>C</td>
                                        <td><?= $m['udara']; ?> %</td>
                                        <td><?= $m['alkohol']; ?> %</td>
                                        <td><?= $m['berat']; ?> Gram</td>
                                        <td><?= (1000 - $m['berat']); ?> Gram</td>
                                        <td>
                                            <?php
                                            if ($m['alkohol'] >= '4') {
                                                echo '<span class="badge badge-success">Tape Sudah Matang</span>';
                                            } else {
                                                echo '<span class="badge badge-danger">Tape Belum Matang</span>';
                                            }
                                            ?>
                                        </td>
                                        <td><?= $m['dibuat']; ?></td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <!-- Pie Chart -->
        <div class="col-xl-4">
            <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Produksi Tape</h6>
                </div>
                <!-- Card Body -->
                <div class="card-body">


                    <!-- Pending Requests Card Example -->
                    <div class="col-xl-12">
                        <div class="card border-left-success shadow h-30 py-2">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                            Panen Tape Matang</div>
                                        <div class="h5 mb-0 font-weight-bold text-gray-800">
                                            <?= $this->Data_model->jmlData(['alkohol' => 4])->num_rows(); ?> Kali
                                        </div>
                                    </div>
                                    <div class="col-auto">
                                        <i class="fas fa-clipboard-check fa-2x text-gray-300"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Pending Requests Card Example -->
                    <div class="col-xl-12 mt-4">
                        <div class="card border-left-primary shadow h-30 py-2">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                            Hasil Produksi</div>
                                        <div class="h5 mb-0 font-weight-bold text-gray-800">0</div>
                                    </div>
                                    <div class="col-auto">
                                        <i class="fas fa-bookmark fa-2x text-gray-300"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

</div>
<!-- /.container-fluid -->

<!-- End of Main Content -->

<script>
    function realtime() {
        $.ajax({
            url: "<?= base_url('admin/get_realtime'); ?>",
            dataType: "json",
            success: function(response) {

                console.log(response)
                $('#suhu').text(response.data.suhu);
                $('#udara').text(response.data.udara);
                $('#alkohol').text(response.data.alkohol);
                $('#berat').text(response.data.berat);

                setTimeout(realtime, 2000)
            }
        });
    }

    realtime();
</script>