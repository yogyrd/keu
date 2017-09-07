<?php

class M_Master_supplier extends MY_Master_Model {

    function __construct() {
        parent::__construct();
        $this->table_name = 'mastersupplier'; // nama tabel
        $this->id_field = 'supplierid'; // nama id primary key dari tabel tsb
    }

    public function getAllSupplier() {
        $sql = "select * from mastersupplier";
        $query = $this->db->query($sql,false);
        return $query->result();
    }

    public function getAllLokasi() {
        $sql = "select * from masterlokasi";
        $query = $this->db->query($sql,false);
        return $query->result();
    }

}