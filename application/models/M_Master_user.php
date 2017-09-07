<?php

class M_Master_user extends MY_Master_Model {

    function __construct() {
        parent::__construct();
        $this->table_name = 'users'; // nama tabel
        $this->id_field = 'id_user'; // nama id primary key dari tabel tsb
    }

    public function getAllUser() {
        $sql = "select * from users a inner join user_group b on a.group_user=b.id inner join masterlokasi c on a.location=c.locid";
        $query = $this->db->query($sql,false);
        return $query->result();
    }
    
    public function getAllGroupUser() {
        $sql = "select * from user_group";
        $query = $this->db->query($sql,false);
        return $query->result();
    }
    
    public function getUserById($id) {
        $sql = "select * from users where id_user ='$id'";
        $query = $this->db->query($sql,false);
        if ($query->num_rows() > 0) {
            return $query->result('array')[0]['nama'];
        } else {
            return '-';
        }
    }

    public function cekUsername($username) {
        $sql = "select username from users where username='$username'";
        $query = $this->db->query($sql,false);
        if ($query->num_rows() > 0) {
            return $query->result('array')[0]['username'];
        } else {
            return '';
        }
    }

    public function simpan($data) {
        return $this->db->insert('users', $data);
    }

    public function ubah($id_user,$password,$loc,$group_user,$nama) {
        $update_data = array('password' => $password, 'location' => $loc, 'group_user' => $group_user, 'nama' => $nama);
        $this->db->where('id_user', $id_user);
        $this->db->update('users', $update_data);
    }

}