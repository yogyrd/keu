<?php
$admin_page_title = 'Approval 2 Penerimaan Kadiv. Keu';
$admin_page_breadcrumb = 'Lokasi : '.ucfirst($this->session->userdata('location'));
include_once 'layout_admin_top.php';


?>

    <div class="row">
        <div class="col-sm-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">Daftar Transaksi</h3>
                </div>

                <form action="<?= base_url('approval_2'); ?>" method="post">
                    <div class="col-md-3" style="margin-top: 10px;">
                        <select name="filter_loc" class="form-control">
                            <option value="">Semua Lokasi</option>
                            <?php foreach($list_lokasi as $list){ ?>
                                <option value="<?= $list->locid; ?>"><?= $list->locationket; ?></option>
                            <?php } ?>
                        </select>
                        <span class="help-block"></span>
                    </div>
                    <input type="submit" class="btn btn-success btn-sm" value="Filter" style="margin-top: 10px;">
                </form>
                <div class="panel-body">
                    <div class="label label-info" style="font-size: medium;">Location : <?= $location; ?></div>
                </div>

                <form action="<?= base_url(); ?>" method="post">
                    <div class="panel-body">
                        <table id="tabel_trans_kas" class="table table-bordered table-striped">
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>Tanggal</th>
                                <th>Jenis</th>
                                <th>Mesin</th>
                                <th>Kartu</th>
                                <th>Nominal Penerimaan</th>
                                <th>Lokasi</th>
                                <th>All <input type="checkbox" onchange="checkAll(this)"/></th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php foreach($list_trans as $info){ ?>
                                <tr>
                                    <td><?= $info->incomeid; ?></td>
                                    <td><?= date('Y-m-d',strtotime($info->inctgl)); ?></td>
                                    <td><?= $info->jenis; ?></td>
                                    <td><?= $info->mesin; ?></td>
                                    <td><?= $info->kartu; ?></td>
                                    <td><?php $rp = number_format($info->incnilai,2,',','.'); echo 'Rp '.$rp;?></td>
                                    <td><?= $info->loc; ?></td>
                                    <td>
                                        <label>
                                            <input type="checkbox" name="editstatus[]" value="<?= $info->incomeid; ?>" checked/>
                                        </label>
                                    </td>
                                </tr>
                            <?php } ?>
                            </tbody>
                        </table>
                        <input type="submit" name="update" class="btn btn-primary btn-sm pull-right" value="APPROVE ALL" style="font-size: large; margin-right: 15px;">
                    </div>
                </form>
                <!--                --><?php
                //                echo '<pre>';
                //               print_r($_POST);
                //                    if(isset($_POST['update'])) {
                //                        if(!empty($_POST['editstatus'])) {
                //                            $selec = 1;
                //                            foreach ($_POST['editstatus'] as $id) {
                //
                //                                echo 'nilai = ' . $_POST['real_'.$id] . "<br />";
                //                            }
                //                        }
                //                    }
                //                ?>
                <script>

                </script>
            </div>
        </div>
    </div>

    <script>

    </script>
    <!-- /.row -->

<?php include_once 'layout_admin_bottom.php'; ?>