<?php
$admin_page_title = $title;
$admin_page_breadcrumb = '';
include_once 'layout_admin_top.php';

$incomeid = $this->input->get('id');
?>

    <div class="row">
        <div class="col-sm-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">Daftar Transaksi</h3>
                </div>
                <div class="panel-body">
                    <span><h5>Location : <?= $location; ?> </h5></span>
                    <a class="btn btn-sm btn-danger pull-right" href="javascript:void(0)" title="Cetak" onclick="window.location.href='<?= base_url(); ?>rpt_bkk/print_bkk?id=<?= $incomeid; ?>'" target="_blank"><i class="glyphicon glyphicon-print"></i> Cetak</a>
                </div>
                <div class="panel-body">

                    <table id="tabel_trans_kas" class="table table-bordered table-striped">
                        <thead>
                        <tr>
                            <th width="20%">Keterangan</th>
                            <th width="15%">Jenis</th>
                            <th width="10%">Tanggal Transaksi</th>
                            <th width="10%">Tanggal Beban</th>
                            <th width="15%">No. Faktur</th>
                            <th width="15%">Nominal Pengajuan</th>
                            <th width="15%">Realisasi</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php $total=0; ?>
                        <?php foreach($list_detail as $info){ ?>
                            <tr>
                                <td><?= $info->keterangan; ?></td>
                                <td><?= $info->jenis; ?></td>
                                <td><?= date('Y-m-d',strtotime($info->transtgl)); ?></td>
                                <td><?= date('Y-m-d',strtotime($info->bebantgl)); ?></td>
                                <td><?= $info->nomorfaktur; ?></td>
                                <td align="right"><?php $rp = number_format($info->nilaiuang,2,',','.'); echo 'Rp '.$rp;?></td>
                                <td align="right"><?php $rp = number_format($info->realisasi,2,',','.'); echo 'Rp '.$rp;?></td>
                            </tr>
                        <?php $total=$total+$info->realisasi;} ?>
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