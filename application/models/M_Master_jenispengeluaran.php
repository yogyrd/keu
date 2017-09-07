<?php

class M_Master_jenispengeluaran extends MY_Master_Model {

    function __construct() {
        parent::__construct();
        $this->table_name = 'accmasterpengeluaran'; // nama tabel
        $this->id_field = 'outid'; // nama id primary key dari tabel tsb
        $this->load->model('M_Master_grouppengeluaran','m_groupjenis');
    }

    public function getAllJenisPengeluaran() {
        $sql = "select * from accmasterpengeluaran a inner join accmasterpengeluarangroup b on a.costid=b.costid";
        $query = $this->db->query($sql,false);
        return $query->result();
    }

    public function getAllGroupPengeluaran() {
        $sql = "select * from accmasterpengeluarangroup";
        $query = $this->db->query($sql,false);
        return $query->result();
    }

    public function getGroupJenis($costid){
        return $this->m_groupjenis->getGroupJenisById($costid);
    }

    public function getAllLokasi() {
        $sql = "select * from masterlokasi";
        $query = $this->db->query($sql,false);
        return $query->result();
    }

    public function searchGroup($term = ''){
        $no_result = [['id'=>'','label'=>"No result for '$term'."]];
        if(trim($term) == '') return $no_result;

        $sql = "select costid id, CONCAT(costjenis,' - ',costket) label
                from accmasterpengeluarangroup
                where
                  LOWER(costjenis) like LOWER('%{$term}%')
                order by label asc limit 25";
        $query = $this->db->query($sql,false);
        $result = $query->result('array');

        if(count($result) == 0){
            $result = $no_result;
        }

        return $result;
    }

    public function getAllJenisSortByName() {
        $sql = "select * 
                from accmasterpengeluaran a inner join accmasterpengeluarangroup b on a.costid=b.costid
                order by b.costjenis asc, a.jenis asc";
        $query = $this->db->query($sql,false);
        return $query->result();
    }

}