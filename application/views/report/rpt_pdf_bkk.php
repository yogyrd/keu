<html>
    <head>
        <style>
            body {
                font-family: "Trebuchet MS", sans-serif;
            }
            .header {
                position: fixed;
                top: 0px;
                width: 100%;}
            .perusahaan {
                font-size: large;
                text-decoration: underline;
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
                position: absolute;
                top:150px;
                font-size: medium;
                width:100%;
            }
            .tabel-content{
                border: 1px solid black;
                border-collapse: collapse;
            }
            .tabel-content > tbody > tr > td, thead > tr > th {
            border: 1px solid black;
            border-collapse: collapse;
            }
            .tabel-content > tbody > tr > td, tfoot > tr > th  {
                padding: 5px;
            }
            .tabel-content > tfoot > tr > th {
                border-top: solid ;
            }
            .footer {
                bottom: 50px;
                position: fixed;
                width:100%;
            }
            .footer > .ttd {
                width: 100%;
                text-align: center;
            }
            /*.footer > .ttd > tbody > tr > td {*/
                /*border: 1px solid black;*/
                /*border-collapse: collapse;*/
            /*}*/
            /*.footer > .ttd > tfoot > tr > td {*/
                /*border: 1px solid black;*/
                /*border-collapse: collapse;*/
            /*}*/
            .footer > .ttd > tbody > tr > td {
                padding-bottom: 40px;
                /*margin-bottom: 10px;*/
            }
        </style>
        <script src="<?= base_url(); ?>assets/js/jquery/jquery.min.js" type="text/javascript"></script>
    </head>
    <body>
        <div class="header pagenum">
            <div class="perusahaan">PT. Jaya Bhakti Mandiri</div>
            <div class="judul">Bukti Kas Keluar</div>
            <div class="judul-detail">Kas Kecil</div>
            <table class="tabel-header">
                <tr>
                    <td>Tanggal</td>
                    <td>:</td>
                    <td>27-01-2017</td>
                </tr>
                <tr>
                    <td>Nomor</td>
                    <td>:</td>
                    <td>XXXXXX-XXXX/XXXX</td>
                </tr>
                <tr>
                    <td>Lokasi</td>
                    <td>:</td>
                    <td><?= $locationket; ?></td>
                </tr>
            </table>
        </div>
        <table class="tabel-content">
            <thead>
            <tr>
                <th width="20%">COA</th>
                <th width="50%">Keterangan</th>
                <th width="5%">Mata Uang</th>
                <th width="30%">Jumlah</th>
            </tr>
            </thead>
            <tbody>
            <?php $total=0; ?>
            <?php foreach ($list_detail as $info) {  ?>
                <tr>
                    <td>1.001</td>
                    <td><?= $info->keterangan; ?></td>
                    <td align="center">IDR</td>
                    <td align="right"><?php $rp = number_format($info->realisasi,2,',','.'); echo $rp;?></td>
                </tr>
                <?php $total=$total+$info->realisasi; ?>
            <?php  } ?>
            </tbody>
            <tfoot>
                <tr align="right">
                    <th></th>
                    <th>TOTAL</th>
                    <th align="center">IDR</th>
                    <th><?php $rp = number_format($total,2,',','.'); echo $rp;?></th>
                </tr>
            </tfoot>
        </table>
        <div class="footer">
            <table class="ttd">
                <tbody>
                    <tr>
                        <td> Mengetahui</td>
                        <td> Penerimaa </td>
                        <td> Kasir</td>
                        <td> Pembukuan </td>
                    </tr>
                </tbody>
                <tfoot>
                    <tr>
                        <td>(................)</td>
                        <td>(................)</td>
                        <td>(................)</td>
                        <td>(................)</td>
                    </tr>
                </tfoot>
            </table>
        </div>

    </body>

</html>