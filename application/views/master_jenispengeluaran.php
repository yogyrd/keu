<?php
$admin_page_title = 'Master Jenis Pengeluaran';
$admin_page_breadcrumb = 'Lokasi : '.ucfirst($this->session->userdata('location'));
include_once 'layout_admin_top.php';
$baseurl = base_url() . "master_jenispengeluaran";
if ($link == $baseurl || $link == $baseurl.'/') {
    $data = 0;
}

$loc = strtoupper(ucfirst($this->session->userdata('location')));
$locid = strtoupper(ucfirst($this->session->userdata('locid')));
?>

    <div class="row">
        <div class="col-sm-12">
            <div id="form" class="panel panel-default panel-sm">
                <div class="panel-heading"><b>Input Jenis Pengeluaran</b></div>
                <div class="panel-body">
                    <form action="<?= $submit_url; ?>" method="post">
                        <table class="table table-condensed">
                            <tr>
                                <td style="width:10%;">Jenis</td>
                                <td>
                                    <div class="col-sm-4">
                                        <input type="hidden" name="outid" value="<?= $data['outid']; ?>" />
                                        <input type="text" name="jenis" class="form-control input-sm" value="<?= $data['jenis']; ?>" required>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>Keterangan</td>
                                <td>
                                    <div class="col-sm-6">
                                        <input type="text" name="keterangan" class="form-control input-sm" value="<?= $data['keterangan']; ?>">
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>Group Jenis Pengeluaran</td>
                                <td>
                                    <div class="col-sm-6">
                                        <input type="hidden" id="group_id" name="costid" value="<?=$data['costid']; ?>"/>
                                        <input type="text" id="group_id_ac" class="form-control input-sm input_ac" placeholder="Search Group Jenis..." value="<?= $model->getGroupJenis($data['costid']); ?>" />
                                        <span></span>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>Keategori</td>
                                <td>
                                    <div class="col-sm-6">
                                        <label class="radio-inline"><input type="radio" name="pengajuan" value="1" <?php if ($data['pengajuan'] == 1): ?>checked="checked"<?php endif; ?> required> Pengajuan</label>
                                        <label class="radio-inline"><input type="radio" name="pengajuan" value="0" <?php if ($data['pengajuan'] == 0): ?>checked="checked"<?php endif; ?> required> Cash</label>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td></td>
                                <td>
                                    <div class="col-sm-6">
                                        <input type="submit" id="btnsimpan" class="btn btn-success btn-sm" value="Simpan">
                                        <a class="btn btn-sm btn-default" href="javascript:void(0)" title="Batal" onclick="window.location.href='<?= base_url() . 'master_jenispengeluaran'; ?>'"> Batal</a>
                                    </div>
                                </td>
                            </tr>
                        </table>
                    </form>
                </div>
            </div>
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">Daftar Jenis Pengeluaran</h3>
                </div>
                <div class="row" style="margin-top: 10px;">
                    <div class="col-sm-12">
                        <a class="btn btn-sm btn-danger pull-right" href="javascript:void(0)" title="PDF" onclick="window.location.href='<?= base_url(); ?>master_jenispengeluaran/cetak_jenispengeluaran'"><span class="fa fa-file-pdf-o"> PDF</span></a>
                    </div>
                </div>
                <div class="panel-body">
                    <table id="tabel_pengeluaran" class="table table-condensed table-bordered table-striped">
                        <thead>
                        <tr>
                            <th width="5%">Pengeluaran ID</th>
                            <th width="15%">Group Jenis</th>
                            <th width="20%">Jenis</th>
                            <th width="20%">Keterangan</th>
                            <th width="15%">Kategori</th>
                            <th width="15%">Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach($list_data as $info){ ?>
                            <tr>
                                <td><?= $info->outid; ?></td>
                                <td><?= $info->costjenis; ?></td>
                                <td><?= $info->jenis; ?></td>
                                <td><?= $info->keterangan; ?></td>
                                <td><?php if($info->pengajuan==1) {echo "Pengajuan";} else {echo "Cash";} ?></td>
                                <td>
                                    <a class="btn btn-sm btn-primary" href="javascript:void(0)" title="Edit" onclick="window.location.href='<?= $load_url; ?>?id=<?= $info->outid; ?>'"><i class="glyphicon glyphicon-pencil"></i> Edit</a>
                                    <a class="btn btn-sm btn-danger" href="javascript:void(0)" title="Hapus" onclick="hapus_data('<?= $info->outid; ?>','<?= $info->jenis; ?>','<?= $del_url; ?>?id=<?= $info->outid; ?>')"><i class="glyphicon glyphicon-trash"></i> Delete</a>
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
    <script>
        $("#group_id_ac").autocomplete({
            source: '<?= $this_controller; ?>/ac_groupjenis',
            minLength: 1,
            select: function( event, ui ) {

                if(ui.item.id == ''){
                    ui.item.label = '';
                    ui.item.value = '';
                }

                console.log(['selected',ui]);

                $("#group_id").val(ui.item.id);
                console.log(document.getElementById('group_id').value);

            },
            response: function( event, ui ) {
                console.log([event,ui]);
                $("#group_id").val('');
            },
        });
        $("#group_id_ac").blur(function () {
            var a = document.getElementById('group_id').value;
            var text = '';
            if (!a) {
                document.getElementById('btnsimpan').disabled = true;
                alert('Group Jenis Tidak Tersedia!!');
            } else {
                document.getElementById('btnsimpan').disabled = false;
            }
        });
    </script>

<?php include_once 'layout_admin_bottom.php'; ?>