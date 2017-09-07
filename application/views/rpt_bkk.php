<?php
$admin_page_title = 'Daftar Kas Keluar';
$admin_page_breadcrumb = 'Lokasi anda : '.ucfirst($this->session->userdata('location'));
include_once 'layout_admin_top.php';


?>

    <div class="row">
        <div class="col-sm-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">Daftar Transaksi</h3>
                </div>
                <form action="<?= base_url('rpt_bkk'); ?>" method="post">
                    <div class="col-sm-5" style="margin-top: 10px;">
                        <select name="filter_loc" class="form-control">
                            <option value="">Semua Lokasi</option>
                            <?php foreach($list_lokasi as $list){ ?>
                                <option value="<?= $list->locid; ?>"><?= $list->locationket; ?></option>
                            <?php } ?>
                        </select>
                        <span class="help-block"></span>
                    </div>
                    <input type="submit" class="btn btn-success btn-sm" value="Filter" style="margin-top: 10px;">
                </form>
                <div class="panel-body">
                    <div class="label label-info" style="font-size: medium;">Location : <?= $location; ?></div>
                </div>
                <div class="panel-body">

                    <table id="tabel_trans_kas" class="table table-bordered table-striped">
                        <thead>
                        <tr>
                            <th width="10%">ID</th>
                            <th width="25%">Lokasi</th>
                            <th width="15%">Tanggal Realisasi</th>
                            <th width="20%">Total</th>
                            <th width="15%">Pengajuan / Cash</th>
                            <th width="15%">Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach($list_kaskeluar as $info){ ?>
                            <tr>
                                <td><?= $info->incomeid; ?></td>
                                <td><?= $model->getLocation($info->loc); ?></td>
                                <td><?= date('Y-m-d',strtotime($info->inctgl)); ?></td>
                                <td align="right"><?php $rp = number_format($info->incnilai,2,',','.'); echo 'Rp '.$rp;?></td>
                                <td><?php if($info->pengajuan==0) {echo 'Cash';} else {echo 'Pengajuan';}  ?></td>
                                <td>
                                    <a class="btn btn-sm btn-info" href="javascript:void(0)" title="Lihat" onclick="window.location.href='<?= base_url(); ?>rpt_bkk/show_detail?id=<?= $info->incomeid; ?>'"><i class="glyphicon glyphicon-search"></i> Detail</a>
                                    <a class="btn btn-sm btn-danger" href="javascript:void(0)" title="Cetak" onclick="window.location.href='<?= base_url(); ?>rpt_bkk/print_bkk?id=<?= $info->incomeid; ?>'"><i class="glyphicon glyphicon-print"></i> Cetak</a>
                                </td>
                            </tr>
                        <?php } ?>
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