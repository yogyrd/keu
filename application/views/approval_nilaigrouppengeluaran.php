<?php
$admin_page_title = 'Approval Nilai Group Jenis Pengeluaran';
$admin_page_breadcrumb = '';
include_once 'layout_admin_top.php';
$baseurl = base_url() . "approval_nilaigrouppengeluaran";
if ($link == $baseurl || $link == $baseurl . '/') {
    $data = 0;
}

$tgl = date('Y-m-d H:i:s');
$userid = $this->session->userdata('id');
$counter=1;
?>

    <div class="row">
        <div class="col-sm-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">Daftar Master Nilai Group Pengeluaran</h3>
                </div>
                <div class="row">
                    <form action="<?= base_url('approval_nilaigrouppengeluaran'); ?>" method="post">
                        <div class="col-md-4" style="margin-top: 10px;">
                            <select name="filter_loc" class="form-control" required>
                                <option value="">Pilih Lokasi</option>
                                <?php foreach($list_lokasi as $list){ ?>
                                    <option value="<?= $list->locid; ?>"><?= $list->locationket; ?></option>
                                <?php } ?>
                            </select>
                            <span class="help-block"></span>
                        </div>
                        <div>
                            <span class="help-block"></span>
                        </div>
                            <input type="submit" class="btn btn-info btn-sm" value="Filter" style="margin-top: 10px;">


                    </form>

                    <form action="<?= base_url('approval_nilaigrouppengeluaran/lock_budget'); ?>" method="post">
                        <div class="panel-body">
                            <table class="table table-bordered table-striped table-hover">
                                <thead>
                                <tr>
                                    <th width="5%">No.</th>
                                    <th width="20%">Lokasi</th>
                                    <th width="20%">Group Jenis</th>
                                    <th width="20%">Keterangan</th>
                                    <th width="15%">Budget Group</th>
                                    <th width="10%">Tanggal Mulai</th>
                                    <th width="5%">Status</th>
                                    <th width="5%">All <input type="checkbox" onchange="checkAll(this)"/></th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php foreach ($list_nilai as $info) { ?>
                                    <tr>
                                        <?php $id=$info->nilaiid; ?>

                                        <td><?= $counter; ?><input name="counter_<?= $id; ?>" type="hidden" class="form-control" value="<?= $id; ?>" readonly/></td>
                                        <td><?= $model->getLocationById($info->locid); ?></td>
                                        <td><?= $info->costjenis; ?></td>
                                        <td><?= $info->costket; ?></td>
                                        <td align="right"><?php $rp= number_format($info->nilaimax,2,',','.'); echo 'Rp '.$rp;?></td>
                                        <td align="center">
                                            <?= date('Y-m-d',strtotime($info->startdate)); ?>
                                        </td>
                                        <td>
                                            <?php if ($info->locked == 0) { ?>
                                                Unlocked
                                            <?php } else { ?>
                                                Locked
                                            <?php } ?>
                                        </td>
                                        <td align="center">
                                            <?php if ($info->locked == 0) { ?>
                                            <label>
                                                <input type="checkbox" name="editstatus[]" value="<?= $id; ?>" />
                                            </label>
                                            <?php } else { ?>
                                            <label>
                                                <input type="checkbox" name="unlock[]" value="<?= $id; ?>" />
                                            </label>
                                            <?php } ?>
                                        </td>
                                    </tr>
                                    <script>


                                    </script>
                                    <?php $counter++; ?>
                                <?php } ?>
                                </tbody>
                            </table>
                            <div class="context_buttons">
                                <input type="submit" name="update" class="btn btn-success pull-right btn-sm" value="Submit" style="margin-right:20px; font-size: large">
                            </div>

                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- /.row -->

<?php include_once 'layout_admin_bottom.php'; ?>