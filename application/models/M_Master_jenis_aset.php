<?php

class M_Master_jenis_aset extends MY_Master_Model {

    function __construct() {
        parent::__construct();
        $this->table_name = 'accmasterjenisaset'; // nama tabel
        $this->id_field = 'aset_id'; // nama id primary key dari tabel tsb
    }

    public function getAllJenisAset() {
        $sql = "select * from accmasterjenisaset";
        $query = $this->db->query($sql,false);
        return $query->result();
    }
    
    public function getLokasiById($locid) {
        $sql = "select * from masterlokasi where locid ='$locid'";
        $query = $this->db->query($sql,false);
        if ($query->num_rows() > 0) {
            return $query->result('array')[0]['locationket'];
        } else {
            return 'Semua Lokasi';
        }
    }

}