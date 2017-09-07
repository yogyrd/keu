<?php
$admin_page_title = 'Laporan Penerimaan';
$admin_page_breadcrumb = 'Lokasi : '.ucfirst($this->session->userdata('location'));
include_once 'layout_admin_top.php';
$baseurl = base_url() . 'penerimaan';
if ($link == $baseurl || $link == $baseurl . '/') {
    $list_trans = 0;
}

?>

    <div class="row">
        <div class="col-sm-12">
            <div id="form" class="panel panel-default panel-sm">
                <div class="panel-heading"><b>Filter</b></div>
                <div class="panel-body">
                    <table>
<!--                        <tr>-->
<!--                            <td align="right">Lokasi</td>-->
<!--                            <td>-->
<!--                                <div class="col-md-6">-->
<!--
<!--                                    <br/>-->
<!--                                </div>-->
<!--                            </td>-->
<!--                        </tr>-->
                        <tr>
                            <td align="right">Tanggal Transaksi</td>
                            <td>
                                <div class="col-md-5">
                                    <div class="form-group">
                                        <div class='input-group date dt_date'>
                                            <input id="tgl1" type='text' class="form-control" id="tgl_trans" placeholder="yyyy-MM-dd" required/>
                                            <span class="input-group-addon">
                                            <span class="glyphicon glyphicon-calendar"></span>
                                        </span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-1">
                                    <h5><center>s/d</center></h5>
                                </div>
                                <div class="col-md-5">
                                    <div class="form-group">
                                        <div class='input-group date dt_date'>
                                            <input id="tgl2" type='text' class="form-control" id="tgl_trans" placeholder="yyyy-MM-dd" required/>
                                            <span class="input-group-addon">
                                            <span class="glyphicon glyphicon-calendar"></span>
                                        </span>
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td></td>
                            <td>
                                <div class="col-sm-6">
                                    <a class="btn btn-sm btn-success" href="javascript:void(0)" title="Cetak" onclick="filter()"><i class="glyphicon glyphicon-eye-open"></i>  View</a>
                                    <a class="btn btn-sm btn-default" href="javascript:void(0)" title="Batal" onclick="resetForm()"> Reset</a>
                                </div>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <script>
        function filter() {
            var tgl1 = document.getElementById('tgl1').value;
            var tgl2 = document.getElementById('tgl2').value;
            if (tgl2 < tgl1) {
                alert('Tanggal akhir harus lebih besar dari tanggal awal')
            } else {
                window.open('<?= base_url() . 'rpt_penerimaan'; ?>' + '/filter?tgl1=' + tgl1 + '&tgl2=' +tgl2);
            }
        }
        
        function resetForm() {
            document.getElementById('tgl1').value = '';
            document.getElementById('tgl2').value = '';
        }
    </script>
    <!-- /.row -->

<?php include_once 'layout_admin_bottom.php'; ?>