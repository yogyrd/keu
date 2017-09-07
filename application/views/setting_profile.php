<?php
$admin_page_title = 'Setting User';
$admin_page_breadcrumb = 'Setting Profile';
include_once 'layout_admin_top.php';
$submit_url = "";
$username = $this->session->userdata('username');
?>

<div class="row">
    <div class="col-lg-12">
        <div id="form" class="panel panel-default panel-sm">
            <div class="panel-heading"><b>Ubah Password</b></div>
            <div class="panel-body">
                <form action="<?= base_url('setting_profile/changePass'); ?>" method="post">
                    <table class="table table-condensed">
                        <tr>
                            <td style="width:10%;">Username</td>
                            <td>
                                <div class="col-sm-2">
                                    <input type="text" name="username" class="form-control input-sm" value="<?= $username; ?>" readonly/>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>Password Baru</td>
                            <td>
                                <div class="col-sm-3">
                                    <input type="password" name="password" class="form-control input-sm" value="" required>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>Confirmasi Password</td>
                            <td>
                                <div class="col-sm-3">
                                    <input type="password" name="confirm_password" class="form-control input-sm" value="" >
                                </div>
                                <?php if($this->session->flashdata('error_message')!="") { ?>
                                    <h5 style="color: #FF0000;"><strong><?= $this->session->flashdata('error_message');?></strong></h5>
                                <?php } ?>
                            </td>

                        </tr>
                        <tr>
                            <td></td>
                            <td>
                                <div class="col-sm-6">
                                    <input type="submit" class="btn btn-success btn-sm" value="Simpan">
                                    <a class="btn btn-sm btn-default" href="javascript:void(0)" title="Batal" onclick="window.location.href='<?= base_url(); ?>'"> Batal</a>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td></td>
                            <td>
                                <?php if($this->session->flashdata('message')!="") { ?>
                                    <div class="alert alert-success alert-dismissible col-sm-5" role="alert" align="center">
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                        <h4><?= $this->session->flashdata('message');?></h4>
                                    </div>
                                <?php } ?>
                            </td>
                        </tr>
                    </table>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- /.row -->

<?php include_once 'layout_admin_bottom.php'; ?>

