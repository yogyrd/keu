<?php
$admin_page_title = '';
$admin_page_breadcrumb = '';
include_once 'layout_admin_top.php';

$jml_pengajuan = 0;
$jml_realisasi = 0;
?>

<div class="row">
    <div class="col-lg-12">
        <form action="<?= base_url('rpt_kaskeluar/cetak'); ?>" method="post" target="_blank">
            <input type="hidden" name="loc" value="<?= $loc; ?>" />
            <input type="hidden" name="transtgl1" value="<?= $tgl1; ?>" />
            <input type="hidden" name="transtgl2" value="<?= $tgl2; ?>" />
            <input type="hidden" name="accuserstatus" value="<?= $accuser; ?>" />
            <input type="hidden" name="acc1status" value="<?= $acc1; ?>" />
            <input type="hidden" name="acc2status" value="<?= $acc2; ?>" />
            <input type="hidden" name="acc3status" value="<?= $acc3; ?>" />
            <input type="hidden" name="opsi" value="<?= $opsi; ?>" />
            <button type="submit" class="btn btn-success btn-sm pull-right"><i class="glyphicon glyphicon-print"></i> Cetak</button>
        </form>
        <div class="panel">
            <div class="panel-body">
                <h3>Laporan Kas Keluar </h3>
                <h5>
                    Tanggal  :<strong> <?= $tgl1; ?> s/d <?= $tgl2; ?> </strong><br/>
                    Kantor Perwakilan : <strong> <?= $loc_name; ?></strong><br/>
                    <?= $opsi; ?>
                </h5>
                <table class="table table-bordered table-striped">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>Jenis</th>
                        <th>Tanggal Transaksi</th>
                        <th>Tanggal Beban</th>
                        <th>Keterangan</th>
                        <th>Nominal Pengajuan</th>
                        <th>Nominal Realisasi</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php if ($list) {
                         foreach($list as $info){ ?>
                            <tr>
                                <td><?= $info->transoutid; ?></td>
                                <td><?= $info->jenis; ?></td>
                                <td><?= date('Y-m-d',strtotime($info->transtgl)); ?></td>
                                <td><?= date('Y-m-d',strtotime($info->bebantgl)); ?></td>
                                <td><?= $info->keterangan; ?></td>
                                <td><?php $rp_pengajuan = number_format($info->nilaiuang,2,',','.'); echo 'Rp '.$rp_pengajuan;?></td>
                                <td><?php $rp_realisasi = number_format($info->realisasi,2,',','.'); echo 'Rp '.$rp_realisasi;?></td>
                                <?php
                                    $jml_pengajuan = $jml_pengajuan + $info->nilaiuang;
                                    $jml_realisasi = $jml_realisasi + $info->realisasi;
                                ?>
                            </tr>
                        <?php }
                    } else {
                        echo "<tr><td colspan='7' align='center'>DATA KOSONG</td></tr>";
                    } ?>

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

