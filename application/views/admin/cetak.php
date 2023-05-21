<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>

    <!-- box -->
    <div class="col-xl-12">
        <div class="card shadow mb-4">
            <!-- Card Header - Dropdown -->
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">Cetak Laporan Fermentasi Tape</h6>
            </div>
            <!-- Card Body -->
            <div class="card-body">
                <div class="col-xl-6 mx-auto">
                    <div class="card border-left-primary shadow h-30 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-m font-weight-bold text-primary text-uppercase mb-1">
                                        Data Monitoring</div> <br>
                                    <button type="button" class="btn btn-danger btn-md" data-toggle="modal"
                                        data-target="#modal-download">Cetak PDF <i
                                            class="fas fa-sharp fa-solid fa-file-pdf"></i></button>
                                    <button type="button" class="btn btn-success btn-md" data-toggle="modal"
                                        data-target="#modal-download1">Cetak Excel <i
                                            class="fas fa-sharp fa-solid fa-file-excel"></i></button>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800">

                                        <!-- Modal pdf -->
                                        <div class="modal fade" id="modal-download" tabindex="-1"
                                            aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel">Cetak Riyawat
                                                            Fermentasi Tape</h5>
                                                        <button type="button" class="close" data-dismiss="modal"
                                                            aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <form action="<?= base_url('admin/proses_cetak'); ?>" method="POST">
                                                        <div class="modal-body">
                                                            <div class="form-group">
                                                                <label>Tanggal Awal</label>
                                                                <input type="date" name="awal" class="form-control">
                                                            </div>
                                                            <div class="form-group">
                                                                <label>Tanggal Akhir</label>
                                                                <input type="date" name="akhir" class="form-control">
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary"
                                                                data-dismiss="modal">Close</button>
                                                            <button type="submit"
                                                                class="btn btn-primary">Download</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Modal excel -->
                                        <div class="modal fade" id="modal-download1" tabindex="-1"
                                            aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel">Cetak Riyawat
                                                            Fermentasi Tape</h5>
                                                        <button type="button" class="close" data-dismiss="modal"
                                                            aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <form action="<?= base_url('admin/proses_cetak_excel'); ?>"
                                                        method="POST">
                                                        <div class="modal-body">
                                                            <div class="form-group">
                                                                <label>Tanggal Awal</label>
                                                                <input type="date" name="awal" class="form-control">
                                                            </div>
                                                            <div class="form-group">
                                                                <label>Tanggal Akhir</label>
                                                                <input type="date" name="akhir" class="form-control">
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary"
                                                                data-dismiss="modal">Close</button>
                                                            <button type="submit"
                                                                class="btn btn-primary">Download</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-solid fa-print fa-3x text-gray-500"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Card Body -->
                <div class="card-body">
                    <div class="row mb-4">
                        <div class="col-xl-6">
                            <!-- Area Chart -->
                            <div class="card h-90 shadow mb-4">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary">Grafik Data Monitoring Suhu</h6>
                                </div>
                                <div class="card-body">
                                    <div class="chart-area">
                                        <canvas id="myAreaChart"></canvas>
                                    </div>
                                    <hr>
                                    <p align="center">5 Data Suhu Terakhir</p>
                                </div>
                            </div>

                        </div>
                        <div class="col-xl-6">
                            <!-- Area Chart -->
                            <div class="card h-90 shadow mb-4">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary">Grafik Data Monitoring Kelembaban</h6>
                                </div>
                                <div class="card-body">
                                    <div class="chart-area">
                                        <canvas id="myAreaChart"></canvas>
                                    </div>
                                    <hr>
                                    <p align="center">5 Data Kelembaban Terakhir</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xl-6">
                            <!-- Area Chart -->
                            <div class="card h-90 shadow mb-4">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary">Grafik Data Monitoring Berat</h6>
                                </div>
                                <div class="card-body">
                                    <div class="chart-area">
                                        <canvas id="myAreaChart"></canvas>
                                    </div>
                                    <hr>
                                    <p align="center">5 Data Suhu Terakhir</p>
                                    <p align="center"><a href="<?= base_url(''); ?>" class="btn btn-info">Analisa
                                            Penyusutan</a> <a href="<?= base_url(''); ?>"
                                            class="btn btn-warning">Laporan
                                            Hasil
                                            Produksi</a></p>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-6">
                            <!-- Donut Chart -->
                            <div class="card h-90 shadow mb-4">
                                <!-- Card Header - Dropdown -->
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary">Grafik Data Monitoring Kadar Alkohol
                                    </h6>
                                </div>
                                <!-- Card Body -->
                                <div class="card-body">
                                    <div class="chart-pie pt-4">
                                        <canvas id="myPieChart"></canvas>
                                    </div>
                                    <div class="mt-4 text-center small">
                                        <span class="mr-2">
                                            <i class="fas fa-circle text-danger"></i> Belum Matang
                                        </span>
                                        <span class="mr-2">
                                            <i class="fas fa-circle text-success"></i> Sudah Matang
                                        </span>
                                    </div>
                                    <hr>
                                    <p align="center">5 Data Suhu Terakhir</p>
                                    <p align="center"><a href="<?= base_url(''); ?>" class="btn btn-warning">Laporan
                                            Tape
                                            Matang</a></p>
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