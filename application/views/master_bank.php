<?php
$admin_page_title = 'Master Bank';
$admin_page_breadcrumb = '';
include_once 'layout_admin_top.php';
$baseurl = base_url() . "master_bank";
if ($link == $baseurl || $link == $baseurl . '/') {
    $data = 0;
}

$user = ucfirst($this->session->userdata('id'));
$loc = strtoupper(ucfirst($this->session->userdata('location')));
$locid = strtoupper(ucfirst($this->session->userdata('locid')));
?>
    <div class="row">
        <div class="col-sm-12">
            <div id="form" class="panel panel-default panel-sm">
                <div class="panel-heading"><b>Input Data Rekening Bank</b></div>
                <div class="panel-body">
                    <form action="<?= $submit_url; ?>" method="post">
                        <table class="table table-condensed">
                            <tr>
                                <td style="width:10%;">ID</td>
                                <td>
                                    <div class="col-sm-2">
                                        <input type="text" name="bankid" class="form-control input-sm" value="<?= $data['bankid']; ?>" readonly>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>Lokasi</td>
                                <td>
                                    <div class="col-md-6">
                                        <select name="locid" class="form-control" required>
                                            <option value="">Pilih Lokasi</option>
                                            <?php foreach($list_lokasi as $list){ ?>
                                                <option value="<?= $list->locid; ?>" <?= ($list->locid == $data['locid']) ? 'selected':''; ?>><?= $list->locationket; ?></option>
                                            <?php } ?>
                                        </select>
                                        <span class="help-block"></span>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>Nama Bank</td>
                                <td>
                                    <div class="col-sm-4">
                                        <input type="text" name="namabank" class="form-control input-sm" value="<?= $data['namabank']; ?>" required>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>Nomor Rekening</td>
                                <td>
                                    <div class="col-sm-4">
                                        <input type="text" name="norekening" class="form-control input-sm" value="<?= $data['norekening']; ?>" required>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>Pemilik Rekening</td>
                                <td>
                                    <div class="col-sm-3">
                                        <input type="text" name="namarekening" class="form-control input-sm" value="<?= $data['namarekening']; ?>" required maxlength="30">
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>Cabang Rekening</td>
                                <td>
                                    <div class="col-sm-4">
                                        <input type="text" name="cabangrekening" class="form-control input-sm" value="<?= $data['cabangrekening']; ?>" required>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td></td>
                                <td>
                                    <div class="col-sm-6">
                                        <input type="submit" class="btn btn-success btn-sm" value="Simpan">
                                        <a class="btn btn-sm btn-default" href="javascript:void(0)" title="Batal" onclick="window.location.href='<?= base_url() . 'master_bank'; ?>'"> Batal</a>
                                    </div>
                                </td>
                            </tr>
                        </table>
                    </form>
                </div>
            </div>
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">Daftar Rekening Bank</h3>
                </div>
                <div class="panel-body">
                    <table id="tabel_data" class="table table-condensed table-bordered table-striped">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nama Lokasi</th>
                            <th>Nama Bank</th>
                            <th>Nomor Rekening</th>
                            <th>Nama Pemilik Rekening</th>
                            <th>Cabang Rekening</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach($list_bank as $info){ ?>
                            <tr>
                                <td><?= $info->bankid; ?></td>
                                <td><?= $info->locationket; ?></td>
                                <td><?= $info->namabank; ?></td>
                                <td><?= $info->norekening; ?></td>
                                <td><?= $info->namarekening; ?></td>
                                <td><?= $info->cabangrekening; ?></td>
                                <td>
                                    <a class="btn btn-sm btn-primary" href="javascript:void(0)" title="Edit" onclick="window.location.href='<?= $load_url; ?>?id=<?= $info->bankid; ?>'"><i class="glyphicon glyphicon-pencil"></i> Edit</a>
                                    <a class="btn btn-sm btn-danger" href="javascript:void(0)" title="Hapus" onclick="hapus_data('<?= $info->bankid; ?>','<?= $info->namabank; ?>','<?= $del_url; ?>?id=<?= $info->bankid; ?>')"><i class="glyphicon glyphicon-trash"></i> Delete</a>
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