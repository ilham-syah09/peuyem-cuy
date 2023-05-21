<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>


    <!-- Content Row -->
    <div class="row">

        <div class="col-xl-6 col-lg-7 mx-auto">

            <!-- Donut Chart -->
            <div class="col-xl-12 col-lg-5">
                <div class="card shadow mb-4">
                    <!-- Card Header - Dropdown -->
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Grafik Data Monitoring Kadar Alkohol</h6>
                    </div>
                    <!-- Card Body -->
                    <div class="card-body">
                        <div id="chart-alkohol"></div>
                    </div>
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
                    <h6 class="m-0 font-weight-bold text-primary">Tabel Data Monitoring Alkohol</h6>
                </div>
                <!-- Card Body -->
                <div class="card-body">

                    <table id="examples" class="table mt-2">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Kadar Alkohol</th>
                                <th>Kondisi</th>
                                <th>Data Masuk</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i = 1; ?>
                            <?php foreach ($monitoring as $m) : ?>
                                <tr>
                                    <td><?= $i++; ?></td>
                                    <td><?= $m['alkohol']; ?></td>
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
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        getAlkohol();
        chartAlkohol = Highcharts.chart('chart-alkohol', {
            chart: {
                plotBackgroundColor: null,
                plotBorderWidth: null,
                plotShadow: false,
                type: 'pie'
            },
            title: {
                text: 'Grafik Kadar Alkohol'
            },
            accessibility: {
                point: {
                    valueSuffix: '%'
                }
            },
            plotOptions: {
                pie: {
                    allowPointSelect: true,
                    cursor: 'pointer',
                    dataLabels: {
                        enabled: true,
                        format: '<b>{point.name}</b>: {point.y} Tape'
                    },
                    showInLegend: true
                }
            },
            series: [{
                name: 'Keterangan',
                colorByPoint: true
            }]
        });
    });

    function getAlkohol() {
        $.ajax({
            url: '<?php echo base_url('admin/get_grafik_alkohol') ?>',
            dataType: 'json',
            success: function(result) {
                let dataAlkohol = [];

                for (let i = 0; i < result.length; i++) {
                    dataAlkohol.push({
                        name: result[i].name,
                        y: parseInt(result[i].total)
                    });
                }

                chartAlkohol.series[0].setData(dataAlkohol);
            }
        })
    }
</script>