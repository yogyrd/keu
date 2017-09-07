<?php
$admin_page_title = 'Master Supplier';
$admin_page_breadcrumb = 'Lokasi : '.ucfirst($this->session->userdata('location'));
include_once 'layout_admin_top.php';
$baseurl = base_url() . "master_supplier";
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
                <div class="panel-heading"><b>Input Data Supplier</b></div>
                <div class="panel-body">
                    <form action="<?= $submit_url; ?>" method="post">
                        <table class="table table-condensed">
                            <tr>
                                <td style="width:10%;">ID</td>
                                <td>
                                    <div class="col-sm-2">
                                        <input type="text" name="supplierid" class="form-control input-sm" value="<?= $data['supplierid']; ?>" readonly>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>Nama Supplier</td>
                                <td>
                                    <div class="col-sm-4">
                                        <input type="text" name="suppliernama" class="form-control input-sm" value="<?= $data['suppliernama']; ?>" maxlength="75" required>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>Alamat Supplier</td>
                                <td>
                                    <div class="col-sm-6">
                                        <input type="text" name="supplieralamat" class="form-control input-sm" value="<?= $data['supplieralamat']; ?>" maxlength="100" required>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>No. Tlp</td>
                                <td>
                                    <div class="col-sm-3">
                                        <input type="text" name="suppliertelp" class="form-control input-sm" value="<?= $data['suppliertelp']; ?>" maxlength="15" required>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>Jenis</td>
                                <td>
                                    <div class="col-sm-4">
                                        <input type="text" name="supplierjenis" class="form-control input-sm" value="<?= $data['supplierjenis']; ?>" maxlength="100" required>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>Bank Rekening Supplier</td>
                                <td>
                                    <div class="col-sm-4">
                                        <input type="text" name="supplierbank" class="form-control input-sm" value="<?= $data['supplierbank']; ?>" maxlength="30" required>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>No. Rekening Supplier</td>
                                <td>
                                    <div class="col-sm-4">
                                        <input type="text" name="supplierbanknorek" class="form-control input-sm" value="<?= $data['supplierbanknorek']; ?>" maxlength="45" required>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>Nama Rekening Supplier</td>
                                <td>
                                    <div class="col-sm-4">
                                        <input type="text" name="supplierbanknamarek" class="form-control input-sm" value="<?= $data['supplierbanknamarek']; ?>" maxlength="75" required>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td></td>
                                <td>
                                    <div class="col-sm-6">
                                        <input type="submit" class="btn btn-success btn-sm" value="Simpan">
                                        <a class="btn btn-sm btn-default" href="javascript:void(0)" title="Batal" onclick="window.location.href='<?= base_url() . 'master_supplier'; ?>'"> Batal</a>
                                    </div>
                                </td>
                            </tr>
                        </table>
                    </form>
                </div>
            </div>
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">Daftar Nama Supplier</h3>
                </div>
                <div class="panel-body">
                    <table id="tabel_data" class="table table-condensed table-bordered table-striped">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nama Supplier</th>
                            <th>Alamat</th>
                            <th>No. Tlp.</th>
                            <th>Jenis</th>
                            <th>Bank Rekening</th>
                            <th>No. Rekening</th>
                            <th>Nama Rekening</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach($list_supp as $info){ ?>
                            <tr>
                                <td><?= $info->supplierid; ?></td>
                                <td><?= $info->suppliernama; ?></td>
                                <td><?= $info->supplieralamat; ?></td>
                                <td><?= $info->suppliertelp; ?></td>
                                <td><?= $info->supplierjenis; ?></td>
                                <td><?= $info->supplierbank; ?></td>
                                <td><?= $info->supplierbanknorek; ?></td>
                                <td><?= $info->supplierbanknamarek; ?></td>
                                <td>
                                    <a class="btn btn-sm btn-primary" href="javascript:void(0)" title="Edit" onclick="window.location.href='<?= $load_url; ?>?id=<?= $info->supplierid; ?>'"><i class="glyphicon glyphicon-pencil"></i> Edit</a>
                                    <a class="btn btn-sm btn-danger" href="javascript:void(0)" title="Hapus" onclick="hapus_data('<?= $info->supplierid; ?>','<?= $info->suppliernama; ?>','<?= $del_url; ?>?id=<?= $info->supplierid; ?>')"><i class="glyphicon glyphicon-trash"></i> Delete</a>
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