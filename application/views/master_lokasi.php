<?php
$admin_page_title = 'Master Lokasi';
$admin_page_breadcrumb = 'Lokasi : '.ucfirst($this->session->userdata('location'));
include_once 'layout_admin_top.php';
$baseurl = base_url() . "master_lokasi";
if ($link == $baseurl || $link == $baseurl . '/') {
    $data = 0;
}

$tgl = date('Y-m-d H:i:s');
$user = ucfirst($this->session->userdata('id'));
$loc = strtoupper(ucfirst($this->session->userdata('location')));
$locid = strtoupper(ucfirst($this->session->userdata('locid')));
?>

    <div class="row">
        <div class="col-sm-12">
            <div id="form" class="panel panel-default panel-sm">
                <div class="panel-heading"><b>Input Lokasi</b></div>
                <div class="panel-body">
                    <form action="<?= $submit_url; ?>" method="post">
                        <table class="table table-condensed">
                            <tr>
                                <td style="width:10%;">ID</td>
                                <td>
                                    <div class="col-sm-2">
                                        <input type="text" name="locid" class="form-control input-sm" value="<?= $data['locid']; ?>" readonly>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>Keterangan</td>
                                <td>
                                    <div class="col-sm-6">
                                        <input type="text" name="locationket" class="form-control input-sm" value="<?= $data['locationket']; ?>" required>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td></td>
                                <td>
                                    <div class="col-sm-6">
                                        <input type="submit" class="btn btn-success btn-sm" value="Simpan">
                                        <a class="btn btn-sm btn-default" href="javascript:void(0)" title="Batal" onclick="window.location.href='<?= base_url() . 'master_lokasi'; ?>'"> Batal</a>
                                    </div>
                                </td>
                            </tr>
                        </table>
                    </form>
                </div>
            </div>
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">Daftar Lokasi</h3>
                </div>
                <div class="panel-body">
                    <table id="tabel_pengeluaran" class="table table-condensed table-bordered table-striped">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nama Lokasi</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach($list_lokasi as $info){ ?>
                            <tr>
                                <td><?= $info->locid; ?></td>
                                <td><?= $info->locationket; ?></td>
                                <td>
                                    <a class="btn btn-sm btn-primary" href="javascript:void(0)" title="Edit" onclick="window.location.href='<?= $load_url; ?>?id=<?= $info->locid; ?>'"><i class="glyphicon glyphicon-pencil"></i> Edit</a>
                                    <a class="btn btn-sm btn-danger" href="javascript:void(0)" title="Hapus" onclick="hapus_data('<?= $info->locid; ?>','<?= $info->locationket; ?>','<?= $del_url; ?>?id=<?= $info->locid; ?>')"><i class="glyphicon glyphicon-trash"></i> Delete</a>
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