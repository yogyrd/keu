<?php
$admin_page_title = '';
$admin_page_breadcrumb = '';
include_once 'layout_admin_top.php';

$jml_pengajuan = 0;
$jml_realisasi = 0;
$CI =& get_instance();
$CI->load->model('M_Rpt_penerimaan','inc');

$tgl1 = $this->input->get('tgl1');
$tgl2 = $this->input->get('tgl2');
?>

<div class="row">
    <div class="col-lg-12">
        <form action="<?= base_url(''); ?>" method="post" target="_blank">
            <button type="submit" class="btn btn-success btn-sm pull-right"><i class="glyphicon glyphicon-print"></i> Cetak</button>
        </form>
        <div class="panel">
            <div class="panel-body">
                <h3>Laporan Pendapatan </h3>
                <h5>
                    Tanggal  :<strong> <?= $tgl1; ?> s/d <?= $tgl2; ?> </strong><br/>
                </h5>
                <table class="table table-striped" id="tableomzet">
                    <thead>
                    <tr>
                        <th>Lokasi</th>
                        <?php foreach ($list_lokasi as $list_loc) { ?>
                            <th colspan="2"><?= $list_loc->locationket; ?></th>
                        <?php } ?>
                    </tr>
                    <tr>
                        <th>Jenis</th>
                        <?php foreach ($list_lokasi as $list_loc) { ?>
                            <th width="10%">TUNAI</th>
                            <th width="10%">TAGIHAN</th>
                        <?php } ?>
                    </tr>
                    </thead>
                    <tbody>
                    <?php $totaltunai=0;$totaltagihan=0;  ?>
                        <tr>
                            <td>Admin</td>
                            <?php foreach ($list_lokasi as $list_loc) { ?>
                                <td align="right"><?= number_format($CI->inc->getOmzetAdminTunai($list_loc->locid,$tgl1,$tgl2),0,',','.'); ?></td>
                                <td align="right"><?= number_format($CI->inc->getOmzetAdminTagihan($list_loc->locid,$tgl1,$tgl2),0,',','.'); ?></td>
                            <?php } ?>
                        </tr>
                        <tr>
                            <td>dr. Umum</td>
                            <?php foreach ($list_lokasi as $list_loc) { ?>
                                <td align="right"><?= number_format($CI->inc->getOmzetPoliAwalTunai($list_loc->locid,$tgl1,$tgl2),0,',','.'); ?></td>
                                <td align="right"><?= number_format($CI->inc->getOmzetPoliAwalTagihan($list_loc->locid,$tgl1,$tgl2),0,',','.'); ?></td>
                            <?php } ?>
                        </tr>
                        <tr>
                            <td>Tindakan</td>
                            <?php foreach ($list_lokasi as $list_loc) { ?>
                                <td align="right"><?= number_format($CI->inc->getOmzetPoliTunai($list_loc->locid,$tgl1,$tgl2),0,',','.'); ?></td>
                                <td align="right"><?= number_format($CI->inc->getOmzetPoliTagihan($list_loc->locid,$tgl1,$tgl2),0,',','.'); ?></td>
                            <?php } ?>
                        </tr>
                        <tr>
                            <td>Gigi</td>
                            <?php foreach ($list_lokasi as $list_loc) { ?>
                                <td align="right"><?= number_format($CI->inc->getOmzetGigiTunai($list_loc->locid,$tgl1,$tgl2),0,',','.'); ?></td>
                                <td align="right"><?= number_format($CI->inc->getOmzetGigiTagihan($list_loc->locid,$tgl1,$tgl2),0,',','.'); ?></td>
                            <?php } ?>
                        </tr>
                        <tr>
                            <td>Lab</td>
                            <?php foreach ($list_lokasi as $list_loc) { ?>
                                <td align="right"><?= number_format($CI->inc->getOmzetLabTunai($list_loc->locid,$tgl1,$tgl2),0,',','.'); ?></td>
                                <td align="right"><?= number_format($CI->inc->getOmzetLabTagihan($list_loc->locid,$tgl1,$tgl2),0,',','.'); ?></td>
                            <?php } ?>
                        </tr>
                    </tbody>
                    <tfoot>
                        <tr>
                            <th>TOTAL</th>
                            <?php foreach ($list_lokasi as $list_loc) { ?>
                                <th class="text-right"><?= number_format($CI->inc->getTotalTunai($list_loc->locid,$tgl1,$tgl2),0,',','.'); ?></th>
                                <th class="text-right"><?= number_format($CI->inc->getTotalTagihan($list_loc->locid,$tgl1,$tgl2),0,',','.'); ?></th>
                            <?php } ?>
                        </tr>
                    </tfoot>
                </table>
                <div class="pull-left">Jumlah Omzet Tunai Semua Klinik:<strong> Rp. <?= number_format($CI->inc->getTotalTunaiAllKlinik($tgl1,$tgl2),0,',','.'); ?></strong></div> <br />
                <div class="pull-left">Jumlah Piutang Semua Klinik:<strong> Rp. <?= number_format($CI->inc->getTotalTagihanAllKlinik($tgl1,$tgl2),0,',','.'); ?></strong></div>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function() {
        $('#tableomzet').DataTable( {
            "scrollX": true,
            "searching": false,
            "paging": false,
            "ordering": false,
            "info": false
        } );
    } );
</script>
<!-- /.row -->

<?php include_once 'layout_admin_bottom.php'; ?>

