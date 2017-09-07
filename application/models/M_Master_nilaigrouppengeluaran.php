<?php

class M_Master_nilaigrouppengeluaran extends MY_Master_Model {

    function __construct() {
        parent::__construct();
        $this->table_name = 'accmasterpengeluarangroupnilai'; // nama tabel
        $this->id_field = 'nilaiid'; // nama id primary key dari tabel tsb
        $this->second_id = $this->input->post('costid'); //untuk cutoff tanggal
    }

    public function getAllNilaiJenisGroupPengeluaran($locid) {
        $sql = "SELECT c.locationket, ifnull(b.locid,'$locid') as locid, ifnull( nilaiid , -9999 ) AS nilaiid, 
                a.costid,  a.costjenis, a.costket, ifnull( b.nilaimax, 0 ) AS nilaimax, 
                ifnull( b.startdate, '2016-12-16' ) AS startdate, 
                ifnull( b.enddate, '9998-12-31' ) AS enddate, b.locked
                FROM accmasterpengeluarangroup a
                LEFT JOIN accmasterpengeluarangroupnilai b ON a.costid = b.costid and b.locid='$locid'
                and now() BETWEEN b.startdate and b.enddate
                left join masterlokasi c on b.locid=c.locid
                where a.cabang=1 order by  a.costid asc, b.locid asc";
        $sql2 = "SELECT c.locationket, ifnull(b.locid,'') as locid, ifnull( nilaiid , -9999 ) AS nilaiid, 
                a.costid,  a.costjenis, a.costket, ifnull( b.nilaimax, 0 ) AS nilaimax, 
                ifnull( b.startdate, '2016-12-16' ) AS startdate, 
                ifnull( b.enddate, '9998-12-31' ) AS enddate, b.locked
                FROM accmasterpengeluarangroup a
                LEFT JOIN accmasterpengeluarangroupnilai b ON a.costid = b.costid and b.locid=''
                and now() BETWEEN b.startdate and b.enddate
                inner join masterlokasi c on b.locid=c.locid
                where a.cabang=1 order by  a.costid asc, b.locid asc";
        if ($locid != '') {
            $query = $this->db->query($sql,false);
            return $query->result();
        } else {
            $query = $this->db->query($sql2,false);
            return $query->result();
        }


    }

    public function getAllLokasi() {
        $sql = "select * from masterlokasi";
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

    public function getLocationId($locid) {
        $sql = "select locid from masterlokasi where locid like '%$locid%'";
        $query = $this->db->query($sql,false);
        return $query->result('array')[0]['locid'];
    }

    public function updateMaster($userid) {
        $update = $this->input->post('update');
        if($update) {
            $updatemaster = $this->input->post('updatemaster');
            if($updatemaster > 0) {
                foreach ($updatemaster as $id) {
                    $locid_new = $this->input->post('locid_'.$id);
                    $costid_new = $this->input->post('costid_'.$id);
                    $nilaimax_new = $this->input->post('nilaimax_'.$id);
                    $startdate_new = $this->input->post('startdate_'.$id);
                    $enddate_new = $this->input->post('enddate_'.$id);
                    $counter = $this->input->post('counter_'.$id);
                    if($id < -999) {
                        $data = array(
                            'locid' => $locid_new,
                            'costid' => $costid_new,
                            'nilaimax' => $nilaimax_new,
                            'startdate' => $startdate_new,
                            'enddate' => $enddate_new,
                            'createby' => $userid
                        );
                        $this->db->insert('accmasterpengeluarangroupnilai', $data);
                    } else {
                        $nilaiid = $id - $counter;
                        $sql = "update accmasterpengeluarangroupnilai set enddate='$startdate_new' where nilaiid='$nilaiid'";
                        $this->db->query($sql);
                        $data = array(
                            'locid' => $locid_new,
                            'costid' => $costid_new,
                            'nilaimax' => $nilaimax_new,
                            'startdate' => $startdate_new,
                            'enddate' => $enddate_new,
                            'createby' => $userid
                        );
                        $this->db->insert('accmasterpengeluarangroupnilai', $data);

                    }
                }
            }
        }

    }

    public function getDataReportNilaiGroupJenis($locid) {
        $sql = "SELECT (select locationket from masterlokasi where locid='$locid') as locket, ifnull(b.locid,'$locid') as locid, ifnull( nilaiid , -9999 ) AS nilaiid, 
                a.costid,  a.costjenis, a.costket, ifnull( b.nilaimax, 0 ) AS nilaimax, 
                ifnull( b.startdate, '2016-12-16' ) AS startdate, 
                ifnull( b.enddate, '9998-12-31' ) AS enddate
                FROM accmasterpengeluarangroup a
                LEFT JOIN accmasterpengeluarangroupnilai b ON a.costid = b.costid and b.locid='$locid'
                and now() BETWEEN b.startdate and b.enddate
                left join masterlokasi c on b.locid=c.locid
                where a.cabang=1 order by  a.costid asc, b.locid asc";
        $query = $this->db->query($sql,false);
        return $query->result();
    }


}