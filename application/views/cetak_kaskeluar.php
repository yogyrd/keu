<?php
$admin_page_title = 'Laporan Kas Keluar';
$admin_page_breadcrumb = '';
include_once 'layout_top.php';

$jml_pengajuan = 0;
$jml_realisasi = 0;
?>

<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-body">
                <h3>Laporan Kas Keluar </h3>
                <h5>
                    Tanggal  :<strong> <?= $tgl1; ?> s/d <?= $tgl2; ?> </strong><br/>
                    Kantor Perwakilan : <strong> <?= $loc_name; ?></strong><br />
                    <?= $opsi; ?>
                </h5>



                <table class="table table-bordered table-striped " style="font-size: x-small;">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>Jenis</th>
                        <th>Tanggal Transaksi</th>
                        <th>Tanggal Beban</th>
                        <th>Keterangan</th>
                        <th>Nominal Pengajuan</th>
                        <th>Realisasi</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach($list as $info){ ?>
                        <tr>
                            <td><?= $info->transoutid; ?></td>
                            <td><?= $info->jenis; ?></td>
                            <td><?= date('Y-m-d',strtotime($info->transtgl)); ?></td>
                            <td><?= date('Y-m-d',strtotime($info->bebantgl)); ?></td>
                            <td><?= $info->keterangan; ?></td>
                            <td><?php $rp = number_format($info->nilaiuang,2,',','.'); echo 'Rp '.$rp;?></td>
                            <td><?php $rp = number_format($info->realisasi,2,',','.'); echo 'Rp '.$rp;?></td>
                            <?php
                                $jml_pengajuan = $jml_pengajuan + $info->nilaiuang;
                                $jml_realisasi = $jml_realisasi + $info->realisasi;
                            ?>
                            </td>
                        </tr>
                    <?php } ?>
                    </tbody>
                </table>
                <div class="pull-right">Jumlah Nominal Pengajuan :<strong> Rp. <?= number_format($jml_pengajuan,2,',','.'); ?></strong></div> <br />
                <div class="pull-right">Jumlah Nominal Realisasi :<strong> Rp. <?= number_format($jml_realisasi,2,',','.'); ?></strong></div>
            </div>
        </div>
    </div>
</div>
<!-- /.row -->

<?php include_once 'layout_admin_bottom.php'; ?>

