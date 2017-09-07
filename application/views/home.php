<?php
$admin_page_title = 'Dashboard';
$admin_page_breadcrumb = 'Statistic Overview';
include_once 'layout_admin_top.php';
if ($this->session->userdata('grp') >= 4) {
    include_once 'dashboard_usergroup4.php';
}
?>
<div class="panel panel-info">
    <div class="panel-heading">
        <h4 class="panel-title">
            <a data-toggle="collapse" href="#collapse_trans">
                Status Transaksi Bulan Ini
            </a>
        </h4>
    </div>
    <div class="panel-body" id="collapse_trans">
        <div id="kaskecilrealisasi" style="min-width: 310px; height: 400px; margin: 0 auto"></div>
    </div>
</div>

<script type="text/javascript">
    jQuery(function(){
        new Highcharts.Chart({
            chart: {
                renderTo: 'kaskecilrealisasi',
                type: 'column',
            },
            title: {
                text: 'Kas Kecil Terealisasi',
                x: -20
            },
            subtitle: {
                text: 'Tahun <?= getdate()['year']; ?>',
                x: -20
            },
            xAxis: {
                title: {text: 'Bulan'},
                categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun',
                    'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec']
            },
            yAxis: {
                title: {
                    text: 'Rupiah (Rp)'
                }
            },
            tooltip: {
                headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
                pointFormat:    '<tr>' +
                                    '<td style="color:{series.color};padding:0">{series.name}: </td>' +
                                    '<td style="padding:0" align="left"><b>Rp</td><td style="padding-left:5px" align="right"> {point.y}</b></td>' +
                '               </tr>',
                footerFormat: '</table>',
                shared: true,
                useHTML: true
            },
            plotOptions: {
                column: {
                    pointPadding: 0,
                    borderWidth: 1
                }
            },
            credits: {
                enabled: false
            },
            series: [
                <?php foreach ($list_lokasi as $lok) { ?>
                {
                    name: '<?= $lok->locationket; ?>',
                    data: <?= json_encode($model->getDataKasKecilRealisasiPerBulanByLoc($lok->locid)); ?>
                },
                <?php } ?>
            ]
        });
    });

</script>
<?php include_once 'layout_admin_bottom.php'; ?>

