<?php

class M_Rpt_kaskecil extends MY_Master_Model {

    function __construct() {
        parent::__construct();
        $this->table_name = 'acctranskas';
        $this->id_field = 'transoutid';
        date_default_timezone_set('Asia/Jakarta');
        $sql = "";
    }

    public function getDataKasKecilNoReal($locid, $tgloption, $tgl1, $tgl2) {
        if ($tgl1 == $tgl2) {
            $sql = "select a.transoutid, a.createddate, a.notrans, a.keterangan, a.nomorfaktur, a.transtgl, a.bebantgl, c.jenis, e.locationket, a.nilaiuang, a.realisasidate,
                    d.suppliernama, d.supplierbank, d.supplierbanknorek
                    from acctranskas a inner join accmasterpengeluarannilai b on a.nilaidetailid=b.nilaidetailid
                    inner join accmasterpengeluaran c on b.outid=c.outid
                    inner join mastersupplier d on a.supplierid=d.supplierid
                    inner join masterlokasi e on a.loc=e.locid
                    where a.loc like '%$locid%' and c.pengajuan=0 and a.realisasistatus=0 and a.closed=0 and (a.$tgloption like '$tgl1 %')
                    order by c.jenis, a.$tgloption asc";
        } else {
            $sql = "select a.transoutid, a.createddate, a.notrans, a.keterangan, a.nomorfaktur, a.transtgl, a.bebantgl, c.jenis, e.locationket, a.nilaiuang, a.realisasidate,
                    d.suppliernama, d.supplierbank, d.supplierbanknorek
                    from acctranskas a inner join accmasterpengeluarannilai b on a.nilaidetailid=b.nilaidetailid
                    inner join accmasterpengeluaran c on b.outid=c.outid
                    inner join mastersupplier d on a.supplierid=d.supplierid
                    inner join masterlokasi e on a.loc=e.locid
                    where a.loc like '%$locid%' and c.pengajuan=0 and a.realisasistatus=0 and a.closed=0 and (a.$tgloption between '$tgl1' and '$tgl2 23:59:59')
                    order by c.jenis, a.$tgloption asc";
        }
        $query = $this->db->query($sql,false);
        return $query->result();
    }

    public function getDataKasKecilReal($locid, $tgloption, $tgl1, $tgl2) {
        if ($tgl1 == $tgl2) {
            $sql = "select a.transoutid, a.createddate, a.notrans, a.keterangan, a.nomorfaktur, a.transtgl, a.bebantgl, c.jenis, e.locationket, a.nilaiuang, a.realisasi, a.realisasidate, a.realisasiket,
                    d.suppliernama, d.supplierbank, d.supplierbanknorek
                    from acctranskas a inner join accmasterpengeluarannilai b on a.nilaidetailid=b.nilaidetailid
                    inner join accmasterpengeluaran c on b.outid=c.outid
                    inner join mastersupplier d on a.supplierid=d.supplierid
                    inner join masterlokasi e on a.loc=e.locid
                    where a.loc like '%$locid%' and c.pengajuan=0 and a.realisasistatus=1 and a.closed<>0 and (a.$tgloption like '$tgl1 %')
                    order by c.jenis, a.$tgloption asc";
        } else {
            $sql = "select a.transoutid, a.createddate, a.notrans, a.keterangan, a.nomorfaktur, a.transtgl, a.bebantgl, c.jenis, e.locationket, a.nilaiuang, a.realisasi, a.realisasidate, a.realisasiket,
                    d.suppliernama, d.supplierbank, d.supplierbanknorek
                    from acctranskas a inner join accmasterpengeluarannilai b on a.nilaidetailid=b.nilaidetailid
                    inner join accmasterpengeluaran c on b.outid=c.outid
                    inner join mastersupplier d on a.supplierid=d.supplierid
                    inner join masterlokasi e on a.loc=e.locid
                    where a.loc like '%$locid%' and c.pengajuan=0 and a.realisasistatus=1 and a.closed<>0 and (a.$tgloption between '$tgl1' and '$tgl2 23:59:59')
                    order by c.jenis, a.$tgloption asc";
        }
        $query = $this->db->query($sql,false);
        return $query->result();
    }


}