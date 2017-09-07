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
                <th width="15%">Jenis</th>
                <th width="10%">Pengajuan / Cash</th>
                <th width="15%">Group Jenis</th>
                <th width="15%">Budget per Klaim</th>
                <th width="15%">Budget per Bulan</th>
                <th width="12%">Tanggal Awal</th>
                <th width="13%">Tanggal Akhir</th>
            </tr>
            </thead>
            <tbody>
            <?php $counter=1; ?>
            <?php foreach ($list_data as $info) { ?>
            <tr>
                <td><?= $counter; $counter++; ?></td>
                <td><?= $info->jenis; ?></td>
                <td>
                    <?php if($info->pengajuan == 0) {echo 'Cash';} else {echo 'Pengajuan';} ?>
                </td>
                <td><?= $info->costjenis; ?></td>
                <td align="right"><?php $rp= number_format($info->nilaimaxdetil,2,',','.'); echo 'Rp '.$rp;?></td>
                <td align="right"><?php $rp= number_format($info->nilaimaxgroup,2,',','.'); echo 'Rp '.$rp;?></td>
                <td align="right"><?= $info->startdate; ?></td>
                <td align="right"><?= $info->enddate; ?></td>
            </tr>
            <?php } ?>

            </tbody>
        </table>
    </body>

</html>