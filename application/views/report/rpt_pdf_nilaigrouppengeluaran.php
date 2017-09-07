<html>
    <head>
        <link href="<?= base_url(); ?>assets/js/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css">
        <script src="<?= base_url(); ?>assets/js/jquery/jquery.min.js" type="text/javascript"></script>
        <script src="<?= base_url(); ?>assets/js/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
    </head>
    <body>
    <div class="row">
        <h3>Daftar Nilai Jenis Pengeluaran </h3>
        <h5>
            Lokasi  : <strong> <?= $locationket; ?>  </strong><br/>
        </h5>
        <table class="table table-bordered table-striped " style="font-size: x-small;">
            <thead>
            <tr>
                <th width="5%">No</th>
                <th width="20%">Group Jenis</th>
                <th width="30%">Keterangan</th>
                <th width="20%">Budget per Bulan</th>
                <th width="12%">Tanggal Awal</th>
                <th width="13%">Tanggal Akhir</th>
            </tr>
            </thead>
            <tbody>
            <?php $counter=1; ?>
            <?php foreach ($list_data as $info) { ?>
            <tr>
                <td><?= $counter; $counter++; ?></td>
                <td><?= $info->costjenis; ?></td>
                <td><?= $info->costket; ?></td>
                <td align="right"><?php $rp= number_format($info->nilaimax,2,',','.'); echo 'Rp '.$rp;?></td>
                <td align="right"><?= $info->startdate; ?></td>
                <td align="right"><?= $info->enddate; ?></td>
            </tr>
            <?php } ?>

            </tbody>
        </table>
    </body>

</html>