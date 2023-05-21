<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>


    <!-- Content Row -->
    <div class="row">

        <div class="col-xl-6 col-lg-7 mx-auto">

            <!-- Area Chart -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Grafik Data Monitoring Berat</h6>
                </div>
                <div class="card-body">
                    <div id="chart-berat"></div>
                    <p align="center">5 Data Berat Terakhir</p>
                </div>
            </div>
        </div>
    </div>

    <div class="row">

        <!-- Area Chart -->
        <div class="col">
            <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Tabel Data Monitoring Berat</h6>
                </div>
                <!-- Card Body -->
                <div class="card-body">

                    <table id="examples" class="table mt-2">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Berat</th>
                                <th>Penyusutan</th>
                                <th>Data Masuk</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i = 1; ?>
                            <?php foreach ($monitoring as $m) : ?>
                                <tr>
                                    <td><?= $i++; ?></td>
                                    <td><?= $m['berat']; ?> Gram</td>
                                    <td><?= (1000 - $m['berat']); ?> Gram</td>
                                    <td><?= $m['dibuat']; ?></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>

</div>


<script>
    var chartBerat;
    var total = 0;

    function getGrafik() {
        $.ajax({
            url: '<?php echo base_url('admin/get_grafik') ?>',
            dataType: 'json',
            success: function(result) {
                if (result.length > total) {
                    total = result.length;

                    var i;
                    var berat = [];
                    var date = [];

                    for (i = 0; i < result.length; i++) {
                        berat[i] = Number(result[i].berat);

                        date[i] = result[i].dibuat;

                        chartBerat.series[0].setData(berat);

                        chartBerat.xAxis[0].setCategories(date);
                    }
                } else if (result.length <= total) {
                    total = result.length;

                    var i;
                    var berat = [];
                    var date = [];

                    for (i = 0; i < result.length; i++) {
                        berat[i] = Number(result[i].berat);

                        date[i] = result[i].dibuat;

                        chartBerat.series[0].setData(berat);

                        chartBerat.xAxis[0].setCategories(date);
                    }
                }

                setTimeout(getGrafik, 30000);
            }
        });
    }

    document.addEventListener('DOMContentLoaded', function() {
        getGrafik();

        chartBerat = Highcharts.chart('chart-berat', {
            chart: {
                type: 'line',
                events: {
                    load: getGrafik
                }
            },
            title: {
                text: 'Grafik Data Monitoring Berat'
            },
            yAxis: {
                title: {
                    text: 'Gram'
                }
            },
            xAxis: {

            },
            series: [{
                name: "Berat"
            }]
        });
    });
</script>