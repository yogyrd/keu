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
            <th>Group Jenis</th>
            <th>Keterangan</th>
            <th>Budget</th>
            <th>Tanggal Awal</th>
            <th>Tanggal Akhir</th>
        </tr>
    </thead>
    <tbody>
    <?php $counter=1; ?>
    <?php foreach ($list_data as $info) { ?>
    <tr>
        <td><?= $counter; $counter++; ?></td>
        <td><?= $info->locket; ?></td>
        <td><?= $info->costjenis; ?></td>
        <td><?= $info->costket; ?></td>
        <td><?= $info->nilaimax;?></td>
        <td><?= $info->startdate; ?></td>
        <td><?= $info->enddate; ?></td>
    </tr>
    <?php } ?>

    </tbody>
</table>