<?php

class M_Approval_nilaigrouppengeluaran extends MY_Master_Model {

    function __construct() {
        parent::__construct();
        $this->table_name = 'accmasterpengeluarannilai'; // nama tabel
        $this->id_field = 'nilaidetailid'; // nama id primary key dari tabel tsb
    }

    public function getAllNilaiJenisGroupPengeluaran($locid) {
        $sql = "SELECT c.locationket, a.costid,  a.costjenis, a.costket, b.locid, b.nilaiid, b.nilaimax, b.startdate, b.enddate, b.locked
                FROM accmasterpengeluarangroup a
                inner JOIN accmasterpengeluarangroupnilai b ON a.costid = b.costid and b.locid='$locid'
                and now() BETWEEN b.startdate and b.enddate
                inner join masterlokasi c on b.locid=c.locid
                where a.cabang=1 order by  a.costid asc, b.locid asc";
		$query = $this->db->query($sql,false);
		return $query->result();
    }

    public function getAllLokasi() {
        $sql = "select * from masterlokasi";
        $query = $this->db->query($sql,false);
        return $query->result();
    }

    public function getAllGroupJenis() {
        $sql = "select * from accmasterpengeluarangroup";
        $query = $this->db->query($sql,false);
        return $query->result();
    }

    public function getLocationById($locid) {
        $sql = "select * from masterlokasi where locid ='$locid'";
        $query = $this->db->query($sql,false);
        if ($query->num_rows() > 0) {
            return $query->result('array')[0]['locationket'];
        } else {
            return '-';
        }
    }

    public function lockBudget($userid) {
        $update = $this->input->post('update');
        if($update) {
            $updatemastergroup = $this->input->post('editstatus');
            if($updatemastergroup > 0) {
                foreach ($updatemastergroup as $id) {
                    $sql = "update accmasterpengeluarangroupnilai set locked=$userid where nilaiid='$id'";
                    $this->db->query($sql);
                }
            }
            $unlock = $this->input->post('unlock');
            if($unlock > 0) {
                foreach ($unlock as $id) {
                    $sql = "update accmasterpengeluarangroupnilai set locked=0 where nilaiid='$id'";
                    $this->db->query($sql);
                }
            }
        }
    }
}