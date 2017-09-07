<?php

class M_Saldo_bank extends MY_Master_Model {

    function __construct() {
        parent::__construct();
        $this->table_name = 'accsaldobank'; // nama tabel
        $this->id_field = 'saldoid'; // nama id primary key dari tabel tsb
    }



}