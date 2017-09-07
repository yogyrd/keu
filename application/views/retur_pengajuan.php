<?php
$admin_page_title = 'Retur Pengajuan';
$admin_page_breadcrumb = '';
include_once 'layout_admin_top.php';
$baseurl = base_url() . "retur_pengajuan";
if ($link == $baseurl || $link == $baseurl . '/') {
    $data = 0;
}
$CI =& get_instance();
$CI->load->model('M_Master_lokasi','mlokasi');
?>

    <div class="row">
        <div class="col-sm-12">
            <div id="form" class="panel panel-default panel-sm">
                <div class="panel-heading"><b>Input Retur Pengajuan</b></div>
                <div class="panel-body">
                    <form action="<?= base_url('retur_pengajuan/save'); ?>" method="post">
                        <table class="table table-condensed">
                            <tr>
                                <td style="width:10%;">Kode Transaksi</td>
                                <td>
                                    <div class="col-sm-3">
                                        <input type="hidden" id="transoutid" name="transoutid" readonly/>
                                        <input type="text" id="notrans" class="form-control input-sm"  readonly/>
                                    </div>
                                    <input type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#list_pengajuan" value="Cari Pengajuan">
                                </td>
                            </tr>
                            <tr>
                                <td>Tanggal Transaksi</td>
                                <td>
                                    <div class="col-sm-2">
                                        <input type="text" id="transtgl" class="form-control input-sm" required readonly />
                                    </div>
                                    <div class="col-sm-1">
                                        Nominal Pengajuan
                                    </div>
                                    <div class="col-sm-3">
                                        <input type="text" class="form-control input-sm" id="strnilaiuang" value="" style="text-align: right" readonly />
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>Tanggal Realisasi</td>
                                <td>
                                    <div class="col-sm-2">
                                        <input type="text" id="realisasidate" class="form-control input-sm" required readonly />
                                    </div>
                                    <div class="col-sm-1">
                                        Nominal Realisasi
                                    </div>
                                    <div class="col-sm-3">
                                        <input type="hidden" id="intrealisasi" name="realisasi" />
                                        <input type="text" class="form-control input-sm" id="strrealisasi" style="text-align: right" readonly/>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>Jenis</td>
                                <td>
                                    <div class="col-sm-3">
                                        <input type="text" id="jenis" class="form-control input-sm" value="" required readonly />
                                    </div>
                                    <div class="col-sm-1">
                                        Keterangan
                                    </div>
                                    <div class="col-sm-6">
                                        <input type="text" id="keterangan" class="form-control input-sm" value="" required readonly />
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>Lokasi</td>
                                <td>
                                    <div class="col-sm-6">
                                        <input type="hidden" id="locid" name="locid" value="" readonly />
                                        <input type="text" id="loc" class="form-control input-sm" value="" readonly />
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>Supplier</td>
                                <td>
                                    <div class="col-sm-6">
                                        <input type="text" id="supplier" class="form-control input-sm" value="" readonly />
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>Nota / Faktur</td>
                                <td>
                                    <div class="col-sm-5">
                                        <input type="text" id="nofaktur" name="nofaktur" class="form-control input-sm" value="" required />
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>Nominal Retur</td>
                                <td>
                                    <div class="col-sm-3">
                                        <div class="input-group">
                                            <span class="input-group-addon">Rp </span>
                                            <input type="hidden" name="nilaiuangretur" id="nilaiuangretur" class="returnilai" required>
                                            <input type="text" id="strnilaiuangretur" class="form-control input-sm" value="" required>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>Transfer ke bank</td>
                                <td>
                                    <div class="col-sm-5">
                                        <input type="hidden" id="bank_id" name="bankid" />
                                        <input type="text" id="bank_id_ac" class="form-control input-sm-5 input_ac" placeholder="isi nama bank/nomor rekening tujuan di sini..." value="" required />
                                        <span></span>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>Keterangan Retur</td>
                                <td>
                                    <div class="col-sm-6">
                                        <input type="text" id="keterangan" name="keterangan" class="form-control input-sm" value="" required>
                                    </div>
                                    <font color="red">*dilarang menggunakan karakter (') atau (") </font>
                                </td>
                            </tr>
                            
                            <tr>
                                <td></td>
                                <td>
                                    <div class="col-sm-6">
                                        <input type="submit" class="btn btn-success btn-sm" value="Simpan">
                                        <a class="btn btn-sm btn-default" href="javascript:void(0)" title="Batal" onclick="window.location.href='<?= base_url() . 'master_lokasi'; ?>'"> Batal</a>
                                    </div>
                                </td>
                            </tr>
                        </table>
                    </form>
                    <div class="row">
                        <?php if($this->session->flashdata('err_message')!="") { ?>
                            <div class="alert alert-success alert-dismissible" role="alert" align="center">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true" id="infoMessage">&times;</span></button>
                                <h4><?= $this->session->flashdata('err_message');?></h4>
                            </div>
                        <?php } ?>
                        </div>
                </div>
            </div>
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">Daftar Transaksi Yang Diretur</h3>
                </div>
                <div class="panel-body">
                    <table id="tabel_pengeluaran" class="table table-condensed table-bordered table-striped">
                        <thead>
                        <tr>
                            <th width="10%">Kode Transaksi</th>
                            <th width="8%">Tanggal Realisasi</th>
                            <th width="10%">Nominal Realisasi</th>
                            <th width="10%">Jenis</th>
                            <th width="14%">Keterangan - No. Faktur / Nota</th>
                            <th width="10%">Lokasi</th>
                            <th width="8%">Tanggal Retur</th>
                            <th width="10%">Nominal Retur</th>
                            <th width="10%">Transfer ke</th>
                            <th width="10%">Keterangan Retur</th>
                            <th width="10%">Action</th>
                        </tr>
                        </thead>
                        <tbody>
                            <?php foreach($list_retur as $info){ ?>
                            <tr>
                                <td><?= $info->notrans; ?></td>
                                <td align="center"><?= date('Y-m-d',strtotime($info->realisasidate)); ?></td>
                                <td align="right"><?php $rp = number_format($info->realisasi,0,',','.'); echo 'Rp '.$rp;?></td>
                                <td><?= $info->jenis; ?></td>
                                <td><?= $info->keterangan; ?> - <?= $info->nomorfaktur; ?></td>
                                <td><?= $info->locationket; ?></td>
                                <td align="center"><?= date('Y-m-d',strtotime($info->inctgl)); ?></td>
                                <td align="right"><?php $rp = number_format($info->incnilai,0,',','.'); echo 'Rp '.$rp;?></td>
                                <td><?= $info->namabank; ?> - <?= $info->norekening; ?> - <?= $info->namarekening; ?></td>
                                <td><?= $info->keteranganretur; ?></td>
                                <td>
                                    <a class="btn btn-sm btn-primary" href="javascript:void(0)" title="Edit" onclick="window.location.href='<?= base_url('retur_pengajuan/load'); ?>?id=<?= $info->incomeid; ?>'"><i class="glyphicon glyphicon-pencil"></i> Edit</a>
                                    <a class="btn btn-sm btn-danger" href="javascript:void(0)" title="Hapus" onclick="hapus_data('<?= $info->incomeid; ?>','<?= $info->keteranganretur; ?>','<?= base_url('retur_pengajuan/delete'); ?>?id=<?= $info->incomeid; ?>')"><i class="glyphicon glyphicon-trash"></i> Delete</a>
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
    <!-- Modal -->
    <div class="modal" id="list_pengajuan" role="dialog">
        <div class="modal-dialog modal-lg">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Daftar Transaksi Pengajuan</h4>
                </div>
                <div class="modal-body">
                    <div class="tab-content">
                        <table id="tabel_cash" class="table table-bordered table-hover table-striped" style="cursor:pointer;">
                            <thead>
                            <tr>
                                <th>Kode Transaksi</th>
                                <th>Lokasi</th>
                                <th>Jenis</th>
                                <th>Keterangan</th>
                                <th>Tanggal Transaksi</th>
                                <th>Nominal Pengajuan</th>
                                <th>Tanggal Reealisasi</th>
                                <th>Nominal Realisasi</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php foreach($list_pengajuan as $info){ ?>
                                <tr id="pilih" transoutid="<?= $info->transoutid; ?>" notrans="<?= $info->notrans; ?>" transtgl="<?= $info->transtgl; ?>"  
                                    nilaiuang="<?= $info->nilaiuang; ?>" realisasidate="<?= $info->realisasidate; ?>" realisasi="<?= $info->realisasi; ?>"
                                    locid="<?= $info->loc; ?>" loc="<?= $info->locationket; ?>" jenis="<?= $info->jenis; ?>" keterangan="<?= $info->keterangan; ?>"
                                    supplier="<?= $info->suppliernama; ?> - <?= $info->supplierbanknamarek; ?> - <?= $info->supplierbanknorek; ?>"
                                    nofaktur="<?= $info->nomorfaktur; ?>">
                                    <td><?= $info->notrans; ?></td>
                                    <td><?= $CI->mlokasi->getLokasiById($info->loc); ?></td>
                                    <td><?= $info->jenis; ?></td>
                                    <td><?= $info->keterangan; ?></td>
                                    <td><?= date('Y-m-d',strtotime($info->transtgl)); ?></td>
                                    <td><?php $rp = number_format($info->nilaiuang,0,',','.'); echo 'Rp '.$rp;?></td>
                                    <td><?= date('Y-m-d',strtotime($info->realisasidate)); ?></td>
                                    <td><?php $rp = number_format($info->realisasi,0,',','.'); echo 'Rp ' .$rp;?></td>
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
        
        $(document).on('click','#pilih', function(e) {
            document.getElementById("transoutid").value = $(this).attr('transoutid');
            document.getElementById("notrans").value = $(this).attr('notrans');
            document.getElementById("transtgl").value = $(this).attr('transtgl');
            
            var txtnilaiuang = formatMoney($(this).attr('nilaiuang'))
            document.getElementById("strnilaiuang").value = txtnilaiuang;
            
            
            document.getElementById("realisasidate").value = $(this).attr('realisasidate');
            
            document.getElementById("intrealisasi").value = $(this).attr('realisasi');
            
            var txtrealisasi = formatMoney($(this).attr('realisasi'));
            document.getElementById("strrealisasi").value = txtrealisasi;
            
            
            document.getElementById("locid").value = $(this).attr('locid');
            document.getElementById("loc").value = $(this).attr('loc');
            document.getElementById("jenis").value = $(this).attr('jenis');
            document.getElementById("keterangan").value = $(this).attr('keterangan');
            document.getElementById("supplier").value = $(this).attr('supplier');
            document.getElementById("nofaktur").value = $(this).attr('nofaktur');

            $('#list_pengajuan').modal('hide');
        });
        
        
        document.getElementById("strnilaiuangretur").oninput = function(e) {
            if (this.value != "") {
                this.value = parseFloat(this.value.replace(/,/g, ""))
                    .toFixed()
                    .toString()
                    .replace(/\B(?=(\d{3})+(?!\d))/g, ",");
            }
            document.getElementById("nilaiuangretur").value = this.value.replace(/,/g, "");

        }
        
        $("#bank_id_ac").autocomplete({
            source: '<?= $this_controller; ?>/ac_bank',
            minLength: 1,
            select: function( event, ui ) {

                if(ui.item.id == ''){
                    ui.item.label = '';
                    ui.item.value = '';
                }

                console.log(['selected',ui]);

                $("#bank_id").val(ui.item.id);
                console.log(document.getElementById('bank_id').value);

            },
            response: function( event, ui ) {
                console.log([event,ui]);
                $("#bank_id").val('');
            },
        });
        $("#bank_id_ac").blur(function () {
            var a = document.getElementById('bank_id').value;
            if (!a) {
                alert('Bank Tidak Tersedia!!');
            }
        });
    </script>

<?php include_once 'layout_admin_bottom.php'; ?>