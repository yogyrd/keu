<?php
$admin_page_title = 'Master Group Jenis Pengeluaran';
$admin_page_breadcrumb = 'Lokasi : '.ucfirst($this->session->userdata('location'));
include_once 'layout_admin_top.php';
$baseurl = base_url() . "master_grouppengeluaran";
if ($link == $baseurl || $link == $baseurl . '/') {
    $data = 0;
}

$loc = strtoupper(ucfirst($this->session->userdata('location')));
$locid = strtoupper(ucfirst($this->session->userdata('locid')));
?>

    <div class="row">
        <div class="col-sm-12">
            <div id="form" class="panel panel-default panel-sm">
                <div class="panel-heading"><b>Input Master Group Pengeluaran</b></div>
                <div class="panel-body">
                    <form action="<?= $submit_url; ?>" method="post">
                        <table class="table table-condensed">
                            <tr>
                                <td style="width:10%;">ID</td>
                                <td>
                                    <div class="col-sm-2">
                                        <input type="text" name="costid" class="form-control input-sm" value="<?= $data['costid']; ?>" readonly>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>Jenis</td>
                                <td>
                                    <div class="col-sm-6">
                                        <input type="text" name="costjenis" class="form-control input-sm" value="<?= $data['costjenis']; ?>" required>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>Keterangan</td>
                                <td>
                                    <div class="col-sm-6">
                                        <input type="text" name="costket" class="form-control input-sm" value="<?= $data['costket']; ?>">
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>Lokasi</td>
                                <td>
                                    <div class="col-sm-6">
                                        <label class="radio-inline"><input type="radio" name="cabang" value="0" <?php if ($data['cabang'] == 0): ?>checked="checked"<?php endif; ?> required> Pusat</label>
                                        <label class="radio-inline"><input type="radio" name="cabang" value="1" <?php if ($data['cabang'] == 1): ?>checked="checked"<?php endif; ?> required> Cabang</label>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>Klasifikasi</td>
                                <td>
                                    <div class="col-sm-6">
                                        <label class="radio-inline"><input type="radio" name="klasifikasi" value="Operasional" <?php if ($data['klasifikasi'] == 0): ?>checked="checked"<?php endif; ?> required> Operasional</label>
                                        <label class="radio-inline"><input type="radio" name="klasifikasi" value="Personel" <?php if ($data['klasifikasi'] == 1): ?>checked="checked"<?php endif; ?> required> Personel</label>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td></td>
                                <td>
                                    <div class="col-sm-6">
                                        <input type="submit" class="btn btn-success btn-sm" value="Simpan">
                                        <a class="btn btn-sm btn-default" href="javascript:void(0)" title="Batal" onclick="window.location.href='<?= base_url() . 'master_grouppengeluaran'; ?>'"> Batal</a>
                                    </div>
                                </td>
                            </tr>
                        </table>
                    </form>
                </div>
            </div>
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">Daftar Group Jenis Pengeluaran</h3>
                </div>
                <div class="row" style="margin-top: 10px;">
                    <div class="col-sm-12">
                        <a class="btn btn-sm btn-danger pull-right" href="javascript:void(0)" title="PDF" onclick="window.location.href='<?= base_url(); ?>master_grouppengeluaran/cetak_groupjenispengeluaran'"><span class="fa fa-file-pdf-o"> PDF</span></a>
                    </div>
                </div>
                <div class="panel-body">
                    <table id="tabel_pengeluaran" class="table table-condensed table-bordered table-striped">
                        <thead>
                        <tr>
                            <th>Group ID</th>
                            <td>Jenis</td>
                            <th>Keterangan</th>
                            <th>Klasifikasi</th>
                            <th>Lokasi</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach($list_group as $info){ ?>
                            <tr>
                                <td><?= $info->costid; ?></td>
                                <td><?= $info->costjenis; ?></td>
                                <td><?= $info->costket; ?></td>
                                <td><?= $info->klasifikasi; ?></td>
                                <td><?php if($info->cabang == 1) {echo "Cabang";} else {echo "Pusat";}  ?></td>
                                <td>
                                    <a class="btn btn-sm btn-primary" href="javascript:void(0)" title="Edit" onclick="window.location.href='<?= $load_url; ?>?id=<?= $info->costid; ?>'"><i class="glyphicon glyphicon-pencil"></i> Edit</a>
                                    <a class="btn btn-sm btn-danger" href="javascript:void(0)" title="Hapus" onclick="hapus_data('<?= $info->costid; ?>','<?= $info->costjenis; ?>','<?= $del_url; ?>?id=<?= $info->costid; ?>')"><i class="glyphicon glyphicon-trash"></i> Delete</a>
                                </td>
                            </tr>
                        <?php } ?>
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </div>
    <!-- /.row -->

<?php include_once 'layout_admin_bottom.php'; ?>