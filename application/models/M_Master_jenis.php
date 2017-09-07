<?php

class M_Master_jenis extends MY_Base_Model {

    function __construct() {
        parent::__construct();
        $this->table_name = 'accmasterpengeluaran';
        $this->id_field = 'outid';
    }

}