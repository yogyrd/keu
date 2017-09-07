<?php
$admin_page_title = '';
$admin_page_breadcrumb = '';
include_once 'layout_admin_top.php';
$locid = $this->input->get('locid');
$tgloption = $this->input->get('tgloption');
$tgl1 = $this->input->get('tgl1');
$tgl2 = $this->input->get('tgl2');
?>

    <div class="row">
        <div class="col-sm-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">Daftar Transaksi</h3>
                </div>
                <div class="panel-body">
                    <span><h5>Location : <?= $locationket; ?> </h5></span>
                    <span><h5>Tgl : <?php if($tgl1 == $tgl2) {echo $tgl1;} else {echo $tgl1 . ' s/d ' . $tgl2;} ?> </h5></span>
                    <a class="btn btn-sm btn-success pull-left" href="javascript:void(0)" title="Kembali" onclick="window.location.href='<?= base_url(); ?>rpt_kaskecil'"><i class="glyphicon glyphicon-chevron-left"></i> Kembali</a>
                    <a class="btn btn-sm btn-danger pull-right" href="javascript:void(0)" title="Cetak" onclick="window.location.href='<?= base_url(); ?>rpt_kaskeluar/print_realized?locid=<?= $locid; ?>&tgloption=<?= $tgloption; ?>&tgl1=<?= $tgl1; ?>&tgl2=<?= $tgl2; ?>'" target="_blank"><i class="glyphicon glyphicon-print"></i> Cetak</a>
                </div>
                <div class="panel-body">

                    <table id="tabel_trans_kas" class="table table-bordered table-striped">
                        <thead>
                        <tr>
                            <th width="10%">Kode Transaksi</th>
                            <th width="10%">Jenis</th>
                            <th width="15%">Keterangan</th>
                            <th width="10%">Nomor Faktur</th>
                            <th width="8%">Tanggal Input</th>
                            <th width="8%">Tanggal Transaksi</th>
                            <th width="8%">Tanggal Realisasi</th>
                            <th width="11%">Nominal Pengajuan</th>
                            <th width="11%">Nominal Realisasi</th>
                            <th width="10%">Keterangan Realisasi</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php $totalnilaiuang=0;$totalrealisasi=0;
                        foreach($list as $info){ ?>
                            <tr>
                                <td><?= $info->notrans; ?></td>
                                <td><?= $info->jenis; ?></td>
                                <td><?= $info->keterangan; ?></td>
                                <td><?= $info->nomorfaktur; ?></td>
                                <td><?= date('Y-m-d',strtotime($info->createddate)); ?></td>
                                <td><?= date('Y-m-d',strtotime($info->transtgl)); ?></td>
                                <td><?= date('Y-m-d',strtotime($info->bebantgl)); ?></td>
                                <td align="right"><?php $rp = number_format($info->nilaiuang,0,',','.'); echo 'Rp '.$rp;?></td>
                                <td align="right"><?php $rp = number_format($info->realisasi,0,',','.'); echo 'Rp '.$rp;?></td>
                                <td><?= $info->realisasiket; ?></td>
                            </tr>
                        <?php
                            $totalnilaiuang=$totalnilaiuang+$info->nilaiuang;
                            $totalrealisasi=$totalrealisasi+$info->realisasi;
                        } ?>
                            <tr style="background-color: #2ecc71; color: #000">
                                <td colspan="7" align="right"><b>Total</b></td>
                                <td align="right"><b><?php $rp = number_format($totalnilaiuang,0,',','.'); echo 'Rp '.$rp;?></b></td>
                                <td align="right"><b><?php $rp = number_format($totalrealisasi,0,',','.'); echo 'Rp '.$rp;?></b></td>
                                <td></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <script>

                </script>
            </div>
        </div>
    </div>

    <script>

    </script>
    <!-- /.row -->

<?php include_once 'layout_admin_bottom.php'; ?>