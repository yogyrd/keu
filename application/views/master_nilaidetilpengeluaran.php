<?php
$admin_page_title = 'Master Nilai Detil Jenis Pengeluaran';
$admin_page_breadcrumb = '';
include_once 'layout_admin_top.php';
$baseurl = base_url() . "master_nilaigrouppengeluaran";
if ($link == $baseurl || $link == $baseurl . '/') {
    $data = 0;
}

$tgl = date('Y-m-d H:i:s');
$userid = $this->session->userdata('id');
$counter=1;
?>

    <div class="row">
        <div class="col-sm-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">Daftar Master Nilai Detil Pengeluaran</h3>
                </div>
                <div class="row">
                    <form action="<?= base_url('master_nilaidetilpengeluaran'); ?>" method="post">
                        <div class="col-md-4" style="margin-top: 10px;">
                            <select name="filter_loc" class="form-control" required>
                                <option value="">Pilih Lokasi</option>
                                <?php foreach($list_lokasi as $list){ ?>
                                    <option value="<?= $list->locid; ?>"><?= $list->locationket; ?></option>
                                <?php } ?>
                            </select>
                            <span class="help-block"></span>
                        </div>
                        <div class="col-md-5" style="margin-top: 10px;">
                            <select name="filter_group" class="form-control">
                                <option value="">Pilih Group</option>
                                <?php foreach($list_groupjenis as $list){ ?>
                                    <option value="<?= $list->costid; ?>"><?= $list->costjenis; ?></option>
                                <?php } ?>
                            </select>
                            <span class="help-block"></span>
                        </div>
                        <div>
                            <span class="help-block"></span>
                        </div>
                            <input type="submit" class="btn btn-info btn-sm" value="Filter" style="margin-top: 10px;">


                    </form>
                    <div class="row">
                        <div class="col-md-12">
                            <input type="hidden" name="locid" value="<?= $locid; ?>"/>
                            <div class="label label-info" style="font-size: medium;">Location : <?= $lokasi; ?></div>
                            <a class="btn btn-sm btn-success pull-right" href="javascript:void(0)" title="CSV" onclick="window.location.href='<?= base_url(); ?>master_nilaidetilpengeluaran/export_to_excel?locid=<?= $locid; ?>'"><span class="fa fa-file-excel-o"> CSV</span></a>
                            <a class="btn btn-sm btn-danger pull-right" title="PDF" onclick="getReport()"><span class="fa fa-file-pdf-o"> PDF</span></a>
<!--                            <a onclick="get_report_pdf()" class="pull-right"><span class="fa fa-print" style="font-size:30px;"></span></a>-->
                        </div>
                    </div>

                    <form action="<?= base_url('master_nilaidetilpengeluaran/insert_cutoff'); ?>" method="post">
                        <div class="panel-body">
                            <table class="table table-bordered table-striped table-hover">
                                <thead>
                                <tr>
                                    <th width="2%">No.</th>
                                    <th width="10%">Lokasi</th>
                                    <th width="10%">Detil Jenis</th>
                                    <th width="20%">Budget Per Klaim</th>
                                    <th width="8%">Pengajuan/Cash</th>
                                    <th width="15%" hidden>Budget Detail Tahunan</th>
                                    <th width="10%">Group Jenis</th>
                                    <th width="10%">Budget Group</th>
                                    <th width="13%">Tanggal Mulai</th>
                                    <th width="2%">Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php foreach ($list_nilai as $info) { ?>
                                    <tr>
                                        <?php $id=$info->nilaidetilid + $counter; ?>
                                        <input name="counter_<?= $id; ?>" type='hidden' class="form-control" value="<?= $counter; ?>" readonly/>
                                        <td><h5><?= $counter; ?></h5></td>
                                        <td><h5><?= $model->getLocationById($info->locidoutid); ?></h5><input name="locid_<?= $id; ?>" type='hidden' class="form-control" value="<?= $info->locidoutid; ?>" readonly/></td>
                                        <td><h5><?= $info->jenis; ?></h5><input name="outid_<?= $id; ?>" type='hidden' class="form-control" value="<?= $info->outid; ?>" readonly/></td>
                                        <td>
                                            <div class="input-group">
                                                <span class="input-group-addon">Rp </span>
                                                <input type="text" id="nilaimax_bln<?=$id; ?>" class="form-control input-sm" value="<?= $info->nilaimaxdetil; ?>">
                                                <input type="hidden" id="nilaimax_<?= $id; ?>" name="nilaimax_<?= $id; ?>" class="form-control input-sm" value="<?= $info->nilaimaxdetil; ?>">
                                            </div>
                                        </td>
                                        <td>
                                            <?php if($info->pengajuan == 1) {echo 'Pengajuan';} else {echo 'Cash';}?>
                                        </td>
                                        <td hidden>
                                            <div class="input-group">
                                                <span class="input-group-addon">Rp </span>
                                                <input type="text" id="nilaimax_thn<?= $id; ?>" class="form-control input-sm" readonly>
                                            </div>
                                        </td>
                                        <td><h5><?= $info->costjenis; ?></h5></td>
                                        <td><h5><?php $rp= number_format($info->nilaimaxgroup,2,',','.'); echo 'Rp '.$rp;?></h5></td>
                                        <td>
                                            <div class="form-group">
                                                <div class='input-group date dt_date'>
                                                    <input name="startdate_<?= $id; ?>" id="startdate_<?= $id; ?>" type='text' class="form-control" value="<?= $info->startdate; ?>" readonly/>
                                                </div>
                                            </div>
                                        </td>
                                        <td hidden>
                                            <?= $info->enddate; ?>
                                            <div class="form-group">
                                                <div class='input-group date dt_date'>
                                                    <input name="enddate_<?= $id; ?>" type='hidden' class="form-control" value="<?= $info->enddate; ?>" readonly/>
                                                </div>
                                            </div>
                                        </td>
                                        <td align="center">
                                            <label>
                                                <input type="checkbox" name="updatemasterdetil[]" value="<?= $id; ?>" <?php if($info->startdate == date('Y-m-d')) { echo "disabled";} ?> />
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

                                        bulan = parseInt(mm) - 1;
                                        $(document).ready(function () {
                                            range_bulan = 12 - bulan;
                                            budget_bln = document.getElementById('nilaimax_<?=$id; ?>').value;
                                            budget_thn = range_bulan * budget_bln
                                            $('#nilaimax_thn<?= $id; ?>').val(budget_thn);
                                            var tbbudgetthn = document.getElementById("nilaimax_thn<?=$id; ?>");
                                            tbbudgetthn.value = parseFloat(tbbudgetthn.value.replace(/,/g, ""))
                                                .toFixed()
                                                .toString()
                                                .replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                                            var tbbudgetbln = document.getElementById("nilaimax_bln<?=$id; ?>");
                                            tbbudgetbln.value = parseFloat(tbbudgetbln.value.replace(/,/g, ""))
                                                .toFixed()
                                                .toString()
                                                .replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                                        });

                                        document.getElementById("nilaimax_bln<?=$id; ?>").oninput = function(e) {
                                            if (this.value != "") {
                                                this.value = parseFloat(this.value.replace(/,/g, ""))
                                                    .toFixed()
                                                    .toString()
                                                    .replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                                            }


                                            document.getElementById("nilaimax_<?=$id; ?>").value = this.value.replace(/,/g, "");
                                            budget_bln = document.getElementById('nilaimax_<?=$id; ?>').value;
                                            budget_thn = range_bulan * budget_bln
                                            $('#nilaimax_thn<?= $id; ?>').val(budget_thn);
                                            var tbbudgetthn = document.getElementById("nilaimax_thn<?=$id; ?>");
                                            tbbudgetthn.value = parseFloat(tbbudgetthn.value.replace(/,/g, ""))
                                                .toFixed()
                                                .toString()
                                                .replace(/\B(?=(\d{3})+(?!\d))/g, ",");

    //                                        $('#startdate_<?//= $id; ?>//').val(today);
    //                                        if (<?//=$info->startdate; ?>// == today) {
    //                                            $('input[value=<?//= $id; ?>//]').attr('checked', true);
    //                                        }
                                        }

                                        //fungsi untuk merubah tanggal menjadi tanggal sekarang jika di check
                                        $('input[type=checkbox]').click(function () {
                                            if (!$('input[value=<?= $id; ?>]').is(':checked')) {
                                                $('#startdate_<?= $id; ?>').val('<?= $info->startdate; ?>');
                                            }
                                            else{
                                                $('#startdate_<?= $id; ?>').val(today);
                                            }
                                        });


                                        $('input[id=nilaimax_bln<?= $id; ?>]').on('blur',function () {
                                            var strnilaimaxgroup = '<?=$info->nilaimaxgroup; ?>';
                                            var nilaimaxgroup = parseInt(strnilaimaxgroup);
                                            var nilaimaxdetail = parseInt(document.getElementById("nilaimax_<?= $id; ?>").value);
                                            if (nilaimaxdetail > nilaimaxgroup) {
                                                alert("Nilai yang anda input melebihi jumlah maksimal group jenis");
                                                $('#nilaimax_bln<?= $id; ?>').val(0);
                                                $('#nilaimax_<?= $id; ?>').val(0);
                                            }

                                        });
                                    </script>
                                    <?php $counter++; ?>
                                <?php } ?>
                                </tbody>
                            </table>
                            <div class="context_buttons">
                                <input type="submit" name="update" class="btn btn-success pull-right btn-sm" value="Simpan" style="margin-right:20px; font-size: large">
                            </div>

                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- /.row -->
    <script>
        function getReport() {
            var costid = document.getElementById('group_id');
            if (costid == null) {
                costid = "0";
            }
            window.location.href="<?= base_url(); ?>master_nilaidetilpengeluaran/cetak_nilaijenispengeluaran?locid=<?= $locid; ?>&costid=" + costid + "";
        }

    </script>

<?php include_once 'layout_admin_bottom.php'; ?>