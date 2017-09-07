<?php

class M_Trans_kas extends MY_Master_Model {
    
    function __construct() {
        parent::__construct();
        $this->table_name = 'acctranskas';
        $this->id_field = 'transoutid';
    }

    public function getAllTransPengeluaran($loc) {
        $grup_user = ucfirst($this->session->userdata('grp'));
        if ($grup_user >=4 ) {
            $sql = "select * from acctranskas where accuserstatus=0 and loc=$loc";
            $query = $this->db->query($sql,false);
            return $query->result();
        } else {
            $sql = "select * from acctranskas where accuserstatus=0";
            $query = $this->db->query($sql,false);
            return $query->result();
        }

    }

    public function getAllLokasi() {
        $sql = "select * from masterlokasi";
        $query = $this->db->query($sql,false);
        return $query->result();
    }

    public function getAllGroupJenisPengeluaran() {
        $sql = "select * from accmasterpengeluarangroup";
        $query = $this->db->query($sql,false);
        return $query->result();
    }

    public function getAllJenisPengeluaranByGroup1() {
        $sql = "select a.outid, c.locationket, b.jenis, b.keterangan, a.nilaimax as nilaimax_detil, 
                a.startdate as start_detil, a.enddate as end_detil, e.costid, e.costjenis, d.nilaimax ,d.startdate as start_group, d.enddate as end_group
                from accmasterpengeluarannilai a inner join accmasterpengeluaran b on a.outid=b.outid
                inner join masterlokasi c on a.locid=c.locid
                inner join accmasterpengeluarangroupnilai d on b.costid=d.costid
                inner join accmasterpengeluarangroup e on d.costid=e.costid
                where a.enddate > now() and d.enddate > now() and b.costid=1;";
        $query = $this->db->query($sql,false);
        return $query->result();
    }

    public function getAllJenisPengeluaranByGroup2() {
        $sql = "select a.outid, c.locationket, b.jenis, b.keterangan, a.nilaimax as nilaimax_detil, 
                a.startdate as start_detil, a.enddate as end_detil, e.costid, e.costjenis, d.nilaimax ,d.startdate as start_group, d.enddate as end_group
                from accmasterpengeluarannilai a inner join accmasterpengeluaran b on a.outid=b.outid
                inner join masterlokasi c on a.locid=c.locid
                inner join accmasterpengeluarangroupnilai d on b.costid=d.costid
                inner join accmasterpengeluarangroup e on d.costid=e.costid
                where a.enddate > now() and d.enddate > now() and b.costid=2;";
        $query = $this->db->query($sql,false);
        return $query->result();
    }

    public function getAllJenisPengeluaranByGroup3() {
        $sql = "select a.outid, c.locationket, b.jenis, b.keterangan, a.nilaimax as nilaimax_detil, 
                a.startdate as start_detil, a.enddate as end_detil, e.costid, e.costjenis, d.nilaimax ,d.startdate as start_group, d.enddate as end_group
                from accmasterpengeluarannilai a inner join accmasterpengeluaran b on a.outid=b.outid
                inner join masterlokasi c on a.locid=c.locid
                inner join accmasterpengeluarangroupnilai d on b.costid=d.costid
                inner join accmasterpengeluarangroup e on d.costid=e.costid
                where a.enddate > now() and d.enddate > now() and b.costid=3;";
        $query = $this->db->query($sql,false);
        return $query->result();
    }

    public function getAllJenisPengeluaranByGroup4() {
        $sql = "select a.outid, c.locationket, b.jenis, b.keterangan, a.nilaimax as nilaimax_detil, 
                a.startdate as start_detil, a.enddate as end_detil, e.costid, e.costjenis, d.nilaimax ,d.startdate as start_group, d.enddate as end_group
                from accmasterpengeluarannilai a inner join accmasterpengeluaran b on a.outid=b.outid
                inner join masterlokasi c on a.locid=c.locid
                inner join accmasterpengeluarangroupnilai d on b.costid=d.costid
                inner join accmasterpengeluarangroup e on d.costid=e.costid
                where a.enddate > now() and d.enddate > now() and b.costid=4;";
        $query = $this->db->query($sql,false);
        return $query->result();
    }

    public function getAllJenisPengeluaranByGroup5() {
        $sql = "select a.outid, c.locationket, b.jenis, b.keterangan, a.nilaimax as nilaimax_detil, 
                a.startdate as start_detil, a.enddate as end_detil, e.costid, e.costjenis, d.nilaimax ,d.startdate as start_group, d.enddate as end_group
                from accmasterpengeluarannilai a inner join accmasterpengeluaran b on a.outid=b.outid
                inner join masterlokasi c on a.locid=c.locid
                inner join accmasterpengeluarangroupnilai d on b.costid=d.costid
                inner join accmasterpengeluarangroup e on d.costid=e.costid
                where a.enddate > now() and d.enddate > now() and b.costid=5;";
        $query = $this->db->query($sql,false);
        return $query->result();
    }

    public function getAllJenisPengeluaranByGroup6() {
        $sql = "select a.outid, c.locationket, b.jenis, b.keterangan, a.nilaimax as nilaimax_detil, 
                a.startdate as start_detil, a.enddate as end_detil, e.costid, e.costjenis, d.nilaimax ,d.startdate as start_group, d.enddate as end_group
                from accmasterpengeluarannilai a inner join accmasterpengeluaran b on a.outid=b.outid
                inner join masterlokasi c on a.locid=c.locid
                inner join accmasterpengeluarangroupnilai d on b.costid=d.costid
                inner join accmasterpengeluarangroup e on d.costid=e.costid
                where a.enddate > now() and d.enddate > now() and b.costid=6;";
        $query = $this->db->query($sql,false);
        return $query->result();
    }

    public function getLokasiById($loc) {
        $sql = "select locationket from masterlokasi where locid = $loc";
        $query = $this->db->query($sql,false);
        return $query->result('array')[0]['locationket'];
    }

    public function getJenisPengeluaran($outid) {
        $sql = "select jenis from accmasterpengeluaran where outid = $outid";
        $query = $this->db->query($sql,false);
        return $query->result('array')[0]['jenis'];
    }

    public function getJenis($transoutid) {
        $sql = "select b.jenis	from acctranskas a inner join accmasterpengeluaran b on a.outid=b.outid where a.transoutid=$transoutid; ";
        $query = $this->db->query($sql,false);
        return $query->result('array');
    }

    public function getMaxBiaya($transoutid) {
        $sql = "select b.maxbiaya from acctranskas a inner join accmasterpengeluaran b on a.outid=b.outid where a.transoutid=$transoutid; ";
        $query = $this->db->query($sql,false);
        return $query->result('array');
    }

    public function getStatus($transoutid) {
        $sql = "select transoutid, acc1status from acctranskas where transoutid=$transoutid";
        $query = $this->db->query($sql, false);
        return $query->result('array');
    }

    public function setStatus($transoutid) {
        $status = $this->getStatus($transoutid);
        $list = [];
        foreach ($status as $stat) {
            $list[$stat['transoutid']] = $stat['acc1status'];
        }
        return $list;
    }
}