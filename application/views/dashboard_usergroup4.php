<div class="row">
    <div class="col-lg-12">
        <div class="panel-body">
            <div class="panel-group">
                <div class="panel panel-info">
                    <div class="panel-heading">
                        <h4 class="panel-title">
                            <a data-toggle="collapse" href="#collapse_trans">
                                Status Transaksi Bulan Ini
                            </a>
                        </h4>
                    </div>
                    <div class="panel-body" id="collapse_trans">
                        <table id="tabel_trans_kas_home" class="table table-condensed table-bordered table-striped">
                            <thead>
                            <tr>
                                <th width="5%">Tanggal Input</th>
                                <th width="5%">No. Transaksi</th>
                                <th width="15%">Keterangan</th>
                                <th width="5%">Tanggal Transaksi</th>
                                <th width="5%">No. Faktur</th>
                                <th width="10%">Jenis</th>
                                <th width="10%">Nilai Pengajuan</th>
                                <th width="5%">Pembayaran</th>
                                <th width="5%">Status Approval KaCab</th>
                                <th width="5%">Status Approval Keu</th>
                                <th width="5%">Status Approval Kadiv. Keu</th>
                                <th width="5%">Status Approval Dir. Keu</th>
                                <th width="5%">Realisasi</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php foreach($list_trans as $info){ ?>
                                <tr>
                                    <td><?= date('Y-m-d',strtotime($info->createddate)); ?></td>
                                    <td><?= $info->notrans; ?></td>
                                    <td><?= $info->keterangan; ?></td>
                                    <td><?= date('Y-m-d',strtotime($info->transtgl)); ?></td>
                                    <td><?= $info->nomorfaktur; ?></td>
                                    <td><?= $info->jenis; ?></td>
                                    <td align="right"><?php $rp = number_format($info->nilaiuang,0,',','.'); echo 'Rp '.$rp;?></td>
                                    <td><?= ($info->supplierid == 1) ? 'TUNAI':$info->suppliernama . ' - ' . $info->supplierbanknorek;  ?></td>
                                    <td align="center">
                                        <?php
                                        $accuserdate = date('Y-m-d',strtotime($info->accuserdate));
                                        if($accuserdate == '-0001-11-30') {
                                            echo "<span class=\"label label-warning\">On Process</span>";
                                        } else {
                                            echo "<span class='label label-success'>Approved</span><br>
                                                  $accuserdate";
                                        } ?>
                                    </td>
                                    <td align="center">
                                        <?php
                                        $acc1date = date('Y-m-d',strtotime($info->acc1date));
                                        if($acc1date == '-0001-11-30') {
                                            echo "<span class=\"label label-warning\">On Process</span>";
                                        } else {
                                            echo "<span class='label label-success'>Approved</span><br>
                                                  $acc1date";
                                        } ?>
                                    </td>
                                    <td align="center">
                                        <?php
                                        $acc2date = date('Y-m-d',strtotime($info->acc2date));
                                        if($acc2date == '-0001-11-30') {
                                            echo "<span class=\"label label-warning\">On Process</span>";
                                        } else {
                                            echo "<span class='label label-success'>Approved</span><br>
                                                  $acc2date";
                                        } ?>
                                    </td>
                                    <td align="center">
                                        <?php
                                        $acc3date = date('Y-m-d',strtotime($info->acc3date));
                                        if($acc3date == '-0001-11-30') {
                                            echo "<span class=\"label label-warning\">On Process</span>";
                                        } else {
                                            echo "<span class='label label-success'>Approved</span><br>" . $acc3date;
                                        } ?>
                                    </td>
                                    <td align="center">
                                        <?php
                                        $realisasidate = date('Y-m-d',strtotime($info->realisasidate));
                                        if($realisasidate == '-0001-11-30') {
                                            echo "<span class=\"label label-warning\">On Process</span>";
                                        } else {
                                            echo "<span class='label label-success'>Approved</span><br>" . $realisasidate;
                                        } ?>
                                    </td>
                                </tr>
                            <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="panel-group">
                <div class="panel panel-danger">
                    <div class="panel-heading">
                        <h4 class="panel-title">
                            <a data-toggle="collapse" href="#collapse_reject">
                                Daftar Transaksi Reject
                            </a>
                        </h4>
                    </div>
                    <div class="panel-body" id="collapse_reject">
                        <table id="tabel_reject" class="table table-condensed table-bordered table-striped">
                            <thead>
                            <tr>
                                <th width="10%">Tanggal Transaksi</th>
                                <th width="15%">Keterangan</th>
                                <th width="15%">Jenis</th>
                                <th width="15%">No. Faktur</th>
                                <th width="15%">Nilai Pengajuan</th>
                                <th width="30%">Alasan Ditolak</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php foreach($list_reject as $info){ ?>
                                <tr>
                                    <td><?= date('Y-m-d',strtotime($info->transtgl)); ?></td>
                                    <td><?= $info->keterangan; ?></td>
                                    <td><?= $info->jenis; ?></td>
                                    <td><?= $info->nomorfaktur; ?></td>
                                    <td align="right"><?php $rp = number_format($info->nilaiuang,0,',','.'); echo 'Rp '.$rp;?></td>
                                    <td><?= $info->alasan; ?></td>
                                </tr>
                            <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="panel-group">
                <div class="panel panel-success">
                    <div class="panel-heading">
                        <h4 class="panel-title">
                            <a data-toggle="collapse" href="#collapse_realisasi">
                                Daftar Pengajuan Yang Terealisasi
                            </a>
                        </h4>
                    </div>
                    <div class="panel-body" id="collapse_realisasi">
                        <table id="tabel_userrealisasi" class="table table-condensed table-bordered table-striped">
                            <thead>
                            <tr>
                                <th width="10%">Kode Transaksi</th>
                                <th width="10%">Tanggal Transaksi</th>
                                <th width="15%">Keterangan</th>
                                <th width="10%">Jenis</th>
                                <th width="10%">No. Faktur</th>
                                <th width="15%">Nilai Pengajuan</th>
                                <th width="15%">Realisasi</th>
                                <th width="10%">Tanggal Realisasi</th>
                                <th width="5%">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php foreach($list_realisasi as $info){ ?>
                                <tr>
                                    <td><?= $info->notrans; ?></td>
                                    <td><?= date('Y-m-d',strtotime($info->transtgl)); ?></td>
                                    <td><?= $info->transket; ?></td>
                                    <td><?= $info->jenis; ?></td>
                                    <td><?= $info->nomorfaktur; ?></td>
                                    <td align="right"><?php $rp = number_format($info->nilaiuang,0,',','.'); echo 'Rp '.$rp;?></td>
                                    <td align="right"><?php $rp = number_format($info->realisasi,0,',','.'); echo 'Rp '.$rp;?></td>
                                    <td><?= date('Y-m-d',strtotime($info->realisasidate)); ?></td>
                                    <td>
                                        <a class="btn btn-sm btn-danger" href="javascript:void(0)" title="Cetak" onclick="window.location.href='<?= base_url(); ?>realisasi_cabang/cetakKasKecil?id=<?= $info->transoutid; ?>'" target="_blank"><i class="glyphicon glyphicon-print"></i> Cetak</a>
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
</div>