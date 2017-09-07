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
                    <a class="btn btn-sm btn-danger pull-right" href="javascript:void(0)" title="Cetak" onclick="window.location.href='<?= base_url(); ?>rpt_kaskeluar/print_rejected?locid=<?= $locid; ?>&tgloption=<?= $tgloption; ?>&tgl1=<?= $tgl1; ?>&tgl2=<?= $tgl2; ?>'" target="_blank"><i class="glyphicon glyphicon-print"></i> Cetak</a>
                </div>
                <div class="panel-body">

                    <table id="tabel_trans_kas" class="table table-bordered table-striped">
                        <thead>
                        <tr>
                            <th width="10%">Kode Transaksi</th>
                            <th width="10%">Jenis</th>
                            <th width="15%">Keterangan</th>
                            <th width="10%">Nomor Faktur</th>
                            <th width="10%">Tanggal Transaksi</th>
                            <th width="10%">Tanggal Beban</th>
                            <th width="10%">Nominal Pengajuan</th>
                            <th width="10%">Tanggal Reject</th>
                            <th width="25%">Alasan</th>
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
                                <td><?= date('Y-m-d',strtotime($info->transtgl)); ?></td>
                                <td><?= date('Y-m-d',strtotime($info->bebantgl)); ?></td>
                                <td align="right"><?php $rp = number_format($info->nilaiuang,2,',','.'); echo 'Rp '.$rp;?></td>
                                <td><?= date('Y-m-d',strtotime($info->rejecteddate)); ?></td>
                                <td><?= $info->alasan; ?></td>
                            </tr>
                        <?php  $total=$total+$info->nilaiuang;} ?>
                        </tbody>
                    </table>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="pull-right">
                                <h4>TOTAL = <?php $rp = number_format($total,2,',','.'); echo 'Rp '.$rp;?></h4>
                            </div>
                        </div>
                    </div>
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