<?php

class M_Trans_kas extends MY_Master_Model {

    function __construct() {
        parent::__construct();
        $this->table_name = 'acctranskas';
        $this->id_field = 'transoutid';
    }

    public function getAllTransKaskecil($loc) {
        $grup_user = $this->session->userdata('grp');
        if ($grup_user > 3 ) {
            $sql = "select a.transoutid, a.notrans, a.nilaidetailid, a.transtgl, a.createdby, a.createddate, a.keterangan, a.bebantgl, a.nilaiuang, a.nomorfaktur, a.loc, a.realisasi, c.jenis, d.locationket, b.nilaimax
                    from acctranskas a inner join accmasterpengeluarannilai b on a.nilaidetailid=b.nilaidetailid 
                    inner join accmasterpengeluaran c on b.outid=c.outid
                    inner join masterlokasi d on a.loc=d.locid
                    where a.accuserstatus=0 and a.closed=0 and loc='$loc' and c.pengajuan=0";
            $query = $this->db->query($sql,false);
            return $query->result();
        } else {
            $sql = "select a.transoutid, a.notrans, a.nilaidetailid, a.transtgl, a.createdby, a.createddate, a.keterangan, a.bebantgl, a.nilaiuang, a.nomorfaktur, a.loc, a.realisasi, c.jenis, d.locationket, b.nilaimax
                    from acctranskas a inner join accmasterpengeluarannilai b on a.nilaidetailid=b.nilaidetailid 
                    inner join accmasterpengeluaran c on b.outid=c.outid
                    inner join masterlokasi d on a.loc=d.locid
                    where a.accuserstatus=0 and a.closed=0 and c.pengajuan=0";
            $query = $this->db->query($sql,false);
            return $query->result();
        }
    }

    public function getAllTransPengajuan($loc) {
        $grup_user = $this->session->userdata('grp');
        if ($grup_user > 3 ) {
            $sql = "select a.transoutid, a.notrans, a.nilaidetailid, a.transtgl, a.createdby, a.createddate, a.keterangan, a.bebantgl, a.nilaiuang, a.nomorfaktur, a.loc, a.realisasi, c.jenis, d.locationket, b.nilaimax
                    from acctranskas a inner join accmasterpengeluarannilai b on a.nilaidetailid=b.nilaidetailid 
                    inner join accmasterpengeluaran c on b.outid=c.outid
                    inner join masterlokasi d on a.loc=d.locid
                    where a.accuserstatus=0 and a.closed=0 and loc='$loc' and c.pengajuan=1";
            $query = $this->db->query($sql,false);
            return $query->result();
        } else {
            $sql = "select a.transoutid, a.notrans, a.nilaidetailid, a.transtgl, a.createdby, a.createddate, a.keterangan, a.bebantgl, a.nilaiuang, a.nomorfaktur, a.loc, a.realisasi, c.jenis, d.locationket, b.nilaimax
                    from acctranskas a inner join accmasterpengeluarannilai b on a.nilaidetailid=b.nilaidetailid 
                    inner join accmasterpengeluaran c on b.outid=c.outid
                    inner join masterlokasi d on a.loc=d.locid
                    where a.accuserstatus=0 and a.closed=0 and c.pengajuan=1";
            $query = $this->db->query($sql,false);
            return $query->result();
        }
    }

    public function getAllLokasi() {
        $sql = "select * from masterlokasi";
        $query = $this->db->query($sql,false);
        return $query->result();
    }

    public function getPengeluaranCash($locid) {
        $group_user = $this->session->userdata('grp');
        if($group_user > 3) {
            $sql = "select a.nilaidetailid, a.locid, e.locationket, a.outid, b.jenis, b.keterangan, a.nilaimax, b.costid, c.costjenis, d.nilaimax as nilaimaxgroup 
                    from accmasterpengeluarannilai a 
                    inner join accmasterpengeluaran b on a.outid=b.outid and now() between a.startdate and a.enddate and a.locid='$locid'
                    inner join accmasterpengeluarangroup c on b.costid=c.costid
                    inner join accmasterpengeluarangroupnilai d on c.costid=d.costid and now() between d.startdate and d.enddate and d.locid='$locid'
                    inner join masterlokasi e on a.locid=e.locid
                    where b.pengajuan=0";
        } else {
            $sql = "select a.nilaidetailid, a.locid, e.locationket, a.outid, b.jenis, b.keterangan, a.nilaimax, b.costid, c.costjenis, d.nilaimax as nilaimaxgroup 
                    from accmasterpengeluarannilai a 
                    inner join accmasterpengeluaran b on a.outid=b.outid and now() between a.startdate and a.enddate
                    inner join accmasterpengeluarangroup c on b.costid=c.costid
                    inner join accmasterpengeluarangroupnilai d on c.costid=d.costid and now() between d.startdate and d.enddate and d.locid=a.locid
                    inner join masterlokasi e on a.locid=e.locid
                    where b.pengajuan=0";
        }
        $query = $this->db->query($sql,false);
        return $query->result();
    }

    public function getPengeluaranPengajuan($locid) {
        $group_user = $this->session->userdata('grp');
        if ($group_user > 3) {
            $sql = "select a.nilaidetailid, a.locid, e.locationket, a.outid, b.jenis, b.keterangan, a.nilaimax, b.costid, c.costjenis, d.nilaimax as nilaimaxgroup 
                    from accmasterpengeluarannilai a 
                    inner join accmasterpengeluaran b on a.outid=b.outid and now() between a.startdate and a.enddate and b.pengajuan=1 and a.locid='$locid'
                    inner join accmasterpengeluarangroup c on b.costid=c.costid
                    inner join accmasterpengeluarangroupnilai d on c.costid=d.costid and now() between d.startdate and d.enddate and d.locid='$locid'
                    inner join masterlokasi e on a.locid=e.locid";
        } else {
            $sql = "select a.nilaidetailid, a.locid, e.locationket, a.outid, b.jenis, b.keterangan, a.nilaimax, b.costid, c.costjenis, d.nilaimax as nilaimaxgroup 
                    from accmasterpengeluarannilai a 
                    inner join accmasterpengeluaran b on a.outid=b.outid and now() between a.startdate and a.enddate 
                    inner join accmasterpengeluarangroup c on b.costid=c.costid
                    inner join accmasterpengeluarangroupnilai d on c.costid=d.costid and now() between d.startdate and d.enddate and d.locid=a.locid
                    inner join masterlokasi e on a.locid=e.locid
                    where b.pengajuan=1";
        }
        $query = $this->db->query($sql,false);
        return $query->result();
    }

    public function getTotalPengeluaran($locid) {
        $sql = "SELECT ifnull(sum(nilaiuang),0) as total
                from acctranskas a inner join accmasterpengeluarannilai b on a.nilaidetailid=b.nilaidetailid
                inner join accmasterpengeluaran c on b.outid=c.outid and c.pengajuan=0 
                where a.realisasistatus = 0 and a.loc='$locid' 
                and (a.reject1id=0 or a.reject2id=0 or a.reject3id=0)
                and a.createddate between DATE_FORMAT(NOW() ,'%Y-%m-01') AND last_day(now());";
        $query = $this->db->query($sql,false);
        return $query->result('array')[0]['total'];
    }

    public function getLocation($locid) {
        $sql = "select locationket from masterlokasi where locid='$locid'";
        $query = $this->db->query($sql,false);
        return $query->result('array')[0]['locationket'];
    }
    
    public function getCostJenis($transoutid) {
        $sql = "select d.costjenis
                from acctranskas a inner join accmasterpengeluarannilai b on a.nilaidetailid=b.nilaidetailid
                inner join accmasterpengeluaran c on b.outid=c.outid
                inner join accmasterpengeluarangroup d on c.costid=d.costid
                where a.transoutid='$transoutid'";
        $query = $this->db->query($sql,false);
        return $query->result('array')[0]['costjenis'];
    }

    public function getJenis($nilaidetailid) {
        $sql = "select c.jenis 
                from acctranskas a inner join accmasterpengeluarannilai b on a.nilaidetailid=b.nilaidetailid
                inner join accmasterpengeluaran c on b.outid=c.outid
                where a.nilaidetailid='$nilaidetailid'";
        $query = $this->db->query($sql,false);
        return $query->result('array')[0]['jenis'];
    }

    public function getStatusPengajuan($nilaidetailid) {
        $sql = "select c.pengajuan 
                from acctranskas a inner join accmasterpengeluarannilai b on a.nilaidetailid=b.nilaidetailid
                inner join accmasterpengeluaran c on b.outid=c.outid
                where a.nilaidetailid='$nilaidetailid'";
        $query = $this->db->query($sql,false);
        return $query->result('array')[0]['pengajuan'];
    }

    public function getOutId($nilaidetailid) {
        $sql = "select b.outid
                from acctranskas a inner join accmasterpengeluarannilai b on a.nilaidetailid=b.nilaidetailid
                where a.nilaidetailid='$nilaidetailid'";
        $query = $this->db->query($sql,false);
        return $query->result('array')[0]['outid'];
    }
    public function getCostId($nilaidetailid) {
        $sql = "select c.costid
                from acctranskas a inner join accmasterpengeluarannilai b on a.nilaidetailid=b.nilaidetailid
                inner join accmasterpengeluaran c on b.outid=c.outid
                where a.nilaidetailid='$nilaidetailid'";
        $query = $this->db->query($sql,false);
        return $query->result('array')[0]['costid'];
    }
    
    public function getNilaiMaxGroup($costid) {
        $sql = "select * from accmasterpengeluarangroupnilai where costid='$costid'";
        $query = $this->db->query($sql,false);
        return $query->result('array')[0]['nilaimax'];
    }

    public function getNilaiMaxDetail($nilaidetailid) {
        $sql = "select b.nilaimax 
                from acctranskas a inner join accmasterpengeluarannilai b on a.nilaidetailid=b.nilaidetailid
                where a.nilaidetailid='$nilaidetailid'";
        $query = $this->db->query($sql,false);
        return $query->result('array')[0]['nilaimax'];
    }

    public function getSaldo($locid) {
        $sql = "select * from acctranskassaldo where locid='$locid'";
        $query = $this->db->query($sql,false);
        return $query->result('array')[0]['saldo'];
    }

    public function getJumlahPengajuan($locid) {
        $sql = "select count(*) as jumlah
                from acctranskas a inner join accmasterpengeluarannilai b on a.nilaidetailid=b.nilaidetailid
                inner join accmasterpengeluaran c on b.outid=c.outid and c.pengajuan=1
                where a.realisasistatus=1 and a.closed=0 and a.incomeid=0 and a.loc='$locid'
                order by realisasidate desc";
        $query = $this->db->query($sql,false);
        return $query->result('array')[0]['jumlah'];
    }

}