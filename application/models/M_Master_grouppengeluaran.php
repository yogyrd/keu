<?php

class M_Master_grouppengeluaran extends MY_Master_Model {

    function __construct() {
        parent::__construct();
        $this->table_name = 'accmasterpengeluarangroup'; // nama tabel
        $this->id_field = 'costid'; // nama id primary key dari tabel tsb
    }

    public function getAllGroupPengeluaran() {
        $sql = "select * from accmasterpengeluarangroup";
        $query = $this->db->query($sql,false);
        return $query->result();
    }

    public function getGroupJenisById($costid){
        if(trim($costid) == '') return '';

        $this->db->where('costid',$costid);
        $query = $this->db->get($this->table_name);
        return $query->result('array')[0]['costjenis'];
    }

    public function getAllGroupSortByName() {
        $sql = "select * from accmasterpengeluarangroup order by costjenis asc";
        $query = $this->db->query($sql,false);
        return $query->result();
    }

}