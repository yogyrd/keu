<?php
$admin_page_title = 'Master User';
$admin_page_breadcrumb = 'Lokasi : '.ucfirst($this->session->userdata('location'));
include_once 'layout_admin_top.php';
$baseurl = base_url() . "master_user";
if ($link == $baseurl || $link == $baseurl . '/') {
    $data = 0;
}
$tgl = date('Y-m-d H:i:s');
?>

    <div class="row">
        <div class="col-sm-12">
            <div id="form" class="panel panel-default panel-sm">
                <div class="panel-heading"><b>Input User</b></div>
                <div class="panel-body">
                    <form action="<?= $baseurl . '/save'; ?>" method="post">
                        <table class="table table-condensed">
                            <tr>
                                <td style="width:10%;">ID</td>
                                <td>
                                    <div class="col-sm-1">
                                        <input type="text" name="id_user" class="form-control input-sm" value="<?= $data['id_user']; ?>" readonly>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>Username</td>
                                <td>
                                    <div class="col-sm-3">
                                        <input type="text" name="username" id="username" class="form-control input-sm" value="<?= $data['username']; ?>" required>
                                    </div>
                                    <span id="userwarning"><font color="red">*user sudah ada </font></span>
                                </td>
                            </tr>
                            <tr>
                                <td>Password</td>
                                <td>
                                    <div class="col-sm-3">
                                        <input type="text" id="passwd" name="password" class="form-control input-sm" value="" required>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>Confirm Password</td>
                                <td>
                                    <div class="col-sm-3">
                                        <input type="password" id="cfm_passwd" name="confirm_password" class="form-control input-sm" value="" required>
                                    </div>
                                    <span id="passwarning"><font color="red">*password tidak cocok </font></span>
                                </td>
                            </tr>
                            <tr>
                                <td>Lokasi</td>
                                <td>
                                    <div class="col-sm-4">
                                        <select name="location" class="form-control" required>
                                            <option value="">Pilih Lokasi</option>
                                            <?php foreach($list_lokasi as $list){ ?>
                                                <option value="<?= $list->locid; ?>" <?= ($list->locid == $data['location']) ? 'selected':''; ?>><?= $list->locationket; ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>Group User</td>
                                <td>
                                    <div class="col-sm-3">
                                        <select name="group_user" class="form-control" required>
                                            <option value="">Pilih Group</option>
                                            <?php foreach($list_group as $list){ ?>
                                                <option value="<?= $list->id; ?>" <?= ($list->id == $data['group_user']) ? 'selected':''; ?>><?= $list->nama_group; ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>Nama User</td>
                                <td>
                                    <div class="col-sm-6">
                                        <input type="text" name="nama" class="form-control input-sm" value="<?= $data['nama']; ?>" required>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td></td>
                                <td>
                                    <div class="col-sm-6">
                                        <input type="submit" id="btn_simpan" class="btn btn-success btn-sm" value="Simpan">
                                        <a class="btn btn-sm btn-default" href="javascript:void(0)" title="Batal" onclick="window.location.href='<?= base_url() . 'master_user'; ?>'"> Batal</a>
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
                            <th>Username</th>
                            <th>Nama User</th>
                            <th>Lokasi</th>
                            <th>Group User</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach($list_user as $info){ ?>
                            <tr>
                                <td><?= $info->username; ?></td>
                                <td><?= $info->nama; ?></td>
                                <td><?= $info->locationket; ?></td>
                                <td><?= $info->nama_group; ?></td>
                                <td>
                                    <a class="btn btn-sm btn-primary" href="javascript:void(0)" title="Edit" onclick="window.location.href='<?= $load_url; ?>?id=<?= $info->id_user; ?>'"><i class="glyphicon glyphicon-pencil"></i> Edit</a>
                                    <a class="btn btn-sm btn-danger" href="javascript:void(0)" title="Hapus" onclick="hapus_data('<?= $info->id_user; ?>','<?= $info->username; ?>','<?= $del_url; ?>?id=<?= $info->id_user; ?>')"><i class="glyphicon glyphicon-trash"></i> Delete</a>
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
<script>
    $(document).ready(function () {
        document.getElementById('userwarning').style.display = 'none';
        document.getElementById('passwarning').style.display = 'none';
    });
    $('#username').change(function () {
        var username = (this).value;
        $.ajax({
            url     : '<?= base_url('master_user/cekUsername'); ?>',
            type    : "POST",
            cache   : false,
            data    : {username:username},
            success : function (result) {
                if(result) {
                    $('#btn_simpan').attr('disabled',true);
                    document.getElementById('userwarning').style.display = 'block';

                } else {
                    document.getElementById('userwarning').style.display = 'none';
                    $('#btn_simpan').attr('disabled',false);
                }
            }

        });
    });
    $('#cfm_passwd').change(function () {
        var cfm_pass = (this).value;
        var pass = document.getElementById('passwd').value;
        if (cfm_pass != pass) {
            $('#btn_simpan').attr('disabled',true);
            document.getElementById('passwarning').style.display = 'block';
        } else {
            $('#btn_simpan').attr('disabled',false);
            document.getElementById('passwarning').style.display = 'none';
        }
    });
    $('#passwd').change(function () {
        var pass = (this).value;
        var cfm_pass = document.getElementById('cfm_passwd').value;
        if (cfm_pass == pass || cfm_pass == '') {
            $('#btn_simpan').attr('disabled',false);
            document.getElementById('passwarning').style.display = 'none';
        } else {
            $('#btn_simpan').attr('disabled',true);
            document.getElementById('passwarning').style.display = 'block';
        }
    });
</script>

<?php include_once 'layout_admin_bottom.php'; ?>