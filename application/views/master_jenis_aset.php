<?php
$admin_page_title = 'Master Jenis Aset';
$admin_page_breadcrumb = '';
include_once 'layout_admin_top.php';
$baseurl = base_url() . "master_jenis_aset";
if ($link == $baseurl || $link == $baseurl . '/') {
    $data = 0;
}

?>

    <div class="row">
        <div class="col-sm-12">
            <div id="form" class="panel panel-default panel-sm">
                <div class="panel-heading"><b>Input Jenis Aset</b></div>
                <div class="panel-body">
                    <form action="<?= $submit_url; ?>" method="post">
                        <table class="table table-condensed">
                            <tr>
                                <td style="width:10%;">ID</td>
                                <td>
                                    <div class="col-sm-2">
                                        <input type="text" name="jenisaset_id" class="form-control input-sm" value="<?= $data['jenisaset_id']; ?>" readonly>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>Nama Aset</td>
                                <td>
                                    <div class="col-sm-6">
                                        <input type="text" name="jenisaset_nama" class="form-control input-sm" value="<?= $data['jenisaset_nama']; ?>" required>
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
                    <h3 class="panel-title">Daftar Jenis Aset</h3>
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
                        <?php foreach($list_jenis as $info){ ?>
                            <tr>
                                <td><?= $info->jenisaset_id; ?></td>
                                <td><?= $info->jenisaset_nama; ?></td>
                                <td>
                                    <a class="btn btn-sm btn-primary" href="javascript:void(0)" title="Edit" onclick="window.location.href='<?= $load_url; ?>?id=<?= $info->jenisaset_id; ?>'"><i class="glyphicon glyphicon-pencil"></i> Edit</a>
                                    <a class="btn btn-sm btn-danger" href="javascript:void(0)" title="Hapus" onclick="hapus_data('<?= $info->jenisaset_id; ?>','<?= $info->jenisaset_nama; ?>','<?= $del_url; ?>?id=<?= $info->jenisaset_id; ?>')"><i class="glyphicon glyphicon-trash"></i> Delete</a>
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