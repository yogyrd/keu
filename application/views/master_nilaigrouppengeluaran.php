<?php
$admin_page_title = 'Master Nilai Group Jenis Pengeluaran';
$admin_page_breadcrumb = 'Lokasi : '.ucfirst($this->session->userdata('location'));
include_once 'layout_admin_top.php';
$baseurl = base_url() . "master_nilaigrouppengeluaran";
if ($link == $baseurl || $link == $baseurl . '/') {
    $data = 0;
}
$tgl = date('Y-m-d H:i:s');
$userid = ucfirst($this->session->userdata('id'));
$loc = strtoupper(ucfirst($this->session->userdata('location')));
$counter=1;
?>

    <div class="row">
        <div class="col-sm-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">Daftar Master Nilai Group Pengeluaran</h3>
                </div>
                <form action="<?= base_url('master_nilaigrouppengeluaran'); ?>" method="post">
                    <div class="col-md-4" style="margin-top: 10px;">
                        <select name="filter_loc" class="form-control">
                            <option value="">Pilih Lokasi</option>
                            <?php foreach($list_lokasi as $list){ ?>
                                <option value="<?= $list->locid; ?>" <?= ($list->locid == $data['locid']) ? 'selected':''; ?>><?= $list->locationket; ?></option>
                            <?php } ?>
                        </select>
                        <span class="help-block"></span>
                    </div>
                    <input type="submit" class="btn btn-info btn-sm" value="Filter" style="margin-top: 10px;">
                </form>
                <div class="row">
                    <div class="col-md-12">
                        <input type="hidden" name="locid" value="<?= $locid; ?>"/>
                        <div class="label label-info" style="font-size: medium;">Location : <?= $lokasi; ?></div>
                        <a class="btn btn-sm btn-success pull-right" href="javascript:void(0)" title="CSV" onclick="window.location.href='<?= base_url(); ?>master_nilaigrouppengeluaran/export_to_excel?locid=<?= $locid; ?>'"><span class="fa fa-file-excel-o"> CSV</span></a>
                        <a class="btn btn-sm btn-danger pull-right" title="PDF" onclick="getReport()"><span class="fa fa-file-pdf-o"> PDF</span></a>
                        <!--                            <a onclick="get_report_pdf()" class="pull-right"><span class="fa fa-print" style="font-size:30px;"></span></a>-->
                    </div>
                </div>
                <form action="<?= base_url('master_nilaigrouppengeluaran/insert_cutoff'); ?>" method="post">
                    <div class="panel-body">

                        <table id="tabel_group_jenis" class="table table-bordered table-striped">
                            <thead>
                            <tr>
                                <th width="5%">No</th>
                                <th width="15%">Jenis Group</th>
                                <th hidden>Nilai ID</th>
                                <th hidden>Lokasi ID</th>
                                <th width="15%">Lokasi</th>
                                <th width="15%">Budget Bulanan</th>
                                <th width="15%" hidden>Budget Tahunan</th>
                                <th width="15%">Tanggal Mulai</th>
                                <th width="15%">Tanggal Akhir</th>
                                <th width="5%">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php foreach($list_groupjenis as $info){ ?>
                                <tr>
                                    <?php $id = $info->nilaiid + $counter; ?>
                                    <td><h5><?= $counter; ?></h5></td>
                                    <input name="counter_<?= $id; ?>" type='hidden' class="form-control" value="<?= $counter; ?>" readonly/>
                                    <td hidden><input name="costid_<?= $id; ?>" type='text' class="form-control" value="<?= $info->costid; ?>" readonly/></td>
                                    <td><?= $info->costjenis; ?><input name="costket_<?= $id; ?>" type='hidden' class="form-control" value="<?= $info->costjenis; ?>" readonly/></td>
                                    <td hidden><input id="nilaiid_<?= $id; ?>" type='text' class="form-control" value="<?= $id; ?>" readonly/></td>
                                    <td hidden><input name="locid_<?= $id; ?>" type='text' class="form-control" value="<?= $info->locid; ?>" readonly/></td>
                                    <td><?= $model->getLocationById($info->locid); ?></td>
                                    <td align="right">
                                        <?php if ($info->locked == 0) { ?>
                                            <div class="input-group">
                                                <span class="input-group-addon">Rp </span>
                                                <input type="text" id="nilaimax_bln<?=$id; ?>" class="form-control input-sm" value="<?= $info->nilaimax; ?>">
                                                <input type="hidden" name="nilaimax_<?=$id; ?>" id="nilaimax_<?=$id; ?>" class="form-control input-sm" value="<?= $info->nilaimax; ?>">
                                            </div>
                                        <?php } else { ?>
                                            <h5><?php $rp = number_format($info->nilaimax,2,',','.'); echo 'Rp '.$rp; ?></h5>
                                        <?php } ?>
                                    </td>
                                    <td hidden>
                                        <div class="input-group">
                                            <span class="input-group-addon">Rp </span>
                                            <input type="text" id="nilaimax_thn<?= $id; ?>" class="form-control input-sm" readonly>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="form-group">
                                            <div class='input-group date dt_date'>
                                                <input name="startdate_<?= $id; ?>" type='text' class="form-control" id="startdate_<?= $id; ?>" value="<?= $info->startdate; ?>" readonly/>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="form-group">
                                            <div class='input-group date dt_date'>
                                                <input name="enddate_<?= $id; ?>" type='text' class="form-control" value="<?= $info->enddate; ?>" readonly/>
                                            </div>
                                        </div>
                                    </td>
                                    <td align="center">
                                        <?php if ($info->locked == 0) { ?>
                                            <label>
                                                <input type="checkbox" name="updatemaster[]" value="<?= $id; ?>" <?php if($info->startdate == date('Y-m-d')) { echo "disabled";} ?>/>
                                            </label>
                                        <?php } else { ?>
                                            Locked
                                        <?php } ?>
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

                                    document.getElementById("nilaimax_bln<?=$id; ?>").oninput =function (e){
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
            </div>
        </div>
    </div>
    <script>
        function getReport() {
            window.location.href="<?= base_url(); ?>master_nilaigrouppengeluaran/cetak_nilaipengeluarangroup?locid=<?= $locid; ?>";
        }

    </script>
    <!-- /.row -->

<?php include_once 'layout_admin_bottom.php'; ?>