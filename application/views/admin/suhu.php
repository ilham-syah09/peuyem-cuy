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
                    <h6 class="m-0 font-weight-bold text-primary">Grafik Data Monitoring Suhu</h6>
                </div>
                <div class="card-body">
                    <div id="chart-suhu"></div>
                    <p align="center">5 Data Suhu Terakhir</p>
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
                    <h6 class="m-0 font-weight-bold text-primary">Tabel Data Monitoring Suhu</h6>
                </div>
                <!-- Card Body -->
                <div class="card-body">

                    <table id="examples" class="table mt-2">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Suhu</th>
                                <th>Data Masuk</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i = 1; ?>
                            <?php foreach ($monitoring as $m) : ?>
                                <tr>
                                    <td><?= $i++; ?></td>
                                    <td><?= $m['suhu']; ?></td>
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
    var chartSuhu;
    var total = 0;

    function getGrafik() {
        $.ajax({
            url: '<?php echo base_url('admin/get_grafik') ?>',
            dataType: 'json',
            success: function(result) {
                if (result.length > total) {
                    total = result.length;

                    var i;
                    var suhu = [];
                    var date = [];

                    for (i = 0; i < result.length; i++) {
                        suhu[i] = Number(result[i].suhu);

                        date[i] = result[i].dibuat;

                        chartSuhu.series[0].setData(suhu);

                        chartSuhu.xAxis[0].setCategories(date);
                    }
                } else if (result.length <= total) {
                    total = result.length;

                    var i;
                    var suhu = [];
                    var date = [];

                    for (i = 0; i < result.length; i++) {
                        suhu[i] = Number(result[i].suhu);

                        date[i] = result[i].dibuat;

                        chartSuhu.series[0].setData(suhu);

                        chartSuhu.xAxis[0].setCategories(date);
                    }
                }

                setTimeout(getGrafik, 30000);
            }
        });
    }

    document.addEventListener('DOMContentLoaded', function() {
        getGrafik();

        chartSuhu = Highcharts.chart('chart-suhu', {
            chart: {
                type: 'line',
                events: {
                    load: getGrafik
                }
            },
            title: {
                text: 'Grafik Data Monitoring Suhu'
            },
            yAxis: {
                title: {
                    text: 'Nilai Suhu'
                }
            },
            xAxis: {

            },
            series: [{
                name: "Suhu"
            }]
        });
    });
</script>