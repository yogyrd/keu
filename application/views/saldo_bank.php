<?php
$admin_page_title = 'Saldo Bank';
$admin_page_breadcrumb = '';
include_once 'layout_admin_top.php';
$baseurl = base_url() . "saldo_bank";
if ($link == $baseurl || $link == $baseurl . '/') {
    $data = 0;
}

$tgl = date('Y-m-d H:i:s');
?>

    <div class="row">
        <div class="col-sm-12">
            <div id="form" class="panel panel-default panel-sm">
                <div class="panel-heading"><b>Input Saldo Awal Bank</b></div>
                <div class="panel-body">
                    <form action="<?=  base_url('saldo_bank/insert_debet'); ?>" method="post">
                        <table class="table table-condensed">
                            <tr>
                                <td style="width:10%;">ID</td>
                                <td>
                                    <div class="col-sm-2">
                                        <input type="text" name="saldoid" class="form-control input-sm" value="<?= $data['saldoid']; ?>" readonly>
                                        <input type="hidden" name="keterangan" class="form-control input-sm" value="Saldo Awal Bank" required>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>Bank</td>
                                <td>
                                    <div class="col-md-4">
                                        <select name="bankid" class="form-control" required>
                                            <option value="">Pilih Bank</option>
                                            <?php foreach($list_bank as $list){ ?>
                                                <option value="<?= $list->bankid; ?>"><?= $list->namabank . ' - ' . $list->norekening; ?></option>
                                            <?php } ?>
                                        </select>
                                        <span class="help-block"></span>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>Nominal saldo awal</td>
                                <td>
                                    <div class="col-sm-4">
                                        <div class="input-group">
                                            <span class="input-group-addon">Rp </span>
                                            <input type="text" id="strnilaiuang" class="form-control input-sm" required>
                                            <input type="hidden" name="debet" id="nilaiuang" class="form-control input-sm"  required>
                                        </div>
                                    </div>
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
                </div>
            </div>
        </div>
    </div>
    <!-- /.row -->
    <script  type="text/javascript">
        document.getElementById("strnilaiuang").oninput = function(e) {
            if (this.value != "") {
                this.value = parseFloat(this.value.replace(/,/g, ""))
                    .toFixed()
                    .toString()
                    .replace(/\B(?=(\d{3})+(?!\d))/g, ",");
            }
            document.getElementById("nilaiuang").value = this.value.replace(/,/g, "");

        }
    </script>

<?php include_once 'layout_admin_bottom.php'; ?>