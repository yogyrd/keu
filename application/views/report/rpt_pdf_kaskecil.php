<html>
    <head>
        <style type="text/css">
            body {
                font-family: "Trebuchet MS", sans-serif;
                font-size: 12px;
            }
            .header {
                top: 0px;
                width: 100%;
            }
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
                top:150px;
                font-size: xx-small;
                width:100%;
            }
            .tabel-content{
                border-collapse: collapse;
            }
            .tabel-content > tbody > tr > td{
                border-top: 1px solid black;
                border-bottom: 1px solid black;
                border-collapse: collapse;
            }
            .tabel-content > tbody > tr:nth-child(even){
                background-color: #f2f2f2
            }
            .tabel-content > tbody > tr > td, tfoot > tr > th  {
                padding: 5px;
            }
            .tabel-content > tfoot > tr > th {
                border-top: solid ;
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
                font-style: italic;
            }
            .footer > .ttd > tbody > tr > td {
                padding-bottom: 40px;
            }
        </style>
    </head>
    <body>
        <div class="header pagenum">
            <div class="perusahaan">PT. Jaya Bhakti Mandiri</div>
            <div class="judul">Laporan Kas Kecil</div>
            <div class="judul-detail">Belum Realisasi</div>
            <table class="tabel-header">
                <tr>
                    <td><?= $tgloption; ?></td>
                    <td>:</td>
                    <td><?= $tgl1; ?> s/d <?= $tgl2; ?></td>
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
                <th width="3%">No. </th>
                <th width="5%">No. Transaksi</th>
                <th width="5%">Tanggal Transaksi</th>
                <th width="5%">Tanggal Beban</th>
                <th width="10%">Jenis</th>
                <th width="15%">Keterangan</th>
                <th width="5%">No. Faktur</th>
                <th width="10%">Nilai Pengajuan</th>

            </tr>
            </thead>
            <tbody>
            <?php $totalnilaiuang=0;$no=1; ?>
            <?php foreach ($list as $info) {  ?>
                <tr>
                    <td align="right"><?= $no; ?>.</td>
                    <td><?= $info->notrans; ?></td>
                    <td align="center"><?= date('Y-m-d',strtotime($info->transtgl)); ?></td>
                    <td align="center"><?= date('Y-m-d',strtotime($info->bebantgl)); ?></td>
                    <td><?= $info->jenis; ?></td>
                    <td><?= $info->keterangan; ?></td>
                    <td><?= $info->nomorfaktur; ?></td>
                    <td align="right"><?php $rp = number_format($info->nilaiuang,0,',','.'); echo 'Rp ' .$rp;?></td>
                </tr>
                <?php $totalnilaiuang=$totalnilaiuang+$info->nilaiuang;
                        $no++;
                        ; ?>
            <?php  } ?>
            </tbody>
            <tfoot>
                <tr align="right">
                    <th colspan="7" align="right">TOTAL</th>
                    <th align="right"><?php $rp = number_format($totalnilaiuang,0,',','.'); echo 'Rp ' .$rp;?></th>
                </tr>
            </tfoot>
        </table>
        <div class="info-print">
            tgl cetak : <?php date_default_timezone_set('Asia/Jakarta'); echo date('Y-m-d H:i:s'); ?>
        </div>
        <div class="footer">
            <table class="ttd">
                <tbody>
                    <tr>
                        <td> Mengetahui</td>
                        <td> </td>
                        <td> </td>
                        <td> Pembukuan </td>
                    </tr>
                </tbody>
                <tfoot>
                    <tr>
                        <td >(................)</td>
                        <td> </td>
                        <td> </td>
                        <td>(................)</td>
                    </tr>
                </tfoot>
            </table>
        </div>

    </body>

</html>