<html>
    <head>
        <link href="<?= base_url(); ?>assets/js/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css">
        <script src="<?= base_url(); ?>assets/js/jquery/jquery.min.js" type="text/javascript"></script>
        <script src="<?= base_url(); ?>assets/js/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
    </head>
    <body>
    <div class="row">
        <h3 style="font-family: "Helvetica Neue", Helvetica, Arial, sans-serif">Daftar Group Jenis Pengeluaran </h3>
    </div>
        <table class="table table-bordered table-striped " style="font-size: x-small;">
            <thead>
            <tr>
                <th width="5%">No</th>
                <th width="30%">Nama Group Jenis</th>
                <th width="45%">Keterangan</th>
                <th width="20%">Lokasi</th>
            </tr>
            </thead>
            <tbody>
            <?php $counter=1; ?>
            <?php foreach ($list_data as $info) { ?>
            <tr>
                <td><?= $counter; $counter++; ?></td>
                <td><?= $info->costjenis; ?></td>
                <td><?= $info->costket; ?></td>
                <td><?php if($info->cabang == 1) {echo "Cabang";} else {echo "Pusat";}  ?></td>
            </tr>
            <?php } ?>

            </tbody>
        </table>
    </body>

</html>