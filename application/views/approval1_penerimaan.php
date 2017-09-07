<?php
$admin_page_title = 'Approval Penerimaan';
$admin_page_breadcrumb = 'Lokasi : '.ucfirst($this->session->userdata('location'));
include_once 'layout_admin_top.php';

?>

    <div class="row">
        <div class="col-sm-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">Daftar Transaksi</h3>
                </div>
                <form action="<?= base_url('approval1_penerimaan'); ?>" method="post">
                    <div class="row">
                        <div class="col-md-5" style="margin-top: 10px;">
                            <select name="filter_loc" class="form-control" required>
                            <option value="">Pilih Lokasi</option>
                                <?php foreach($list_lokasi as $list){ ?>
                                <option value="<?= $list->locid; ?>"><?= $list->locationket; ?></option>
                                <?php } ?>
                            </select>
                            <span class="help-block"></span>
                            <input type="submit" class="btn btn-success btn-sm" value="Filter" style="margin-top: 10px;">
                        </div>
                        <div class="col-md-3" style="margin-top: 10px;">
                            <div class="form-group">
                                <div class='input-group date dt_date'>
                                    <input name="filter_tgl" type='text' class="form-control" id="tgl_trans" placeholder="yyyy-MM-dd" required/>
                                    <span class="input-group-addon">
                                        <span class="glyphicon glyphicon-calendar"></span>
                                    </span>
                                </div>
                            </div>
                            <span class="help-block"></span>
                        </div>
                    </div>                    
                </form>
                <div class="panel-body">
                    <div class="label label-info" style="font-size: medium;">Location : <?= $location; ?></div>
                </div>
                <form action="<?= base_url('approval1_penerimaan/update_status'); ?>" method="post">
                    <input type="hidden" name="locid" value="<?= $locid; ?>"/>
                    <input type="hidden" name="tgl" value="<?= $tgl; ?>"/>
                    <div class="panel-body">
                        <table class="table table-bordered table-striped">
                            <thead>
                            <tr>
                                <th hidden>ID</th>
                                <th width="10%">Tanggal</th>
                                <th width="15%">Jenis Penerimaan</th>
                                <th width="15%">Jenis Pembayaran</th>
                                <th width="15%">Kartu</th>
                                <th width="15%">Mesin</th>
                                <th>Nominal Penerimaan</th>
                                <th>ID Pasien</th>
                                <th>All <input type="checkbox" onchange="checkAll(this)"/></th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php foreach($list_trans as $info){ ?>
                                <tr>
                                    <td hidden>
                                        <input name="incdetailid_<?= $info->incdetailid; ?>" value="<?= $info->incdetailid; ?> "/>
                                    </td>
                                    <td><?= date('Y-m-d',strtotime($info->inctgl)); ?></td>
                                    <td>
                                        <select name="jenispenerimaan_<?= $info->incdetailid; ?>" class="form-control" required>
                                            <?php foreach($list_jenispenerimaan as $list){ ?>
                                                <option value="<?= $list->configValue; ?>" <?= ($list->configValue == trim($info->incjenis)) ? 'selected':''; ?>><?= $list->configValue; ?>
                                                </option>
                                            <?php } ?>
                                        </select>
                                    </td>
                                    <td>
                                        <select name="jenisbayar_<?= $info->incdetailid; ?>" class="form-control" required>
                                            <?php foreach($list_jenisbayar as $list){ ?>
                                                <option value="<?= $list->configValue; ?>" <?= ($list->configValue == trim($info->jenis)) ? 'selected':''; ?>><?= $list->configValue; ?>
                                                </option>
                                            <?php } ?>
                                        </select>
                                    </td>
                                    <td>
                                        <select name="kartu_<?= $info->incdetailid; ?>" class="form-control" required>
                                            <?php foreach($list_kartu as $list){ ?>
                                                <option value="<?= $list->configValue; ?>" <?= ($list->configValue == trim($info->kartu)) ? 'selected':''; ?>><?= $list->configValue; ?>
                                                </option>
                                            <?php } ?>
                                        </select>
                                    </td>
                                    <td>
                                        <select name="mesin_<?= $info->incdetailid; ?>" class="form-control" required>
                                            <?php foreach($list_mesin as $list){ ?>
                                                <option value="<?= $list->configValue; ?>" <?= ($list->configValue == trim($info->mesin)) ? 'selected':''; ?>><?= $list->configValue; ?>
                                                </option>
                                            <?php } ?>
                                        </select>
                                    </td>
                                    <td align="right">
                                        <?php $rp = number_format($info->incnilai,2,',','.'); echo 'Rp '.$rp;?>
                                        <input name="nilai_<?= $info->incdetailid; ?>" value="<?= $info->incnilai; ?> " hidden/>
                                    </td>
                                    <td><?= $info->idinternet; ?></td>
                                    <td align="center">
                                        <label>
                                            <input type="checkbox" name="editstatus[]" value="<?= $info->incdetailid; ?>"/>
                                        </label>
                                    </td>
                                </tr>
                            <?php } ?>
                            </tbody>
                        </table>
                        <div class="context_buttons">
                            <input type="submit" name="update" class="btn btn-success pull-right btn-sm" value="Simpan" style="margin-right:20px; font-size: large">
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>

    </script>
    <!-- /.row -->

<?php include_once 'layout_admin_bottom.php'; ?>