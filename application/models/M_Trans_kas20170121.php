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

//    public function getAllJenisPengeluaran($locid) {
//        $sql = "select a.nilaidetailid, a.locid, a.outid, b.jenis, a.nilaimax, a.startdate, a.enddate,c.costid ,d.costjenis as jenisgroup ,c.nilaimax as nilaimaxgroup, c.startdate, c.enddate
//                from accmasterpengeluarannilai a inner join accmasterpengeluaran b on a.outid=b.outid and
//                now() between a.startdate and a.enddate
//                inner join accmasterpengeluarangroupnilai c on b.costid=c.costid and
//                now() between c.startdate and c.enddate
//                inner join accmasterpengeluarangroup d on c.costid=d.costid
//                where a.locid=1 and c.locid=1";
//        $query = $this->db->query($sql, false);
//        return $query->result();
//    }

    public function getAllGroupJenisByLocId($locid) {
        $groupjenis = "<option value=''>Pilih Group Jenis Pengeluaran</pilih>";
        $sql = "select distinct(c.costid) ,d.costjenis as jenisgroup 
                from accmasterpengeluarannilai a inner join accmasterpengeluaran b on a.outid=b.outid and 
                now() between a.startdate and a.enddate
                inner join accmasterpengeluarangroupnilai c on b.costid=c.costid and 
                now() between c.startdate and c.enddate
                inner join accmasterpengeluarangroup d on c.costid=d.costid
                where a.locid=$locid and c.locid=$locid";
        $query = $this->db->query($sql,false);

        foreach ($query->result_array() as $list) {
            $groupjenis.= "<option value='$list[costid]'>$list[jenisgroup]</option>";
        }
        return $groupjenis;
    }

    public function getAllJenisByGroup($locid,$costid) {
        $jenis = "<option value=''>Pilih Jenis Pengeluaran</pilih>";
        $sql = "select a.outid, b.jenis 
                from accmasterpengeluarannilai a inner join accmasterpengeluaran b on a.outid=b.outid and 
                now() between a.startdate and a.enddate
                inner join accmasterpengeluarangroupnilai c on b.costid=c.costid and 
                now() between c.startdate and c.enddate
                inner join accmasterpengeluarangroup d on c.costid=d.costid
                where a.locid=$locid and c.locid=$locid and c.costid=$costid";
        $query = $this->db->query($sql,false);

        foreach ($query->result_array() as $list) {
            $jenis.= "<option value='$list[outid]'>$list[jenis]</option>";
        }
        return $jenis;
    }

    public function getNilaimaxGroupJenis($locid,$costid) {
        $sql = "select a.nilaidetailid, a.locid, a.outid, b.jenis, a.nilaimax, a.startdate, a.enddate,c.costid ,d.costjenis as jenisgroup ,c.nilaimax as nilaimaxgroup, c.startdate, c.enddate
                from accmasterpengeluarannilai a inner join accmasterpengeluaran b on a.outid=b.outid and 
                now() between a.startdate and a.enddate
                inner join accmasterpengeluarangroupnilai c on b.costid=c.costid and 
                now() between c.startdate and c.enddate
                inner join accmasterpengeluarangroup d on c.costid=d.costid
                where a.locid=$locid and c.locid=$locid and c.costid=$costid";
        $query = $this->db->query($sql,false);

        return $query->result('array')[0]['nilaimaxgroup'];
    }

    public function getNilaimaxJenis($locid,$costid,$outid) {
        $sql = "select a.nilaidetailid, a.locid, a.outid, b.jenis, a.nilaimax, a.startdate, a.enddate,c.costid ,d.costjenis as jenisgroup ,c.nilaimax as nilaimaxgroup, c.startdate, c.enddate
                from accmasterpengeluarannilai a inner join accmasterpengeluaran b on a.outid=b.outid and 
                now() between a.startdate and a.enddate
                inner join accmasterpengeluarangroupnilai c on b.costid=c.costid and 
                now() between c.startdate and c.enddate
                inner join accmasterpengeluarangroup d on c.costid=d.costid
                where a.locid=$locid and c.locid=$locid and c.costid=$costid and a.outid=$outid";
        $query = $this->db->query($sql,false);

        return $query->result('array')[0]['nilaimax'];
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

    public function getTotalPengeluaran($locid, $outid) {
        $sql = "select sum(nilaiuang) as total from acctranskas where realisasidate is null and loc=$locid and pengajuan=false and outid in (
                select outid from accmasterpengeluaran where costid in (select costid from accmasterpengeluaran where outid=$outid));";
        $query = $this->db->query($sql,false);
        return $query->result('array')[0]['total'];
    }


}