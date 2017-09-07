<?php
$admin_page_title = 'Master Charts Of Accounts';
$admin_page_breadcrumb = '';
include_once 'layout_admin_top.php';
$baseurl = base_url() . "master_COA";
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
                <div class="panel-heading"><b>Input Master COA</b></div>
                <div class="panel-body">
                    <form action="<?= $submit_url; ?>" method="post">
                        <table class="table table-condensed">
                            <tr>
                                <td style="width:10%;">ID</td>
                                <td>
                                    <div class="col-sm-2">
                                        <input type="text" name="akunid" class="form-control input-sm" value="<?= $data['akunid']; ?>" readonly>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>Level</td>
                                <td>
                                    <div class="col-md-2">
                                        <select id="cmblevel" name="lvl" class="form-control">
                                            <option value="">Pilih Level</option>
                                            <?php foreach($list_level as $list){ ?>
                                                <option value="<?= $list->lvl; ?>" <?= ($list->lvl == $data['lvl']) ? 'selected':''; ?>><?= $list->lvl; ?></option>
                                            <?php } ?>
                                        </select>
                                        <span class="help-block"></span>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>Kategori</td>
                                <td>
                                    <div class="col-md-5">
                                        <select id="cmbkategori" class="form-control">
                                        </select>
                                        <span class="help-block"></span>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>Nama Akun</td>
                                <td>
                                    <div class="col-sm-6">
                                        <input type="text" name="namaakun" class="form-control input-sm" value="<?= $data['namaakun']; ?>" required>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>Nomor Akun</td>
                                <td>
                                    <div class="col-sm-2">
                                        <input type="text" name="noakun" id="noakun" class="form-control input-sm" value="<?= $data['noakun']; ?>" required>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td></td>
                                <td>
                                    <div class="col-sm-6">
                                        <input type="submit" class="btn btn-success btn-sm" value="Simpan">
                                        <a class="btn btn-sm btn-default" href="javascript:void(0)" title="Batal" onclick="window.location.href='<?= base_url() . 'master_COA'; ?>'"> Batal</a>
                                    </div>
                                </td>
                            </tr>
                        </table>
                    </form>
                </div>
            </div>
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">Daftar Charts Of Accounts</h3>
                </div>
                <div class="panel-body">
                    <table class="table table-condensed table-hover table-striped">
                        <thead>
                        <tr>
                            <th colspan="4">No. Akun</th>
                            <th>Nama Akun</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach($list_coa as $info){ ?>
                        <tr>
                            <td width="5%"><?php if($info->lvl == 1) {echo $info->noakun;} ?></td>
                            <td width="5%"><?php if($info->lvl == 2) {echo $info->noakun;} ?></td>
                            <td width="5%"><?php if($info->lvl == 3) {echo $info->noakun;} ?></td>
                            <td width="10%"><?php if($info->lvl == 4) {echo $info->noakun;} ?></td>
                            <td width="55%"><?= $info->namaakun; ?></td>
                            <td width="20%">
                                <a class="btn btn-sm btn-primary" href="javascript:void(0)" title="Edit" onclick="window.location.href='<?= $load_url; ?>?id=<?= $info->akunid; ?>'"><i class="glyphicon glyphicon-pencil"></i> Edit</a>
                                <a class="btn btn-sm btn-danger" href="javascript:void(0)" title="Hapus" onclick="hapus_data('<?= $info->akunid; ?>','<?= $info->namaakun; ?>','<?= $del_url; ?>?id=<?= $info->akunid; ?>')"><i class="glyphicon glyphicon-trash"></i> Delete</a>
                            </td>
                        </tr>
                        <?php } ?>
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </div>
    <script>
        $(function () {
            $('#cmblevel').change(function () {
                var parent = 0;
                var lvl = $(this).val();
                console.log(lvl);
                if (lvl == 1) {
                   document.getElementById('cmbkategori').disabled = true;
                    document.getElementById('cmbkategori').value = "";
                    $.ajaxSetup({
                        type:"POST",
                        url : "<?php echo base_url('master_COA/getParent'); ?>",
                        cache: false
                    });
                    $.ajax({
                        success: function (result) {
                            $("#noakun").val(result);
                            console.log(lvl);
                            console.log(parent);
                        }
                    });
                } else if (lvl >= 2) {
                    document.getElementById('cmbkategori').disabled = false;
                    $.ajaxSetup({
                        type:"POST",
                        url : "<?php echo base_url('master_COA/getKategori'); ?>",
                        cache: false
                    });
                    $.ajax({
                        data : {lvl:lvl},
                        success: function (kategori) {
                            $("#cmbkategori").html(kategori);
                        }
                    });
                    document.getElementById('noakun').value = '';
                }
            });
        });

    </script>
    <!-- /.row -->

<?php include_once 'layout_admin_bottom.php'; ?>