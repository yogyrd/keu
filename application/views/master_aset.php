<?php
$admin_page_title = 'Master Aset';
$admin_page_breadcrumb = '';
include_once 'layout_admin_top.php';
$baseurl = base_url() . "master_aset";
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
                                <td>Nama Aset</td>
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

                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </div>
    <!-- /.row -->

<?php include_once 'layout_admin_bottom.php'; ?>