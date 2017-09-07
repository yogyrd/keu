<?php

class M_Rpt_bkk extends MY_Base_Model {
    
    function __construct() {
        parent::__construct();
        date_default_timezone_set('Asia/Jakarta');
    }

    public function getAllKasKeluar($locid) {
        $sql = "select DISTINCT(a.incomeid), a.loc, a.inctgl, a.incnilai, d.pengajuan
                from acctranspenerimaan a inner join acctranskas b on b.incomeid=a.incomeid
                inner join accmasterpengeluarannilai c on b.nilaidetailid=c.nilaidetailid
                inner join accmasterpengeluaran d on c.outid=d.outid
                where a.incomeid in (select incomeid from acctranskas where closed=0) and a.loc like '%$locid%'";
        $query = $this->db->query($sql,false);
        return $query->result();
    }

    public function getAllLokasi() {
        $sql = "select * from masterlokasi";
        $query = $this->db->query($sql,false);
        return $query->result();
    }

    public function getLocation($loc) {
        $sql = "select * from masterlokasi where locid ='$loc'";
        $query = $this->db->query($sql,false);
        if ($query->num_rows() > 0) {
            return $query->result('array')[0]['locationket'];
        } else {
            return 'Semua Lokasi';
        }
    }

    public function getLocid($incomeid) {
        $sql = "select loc from acctranspenerimaan where incomeid ='$incomeid'";
        $query = $this->db->query($sql,false);
        return $query->result('array')[0]['loc'];
    }

    public function getAllDetailById($id) {
        $sql = "select a.transoutid, a.keterangan, c.jenis, a.transtgl, a.bebantgl, a.nilaiuang, a.nomorfaktur, a.realisasi
                from acctranskas a inner join accmasterpengeluarannilai b on a.nilaidetailid=b.nilaidetailid
                inner join accmasterpengeluaran c on b.outid=c.outid
                where incomeid='$id';";
        $query = $this->db->query($sql,false);
        return $query->result();
    }

    public function getKasKeluar($incomeid) {
        $sql = "select * from acctranspenerimaan where incomeid='$incomeid'";
        $query = $this->db->query($sql,false);
        return $query->result();
    }

    public function closeTransaksi($incomeid) {
        $tgl = date('Y-m-d H:i:s');
        $sql = "update acctranskas set closed=1, closeddate='$tgl' where incomeid='$incomeid';";
        $query = $this->db->query($sql, false);
    }

    public function getTransRealized($transoutid) {
        $sql = "select * 
                from acctranskas a inner join accmasterpengeluarannilai b on a.nilaidetailid=b.nilaidetailid
                inner join accmasterpengeluaran c on b.outid=c.outid 
                where a.transoutid='$transoutid'";
        $query = $this->db->query($sql, false);
        return $query->result();
    }
    
}