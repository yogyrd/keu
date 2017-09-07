<html>
    <head>
        <style>
            body {
                font-family: "Trebuchet MS", sans-serif;
                font-size: x-small;
            }
            .header {
                top: 0px;
                width: 100%;}
            .logo {
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
            .tabel-header {
                border-collapse: collapse;
                float: left;
            }
            .tabel-header, tr, td {
                font-size: small;
            }
            .tabel-header-right {
                border-collapse: collapse;
                float: right;
            }
            .tabel-content {
                top:150px;
                font-size: medium;
                width:100%;
                border-collapse: collapse;
                margin-top: 15%;
            }
            .tabel-content > tbody > tr > td, tfoot > tr > th  {
                padding: 10px;
            }
            .tabel-content > tfoot > tr > th {
                border-top: solid ;
            }
            .footer {
                bottom: 70px;
                position: fixed;
                width:100%;
            }
            .footer > .ttd {
                width: 98%;
                text-align: center;
                border-collapse: collapse;
            }
            .footer > .ttd, .footer > tr, .footer > td {
                border: 1px solid black;
            }
            .footer > .ttd > tbody > tr > td {
                border: 1px solid black;
            }
            .footer > .ttd > tfoot > tr > td {
                padding-top: 60px;
                border: 1px solid black;
            }
            .info-print {
                bottom: 100px;
                position: fixed;
                font-style: italic;
            }
        </style>
        <script src="<?= base_url(); ?>assets/js/jquery/jquery.min.js" type="text/javascript"></script>
    </head>
    <body>
        <div class="header pagenum">
            <div class="logo">PT. Jaya Bhakti Mandiri</div>
            <hr>
            <div class="judul">Voucher</div>
            <div class="judul-detail"></div>
            <table class="tabel-header">
                <tr>
                    <td>Nomor Transaksi</td>
                    <td>:</td>
                    <td><?= $notrans; ?></td>
                </tr>
                <tr>
                    <td>Lokasi</td>
                    <td>:</td>
                    <td><?= $locationket; ?></td>
                </tr>
                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
            </table>
            <table class="tabel-header-right">
                <tr>
                    <td>Tanggal Transaksi</td>
                    <td>:</td>
                    <td><?= date('Y-m-d',strtotime($tgltrans)); ?></td>
                </tr>
                <tr>
                    <td>Tanggal Realisasi</td>
                    <td>:</td>
                    <td><?= date('Y-m-d',strtotime($tglrealisasi)); ?></td>
                </tr>
                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
            </table>
        </div>
        <table class="tabel-content">
            <thead>
            <tr>
                <th width="5%">Kode Transaksi</th>
                <th width="20%">Nomor Perkiraan</th>
		<th width="15%">Jenis</th>
                <th width="20%">Keterangan</th>
                <th width="30%">Jumlah</th>
            </tr>
            </thead>
			<tbody>
            <?php $totalreal = 0;
            foreach ($list_trans as $info) { ?>
                <tr>
                    <td align="right"><?= $notrans; ?></td>
                    <td><?= $info->noakun; ?></td>
                    <td><?= $info->jenis; ?></td>
                    <td><?= $info->keterangan; ?></td>
                    <td align="right"><?php $rp = number_format($info->realisasi, 0, ',', '.');
                        echo 'Rp ' . $rp; ?></td>
                </tr>
            <?php $totalreal = $totalreal + $info->realisasi;
            }?>
            </tbody>
            <tfoot>
                <tr>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th>TOTAL</th>
                    <th align="right"><?php $rp = number_format($totalreal,0,',','.'); echo 'Rp ' .$rp;?></th>
                </tr>
            </tfoot>
        </table>
        <div class="info-print">
            tgl cetak : <?php date_default_timezone_set('Asia/Jakarta'); echo date('Y-m-d H:i:s'); ?><br />
            by <?= ucfirst($this->session->userdata('username')); ?>
        </div>
        <div class="footer">
            <table class="ttd">
                <tbody>
                    <tr>
                        <td> Pembukuan </td>
                        <td> Mengetahui</td>
                        <td> Kasir</td>
                        <td> Penerima</td>
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