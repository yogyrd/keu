<?php

header("Content-type: application/octet-stream");
header("Content-Disposition: attachment; filename=". $title .".xls");
header("Pragma: no-cache");
header("Expires: 0");

?>
<table class="table">
    <thead>
        <tr>
            <th>No</th>
            <th>Lokasi</th>
            <th>Jenis</th>
            <th>Budget per Klaim</th>
            <th>Group Jenis</th>
            <th>Budget per Bulan</th>
            <th>Tanggal Awal</th>
            <th>Tanggal Akhir</th>
        </tr>
    </thead>
    <tbody>
    <?php $counter=1; ?>
    <?php foreach ($list_data as $info) { ?>
    <tr>
        <td><?= $counter; $counter++; ?></td>
        <td><?= $info->locationket; ?></td>
        <td><?= $info->jenis; ?></td>
        <td><?= $info->nilaimaxdetil; ?></td>
        <td><?= $info->costjenis;?></td>
        <td><?= $info->nilaimaxgroup;?></td>
        <td><?= $info->startdate; ?></td>
        <td><?= $info->enddate; ?></td>
    </tr>
    <?php } ?>

    </tbody>
</table>