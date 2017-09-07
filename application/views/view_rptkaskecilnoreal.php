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
                    <a class="btn btn-sm btn-danger pull-right" href="javascript:void(0)" title="Cetak" onclick="window.location.href='<?= base_url(); ?>rpt_kaskecil/print_kaskecil?locid=<?= $locid; ?>&tgloption=<?= $tgloption; ?>&tgl1=<?= $tgl1; ?>&tgl2=<?= $tgl2; ?>'" target="_blank"><i class="glyphicon glyphicon-print"></i> Cetak</a>
                </div>
                <div class="panel-body">

                    <table id="tabel_trans_kas" class="table table-bordered table-striped">
                        <thead>
                        <tr>
                            <th width="5%">No. Transaksi</th>
                            <th width="10%">Jenis</th>
                            <th width="15%">Keterangan</th>
                            <th width="5%">Nomor Nota</th>
                            <th width="10%">Lokasi</th>
                            <th width="8%">Tanggal Input</th>
                            <th width="8%">Tanggal Transaksi</th>
                            <th width="8%">Tanggal Beban</th>
                            <th width="10%">Nilai Pengajuan</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php $total = 0;
                        foreach($list as $info){ ?>
                            <tr>
                                <td><?= $info->notrans; ?></td>
                                <td><?= $info->jenis; ?></td>
                                <td><?= $info->keterangan; ?></td>
                                <td><?= $info->nomorfaktur; ?></td>
                                <td><?= $info->locationket; ?></td>
                                <td><?= date('Y-m-d',strtotime($info->createddate)); ?></td>
                                <td><?= date('Y-m-d',strtotime($info->transtgl)); ?></td>
                                <td><?= date('Y-m-d',strtotime($info->bebantgl)); ?></td>
                                <td align="right"><?php $rp = number_format($info->nilaiuang,0,',','.'); echo 'Rp '.$rp;?></td>
                            </tr>
                        <?php  $total=$total+$info->nilaiuang;} ?>
                            <tr style="background-color: #2ecc71; color: #000">
                                <td colspan="8" align="right"><b>Total</b></td>
                                <td align="right"><b><?php $rp = number_format($total,0,',','.'); echo 'Rp '.$rp;?></b></td>
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