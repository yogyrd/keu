<?php
$admin_page_title = 'Approval Kas Pengeluaran Kepala Cabang';
$admin_page_breadcrumb = 'Lokasi anda : '.ucfirst($this->session->userdata('location'));
include_once 'layout_admin_top.php';


?>

    <div class="row">
        <div class="col-sm-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">Daftar Transaksi</h3>
                </div>
                <form action="<?= base_url('approval_user/update_status'); ?>" method="post">
                    <div class="panel-body">

                        <table id="tabel_trans_kas" class="table table-bordered table-condensed table-hover table-striped">
                            <thead>
                            <tr>
                                <th width="2%" hidden>ID</th>
                                <th width="10%">Kode Transaksi</th>
                                <th width="15%">Jenis</th>
                                <th width="15%">Keterangan</th>
                                <th width="8%">No Nota / Faktur</th>
                                <th width="8%">Tanggal Transaksi</th>
                                <th width="8%">Tanggal Beban</th>
                                <th width="10%">Lokasi</th>
                                <th width="10%">Nilai Uang Pengajuan</th>
                                <th width="10%">Budget</th>
                                <th width="8%">Pengajuan / Cash</th>
                                <th width="2%">All <input type="checkbox" onchange="checkAll(this)"/></th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php foreach($list_trans as $info){ ?>
                                <tr>
                                    <td hidden><?= $info->transoutid; ?></td>
                                    <td><?= $info->notrans; ?></td>
                                    <td><?= $info->jenis; ?></td>
                                    <td><?= $info->keterangan; ?><?= $info->nomorfaktur; ?></td>
                                    <td><?= $info->nomorfaktur; ?></td>
                                    <td align="center"><?= date('Y-m-d',strtotime($info->transtgl)); ?></td>
                                    <td align="center"><?= date('Y-m-d',strtotime($info->bebantgl)); ?></td>
                                    <td><?= $info->locationket; ?></td>
                                    <td align="right"><?php $rp = number_format($info->nilaiuang,0,',','.'); echo 'Rp '.$rp;?></td>
                                    <td align="right"><?php $rp = number_format($info->nilaimax,0,',','.'); echo 'Rp '.$rp;?></td>
                                    <td><?php if($info->pengajuan==0) {echo 'Cash';} else {echo 'Pengajuan';}  ?></td>
                                    <td align="center">
                                        <label>
                                            <input type="checkbox" name="editstatus[]" value="<?= $info->transoutid; ?>" checked/>
                                        </label>
                                    </td>
                                </tr>
                            <?php } ?>
                            </tbody>
                        </table>
                        <div class="context_buttons">
                            <input type="submit" name="update" class="btn btn-success pull-right btn-sm" value="APPROVE" style="font-size: large; margin-right: 15px;">
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    
    <script type="text/javascript">
        $(document).ready(function () {
            $('#tabel_trans_kas').dataTable({
                 paginate:false,
                 search:true,
                 sort:false
             }); 
         });
    </script>
    <!-- /.row -->

<?php include_once 'layout_admin_bottom.php'; ?>