<?php 
$admin_page_title = 'Transaksi Kas Pengeluaran';
$admin_page_breadcrumb = 'Lokasi : ' . $this->session->userdata('location');
include_once 'layout_admin_top.php';
$baseurl = base_url() . "trans_kas";
if ($link == $baseurl || $link == $baseurl.'/') {
    $data = 0;
}
$loc = strtoupper(ucfirst($this->session->userdata('location')));
$locid = strtoupper(ucfirst($this->session->userdata('locid')));

$get_name_location = '';
$get_jenis = '';
$get_status_pengajuan = '';
$get_outid = '';
$get_costid = '';
$get_costjenis = '';
$get_nilaimax = '';
$get_nilaimaxgroup = '';
if(trim($data['transoutid']) !== ''){
    $get_name_location = $model->getLocation($data['loc']);
    $get_jenis = $model->getJenis($data['nilaidetailid']);
    $get_status_pengajuan = $model->getStatusPengajuan($data['nilaidetailid']);
    $get_outid = $model->getOutId($data['nilaidetailid']);
    $get_costjenis = $model->getCostJenis($data['transoutid']);
    $get_costid = $model->getCostId($data['nilaidetailid']);
    $get_nilaimax = $model->getNilaiMaxDetail($data['nilaidetailid']);
    $get_nilaimaxgroup = $model->getNilaiMaxGroup($get_costid);

}

?>

<div class="row">
    <div class="col-sm-12">
        <div id="form" class="panel panel-default panel-sm">
            <div class="panel-heading"><b>Input Transaksi</b></div>
            <div class="panel-body">
                <h4 style="color: red">Sisa Saldo Kas Kecil: <span id="sisaplafon_str"></span> </h4>
                <input type="hidden" id="sisaplafon" value="" />
                <form action="<?= $submit_url; ?>" method="post">
                    <table class="table table-condensed">
                        <tr>
                            <td style="width:10%;">Trans ID</td>
                            <td>
                                <div class="col-sm-2">
                                    <input type="hidden" name="transoutid" value="<?= $data['transoutid'] ?>" />
                                    <input type="text" class="form-control input-sm" value="<?= $data['notrans'] ?>" size="5" readonly required/>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>Group Jenis Pengeluaran</td>
                            <td>
                                <div class="col-md-4">
                                    <input type="hidden" class="form-control input-sm" id="costid" value="<?= $get_costid; ?>" readonly required/>
                                    <input type="text" class="form-control input-sm" id="costjenis" value="<?= $get_costjenis; ?>" readonly required/>
                                    <input type="hidden" class="form-control input-sm" id="pengajuan" value="<?= $get_status_pengajuan; ?>" readonly required/>
                                </div>
                                <div class="col-sm-1">
                                    Biaya Maksimal
                                </div>
                                <div class="col-sm-3">
                                    <div class="input-group">
                                        <span class="input-group-addon">Rp </span>
                                        <input type="hidden" class="form-control input-sm" id="nilaimaxgroup" value="<?= $get_nilaimaxgroup; ?>" style="text-align: right" readonly/>
                                        <input type="text" class="form-control input-sm" id="strnilaimaxgroup" value="" style="text-align: right" readonly/>
                                    </div>
                                </div>
                                <input type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#list_jenis" value="Cari Jenis Pengeluaran">
                            </td>
                        </tr>
                        <tr>
                            <td>Jenis Pengeluaran</td>
                            <td>
                                <div class="col-md-4">
                                    <input type="hidden" class="form-control input-sm" id="outid" value="<?= $get_outid; ?>" readonly/>
                                    <input type="text" class="form-control input-sm" id="jenis" value="<?= $get_jenis; ?>" readonly/>
                                    <input type="hidden" class="form-control input-sm" id="nilaidetailid" name="nilaidetailid" value="<?= $data['nilaidetailid'] ?>" readonly/>
                                </div>

                                <div class="col-sm-1">
                                    Biaya Maksimal
                                </div>
                                <div class="col-sm-3">
                                    <div class="input-group">
                                        <span class="input-group-addon">Rp </span>
                                        <input type="hidden" class="form-control input-sm" id="nilaimax" value="<?= $get_nilaimax; ?>" style="text-align: right" readonly/>
                                        <input type="text" class="form-control input-sm" id="strnilaimax" value="" style="text-align: right" readonly/>
                                    </div>
                                </div>

                                
                            </td>
                        </tr>
                        <tr>
                            <td>Lokasi</td>
                            <td>
                                <div class="col-sm-5">
                                    <input type="text" class="form-control input-sm" id="lokasi" value="<?= $get_name_location; ?>" readonly/>
                                    <input type="hidden" class="form-control input-sm" id="locid" name="loc" value="<?= $data['loc'] ?>" readonly/>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>Tanggal Transaksi</td>
                            <td>
                                <div class="col-sm-3">
                                    <div class="form-group">
                                        <div class='input-group date dt_date'>
                                            <input name="transtgl" type='text' class="form-control" value="<?= $data['transtgl'] ?>" id="tgl_trans" placeholder="yyyy-MM-dd" required/>
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
                                            <input name="bebantgl" type='text' class="form-control" value="<?= $data['bebantgl'] ?>" id="tgl_beban" placeholder="yyyy-MM-dd" required/>
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
                                        <input type="text" id="strnilaiuang" class="form-control input-sm" value="<?= $data['nilaiuang'] ?>" required>
                                        <input type="hidden" name="nilaiuang" id="nilaiuang" class="form-control input-sm" value="<?= $data['nilaiuang'] ?>" required>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>Keterangan</td>
                            <td>
                                <div class="col-sm-6">
                                    <input type="text" id="keterangan" name="keterangan" class="form-control input-sm" value="<?= $data['keterangan'] ?>" required>
                                </div>
                                <font color="red">*dilarang menggunakan karakter (') atau (") </font>
                            </td>
                        </tr>
                        <tr>
                            <td>Pembayaran</td>
                            <td>
                                <div class="col-sm-2">
                                    <select class="form-control" id="metode_bayar">
                                        <option value="0">TUNAI</option>
                                        <option value="1">TRANSFER</option>
                                    </select>
                                    <span class="help-block"></span>
                                </div>
                                <div id="bayar_trf">
                                    <div class="col-sm-6">
                                        <div class="input-group">
                                            <span class="input-group-addon" id="basic-addon1">ke</span>
                                            <input type="hidden" id="supp_id" name="supplierid" value="1"/>
                                            <input type="text" id="supp_id_ac" class="form-control input-sm-5 input_ac" placeholder="isi nama supplier/nomor rekening/nama rekening tujuan di sini..." aria-describedby="basic-addon1" value="">
                                            <span></span>
                                        </div>
                                    </div>
                                    <font color="red">Jika tidak ada, ajukan supplier baru ke keuangan</font>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>Nomor Faktur</td>
                            <td>
                                <div class="col-sm-3">
                                    <input type="text" id="nomorfaktur" name="nomorfaktur" class="form-control input-sm" value="<?= $data['nomorfaktur'] ?>" required>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td></td>
                            <td>
                                <div class="col-sm-6">
<!--                                    <input type="submit" class="btn btn-success btn-sm" value="Simpan">-->
                                    <input type="button" id="btncek" class="btn btn-info btn-sm" data-toggle="modal" data-target="#MessageBox" value="Simpan" onclick="cekRealisasi()">
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
                <ul class="nav nav-tabs nav-justified">
                    <li class="active"><a href="#tab_data1" data-toggle="tab">Kas Kecil</a></li>
                    <li><a href="#tab_data2" data-toggle="tab">Pengajuan</a></li>
                </ul>

                <div class="tab-content">
                    <div class="tab-pane active" id="tab_data1">
                        <table id="tabel_listkaskecil" class="table table-bordered table-hover table-striped" style="cursor:pointer;">
                            <thead>
                            <tr>
                                <th width="3%">Kode</th>
                                <th width="10%">Jenis</th>
                                <th width="10%">Tanggal Transaksi</th>
                                <th width="10%">Tanggal Beban</th>
                                <th width="10%">Keterangan</th>
                                <th width="10%">Lokasi</th>
                                <th width="10%">Nominal Pengajuan</th>
                                <th width="10%">Budget</th>
                                <th width="7%">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php foreach($list_transkaskecil as $info){ ?>
                                <tr>
                                    <td><?= $info->notrans; ?></td>
                                    <td><?= $info->jenis; ?></td>
                                    <td><?= date('Y-m-d',strtotime($info->transtgl)); ?></td>
                                    <td><?= date('Y-m-d',strtotime($info->bebantgl)); ?></td>
                                    <td><?= $info->keterangan; ?></td>
                                    <td><?= $info->locationket; ?></td>
                                    <td align="right"><?php $rp = number_format($info->nilaiuang,2,',','.'); echo 'Rp '.$rp;?></td>
                                    <td align="right"><?php $rp = number_format($info->nilaimax,2,',','.'); echo 'Rp ' .$rp;?></td>
                                    <td>
<a class="btn btn-sm btn-primary" href="javascript:void(0)" title="Edit" onclick="window.location.href='<?= $load_url; ?>?id=<?= $info->transoutid; ?>'"><i class="glyphicon glyphicon-pencil"></i> Edit</a>
                                        <a class="btn btn-sm btn-danger" href="javascript:void(0)" title="Hapus" onclick="hapus_data('<?= $info->transoutid; ?>','<?= $info->keterangan; ?>','<?= $del_url; ?>?id=<?= $info->transoutid; ?>')"><i class="glyphicon glyphicon-trash"></i> Delete</a>
                                    </td>
                                </tr>
                            <?php } ?>
                            </tbody>
                        </table>
                    </div>
                    <div class="tab-pane" id="tab_data2">
                        <table id="tabel_listpengajuan" class="table table-bordered table-hover table-striped" style="cursor:pointer;">
                            <thead>
                            <tr>
                                <th width="3%">Kode</th>
                                <th width="10%">Jenis</th>
                                <th width="10%">Tanggal Transaksi</th>
                                <th width="10%">Tanggal Beban</th>
                                <th width="10%">Keterangan</th>
                                <th width="10%">Lokasi</th>
                                <th width="10%">Nominal Pengajuan</th>
                                <th width="10%">Budget</th>
                                <th width="7%">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php foreach($list_transpengajuan as $info){ ?>
                                <tr>
                                    <td><?= $info->notrans; ?></td>
                                    <td><?= $info->jenis; ?></td>
                                    <td><?= date('Y-m-d',strtotime($info->transtgl)); ?></td>
                                    <td><?= date('Y-m-d',strtotime($info->bebantgl)); ?></td>
                                    <td><?= $info->keterangan; ?></td>
                                    <td><?= $info->locationket; ?></td>
                                    <td align="right"><?php $rp = number_format($info->nilaiuang,2,',','.'); echo 'Rp '.$rp;?></td>
                                    <td align="right"><?php $rp = number_format($info->nilaimax,2,',','.'); echo 'Rp ' .$rp;?></td>
                                    <td>

                                        <a class="btn btn-sm btn-danger" href="javascript:void(0)" title="Hapus" onclick="hapus_data('<?= $info->transoutid; ?>','<?= $info->keterangan; ?>','<?= $del_url; ?>?id=<?= $info->transoutid; ?>')"><i class="glyphicon glyphicon-trash"></i> Delete</a>
                                    </td>
                                </tr>
                            <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal" id="list_jenis" role="dialog">
        <div class="modal-dialog modal-lg">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Daftar Jenis Pengeluaran</h4>
                </div>
                <div class="modal-body">
                    <ul class="nav nav-tabs nav-justified">
                        <li class="active"><a href="#tab1" data-toggle="tab">Pengeluaran Cash</a></li>
                        <li><a href="#tab2" data-toggle="tab">Pengajuan</a></li>
                    </ul>

                    <div class="tab-content">
                        <div class="tab-pane active" id="tab1">
                            <table id="tabel_cash" class="table table-bordered table-hover table-striped" style="cursor:pointer;">
                                <thead>
                                <tr>
                                    <th>Jenis</th>
                                    <th>Keterangan</th>
                                    <th>Lokasi</th>
                                    <th>Budget per Klaim</th>
                                    <th>Group Jenis</th>
                                    <th>Budget per Bulan</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php foreach($list_cash as $info){ ?>
                                    <tr id="pilih" pengajuan="0" nilaidetailid="<?= $info->nilaidetailid; ?>" outid="<?= $info->outid; ?>" jenis="<?= $info->jenis; ?>" nilaimax="<?= $info->nilaimax; ?>" costjenis="<?= $info->costjenis; ?>" nilaimaxgroup="<?= $info->nilaimaxgroup; ?>" lokasi="<?= $info->locationket; ?>" locid="<?= $info->locid; ?>">
                                        <td><?= $info->jenis; ?></td>
                                        <td><?= $info->keterangan; ?></td>
                                        <td><?= $info->locationket; ?></td>
                                        <td><?php $rp = number_format($info->nilaimax,2,',','.'); echo 'Rp '.$rp;?></td>
                                        <td><?= $info->costjenis; ?></td>
                                        <td><?php $rp = number_format($info->nilaimaxgroup,2,',','.'); echo 'Rp ' .$rp;?></td>
                                    </tr>
                                <?php } ?>
                                </tbody>
                            </table>
                        </div>
                        <div class="tab-pane" id="tab2">
                            <table id="tabel_pengajuan" class="table table-bordered table-hover table-striped" style="cursor:pointer;">
                                <thead>
                                <tr>
                                    <th>Jenis</th>
                                    <th>Keterangan</th>
                                    <th>Lokasi</th>
                                    <th>Budget per Klaim</th>
                                    <th>Group Jenis</th>
                                    <th>Budget per Bulan</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php foreach($list_pengajuan as $info){ ?>
                                    <tr id="pilih" pengajuan="1" nilaidetailid="<?= $info->nilaidetailid; ?>" outid="<?= $info->outid; ?>" jenis="<?= $info->jenis; ?>" nilaimax="<?= $info->nilaimax; ?>" costjenis="<?= $info->costjenis; ?>" nilaimaxgroup="<?= $info->nilaimaxgroup; ?>" lokasi="<?= $info->locationket; ?>" locid="<?= $info->locid; ?>">
                                        <td><?= $info->jenis; ?></td>
                                        <td><?= $info->keterangan; ?></td>
                                        <td><?= $info->locationket; ?></td>
                                        <td><?php $rp = number_format($info->nilaimax,2,',','.'); echo 'Rp '.$rp;?></td>
                                        <td><?= $info->costjenis; ?></td>
                                        <td><?php $rp = number_format($info->nilaimaxgroup,2,',','.'); echo 'Rp ' .$rp;?></td>
                                    </tr>
                                <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script type="text/javascript">
        function formatMoney(number, places, symbol, thousand, decimal) {
            number = number || 0;
            places = !isNaN(places = Math.abs(places)) ? places : 0;
            symbol = symbol !== undefined ? symbol : "";
            thousand = thousand || ",";
            decimal = decimal || ".";
            var negative = number < 0 ? "-" : "",
                i = parseInt(number = Math.abs(+number || 0).toFixed(places), 10) + "",
                j = (j = i.length) > 3 ? j % 3 : 0;
            return symbol + negative + (j ? i.substr(0, j) + thousand : "") + i.substr(j).replace(/(\d{3})(?=\d)/g, "$1" + thousand) + (places ? decimal + Math.abs(number - i).toFixed(places).slice(2) : "");
        }

        document.getElementById("strnilaiuang").oninput = function(e) {
            if (this.value != "") {
                this.value = parseFloat(this.value.replace(/,/g, ""))
                    .toFixed()
                    .toString()
                    .replace(/\B(?=(\d{3})+(?!\d))/g, ",");
            }
            document.getElementById("nilaiuang").value = this.value.replace(/,/g, "");

        }
        

        $('#metode_bayar').change(function () {
            var metode_bayar = $(this).val();
            if (metode_bayar == 1) {
                $('#bayar_trf').show();
            } else {
                $('#bayar_trf').hide();
                document.getElementById("supp_id").value = 1;
                console.log(document.getElementById("supp_id").value);
            }
        });

        $(document).on('click','#pilih', function(e) {
            document.getElementById("nilaidetailid").value = $(this).attr('nilaidetailid');
            document.getElementById("jenis").value = $(this).attr('jenis');
            document.getElementById("nilaimax").value = $(this).attr('nilaimax');
            var txtnilaimax = formatMoney(document.getElementById('nilaimax').value);
            $("#strnilaimax").val(txtnilaimax);
            document.getElementById("costjenis").value = $(this).attr('costjenis');
            document.getElementById("nilaimaxgroup").value = $(this).attr('nilaimaxgroup');
            var txtnilaimaxgroup = formatMoney(document.getElementById('nilaimaxgroup').value);
            $("#strnilaimaxgroup").val(txtnilaimaxgroup);
            document.getElementById("lokasi").value = $(this).attr('lokasi');
            var pengajuan = $(this).attr('pengajuan');
            $("#pengajuan").val(pengajuan);
            var locid = $(this).attr('locid');
            $("#locid").val(locid);
            var outid = $(this).attr('outid');
            $("#outid").val(outid);
//            if (pengajuan == 0 ) {
//                
//            } else {
//                var span = document.getElementById("sisaplafon_str");
//                var txt = document.createTextNode("-");
//                span.innerText = txt.textContent;
//            }
            $('#list_jenis').modal('hide');
        });

        $(document).ready(function () {
            var nilaidetailid = document.getElementById("nilaidetailid").value;
            var nilaimaxgroup = document.getElementById("nilaimaxgroup").value;
            var nilaiuang = document.getElementById("nilaiuang").value;
            console.log(nilaidetailid);
            if (nilaidetailid != '') {
                var strnilaimax = formatMoney(document.getElementById("nilaimax").value);
                $('#strnilaimax').val(strnilaimax);
            }
            if (nilaimaxgroup != '') {
                var strnilaigrup = formatMoney(document.getElementById("nilaimaxgroup").value);
                $('#strnilaimaxgroup').val(strnilaigrup);
            }
            if (nilaiuang != '') {
                var strnilaigrup = formatMoney(document.getElementById("nilaiuang").value);
                $('#strnilaiuang').val(strnilaigrup);
            }
            var locid = <?= $locid; ?>;
            $.ajaxSetup({
                type:"POST",
                url : "<?= base_url('trans_kas/loadTotalPengeluaran'); ?>",
                cache: false
            });
            $.ajax({
                data : {pengajuan:0,locid:locid},
                success: function (result) {
                    //untuk load saldo yang ada pada lokasi user
                    $.ajaxSetup({
                        type:"POST",
                        url : "<?= base_url('trans_kas/getSaldo'); ?>",
                        cache: false
                    });
                    $.ajax({
                        data : {locid:locid},
                        success: function (hasil) {
                            $("#saldolocid").val(hasil);
                            console.log(hasil);
                            var pemakaian = parseFloat(result);
                            var saldoawal = parseFloat(hasil);
                            var saldo = saldoawal - pemakaian;
                            console.log(pemakaian);
                            console.log(saldoawal);
                            console.log(saldo);
                            $("#sisaplafon").val(saldo);
                            var span = document.getElementById("sisaplafon_str");
                            var txt = document.createTextNode(formatMoney(saldo));
                            span.innerText = txt.textContent;
                        }
                    });
                }
            });
            $('#bayar_trf').hide();
        });

        function cekRealisasi() {
            var text;
            var jum_pengajuan = parseInt(<?php $jum_pengajuan; ?>);
            var maxdetail = parseFloat(document.getElementById("nilaimax").value);
            var nilaiuang = parseFloat(document.getElementById("nilaiuang").value);
            var saldo = parseFloat(document.getElementById("sisaplafon").value);
            var pengajuan = document.getElementById("pengajuan").value;
            var transtgl = document.getElementById("tgl_trans").value;
            var bebantgl = document.getElementById("tgl_beban").value;
            var keterangan = document.getElementById("keterangan").value;
            var nomorfaktur = document.getElementById("nomorfaktur").value;
            var metode_bayar = document.getElementById("metode_bayar").selectedIndex;
            var supp_id = document.getElementById("supp_id").value;

            console.log(metode_bayar);

            if (transtgl == "" || bebantgl == "" || nomorfaktur == "" || (metode_bayar ==1 && supp_id== "")) {
                document.getElementById("btnsimpan").disabled = true;
                text = "Form harus dilengkapi!!";
            } else if(pengajuan == 0) {
                if (nilaiuang <= saldo) {
                    if (nilaiuang <= maxdetail) {
                        document.getElementById("btnsimpan").disabled = false;
                        text = "Nominal Pengajuan : " + formatMoney(nilaiuang);
                    } else {
                        document.getElementById("btnsimpan").disabled = true;
                        text = "Nominal melebihi budget, harus inputkan sebagai pengajuan";
                    }
                } else {
                    document.getElementById("btnsimpan").disabled = true;
                    text = "Nominal melebihi saldo, harus inputkan sebagai pengajuan";
                }
            } else {
                text = "Nominal Pengajuan : " + formatMoney(nilaiuang);
                document.getElementById("btnsimpan").disabled = false;
            }
            console.log(text);
            document.getElementById("nilaiuanginfo").innerHTML = text;

            if (metode_bayar == 0) {
                supp_id = "";
            }

        }

        $("#supp_id_ac").autocomplete({
            source: '<?= $this_controller; ?>/ac_supplier',
            minLength: 1,
            select: function( event, ui ) {

                if(ui.item.id == ''){
                    ui.item.label = '';
                    ui.item.value = '';
                }

                console.log(['selected',ui]);

                $("#supp_id").val(ui.item.id);
                console.log(document.getElementById('supp_id').value);

            },
            response: function( event, ui ) {
                console.log([event,ui]);
                $("#supp_id").val('');
            },
        });
        $("#supp_id_ac").blur(function () {
            var a = document.getElementById('supp_id').value;
            if (!a) {
                alert('Supplier Tidak Tersedia!!');
            }
        });
    </script>
</div>
<?php
$jum_pengajuan = $model->getJumlahPengajuan($locid);
if ($jum_pengajuan > 0 ) {
    echo "<script> alert('Anda tidak bisa melakukan pengajuan sebelum cetak voucher pengajuan sebelumnya!'); document.getElementById('btncek').disabled = true;</script>";
}
?>
<!-- /.row -->

<?php include_once 'layout_admin_bottom.php'; ?>