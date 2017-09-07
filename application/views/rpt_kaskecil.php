<?php
$admin_page_title = 'Laporan Kas Kecil';
$admin_page_breadcrumb = 'Lokasi Anda : '.ucfirst($this->session->userdata('location'));
include_once 'layout_admin_top.php';
$baseurl = base_url() . '/rpt_kaskecil';
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
                        <tr>
                            <td style="width:10%;" align="right">Opsi</td>
                            <td>
                                <div class="col-md-5">
                                    <select id="option" class="form-control">
                                        <option value="1">Kas Kecil Belum Terealisasi</option>
                                        <option value="2">Kas Kecil Terealisasi</option>
                                    </select>
                                    <span class="help-block"></span>
                                </div>
                            </td>
                        </tr>
                        <?php
                        if ($this->session->userdata('grp') < 4) {
                            ?>
                            <tr>
                                <td align="right">Lokasi</td>
                                <td>
                                    <div class="col-md-6">
                                        <select id="locid" class="form-control">
                                            <option value="">Semua Lokasi</option>
                                            <?php foreach ($list_lokasi as $list) { ?>
                                                <option value="<?= $list->locid; ?>"><?= $list->locationket; ?></option>
                                            <?php } ?>
                                        </select>
                                        <br/>
                                    </div>
                                </td>
                            </tr>
                            <?php
                        } else {
                            ?>
                            <input type="hidden" value="<?= $this->session->userdata('locid'); ?>" id="locid"/>

                            <?php
                        }
                        ?>
                        <tr>
                            <td align="right">Pilih Tanggal</td>
                            <td>
                                <div class="col-md-4">
                                    <select id="tgloption" class="form-control" required>
                                        <option value="">Pilih Opsi Tanggal</option>
                                        <option value="createddate">Tanggal Input</option>
                                        <option value="transtgl">Tanggal Transaksi</option>
                                        <option value="realisasidate">Tanggal Realisasi</option>
                                    </select>
                                    <span class="help-block"></span>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td align="right"></td>
                            <td>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <div class='input-group date dt_date'>
                                            <input id="tgl1" type='text' class="form-control" placeholder="yyyy-MM-dd"/>
                                            <span class="input-group-addon">
                                            <span class="glyphicon glyphicon-calendar"></span>
                                        </span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-1">
                                    <h5><center>s/d</center></h5>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <div class='input-group date dt_date'>
                                            <input id="tgl2" type='text' class="form-control" placeholder="yyyy-MM-dd"/>
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
                                    <a class="btn btn-sm btn-success" href="javascript:void(0)" title="View" onclick="filter()"><i class="glyphicon glyphicon-eye-open"></i>  View</a>
                                    <a class="btn btn-sm btn-default" href="javascript:void(0)" title="Batal" onclick="window.location.href='<?= base_url() . 'rpt_kaskeluar'; ?>'"> Reset</a>
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
            var locid = document.getElementById('locid').value;
            var option = document.getElementById('option').value;
            var tgloption = document.getElementById('tgloption').value;
            var tgl1 = document.getElementById('tgl1').value;
            var tgl2 = document.getElementById('tgl2').value;
            if (option =="" || tgloption == "" || tgl1 == "" || tgl2 == "") {
                alert('Form harus dilengkapi!!');
            }
            else if (tgl2 < tgl1) {
                alert('Tanggal awal harus lebih kecil dari tanggal akhir!!');
            } else {
                window.open('<?= base_url() . 'rpt_kaskecil'; ?>' + '/filter?locid='+ locid + '&option=' + option + '&tgloption=' + tgloption + '&tgl1=' + tgl1 + '&tgl2=' +tgl2);
            }
        }
    </script>
    <!-- /.row -->

<?php include_once 'layout_admin_bottom.php'; ?>