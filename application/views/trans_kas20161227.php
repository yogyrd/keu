<?php 
$admin_page_title = 'Transaksi Kas Pengeluaran';
$admin_page_breadcrumb = '';
include_once 'layout_admin_top.php';
$link = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
$baseurl = base_url() . "trans_kas";
if ($link == $baseurl) {
    $data = 0;
}
$user = ucfirst($this->session->userdata('id'));
$loc = strtoupper(ucfirst($this->session->userdata('location')));
$locid = strtoupper(ucfirst($this->session->userdata('locid')));


?>

<div class="row">
    <div class="col-sm-12">
        <div id="form" class="panel panel-default panel-sm">
            <div class="panel-heading"><b>Input Transaksi</b></div>
            <div class="panel-body">
                <form action="<?= $submit_url; ?>" method="post">
                    <table class="table table-condensed">
                        <input type="hidden" name="createby" value="<?= $user; ?>" />
                        <tr>
                            <td style="width:10%;">Trans ID</td>
                            <td>
                                <div class="col-sm-2">
                                    <input type="text" name="transoutid" class="form-control input-sm" value="<?= $data['transoutid']; ?>" maxlength="5" size="5" readonly required/>
                                </div>
                            </td>
                        </tr>
                        <?php if (ucfirst($this->session->userdata('grp')) < 4) { ?>
                        <tr>
                            <td>Lokasi</td>
                            <td>
                                <div class="col-md-3">
                                    <select name="loc" class="form-control">
                                        <option value="">Pilih Lokasi</option>
                                        <?php foreach($lokasi as $list){ ?>
                                        <option value="<?= $list->locid; ?>" <?= ($list->locid == $data['loc']) ? 'selected':''; ?>><?= $list->locationket; ?></option>
                                        <?php } ?>
                                    </select>
                                    <span class="help-block"></span>
                                </div>
                            </td>
                        </tr>
                        <?php } else { ?>
                        <tr>
                            <td></td>
                            <td>
                                <input type="hidden" name="loc" value="<?= $locid; ?>" />
                            </td>
                        </tr>
                        <?php } ?>
                        <tr>
                            <td>Tanggal Transaksi</td>
                            <td>
                                <div class="col-sm-3">
                                    <div class="form-group">
                                        <div class='input-group date dt_date'>
                                            <input name="transtgl" type='text' class="form-control" value="<?= $data['transtgl']; ?>" id="tgl_trans" placeholder="yyyy-MM-dd" required/>
                                            <span class="input-group-addon">
                                                <span class="glyphicon glyphicon-calendar"></span>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>Jenis Pengeluaran</td>
                            <td>
                                <div class="col-sm-4">
                                    <input type="hidden" name="outid" id="outid" value="<?= $data['outid']; ?>" required/>
                                    <input type="text" id="jenis" class="form-control input-sm" value="" readonly/>
                                </div>


                                <div class="col-sm-1">
                                    Biaya Maksimal
                                </div>
                                <div class="col-sm-2">
                                    <div class="input-group">
                                        <span class="input-group-addon">Rp </span>
                                        <input type="text" id="maxbiaya" class="form-control input-sm" value="" style="text-align: right" readonly/>
                                    </div>
                                </div>
                                <input type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#myModal" value="Find Jenis Pengeluaran" >
                            </td>
                        </tr>
                        <tr>
                            <td>Group Jenis Pengeluaran</td>
                            <td>
                                <div class="col-sm-4">
                                    <input type="text" id="costjenis" class="form-control input-sm" value="" readonly/>
                                </div>


                                <div class="col-sm-1">
                                    Biaya Maksimal
                                </div>
                                <div class="col-sm-2">
                                    <div class="input-group">
                                        <span class="input-group-addon">Rp </span>
                                        <input type="text" id="nilaigroup" class="form-control input-sm" value="" style="text-align: right" readonly/>
                                    </div>
                                </div>
                                <h4 style="color: red">Sisa Plafon : Rp <label id="sisaplafon"></label> </h4>
                            </td>
                        </tr>
                        <tr>
                            <td>Tanggal Beban</td>
                            <td>
                                <div class="col-sm-3">
                                    <div class="form-group">
                                        <div class='input-group date dt_date'>
                                            <input name="bebantgl" type='text' class="form-control" value="<?= $data['bebantgl']; ?>" placeholder="yyyy-MM-dd" required/>
                                            <span class="input-group-addon">
                                                <span class="glyphicon glyphicon-calendar"></span>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>Jumlah</td>
                            <td>
                                <div class="col-sm-3">
                                    <div class="input-group">
                                        <span class="input-group-addon">Rp </span>
                                        <input type="number" name="nilaiuang" id="nilaiuang" class="form-control input-sm" value="<?= $data['nilaiuang']; ?>" required>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>Keterangan</td>
                            <td>
                                <div class="col-sm-6">
                                    <input type="text" name="keterangan" class="form-control input-sm" value="<?= $data['keterangan']; ?>" required>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>Nomor Faktur</td>
                            <td>
                                <div class="col-sm-3">
                                    <input type="text" name="nomorfaktur" class="form-control input-sm" value="<?= $data['nomorfaktur']; ?>">
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td></td>
                            <td>
                                <div class="col-sm-6">
<!--                                    <input type="submit" class="btn btn-success btn-sm" value="Simpan">-->
                                    <input type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#MessageBox" value="Simpan" onclick="cekRealisasi()">
                                    <a class="btn btn-sm btn-default" href="javascript:void(0)" title="Batal" onclick="window.location.href='<?= base_url() . 'trans_kas'; ?>'"> Batal</a>
                                </div>
                                <div class="modal fade" id="MessageBox" role="dialog">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5>Apakah anda mau menyimpan transaksi ini?</h5>
                                            </div>
                                            <div class="modal-body">
                                                <p id="nilaiuang"></p>
<!--                                                <p id="plafondetil"></p>-->
                                            </div>
                                            <div class="modal-footer">
                                                <input type="submit" class="btn btn-success btn-sm pull-left" value="Simpan" />
                                                <input type="button" class="btn btn-danger btn-sm pull-left" data-dismiss="modal" value="Batal" />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <script>
                                    function formatMoney(number, places, symbol, thousand, decimal) {
                                        number = number || 0;
                                        places = !isNaN(places = Math.abs(places)) ? places : 2;
                                        symbol = symbol !== undefined ? symbol : "Rp ";
                                        thousand = thousand || ".";
                                        decimal = decimal || ",";
                                        var negative = number < 0 ? "-" : "",
                                            i = parseInt(number = Math.abs(+number || 0).toFixed(places), 10) + "",
                                            j = (j = i.length) > 3 ? j % 3 : 0;
                                        return symbol + negative + (j ? i.substr(0, j) + thousand : "") + i.substr(j).replace(/(\d{3})(?=\d)/g, "$1" + thousand) + (places ? decimal + Math.abs(number - i).toFixed(places).slice(2) : "");
                                    }

                                    // To create it as a library method:
                                    myLibrary.formatMoney = function(number, places, symbol, thousand, decimal) {
                                        /* as above */
                                    }

                                    function cekRealisasi() {
                                        var nilaiuang = document.getElementById("nilaiuang").value;
//                                        var plafondetil = document.getElementById("maxbiaya").value;
                                        document.getElementById("nilaiuang").innerHTML = "Nominal Pengejuan " + formatMoney(nilaiuang);
//                                        document.getElementById("plafondetil").innerHTML = "Nominal Plafon Detil " + formatMoney(plafondetil);
                                    }

                                </script>
                            </td>
                        </tr>
                    </table>
                </form>
            </div>
        </div>

        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">Daftar Transaksi</h3>
            </div>
            <div class="panel-body">
                <table id="tabel_trans_kas" class="table table-bordered table-striped">
                    <thead>
                    <tr>
                        <th>Trans Out ID</th>
                        <th>Jenis</th>
                        <th>Tanggal Transaksi</th>
                        <th>Tanggal Beban</th>
                        <th>Keterangan</th>
                        <th>Lokasi</th>
                        <th>Nominal Pengajuan</th>
                        <th>Realisasi</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach($list_trans as $info){ ?>
                        <tr>
                            <td><?= $info->transoutid; ?></td>
                            <td><?= $model->getJenisPengeluaran($info->outid); ?></td>
                            <td><?= date('Y-m-d',strtotime($info->transtgl)); ?></td>
                            <td><?= date('Y-m-d',strtotime($info->bebantgl)); ?></td>
                            <td><?= $info->keterangan; ?></td>
                            <td><?= $model->getLokasiById($info->loc); ?></td>
                            <td><?php $rp = number_format($info->nilaiuang,2,',','.'); echo 'Rp '.$rp;?></td>
                            <td><?php $rp = number_format($info->realisasi,2,',','.'); echo 'Rp ' .$rp;?></td>
                            <td>
                                <a class="btn btn-sm btn-primary" href="javascript:void(0)" title="Edit" onclick="window.location.href='<?= $load_url; ?>?id=<?= $info->transoutid; ?>'"><i class="glyphicon glyphicon-pencil"></i> Edit</a>
                                <a class="btn btn-sm btn-danger" href="javascript:void(0)" title="Hapus" onclick="hapus_data('<?= $info->transoutid; ?>','<?= $info->keterangan; ?>','<?= $del_url; ?>?id=<?= $info->transoutid; ?>')"><i class="glyphicon glyphicon-trash"></i> Delete</a>
                            </td>
                        </tr>
                    <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <!-- Modal -->
    <div class="modal fade" id="myModal" role="dialog">
        <div class="modal-dialog modal-lg">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Daftar Jenis Pengeluaran</h4>
                </div>


                <div class="modal-body">

                    <ul class="nav nav-tabs">
                        <li class="active"><a href="#tab1" data-toggle="tab">Pengeluaran KAS</a></li>
                        <li><a href="#tab2" data-toggle="tab">Gaji</a></li>
                        <li><a href="#tab3" data-toggle="tab">Persalinan</a></li>
                        <li><a href="#tab4" data-toggle="tab">TES</a></li>
                    </ul>


                    <div class="tab-content">
                        <div class="tab-pane fade in active" id="tab1">
                            <table id="tabel_modal1" class="table table-bordered table-hover table-striped" style="cursor:pointer;">
                                <thead>
                                <tr>
                                    <th>Pengeluaran ID</th>
                                    <th>Lokasi</th>
                                    <th>Jenis</th>
                                    <th>Keterangan</th>
                                    <th>Nilai Maksimal</th>
                                    <th>Tanggal Awal</th>
                                    <th>Tanggal Akhir</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php foreach($list_1 as $info){ ?>
                                    <tr id="pilih" out_id="<?= $info->outid; ?>" jenis="<?= $info->jenis; ?>" max_biaya="<?= $info->nilaimax_detil; ?>" cost_jenis="<?= $info->costjenis; ?>" nilai_group="<?= $info->nilaimax; ?>">
                                        <td><?= $info->outid; ?></td>
                                        <td><?= $info->locationket; ?></td>
                                        <td><?= $info->jenis; ?></td>
                                        <td><?= $info->keterangan; ?></td>
                                        <td><?php $rp = number_format($info->nilaimax_detil,2,',','.'); echo 'Rp ' .$rp;?></td>
                                        <td><?= $info->start_detil; ?></td>
                                        <td><?= $info->end_detil; ?></td>
                                    </tr>
                                <?php } ?>
                                </tbody>
                            </table>
                        </div>
                        <div class="tab-pane fade" id="tab2">
                            <table id="tabel_modal2" class="table table-bordered table-hover table-striped" style="cursor:pointer;">
                                <thead>
                                <tr>
                                    <th>Pengeluaran ID</th>
                                    <th>Lokasi</th>
                                    <th>Jenis</th>
                                    <th>Keterangan</th>
                                    <th>Nilai Maksimal</th>
                                    <th>Tanggal Awal</th>
                                    <th>Tanggal Akhir</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php foreach($list_2 as $info){ ?>
                                    <tr id="pilih" out_id="<?= $info->outid; ?>" jenis="<?= $info->jenis; ?>" max_biaya="<?= $info->nilaimax_detil; ?>" cost_jenis="<?= $info->costjenis; ?>" nilai_group="<?= $info->nilaimax; ?>">
                                        <td><?= $info->outid; ?></td>
                                        <td><?= $info->locationket; ?></td>
                                        <td><?= $info->jenis; ?></td>
                                        <td><?= $info->keterangan; ?></td>
                                        <td><?php $rp = number_format($info->nilaimax_detil,2,',','.'); echo 'Rp ' .$rp;?></td>
                                        <td><?= $info->start_detil; ?></td>
                                        <td><?= $info->end_detil; ?></td>
                                    </tr>
                                <?php } ?>
                                </tbody>
                            </table>
                        </div>
                        <div class="tab-pane fade" id="tab3">
                            <table id="tabel_modal3" class="table table-bordered table-hover table-striped" style="cursor:pointer;">
                                <thead>
                                <tr>
                                    <th>Pengeluaran ID</th>
                                    <th>Lokasi</th>
                                    <th>Jenis</th>
                                    <th>Keterangan</th>
                                    <th>Nilai Maksimal</th>
                                    <th>Tanggal Awal</th>
                                    <th>Tanggal Akhir</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php foreach($list_3 as $info){ ?>
                                    <tr id="pilih" out_id="<?= $info->outid; ?>" jenis="<?= $info->jenis; ?>" max_biaya="<?= $info->nilaimax_detil; ?>" cost_jenis="<?= $info->costjenis; ?>" nilai_group="<?= $info->nilaimax; ?>">
                                        <td><?= $info->outid; ?></td>
                                        <td><?= $info->locationket; ?></td>
                                        <td><?= $info->jenis; ?></td>
                                        <td><?= $info->keterangan; ?></td>
                                        <td><?php $rp = number_format($info->nilaimax_detil,2,',','.'); echo 'Rp ' .$rp;?></td>
                                        <td><?= $info->start_detil; ?></td>
                                        <td><?= $info->end_detil; ?></td>
                                    </tr>
                                <?php } ?>
                                </tbody>
                            </table>
                        </div>
                        <div class="tab-pane fade" id="tab4">
                            <table id="tabel_modal4" class="table table-bordered table-hover table-striped" style="cursor:pointer;">
                                <thead>
                                <tr>
                                    <th>Pengeluaran ID</th>
                                    <th>Lokasi</th>
                                    <th>Jenis</th>
                                    <th>Keterangan</th>
                                    <th>Nilai Maksimal</th>
                                    <th>Tanggal Awal</th>
                                    <th>Tanggal Akhir</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php foreach($list_4 as $info){ ?>
                                    <tr id="pilih" out_id="<?= $info->outid; ?>" jenis="<?= $info->jenis; ?>" max_biaya="<?= $info->nilaimax_detil; ?>" cost_jenis="<?= $info->costjenis; ?>" nilai_group="<?= $info->nilaimax; ?>">
                                        <td><?= $info->outid; ?></td>
                                        <td><?= $info->locationket; ?></td>
                                        <td><?= $info->jenis; ?></td>
                                        <td><?= $info->keterangan; ?></td>
                                        <td><?php $rp = number_format($info->nilaimax_detil,2,',','.'); echo 'Rp ' .$rp;?></td>
                                        <td><?= $info->start_detil; ?></td>
                                        <td><?= $info->end_detil; ?></td>
                                    </tr>
                                <?php } ?>
                                </tbody>
                            </table>
                        </div>
                        <div class="tab-pane fade" id="tab5">
                            <table id="tabel_modal5" class="table table-bordered table-hover table-striped" style="cursor:pointer;">
                                <thead>
                                <tr>
                                    <th>Pengeluaran ID</th>
                                    <th>Lokasi</th>
                                    <th>Jenis</th>
                                    <th>Keterangan</th>
                                    <th>Nilai Maksimal</th>
                                    <th>Tanggal Awal</th>
                                    <th>Tanggal Akhir</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php foreach($list_5 as $info){ ?>
                                    <tr id="pilih" out_id="<?= $info->outid; ?>" jenis="<?= $info->jenis; ?>" max_biaya="<?= $info->nilaimax_detil; ?>" cost_jenis="<?= $info->costjenis; ?>" nilai_group="<?= $info->nilaimax; ?>">
                                        <td><?= $info->outid; ?></td>
                                        <td><?= $info->locationket; ?></td>
                                        <td><?= $info->jenis; ?></td>
                                        <td><?= $info->keterangan; ?></td>
                                        <td><?php $rp = number_format($info->nilaimax_detil,2,',','.'); echo 'Rp ' .$rp;?></td>
                                        <td><?= $info->start_detil; ?></td>
                                        <td><?= $info->end_detil; ?></td>
                                    </tr>
                                <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

        </div>
    </div>
    <script type="text/javascript">
        $(document).on('click','#pilih', function(e) {
            document.getElementById("outid").value = $(this).attr('out_id');
            document.getElementById("jenis").value = $(this).attr('jenis');
            document.getElementById("maxbiaya").value = $(this).attr('max_biaya');
            document.getElementById("costjenis").value = $(this).attr('cost_jenis');
            document.getElementById("nilaigroup").value = $(this).attr('nilai_group');
            $('#myModal').modal('hide');
        });
        
        function getValueGroupJenisPengeluaran() {
            var x = document.getElementById("group_pengeluaran").value;
            alert(x);
        }
    </script>
</div>
<!-- /.row -->

<?php include_once 'layout_admin_bottom.php'; ?>