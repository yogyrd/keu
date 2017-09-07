<?php
$admin_page_title = 'Master Jurnal';
$admin_page_breadcrumb = '';
include_once 'layout_admin_top.php';
$baseurl = base_url() . "master_jurnal";
if ($link == $baseurl || $link == $baseurl ."/") {
    $data = 0;
}

$tgl = date('Y-m-d H:i:s');
$user = ucfirst($this->session->userdata('id'));
$loc = strtoupper(ucfirst($this->session->userdata('location')));
$locid = strtoupper(ucfirst($this->session->userdata('locid')));
$nocounter = 1;
$jenisid = $this->input->get('id');
$rowdata = 0;
$get_jenis = '';
if(trim($data['jenisid']) !== ''){
    $get_jenis = $model->getJenis($data['jenisid']);

}
if($this->session->flashdata('caution')!="") {
    echo "<script> alert('Jenis Sudah Ada!') </script>";
}
?>

    <div class="row">
        <div class="col-sm-12">
            <div id="form" class="panel panel-default panel-sm">
                <div class="panel-heading"><b>Input Jurnal</b></div>
                <div class="panel-body">
                    <form action="<?= base_url('master_jurnal/simpan'); ?>" method="post">

                        <table class="table table-condense  d">
                            <tr>
                                <td style="width: 15%;">Jenis Pengeluaran / Penerimaan</td>
                                <td>
                                    <div class="col-sm-4">
                                        <input type="hidden" name="penerimaan" id="penerimaan" />
                                        <input type="hidden" name="jenisid" id="jenisid" class="form-control input-sm" />
                                        <input type="text" id="jenis" class="form-control input-sm" value="<?= $get_jenis; ?>" readonly>
                                    </div>

                                    <input type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#list_jenis" value="Find Pengeluaran / Penerimaan" required>
                                </td>
                            </tr>
                            <tr>
                                <td>Keterangan</td>
                                <td>
                                    <div class="col-sm-6">
                                        <input type="text" id="keterangan" class="form-control input-sm" required readonly>
                                    </div>
                                </td>
                            </tr>
                        </table>
                        <div id="form" class="panel panel-default panel-sm">
                            <div class="panel-heading"><b>Detail Jurnal</b></div>
                            <div class="panel-body">
                                <a class="btn btn-sm btn-info" href="javascript:void(0)" onclick="addRow('detil_jurnal')"><i class="glyphicon glyphicon-plus"></i>Tambah Detil</a>
                                <a class="btn btn-sm btn-danger" href="javascript:void(0)" onclick="deleteRow('detil_jurnal')"><i class="glyphicon glyphicon-trash"></i>Delete Detil</a>
                                <table class="table table-bordered table-striped table-hover" id="detil_jurnal">
                                    <thead>
                                        <tr>
                                            <th width="3%">No</th>
                                            <th width="45%">Nama Akun</th>
                                            <th width="10%">Jurnal</th>
                                            <th width="10%">Ledger</th>
                                            <th width="10%">Laba Rugi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php if ($jenisid) {
                                        $count = 1;
                                        if (count($model->getDataByJenisId($jenisid)) > 0) {
                                            foreach ($model->getDataByJenisId($jenisid) as $info) {
                                           ;?>
                                            <tr>
                                                <td><?= $info->jurnalno; ?><input type="text" name="jurnalno[]" value="<?= $info->jurnalno; ?>" /> </td>
                                                <td>
                                                    <div class="col-sm-11">
                                                        <input type="text" id="nrcid_<?= $info->jurnalno ?>" name="nrcid_<?= $info->jurnalno ?>" value="<?= $info->akunid; ?>"/>
                                                        <input type="text" id="jurnalnama_<?= $info->jurnalno; ?>" name="jurnalnama_<?= $info->jurnalno; ?>" class="form-control input-sm" value="<?= $info->namaakun; ?>" readonly/>
                                                    </div>
                                                    <input type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#list_akun" value="..." id="modal<?= $info->jurnalno; ?>" />
                                                </td>
                                                <td>
                                                    <label class="radio-inlined">
                                                        <input type="radio" name="jurnaldk_<?= $info->jurnalno; ?>" value="1" <?php if ($info->jurnaldebet == 1): ?>checked="checked"<?php endif; ?>/> Debet
                                                    </label>
                                                    <label class="radio-inlined">
                                                        <input type="radio" name="jurnaldk_<?= $info->jurnalno; ?>" value="0" <?php if ($info->jurnaldebet == 0): ?>checked="checked"<?php endif; ?>/> Kredit
                                                    </label>
                                                </td>
                                                <td>
                                                    <label class="radio-inlined">
                                                        <input type="radio" name="ledgerdk_<?= $info->jurnalno; ?>" value="1" <?php if ($info->ledgerdebet == 1): ?>checked="checked"<?php endif; ?>/> Debet
                                                    </label>
                                                    <label class="radio-inlined">
                                                        <input type="radio" name="ledgerdk_<?= $info->jurnalno; ?>" value="0" <?php if ($info->ledgerdebet == 0): ?>checked="checked"<?php endif; ?>/> Kredit
                                                    </label>
                                                </td>
                                                <td>
                                                    <label class="radio-inlined">
                                                        <input type="radio" name="lrdk_<?= $info->jurnalno; ?>" value="1" <?php if ($info->labarugidebet == 1): ?>checked="checked"<?php endif; ?>/> Debet
                                                    </label>
                                                    <label class="radio-inlined">
                                                        <input type="radio" name="lrdk_<?= $info->jurnalno; ?>" value="0" <?php if ($info->labarugidebet == 0): ?>checked="checked"<?php endif; ?>/> Kredit
                                                    </label>
                                                </td>
                                            </tr>

                                    <?php }
                                        }
                                    $count++;
                                    } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="row">
                        <div class="col-sm-6">
                            <input type="submit" name="simpan" class="btn btn-success btn-sm" value="Simpan">
                            <a class="btn btn-sm btn-default" href="javascript:void(0)" title="Batal" onclick="window.location.href='<?= base_url() . 'master_jurnal'; ?>'"> Batal</a>
                        </div>
                        </div>
                        <div class="row">
                        <?php if($this->session->flashdata('err_message')!="") { ?>
                            <div class="alert alert-success alert-dismissible" role="alert" align="center">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true" id="infoMessage">&times;</span></button>
                                <h4><?= $this->session->flashdata('err_message');?></h4>
                            </div>
                        <?php } ?>
                        </div>

                    </form>
                </div>
            </div>
            <div id="form" class="panel panel-default panel-sm">
                <div class="panel-heading"><b>Daftar Jurnal</b></div>
                <div class="panel-body">
                    <a class="btn btn-sm btn-info" href="javascript:void(0)" onclick="window.location.href='<?= base_url('master_jurnal/input_jurnal'); ?>'"><i class="glyphicon glyphicon-plus"></i>Tambah Detil</a>
                    <table id="tabel_pengeluaran" class="table table-condensed table-hover table-striped">
                        <thead>
                        <tr>
                            <th width="20%" rowspan="2" class="text-center">Jenis</th>
                            <th width="20%" rowspan="2" class="text-center">Keterangan</th>
                            <th width="15%" rowspan="2" class="text-center">Pengeluaran / Penerimaan</th>
                            <th class="text-center"  width="30%" colspan="2">Jurnal</th>
                            <th width="15%" class="text-center" rowspan="2">Action</th>
                        </tr>
                        <tr>
                            <th class="text-center">Debet</th>
                            <th class="text-center">Kredit</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php $num=0; ?>
                        <?php foreach($list_jurnal as $info){ ?>
                             <?php $num++; ?>
                            <tr>
                                <td>
                                    <span id="jenis_<?= $num ?>"><?= $info->jenis;  ?></span>
                                    <script>
                                        var previd = $('#jenis_<?= $num-1 ?>').text();
                                        var id = $('#jenis_<?= $num ?>').text();
                                        if (previd == id) {
                                            document.getElementById('jenis_<?= $num ?>').textContent = '';
                                        } else {
                                            document.getElementById('jenis_<?= $num ?>').textContent = '<?= $info->jenis;  ?>';
                                        }
                                    </script>
                                </td>
                                <td>
                                    <span id="keterangan_<?= $num ?>"><?= $info->keterangan;  ?></span>
                                    <script>
                                        var previd = $('#keterangan_<?= $num-1 ?>').text();
                                        var id = $('#keterangan_<?= $num ?>').text();
                                        if (previd == id) {
                                            document.getElementById('keterangan_<?= $num ?>').textContent = '';
                                        }
                                    </script>
                                </td>
                                <td>
                                    <span id="status_<?= $num ?>"><?= ($info->penerimaan==0) ? 'Pengeluaran' : 'Penerimaan';  ?></span>
                                    <script>
                                        var previd = $('#status_<?= $num-1 ?>').text();
                                        var id = $('#status_<?= $num ?>').text();
                                        if (previd == id) {
                                            document.getElementById('status_<?= $num ?>').textContent = '';
                                        } else {
                                            document.getElementById('status_<?= $num ?>').textContent = id;
                                        }
                                    </script>
                                </td>
                                <td><?= ($info->jurnaldebet==1) ? $info->namaakun : '';  ?></td>
                                <td><?= ($info->jurnaldebet==0) ? $info->namaakun : '';  ?></td>
                                <td width="20%">
                                    <a class="btn btn-sm btn-primary" href="javascript:void(0)" title="Edit" onclick="window.location.href='<?= $load_url; ?>?id=<?= $info->jenisid; ?>'"><i class="glyphicon glyphicon-pencil"></i> Edit</a>
                                    <a class="btn btn-sm btn-danger" href="javascript:void(0)" title="Hapus" onclick="hapus_data('<?= $info->jenisid; ?>','<?= $info->jenis; ?>','<?= $del_url; ?>?id=<?= $info->jenisid; ?>')"><i class="glyphicon glyphicon-trash"></i> Delete</a>
                                </td>
                            </tr>
                        <?php } ?>
                        </tbody>
                    </table>
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
                    <h4 class="modal-title" id="myModalLabel">Daftar Jenis PenerimAan & Pengeluaran</h4>
                </div>
                <div class="modal-body">
                    <ul class="nav nav-tabs nav-justified">
                        <li><a href="#tab1" data-toggle="tab">Penerimaan</a></li>
                        <li class="active"><a href="#tab2" data-toggle="tab">Pengeluaran</a></li>
                    </ul>

                    <div class="tab-content">
                        <div class="tab-pane" id="tab1">
                            <table id="tabel_jenispenerimaan" class="table table-bordered table-hover table-striped" style="cursor:pointer;">
                                <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Jenis</th>
                                    <th>Keterangan</th>
                                    <th>Lokasi</th>
                                    <th>Keterangan Jenis Penerimaan</th>
                                    <th>Mesin Jenis Penerimaan</th>
                                    <th>Kartu Jenis Penerimaan</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php foreach($list_penerimaan as $info){ ?>
                                    <tr id="pilih" penerimaan="1" jenisid="<?= $info->inid; ?>" jenis="<?= $info->jenis; ?>" keterangan="<?= $info->keterangan; ?>">
                                        <td><?= $info->inid; ?></td>
                                        <td><?= $info->jenis; ?></td>
                                        <td><?= $info->keterangan; ?></td>
                                        <td><?= $info->locationket; ?></td>
                                        <td><?= $info->inketjenis; ?></td>
                                        <td><?= $info->inketmesin; ?></td>
                                        <td><?= $info->inketkartu; ?></td>
                                    </tr>
                                <?php } ?>
                                </tbody>
                            </table>
                        </div>
                        <div class="tab-pane active" id="tab2">
                            <table id="tabel_jenispengeluaran" class="table table-bordered table-hover table-striped" style="cursor:pointer;">
                                <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Jenis</th>
                                    <th>Keterangan</th>
                                    <th>Pengajuan/Cash</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php $no=1; ?>
                                <?php foreach($list_pengeluaran as $info){ ?>
                                    <tr id="pilih" penerimaan="0" jenisid="<?= $info->outid; ?>" jenis="<?= $info->jenis; ?>" keterangan="<?= $info->keterangan; ?>">
                                        <td><?= $no; ?></td>
                                        <td><?= $info->jenis; ?></td>
                                        <td><?= $info->keterangan; ?></td>
                                        <td><?php if($info->pengajuan==0) {echo 'Cash';} else {echo 'Pengajuan';}  ?></td>
                                    </tr>
                                    <?php $no++; ?>
                                <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>


                </div>
            </div>
        </div>
    </div>
    <div class="modal" id="list_akun" role="dialog">
        <div class="modal-dialog modal-lg">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Daftar Jenis Peneriamaan & Pengeluaran</h4>
                </div>
                <div class="modal-body">
                    <input type="hidden" id="noakun">
                    <table id="tabel_akun" class="table table-hover table-striped" style="cursor:pointer;">
                        <thead>
                        <tr>
                            <th colspan="4">No. Akun</th>
                            <th>Nama Akun</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach($list_akun as $info){ ?>
                            <tr id="pilih2" nrcid="<?= $info->akunid; ?>" namaakun="<?= $info->namaakun; ?>">
                                <td width="5%"><?php if($info->lvl == 1) {echo $info->noakun;} ?></td>
                                <td width="5%"><?php if($info->lvl == 2) {echo $info->noakun;} ?></td>
                                <td width="5%"><?php if($info->lvl == 3) {echo $info->noakun;} ?></td>
                                <td width="10%"><?php if($info->lvl == 4) {echo $info->noakun;} ?></td>
                                <td width="55%"><?= $info->namaakun; ?></td>
                            </tr>
                        <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
        <script>
            function addRow(detil_jurnal) {
                var table = document.getElementById(detil_jurnal);
                var rowCount = table.rows.length;
                console.log(rowCount);
                var row = table.insertRow(rowCount);

                var col1 = row.insertCell(0);
                var element1 = document.createElement("input");
                element1.type = "hidden"; //hidden
                element1.name = "jurnalno[]";
                console.log(element1.name);
                element1.value = rowCount;
                col1.innerHTML = rowCount;
                col1.appendChild(element1);

                var col2 = row.insertCell(1);
                var div = document.createElement("div");
                div.className = "col-sm-11";
                col2.appendChild(div);
                var element2 = document.createElement("input");
                element2.type = "hidden"; //hidden
                element2.id = "nrcid_"+rowCount;
                element2.name = "nrcid_"+ rowCount;
                console.log(element2.name);
                div.appendChild(element2);
                var element3 = document.createElement("input");
                element3.type = "text";
                element3.id = "jurnalnama_"+rowCount;
                element3.name = "jurnalnama_"+rowCount;
                element3.className = "form-control input-sm";
                element3.readOnly = true;
                console.log(element3.name);
                div.appendChild(element3);

                var elementbtn = document.createElement("input");
                elementbtn.type = "button";
                elementbtn.className = "btn btn-info btn-sm";
                elementbtn.setAttribute("data-toggle","modal");
                elementbtn.setAttribute("data-target","#list_akun");
                elementbtn.value = "...";
                elementbtn.id = "modal"+rowCount;
                col2.appendChild(elementbtn);

                var col3 = row.insertCell(2);
                var label1 = document.createElement("label");
                label1.className = "radio-inlane";
                col3.appendChild(label1);
                var element4 = document.createElement("input");
                element4.type = "radio";
                element4.name = "jurnaldk_" + rowCount;
                element4.value = "1";
                console.log(element4.name); console.log(element4.value);
                label1.appendChild(element4);
                label1.innerHTML += " Debet";
                var label2 = document.createElement("label");
                label2.className = "radio-inlane";
                col3.appendChild(label2);
                var element5 = document.createElement("input");
                element5.type = "radio";
                element5.name = "jurnaldk_" + rowCount;
                element5.value = "0";
                console.log(element5.name); console.log(element5.value);
                label2.appendChild(element5);
                label2.innerHTML += " Kredit";

                var col4 = row.insertCell(3);
                var label3 = document.createElement("label");
                label3.className = "radio-inlane";
                col4.appendChild(label3);
                var element6 = document.createElement("input");
                element6.type = "radio";
                element6.name = "ledgerdk_" + rowCount;
                element6.value = "1";
                console.log(element6.name); console.log(element6.value);
                label3.appendChild(element6);
                label3.innerHTML += " Debet";
                var label4 = document.createElement("label");
                label4.className = "radio-inlane";
                col4.appendChild(label4);
                var element6 = document.createElement("input");
                element6.type = "radio";
                element6.name = "ledgerdk_" + rowCount;
                element6.value = "0";
                console.log(element6.name); console.log(element6.value);
                label4.appendChild(element6);
                label4.innerHTML += " Kredit";

                var col5 = row.insertCell(4);
                var label5 = document.createElement("label");
                label5.className = "radio-inlane";
                col5.appendChild(label5);
                var element7 = document.createElement("input");
                element7.type = "radio";
                element7.name = "lrdk_" + rowCount;
                element7.value = "1";
                console.log(element7.name); console.log(element7.value);
                label5.appendChild(element7);
                label5.innerHTML += " Debet";
                var label6 = document.createElement("label");
                label6.className = "radio-inlane";
                col5.appendChild(label6);
                var element8 = document.createElement("input");
                element8.type = "radio";
                element8.name = "lrdk_" + rowCount;
                element8.value = "0";
                console.log(element8.name); console.log(element8.value);
                label6.appendChild(element8);
                label6.innerHTML += " Kredit";
            }
            function deleteRow(detil_jurnal) {
                try {
                    var table = document.getElementById(detil_jurnal);
                    var rowCount = table.rows.length - 1;
                    console.log(rowCount);

                    for(var i =0; i < rowCount; i++) {
                        if (i = rowCount) {
                            table.deleteRow(i);
                            rowCount--;
                            i--;
                        }
                    }
                } catch (e) {
                    alert(e);
                }
            }

            $(document).on('click','#pilih', function(e) {
                document.getElementById("penerimaan").value = $(this).attr('penerimaan');
                document.getElementById("jenisid").value = $(this).attr('jenisid');
                document.getElementById("jenis").value = $(this).attr('jenis');
                document.getElementById("keterangan").value = $(this).attr('keterangan');
                $('#list_jenis').modal('hide');
            });

            $(document).on('click','#pilih2', function(e) {
                var id = document.getElementById('noakun').value;
                var tbneracaid = "nrcid_" + id;
                var tbnama = "jurnalnama_" + id;
                document.getElementById(tbneracaid).value = $(this).attr('nrcid');
                document.getElementById(tbnama).value = $(this).attr('namaakun');
                $('#list_akun').modal('hide');
            });

            $('#list_akun').on('show.bs.modal', function(e) {
                var $modal = $(this),
                esseyId = e.relatedTarget.id;
                var id = esseyId.substring(5,6);
                $modal.find('#noakun').val(id);

            });


        </script>
    </div>
    <!-- /.row -->

<?php include_once 'layout_admin_bottom.php'; ?>