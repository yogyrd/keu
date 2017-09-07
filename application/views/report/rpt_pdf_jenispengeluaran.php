<html>
    <head>
        <link href="<?= base_url(); ?>assets/js/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css">
        <script src="<?= base_url(); ?>assets/js/jquery/jquery.min.js" type="text/javascript"></script>
        <script src="<?= base_url(); ?>assets/js/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
    </head>
    <body>
    <div class="row">
        <h3 style="font-family: "Helvetica Neue", Helvetica, Arial, sans-serif">Daftar Jenis Pengeluaran </h3>
    </div>
        <table class="table table-responsive table-bordered table-striped " style="font-size: x-small;">
            <thead>
                <tr>
                    <th width="5%">No</th>
                    <th width="20%">Jenis</th>
                    <th width="20%">Keterangan Jenis</th>
                    <th width="15%">Group Jenis</th>
                    <th width="20%">Group Jenis Keterangan</th>
                    <th width="10%">Pengajuan/Cash</th>

                </tr>
            </thead>
            <tbody>
            <?php $no=1; ?>
            <?php foreach ($list_data as $info) {  ?>
                <tr>
                    <td align="right"><?= $no; ?>.</td>
                    <td><?= $info->jenis; ?></td>
                    <td><?= $info->keterangan; ?></td>
                    <td><?= $info->costjenis; ?></td>
                    <td><?= $info->costket; ?></td>
                    <td><?php  if($info->pengajuan == 1) {echo 'pengajuan';} else {echo 'Cash';} ?></td>
                </tr>
                <?php
                $no++;
                ?>
            <?php  } ?>

            </tbody>
        </table>
    </body>

</html>