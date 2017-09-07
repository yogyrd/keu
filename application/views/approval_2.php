<?php
$admin_page_title = 'Approval Kadiv Keuangan || Kas Pengeluaran';
$admin_page_breadcrumb = 'Lokasi : '.ucfirst($this->session->userdata('location'));
include_once 'layout_admin_top.php';
?>
    <div class="row">
        <div class="col-sm-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">Daftar Transaksi</h3>
                </div>
                <div class="panel-body">
                    <form action="<?= base_url('approval_2'); ?>" method="post">
                        <div class="col-sm-5" style="margin-top: 10px;">
                            <select name="filter_loc" class="form-control">
                                <option value="">Semua Lokasi</option>
                                <?php foreach($list_lokasi as $list){ ?>
                                <option value="<?= $list->locid; ?>"><?= $list->locationket; ?></option>
                                <?php } ?>
                            </select>
                            <span class="help-block"></span>
                        </div>
                        <div class="col-sm-12">
                            <input type="submit" class="btn btn-primary btn-sm" value="Filter">
                            <input type="button" id="btncek" class="btn btn-success btn-sm pull-right" data-toggle="modal" data-target="#MessageBox" value="View Approved">
                        </div>
                    </form>
                        <div class="col-sm-12">
                            <div class="modal" id="MessageBox" role="dialog">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-body">
                                            <table>
                                                <tr>
                                                    <td style="width:10%;">Lokasi</td>
                                                    <td>
                                                        <div class="col-sm-10">
                                                            <select name="filter_loc" id="filter_loc" class="form-control">
                                                                <option value="">Semua Lokasi</option>
                                                                <?php foreach($list_lokasi as $list){ ?>
                                                                <option value="<?= $list->locid; ?>"><?= $list->locationket; ?></option>
                                                                <?php } ?>
                                                            </select>
                                                            <span class="help-block"></span>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>Tanggal Approved</td>
                                                    <td>
                                                        <div class="col-sm-5">
                                                            <div class="form-group">
                                                                <div class='input-group date dt_date'>
                                                                    <input id="tgl1" type='text' class="form-control" placeholder="yyyy-MM-dd"/>
                                                                    <span class="input-group-addon">
                                                                    <span class="glyphicon glyphicon-calendar"></span>
                                                                </span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-1">
                                                            <h5><center>s/d</center></h5>
                                                        </div>
                                                        <div class="col-sm-5">
                                                            <div class="form-group">
                                                                <div class='input-group date dt_date'>
                                                                    <input id="tgl2" type='text' class="form-control" placeholder="yyyy-MM-dd"/>
                                                                    <span class="input-group-addon">
                                                                    <span class="glyphicon glyphicon-calendar"></span>
                                                                </span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </td>
                                                </tr>
                                            </table>
                                        </div>
                                        <div class="modal-footer">
                                            <a class="btn btn-sm btn-success" href="javascript:void(0)" title="Edit" onclick="view_approved()"><i class="glyphicon glyphicon-eye-open"></i> View Approved</a>
                                            <input type="button" class="btn btn-danger btn-sm" data-dismiss="modal" value="Batal" />
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <span class="help-block"></span>
                            <div class="label label-info" style="font-size: medium;">Location : <?= $location; ?></div>
                        </div>
                </div>
                <form action="<?= base_url('approval_2/update_status'); ?>" method="post">
                    <div class="panel-body">
                        <table id="tabel_trans_kas" class="table table-bordered table-striped">
                            <thead>
                            <tr>
                                <th width="2%" hidden>ID</th>
                                <th width="2%">No. Trans</th>
                                <th width="15%">Jenis</th>
                                <th width="15%">Keterangan</th>
                                <th width="8%">Tanggal Transaksi</th>
                                <th width="10%">Lokasi</th>
                                <th width="12%">Nilai Uang Pengajuan</th>
                                <th width="15%">Budget</th>
                                <th width="11%">Realisasi</th>
                                <th width="5%">Pengajuan / Cash</th>
                                <th width="5%">
                                    All <input type="checkbox" onchange="checkAll(this)"/>
                                </th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php foreach($list_trans as $info){ ?>
                                <tr>
                                    <td hidden><?= $info->transoutid; ?></td>
                                    <td><?= $info->notrans; ?></td>
                                    <td><?= $info->jenis; ?></td>
                                    <td><?= $info->keterangan; ?> - <?= $info->nomorfaktur; ?></td>
                                    <td align="center"><?= date('Y-m-d',strtotime($info->transtgl)); ?></td>
                                    <td><?= $info->locationket; ?></td>
                                    <td align="right"><?php $rp = number_format($info->nilaiuang,0,',','.'); echo 'Rp '.$rp;?></td>
                                    <td align="right"><?php $rp = number_format($info->nilaimax,0,',','.'); echo 'Rp '.$rp;?></td>
                                    <td align="right"><?php $rp = number_format($info->realisasi,0,',','.'); echo 'Rp '.$rp;?></td>
                                    <td>
                                        <input type="hidden" value="<?= $info->pengajuan; ?>" name="pengajuan<?= $info->transoutid; ?>" />
                                        <?php if($info->pengajuan==0) {echo 'Cash';} else {echo 'Pengajuan';}  ?>
                                    </td>
                                    <td align="center">
                                        <label>
                                            <input type="checkbox" name="editstatus[]" value="<?= $info->transoutid; ?>"/>
                                        </label>
                                        <input type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#rejectBox" value="Reject" onclick="rejectTrans<?= $info->transoutid; ?>()">
                                    </td>
                                    <script>
                                        function rejectTrans<?= $info->transoutid; ?>() {
                                            document.getElementById('transoutid_modal').value = <?= $info->transoutid; ?>;
                                            document.getElementById('notrans_modal').innerText = '<?= $info->notrans; ?>';
                                        }
                                    </script>
                                </tr>
                            <?php } ?>
                            </tbody>
                        </table>
                        <div class="context_buttons">
                            <input type="submit" name="update" class="btn btn-success btn-sm pull-right" value="APPROVE" style="font-size: large; margin-right: 15px;">
                        </div>
                    </div>
                </form>
                <form action="<?= base_url('approval_2/reject_transaksi'); ?>" method="post">
                    <div class="modal" id="rejectBox" role="dialog">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 >Reject Transaksi No. <span id="notrans_modal"></span> </h5>
                                    <input type="hidden" id="transoutid_modal" name="transoutid_modal">
                                </div>
                                <div class="modal-body">
                                    <table>
                                        <tr>
                                            <td>Keterangan</td>
                                            <td>
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <textarea class="form-control" rows="2" name="keterangan"></textarea>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    </table>
                                </div>
                                <div class="modal-footer">
                                    <input type="submit" name="update" class="btn btn-success pull-left btn-sm" value="OK" />
                                    <input type="button" class="btn btn-danger btn-sm pull-left" data-dismiss="modal" value="Batal" />
                                </div>
                            </div>
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
        function view_approved() {
            var loc = document.getElementById('filter_loc').value;
            var tgl1 = document.getElementById('tgl1').value;
            var tgl2 = document.getElementById('tgl2').value;
            if (tgl1 > tgl2) {
                alert('Tanggal awal harus lebih kecil dari tanggal akhir!!');
            } else if(tgl1 == "" || tgl2=="") {
                alert('Tanggal awal dan akhir harus diisi!!');
            } else {
                window.location.href="<?= base_url('approval_2/view_approved'); ?>?locid=" + loc + "&tgl1=" + tgl1 + "&tgl2=" + tgl2;
            }
        }
    </script>
    <!-- /.row -->
<?php include_once 'layout_admin_bottom.php'; ?>