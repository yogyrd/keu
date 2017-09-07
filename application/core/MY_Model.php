<?php

class MY_Model extends CI_Model {
    function __construct() {
        parent::__construct();
        date_default_timezone_set('Asia/Jakarta');
    }
}

class MY_Base_Model extends MY_Model {
    
    function __construct() {
        parent::__construct();
    }
    
}

class MY_Master_Model extends MY_Base_Model {
    
    protected $table_name,$limit,$id_field;
    public $page,$search_text,$search_fields;
    
    function __construct() {
        parent::__construct();
        $this->limit = 20; // ini default, klo ndak di isi
        $this->page = 0; // terutama saat first load, ini = offset di db
        $this->search_text = ''; // search_text
        $this->exclude_fields = []; // apabila ada field2 di form yg harus di handle terpisah
    }
    
    public function getList(){
        //$query = $this->queryAdjustSearchText($query);
//        foreach($this->order_by as $order_by => $direction){
//            $query = $this->db->order_by($order_by,$direction);
//        }
        $query = $this->db->get($this->table_name, $this->limit, $this->page);
        return $query->result();
    }

    public function getKeyValuePairList($id_field,$label_field){
        $sql = "select $id_field id, $label_field label from {$this->table_name}";
        $query = $this->db->query($sql,false);
        return $query->result('array');
    }

    public function add($form_values){
        $cols = [];
        $values = [];
        foreach($form_values as $field_id=>$field_value){
            if(in_array($field_id,$this->exclude_fields)) continue;
            if($field_id !== $this->id_field){
                $cols[] = "`" . $field_id . "`";
                $values[] = "'" . $field_value . "'";
            }
        }
        $cols = implode(',',$cols);
        $values = implode(',',$values);
        $sql = "insert into {$this->table_name} ($cols) values ($values)";
        $this->db->query($sql);

        // ambil id dari yg barusan di insert
//        $sql = "select max({$this->id_field}) {$this->id_field} from {$this->table_name}";
//        $query = $this->db->query($sql,false);
//        return $query->result('array')[0]['film_id'];
    }
    
    public function load($id){
        $query = $this->db->get_where($this->table_name, array($this->id_field => $id));
        $result = $query->result();
        return $result[0];
    }
    
    public function filterByLocation($locid){
        $sql = "select a.transoutid, a.keterangan, b.jenis, c.costjenis, a.nilaiuang, a.realisasi, a.realisasidate, a.realisasistatus 
                from acctranskas a inner join accmasterpengeluaran b on a.outid=b.outid
                inner join accmasterpengeluarangroup c on b.costid=c.costid
                where realisasistatus=0 and b.pengajuan=0 and a.loc='$locid' and a.acc3status=0;";
        $query = $this->db->query($sql,false);
        return $query->result('array');
    }
    
    public function edit($form_values){
        $sets = [];
        foreach($form_values as $field_id=>$field_value){
            if(in_array($field_id,$this->exclude_fields)) continue;
            if($field_id !== $this->id_field){
                $sets[] = "`$field_id` = '$field_value'";
            }
        }
        $sets = implode(',',$sets);
        $sql = "update {$this->table_name} set $sets where `{$this->id_field}`={$form_values[$this->id_field]}";
        return $this->db->query($sql);
    }

    public function updateEdit($form_values) {
        $sets = [];
        foreach($form_values as $field_id=>$field_value){
            if(in_array($field_id,$this->exclude_fields)) continue;
            if($field_id !== $this->id_field){
                $sets[] = "`$field_id` = '$field_value'";
            }
        }
        $sets = implode(',',$sets);
        $sql = "update {$this->table_name} set $sets where `{$this->id_field}`={$form_values[$this->id_field]}";
        return $this->db->query($sql);
    }

    public function updateDelete($form_values,$id) {
        $sets = [];
        foreach($form_values as $field_id=>$field_value){
            if(in_array($field_id,$this->exclude_fields)) continue;
            if($field_id !== $this->id_field){
                $sets[] = "`$field_id` = '$field_value'";
            }
        }
        $sets = implode(',',$sets);
        $sql = "update {$this->table_name} set $sets where `{$this->id_field}`=$id";
        return $this->db->query($sql);
    }

    public function delete($id){
        $sql = "delete from {$this->table_name} where `{$this->id_field}`=$id";
        return $this->db->query($sql);
    }

    public function searchSupplier($term = ''){
        $no_result = [['id'=>'','label'=>"No result for '$term'."]];
        if(trim($term) == '') return $no_result;

        $sql = "select supplierid id, CONCAT(suppliernama,' - ',supplierbank,' - ',supplierbanknorek,' - ',supplierbanknamarek) label
                from mastersupplier
                where
                supplierid <> 1 and 
                (LOWER(suppliernama) like LOWER('%$term%') or LOWER(supplierbanknorek) like LOWER('%$term%') or LOWER(supplierbanknorek) like LOWER('%$term%'))
                order by label asc limit 25";
        $query = $this->db->query($sql,false);
        $result = $query->result('array');

        if(count($result) == 0){
            $result = $no_result;
        }

        return $result;
    }
    
    public function searchBank($term = ''){
        $no_result = [['id'=>'','label'=>"No result for '$term'."]];
        if(trim($term) == '') return $no_result;

        $sql = "select bankid id, CONCAT(namabank,' - ',norekening,' - ',namarekening, ' - ', locationket) label
                from accmasterbank a inner join masterlokasi b on a.locid=b.locid				
                where
                bankid <> 1 and 
                (LOWER(namabank) like LOWER('%$term%') or LOWER(norekening) like LOWER('%$term%') or LOWER(namarekening) like LOWER('%$term%') or LOWER(locationket) like LOWER('%$term%'))
                order by label asc limit 25";
        $query = $this->db->query($sql,false);
        $result = $query->result('array');

        if(count($result) == 0){
            $result = $no_result;
        }

        return $result;
    }

}
