<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>

    <!-- box -->
    <div class="row mb-4">
        <div class="col-xl-6">
            <!-- Area Chart -->
            <div class="card h-90 shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Grafik Data Monitoring Suhu</h6>
                </div>
                <div class="card-body">
                    <div id="chart-suhu"></div>
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
                    <div id="chart-kelembapan"></div>
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
                    <div id="chart-berat"></div>
                    <p align="center"><a href="<?= base_url('admin/berat'); ?>" class="btn btn-info">Analisa
                            Penyusutan</a> <a href="<?= base_url('admin/hasilproduksi'); ?>" class="btn btn-warning">Laporan
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
                    <div id="chart-alkohol"></div>
                    <p align="center"><a href="<?= base_url('admin/tapematang'); ?>" class="btn btn-warning">Laporan
                            Tape
                            Matang</a></p>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    var chartSuhu;
    var chartKelembapan;
    var chartBerat;
    var chartAlkohol;

    var total = 0;
    var totalMateng = 0,
        totalMentah = 0;

    function getGrafik() {
        $.ajax({
            url: '<?php echo base_url('admin/get_grafik') ?>',
            dataType: 'json',
            success: function(result) {
                if (result.length > total) {
                    total = result.length;

                    var i;
                    var suhu = [];
                    var kelembapan = [];
                    var berat = [];
                    var alkohol = [];
                    var date = [];

                    for (i = 0; i < result.length; i++) {
                        suhu[i] = Number(result[i].suhu);
                        kelembapan[i] = Number(result[i].udara);
                        berat[i] = Number(result[i].berat);

                        date[i] = result[i].dibuat;

                        chartSuhu.series[0].setData(suhu);
                        chartKelembapan.series[0].setData(kelembapan);
                        chartBerat.series[0].setData(berat);

                        chartSuhu.xAxis[0].setCategories(date);
                        chartKelembapan.xAxis[0].setCategories(date);
                        chartBerat.xAxis[0].setCategories(date);
                    }
                } else if (result.length <= total) {
                    var i;
                    var suhu = [];
                    var kelembapan = [];
                    var berat = [];
                    var alkohol = [];
                    var date = [];

                    for (i = 0; i < result.length; i++) {
                        suhu[i] = Number(result[i].suhu);
                        kelembapan[i] = Number(result[i].udara);
                        berat[i] = Number(result[i].berat);

                        date[i] = result[i].dibuat;

                        chartSuhu.series[0].setData(suhu);
                        chartKelembapan.series[0].setData(kelembapan);
                        chartBerat.series[0].setData(berat);

                        chartSuhu.xAxis[0].setCategories(date);
                        chartKelembapan.xAxis[0].setCategories(date);
                        chartBerat.xAxis[0].setCategories(date);
                    }
                }

                setTimeout(getGrafik, 30000);
            }
        });
    }

    document.addEventListener('DOMContentLoaded', function() {
        getGrafik();
        getAlkohol();

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

        chartKelembapan = Highcharts.chart('chart-kelembapan', {
            chart: {
                type: 'line',
                events: {
                    load: getGrafik
                }
            },
            title: {
                text: 'Grafik Data Monitoring Kelembaban'
            },
            yAxis: {
                title: {
                    text: 'Nilai Kelembapan Udara'
                }
            },
            xAxis: {

            },
            series: [{
                name: "Kelembapan Udara"
            }]
        });

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
                    text: 'gram'
                }
            },
            xAxis: {

            },
            series: [{
                name: "Berat"
            }]
        });

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