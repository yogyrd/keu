<?php
$admin_page_title = '';
$admin_page_breadcrumb = '';
include_once 'layout_admin_top.php';
$locid = $this->input->get('locid');
$tgloption = $this->input->get('tgloption');
$tgl1 = $this->input->get('tgl1');
$tgl2 = $this->input->get('tgl2'); 
$CI =& get_instance();
$CI->load->model('M_Master_lokasi','mlokasi');
$CI->load->model('M_Master_user','muser');
?>

    <div class="row">
        <div class="col-sm-12">
            <a class="btn btn-sm btn-success" href="<?php if($app1) {echo base_url('approval_1');} if($app2) {echo base_url('approval_2');} if($app3) {echo base_url('approval_3');}  ?>" title="Batal"><i class="glyphicon glyphicon-chevron-left"></i> Kembali</a>
            <span class="help-block"></span>
            <div class="panel panel-info">
                <div class="panel-heading">
                    <h3 class="panel-title">Daftar Transaksi</h3>
                </div>
                <div class="panel-body">
                    <table id="tabel_trans_kas" class="table table-bordered table-hover table-condensed table-striped">
                        <thead>
                        <tr>
                            <th width="5%">Kode Transaksi</th>
                            <th width="8%">Tanggal Input</th>
                            <th width="10%">Jenis</th>
                            <th width="15%">Keterangan</th>
                            <th width="8%">Lokasi</th>
                            <th width="8%">Tanggal Transaksi</th>
                            <th width="10%">Nomor Faktur</th>
                            <th width="10%">Nominal Pengajuan</th>
                            <th width="8%">Tanggal Approve</th>
                            <th width="8%">Approved By</th>
                            <th width="10%">Nominal Realisasi</th>
                            <th width="10%">Keterangan Realisasi</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach($list as $info){ ?>
                            <tr>
                                <td><?= $info->notrans; ?></td>
                                <td><?= date('Y-m-d',strtotime($info->createddate)); ?></td>
                                <td><?= $info->jenis; ?></td>
                                <td><?= $info->keterangan; ?></td>
                                <td><?= $CI->mlokasi->getLokasiById($info->loc); ?></td>
                                <td><?= date('Y-m-d',strtotime($info->transtgl)); ?></td>
                                <td><?= $info->nomorfaktur; ?></td>
                                <td align="right"><?php $rp = number_format($info->nilaiuang,0,',','.'); echo 'Rp '.$rp;?></td>
                                <td><?= date('Y-m-d',strtotime($info->acc1date)); ?></td>
                                <td>
                                    <?php
                                    if ($app1) {
                                        echo $CI->muser->getUserById($info->acc1by); 
                                    }
                                    if ($app2) {
                                        echo $CI->muser->getUserById($info->acc2by); 
                                    }
                                    if ($app3) {
                                        echo $CI->muser->getUserById($info->acc3by); 
                                    }
                                    ?>
                                </td>
                                <td align="right"><?php $rp = number_format($info->realisasi,0,',','.'); echo 'Rp '.$rp;?></td>
                                <td><?= $info->realisasiket; ?></td>
                            </tr>
                        <?php } ?>
                        </tbody>
                    </table>
                </div>
                <script>

                </script>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function () {
           $('#tabel_trans_kas').dataTable({
                paginate:false,
                search:true,
                sort:true
            }); 
        });
    </script>
    <!-- /.row -->

<?php include_once 'layout_admin_bottom.php'; ?>