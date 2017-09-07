<html>
    <head>
        <style>
            body {
                font-family: "Trebuchet MS", sans-serif;
            }
            .header {
                top: 0px;
                width: 100%;}
            .perusahaan {
                font-size: large;
            }
            hr {
                height: 2px;
                background-color: #5DADE2;
                border:none;
            }
            .judul {
                text-align: center;
                font-size: x-large;
            }
            .judul-detail {
                text-align: center;
                font-size: medium;
            }
            .tabel-header, tr, td {
                border: none;
                font-size: small;
            }
            .tabel-content {
                font-size: xx-small;
                top:150px;
                font-size: medium;
                width:100%;
                border-collapse: collapse;
                border: solid 1px ;
                margin-top: 3%;
            }
            .tabel-content > thead > tr > th {
                border: solid 1px ;
            }
            .tabel-content > tbody > tr > td, tfoot > tr > th  {
                padding: 5px;
                border: solid 1px ;
            }
            .tabel-content > tfoot > tr > th {
                border-top: solid ;
            }
            tbody tr:nth-child(odd) {
                background-color: #D2D7D3;
            }
            .footer {
                margin-top: 10%;
                width:100%;
            }
            .footer > .ttd {
                width: 100%;
                text-align: center;
            }
            .info-print {
                font-size: xx-small;
                font-style: italic;
            }
            .footer > .ttd > tbody > tr > td {
                padding-bottom: 40px;
            }
        </style>
        <script src="<?= base_url(); ?>assets/js/jquery/jquery.min.js" type="text/javascript"></script>
    </head>
    <body>
        <div class="header pagenum">
            <div class="perusahaan">PT. Jaya Bhakti Mandiri</div>
            <hr>
            <div class="judul">Daftar Jenis Pengeluaran</div>
        </div>
        <table class="tabel-content">
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
        <div class="info-print">
            tgl cetak : <?php date_default_timezone_set('Asia/Jakarta'); echo date('Y-m-d H:i:s'); ?>
        </div>

    </body>

</html>