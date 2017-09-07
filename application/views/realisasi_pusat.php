<?php
$admin_page_title = 'Realisasi Pusat';
$admin_page_breadcrumb = '';
include_once 'layout_admin_top.php';
$counter=1;
?>

    <div class="row">
        <div class="col-sm-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">Daftar Transaksi</h3>
                </div>
                <div class="row">
                    <div class="panel-body">
                        <form action="<?= base_url('realisasi_pusat'); ?>" method="post">
                            <table class="table">
                                <tr>
                                    <td style="width:10%;" align="right">Lokasi</td>
                                    <td>
                                        <div class="col-md-5">
                                            <select name="filter_loc" class="form-control" required>
                                                <option value="">Pilih Lokasi</option>
                                                <?php foreach($list_lokasi as $list){ ?>
                                                    <option value="<?= $list->locid; ?>"><?= $list->locationket; ?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="width:10%;" align="right">Transfer dari Bank</td>
                                    <td>
                                        <div class="col-sm-6">
                                            <input type="hidden" id="bank_id" name="bankid" />
                                            <input type="text" id="bank_id_ac" class="form-control input-sm-5 input_ac" placeholder="isi nama bank/nomor rekening asal di sini..." value="" required />
                                            <span></span>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td>
                                        <div class="col-md-4">
                                            <input type="submit" class="btn btn-success btn-sm" value="Filter" style="margin-top: 10px;">
                                        </div>
                                    </td>
                                </tr>
                            </table>
                        </form>
                        <p id="tes"></p>
                        <div class="label label-info" style="font-size: medium;">Location : <script> var a = '<?= $locid; ?>'; console.log(a);</script><?= $location; ?></div>
                    </div>
                </div>
                
                <form action="<?= base_url('realisasi_pusat/update_status'); ?>" method="post">
                    <input type="hidden" name="locid" value="<?= $locid; ?>"/>
                    <div class="panel-body">
                        <table id="tabel_trans_kas" class="table table-bordered table-striped">
                            <thead>
                            <tr>
                                <th width="3%" hidden>ID</th>
                                <th width="3%">No. Trans</th>
                                <th width="15%">Keterangan</th>
                                <th width="15%">Jenis</th>
                                <th width="16%">Nominal Pengajuan</th>
                                <th width="15%">Realisasi</th>
                                <th width="14%">Bank</th>
                                <th width="14%">Tanggal Realisasi</th>
                                <th width="5%">Pengajuan / Cash</th>
                                <th width="3%"> All <input type="checkbox" onchange="checkAll(this)"/></th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php foreach($list_trans as $info){ ?>
                                <tr>
                                    <?php $id = $info->transoutid; ?>
                                    <td hidden><input type="text" value="<?=$id; ?>" /></td>
                                    <td><?= $info->notrans; ?></td>
                                    <td><?= $info->keterangan; ?></td>
                                    <td><?= $info->jenis; ?></td>
                                    <td>
                                        <?php $rp = number_format($info->nilaiuang,2,',','.'); echo 'Rp '.$rp;?>
                                    </td>
                                    <td>
                                        <?php $rp = number_format($info->realisasi,2,',','.'); echo 'Rp '.$rp;?>
                                        <input type="hidden" id="realisasi_<?= $id; ?>" name="realisasi_<?= $id; ?>" class="form-control input-sm" value="<?= $info->realisasi; ?>">
                                    </td>
                                    <td>
                                        <?= $bank; ?>
                                        <input type="hidden" name="bankid_<?= $id; ?>" value="<?= $bankid; ?>">
                                    </td>
                                    <td>
                                        <div class="form-group">
                                            <div class='input-group date dt_date'>
                                                <input id="realisasidate_<?= $id; ?>" type='text' class="form-control input-sm" value="<? echo '0000-00-00'; ?>" readonly/>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <?php if($info->pengajuan==0) {echo 'Cash';} else {echo 'Pengajuan';}  ?>
                                    </td>
                                    <td align="center">
                                        <label>
                                            <input type="checkbox" name="editstatus[]" value="<?= $id; ?>"/>
                                        </label>
                                    </td>
                                </tr>
                                <script>
                                    //fungsi untuk membuat tanggal hari ini
                                    var today = new Date();
                                    var dd = today.getDate();
                                    var mm = today.getMonth()+1; //January is 0!
                                    var yyyy = today.getFullYear();

                                    if(dd<10) {
                                        dd='0'+dd
                                    }

                                    if(mm<10) {
                                        mm='0'+mm
                                    }

                                    today = yyyy+'-'+mm+'-'+dd;
                                    $('input[type=checkbox]').change(function () {
                                    if (!$('input[value=<?= $id; ?>]').is(':checked')) {
                                    $('#realisasidate_<?= $id; ?>').val('0000-00-00');
                                    }
                                    else{
                                    $('#realisasidate_<?= $id; ?>').val(today);
                                    }
                                    });

                                    document.getElementById("strrealisasi_<?=$id; ?>").oninput = function(e) {
                                        if (this.value != "") {
                                            this.value = parseFloat(this.value.replace(/,/g, ""))
                                                .toFixed()
                                                .toString()
                                                .replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                                        }


                                        document.getElementById("realisasi_<?=$id; ?>").value = this.value.replace(/,/g, "");
                                    }

                                    $(document).ready(function () {
                                        var tbrealisasi = document.getElementById("strrealisasi_<?=$id; ?>");
                                        tbrealisasi.value = parseFloat(tbrealisasi.value.replace(/,/g, ""))
                                            .toFixed()
                                            .toString()
                                            .replace(/\B(?=(\d{3})+(?!\d))/g, ",");

                                    });
                                </script>
                            <?php } ?>
                            </tbody>
                        </table>
                        <input type="submit" name="update" class="btn btn-success pull-right btn-sm" value="SUBMIT" style="font-size: large; margin-right: 15px;">
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
            </div>
        </div>
    </div>

    <script>

    </script>
    <!-- /.row -->

<?php include_once 'layout_admin_bottom.php'; ?>