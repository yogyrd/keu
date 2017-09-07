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
$list_jenis = [];


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
                                <div class="col-md-6">
                                    <select id="cmbloc" name="loc" class="form-control" required>
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
                                <select id="cmbloc" name="loc" class="form-control" required>
                                    <option value="<?= $locid; ?>" hidden></option>
                                </select>
                            </td>
                        </tr>
                        <?php } ?>
                        <tr>
                            <td>Group Jenis Pengeluaran</td>
                            <td>
                                <div class="col-md-4">
                                    <select id="cmbcostid" class="form-control">
                                        <option value="">Pilih Group Jenis Pengeluaran</option>
                                    </select>
                                    <span class="help-block"></span>
                                </div>
                                <div class="col-sm-1">
                                    Biaya Maksimal
                                </div>
                                <div class="col-sm-3">
                                    <div class="input-group">
                                        <span class="input-group-addon">Rp </span>
                                        <input type="text" id="nilaigroup_str" class="form-control input-sm" value="" style="text-align: right" readonly/>
                                        <input type="hidden" id="nilaigroup" class="form-control input-sm" value="" style="text-align: right"/>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>Jenis Pengeluaran</td>
                            <td>
                                <div class="col-md-4">
                                    <select id="cmboutid" name="outid" class="form-control">
                                        <option value="">Pilih Jenis Pengeluaran</option>
                                    </select>
                                    <span class="help-block"></span>
                                </div>

                                <div class="col-sm-1">
                                    Biaya Maksimal
                                </div>
                                <div class="col-sm-3">
                                    <div class="input-group">
                                        <span class="input-group-addon">Rp </span>
                                        <input type="hidden" id="nilaidetail" class="form-control input-sm" value="" style="text-align: right" readonly/>
                                        <input type="text" id="nilaidetail_str" class="form-control input-sm" value="" style="text-align: right" readonly/>
                                    </div>
                                </div>

                                <h4 style="color: red">Sisa Saldo : <span id="sisaplafon_str"></span> </h4>
                                <input type="hidden" id="sisaplafon" value="" />
                            </td>
                        </tr>
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
                                <div class="modal" id="MessageBox" role="dialog">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5>Apakah anda mau menyimpan transaksi ini?</h5>
                                            </div>
                                            <div class="modal-body">
                                                <p id="nilaiuanginfo"></p>
                                                <p id="plafongroup"></p>
                                                <p id="plafondetil"></p>
                                            </div>
                                            <div class="modal-footer">
                                                <input type="submit" id="btnsimpan" class="btn btn-success btn-sm pull-left" value="Simpan" />
                                                <input type="button" class="btn btn-danger btn-sm pull-left" data-dismiss="modal" value="Batal" />
                                            </div>
                                        </div>
                                    </div>
                                </div>
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

    <script type="text/javascript">
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
//                                            myLibrary.formatMoney = function(number, places, symbol, thousand, decimal) {
        /* as above */
        //                                    }

        function cekRealisasi() {
            var maxgroup = document.getElementById("nilaigroup").value;
            var maxdetail = document.getElementById("nilaidetail").value;
            var nilaiuang = document.getElementById("nilaiuang").value;
            var saldo = document.getElementById("sisaplafon").value;
            var text;
            console.log(saldo);
            console.log(nilaiuang);
            if (nilaiuang <= saldo) {
                if(nilaiuang <= maxdetail) {
                    if (nilaiuang <= maxgroup) {
                        text = "Nominal Pengajuan : " + formatMoney(nilaiuang) + "<br> Nominal Plafon Group : " + formatMoney(maxgroup) + "<br> Nominal Plafon Detil : " + formatMoney(maxdetail);
                    }
                    else if (nilaiuang >= maxgroup) {
                        document.getElementById("btnsimpan").disabled = true;
                        text = "Nominal pengajuan melebihi maksimal biaya group ";
                    }
                }
                else if(nilaiuang >= maxdetail) {
                    document.getElementById("btnsimpan").disabled = true;
                    text = "Nominal pengajuan melebihi maksimal biaya detail ";
                }
            }
            else if(nilaiuang >= saldo) {
                document.getElementById("btnsimpan").disabled = true;
                text = "Nominal pengajuan melebihi saldo ";
            }
            document.getElementById("nilaiuanginfo").innerHTML = text;
        }
        $(function () {
            $('#cmbloc').change(function () {
                var locid = $(this).val();
                console.log(locid);
                if (locid >0) {
                    $.ajaxSetup({
                        type:"POST",
                        url: "<?php echo base_url('trans_kas/loadJenis') ?>",
                        cache: false
                    });
                    $.ajax({
                        data : {modul:'groupjenis', id:locid},
                        success: function (respond) {
                            $("#cmbcostid").html(respond);
                            console.log(respond);
                        }
                    });
                }

            });
            $('#cmbcostid').change(function () {
                var locid = $('#cmbloc').val();
                var costid = $(this).val();
                console.log(costid);
                if(costid > 0) {
                    $.ajax({
                        data : {modul:'jenis',locid:locid,costid:costid},
                        success: function (respond) {
                            $("#cmboutid").html(respond);
                            console.log(respond);
                        }
                    });
                }
            });
            $('#cmbcostid').change(function () {
                var locid = $('#cmbloc').val();
                var costid = $(this).val();
                if(costid > 0) {
                    $.ajaxSetup({
                        type:"POST",
                        url : "<?php echo base_url('trans_kas/loadNilaimax'); ?>",
                        cache: false
                    });
                    $.ajax({
                        data : {nilaimax:'groupjenis',locid:locid,costid:costid},
                        success: function (result) {
                            $("#nilaigroup").val(result);
                            console.log(result);
                            var textmaxgroup = formatMoney(result);
                            $("#nilaigroup_str").val(textmaxgroup);
                        }
                    });
                }
            });
            $('#cmboutid').change(function () {
                var locid = $('#cmbloc').val();
                var costid = $('#cmbcostid').val();
                var outid = $(this).val();
                if(outid > 0) {
                    $.ajax({
                        data : {nilaimax:'jenis',locid:locid,costid:costid,outid:outid},
                        success: function (result) {
                            $("#nilaidetail").val(result);
                            console.log(result);
                            var textmaxdetil = formatMoney(result);
                            $("#nilaidetail_str").val(textmaxdetil);
                        }
                    });
                }
            });
            var saldo;
            $('#cmboutid').change(function () {
                var locid = $('#cmbloc').val();
                var costid = $('#cmbcostid').val();
                var outid = $(this).val();
                if(outid > 0) {
                    $.ajaxSetup({
                        type:"POST",
                        url : "<?php echo base_url('trans_kas/loadTotalPengeluaran'); ?>",
                        cache: false
                    });
                    $.ajax({
                        data : {total:'pengeluaran',locid:locid,costid:costid,outid:outid},
                        success: function (result) {
                            var total = result;
                            console.log(total);
                            var nilaimaxgroup = document.getElementById("nilaigroup").value;
                            console.log(nilaimaxgroup);
                            saldo = nilaimaxgroup - total;
                            console.log(saldo);
                            $("#sisaplafon").val(saldo);
                            var span = document.getElementById("sisaplafon_str");
                            var txt = document.createTextNode(formatMoney(saldo));
                            span.innerText = txt.textContent;
                        }
                    });
                }
            });
        });


    </script>
</div>
<!-- /.row -->

<?php include_once 'layout_admin_bottom.php'; ?>