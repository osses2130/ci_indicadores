<style>
    .highcharts-figure, .highcharts-data-table table {
        min-width: 360px; 
        max-width: 100%;
        margin: 1em auto;
    }

    .highcharts-data-table table {
        font-family: Verdana, sans-serif;
        border-collapse: collapse;
        border: 1px solid #EBEBEB;
        margin: 10px auto;
        text-align: center;
        width: 100%;
        max-width: 500px;
    }
    .highcharts-data-table caption {
        padding: 1em 0;
        font-size: 1.2em;
        color: #555;
    }
    .highcharts-data-table th {
        font-weight: 600;
        padding: 0.5em;
    }
    .highcharts-data-table td, .highcharts-data-table th, .highcharts-data-table caption {
        padding: 0.5em;
    }
    .highcharts-data-table thead tr, .highcharts-data-table tr:nth-child(even) {
        background: #f8f8f8;
    }
    .highcharts-data-table tr:hover {
        background: #f1f7ff;
    }
</style>

<div class="col-lg-4 col-md-12">
    <div class="small-box bg-info">
    <div class="inner">
        <h3><?php echo number_format($losDatos["vmaximo"],1,'.',',');?> <?php echo $losDatos["unidad"]?></h3>

        <p>Valor máximo</p>
    </div>
    <div class="icon">
    <i class="ion ion-stats-bars"></i>
    </div>
    <a href="#" class="small-box-footer"><?php echo $losDatos["nombre"];?></a>
    </div>
</div>
<div class="col-lg-4 col-md-12">
    <div class="small-box bg-success">
    <div class="inner">
        <h3><?php echo number_format($losDatos["vminimo"],1,'.',',');?> <?php echo $losDatos["unidad"]?><sup style="font-size: 20px"></sup></h3>

        <p>Valor mínimo</p>
    </div>
    <div class="icon">
        <i class="ion ion-stats-bars"></i>
    </div>
    <a href="#" class="small-box-footer"><?php echo $losDatos["nombre"];?></a>
    </div>
</div>
<div class="col-lg-4 col-md-12">
    <div class="small-box bg-warning">
    <div class="inner">
        <h3><?php echo number_format($losDatos["vpromedio"],1,'.',',');?> <?php echo $losDatos["unidad"]?></h3>

        <p>Valor promedio</p>
    </div>
    <div class="icon">
    <i class="ion ion-stats-bars"></i>
    </div>
    <a href="#" class="small-box-footer"><?php echo $losDatos["nombre"];?></a>
    </div>
</div>


<div class="col-lg-12">
    <div class="card">
        
        
        <div class="card-body">
            <figure class="highcharts-figure">
                <div id="container"></div>
                <p class="highcharts-description">
                    Los datos corresponden al día 1ro de cada mes.
                </p>
            </figure>
        </div>
    </div>
</div>


<script>
    Highcharts.chart('container', {
        chart: {
            type: 'line'
        },
        title: {
            text: '<?php echo $losDatos["nombre"];?>'
        },
        subtitle: {
            text: 'Fuente: mindicador.cl/'
        },
        xAxis: {
            categories: [<?php echo $losDatos["categoria"];?>]
        },
        yAxis: {
            title: {
                text: '<?php echo $losDatos["unidad"];?>'
            }
        },
        plotOptions: {
            line: {
                dataLabels: {
                    enabled: true
                },
                enableMouseTracking: false
            }
        },
        series: [{
            name: '<?php echo $losDatos["nombre"];?>',
            data: [<?php echo $losDatos["data"];?>]
        }]
    });
</script>

