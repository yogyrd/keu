<?php

class M_Master_nilaidetilpengeluaran extends MY_Master_Model {

    function __construct() {
        parent::__construct();
        $this->table_name = 'accmasterpengeluarannilai'; // nama tabel
        $this->id_field = 'nilaidetailid'; // nama id primary key dari tabel tsb
    }

    public function getAllNilaiJenisDetilPengeluaran($locid,$group) {
        $sql = "select ifnull(b.nilaidetailid,-9999)as nilaidetilid, b.locid, a.outid, a.jenis, ifnull(b.nilaimax,0) as nilaimaxdetil,
		ifnull(b.startdate,'2000-01-01') as startdate, ifnull(b.enddate,'9998-12-31') as enddate, c.locid as locidgroup, c.costid, d.costjenis, c.nilaimax as nilaimaxgroup,
		c.startdate as startdategroup, c.enddate as enddategroup,ifnull(b.locid,c.locid) as locidoutid, a.pengajuan
		from accmasterpengeluaran a left join accmasterpengeluarannilai b on a.outid=b.outid and b.locid = '$locid' and 
		now() between b.startdate and b.enddate
		left join accmasterpengeluarangroupnilai c on a.costid=c.costid and c.locid = '$locid' and 
		now() between c.startdate and c.enddate
		left join accmasterpengeluarangroup d on c.costid=d.costid
		where c.costid like '%$group%'
		order by d.costid asc, outid asc";
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

    public function updateMaster($userid) {
        $update = $this->input->post('update');
        if($update) {
            $updatemasterdetil = $this->input->post('updatemasterdetil');
            if($updatemasterdetil > 0) {
                foreach ($updatemasterdetil as $id) {
                    $locid_new = $this->input->post('locid_'.$id);
                    $outid_new = $this->input->post('outid_'.$id);
                    $nilaimax_new = $this->input->post('nilaimax_'.$id);
                    $startdate_new = $this->input->post('startdate_'.$id);
                    $enddate_new = $this->input->post('enddate_'.$id);
                    $counter = $this->input->post('counter_'.$id);
                    if($id < -999) {
                        $data = array(
                            'locid' => $locid_new,
                            'outid' => $outid_new,
                            'nilaimax' => $nilaimax_new,
                            'startdate' => $startdate_new,
                            'enddate' => $enddate_new,
                            'createby' => $userid
                        );
                        $this->db->insert('accmasterpengeluarannilai', $data);
                    } else {
                        $nilaidetilid = $id - $counter;
                        $sql = "update accmasterpengeluarannilai set enddate='$startdate_new' where nilaidetailid='$nilaidetilid'";
                        $this->db->query($sql);
                        $data = array(
                            'locid' => $locid_new,
                            'outid' => $outid_new,
                            'nilaimax' => $nilaimax_new,
                            'startdate' => $startdate_new,
                            'enddate' => $enddate_new,
                            'createby' => $userid
                        );
                        $this->db->insert('accmasterpengeluarannilai', $data);

                    }
                }
            }
        }

    }

    public function getDataReportNilaiJenis($locid, $group) {
        $sql = "select ifnull(b.nilaidetailid,-9999)as nilaidetilid, b.locid, a.outid, a.jenis, ifnull(b.nilaimax,0) as nilaimaxdetil,
                ifnull(b.startdate,'2000-01-01') as startdate, ifnull(b.enddate,'9998-12-31') as enddate, c.locid as locidgroup, e.locationket, c.costid, d.costjenis, c.nilaimax as nilaimaxgroup,
                c.startdate as startdategroup, c.enddate as enddategroup,ifnull(b.locid,c.locid) as locidoutid, a.pengajuan
                from accmasterpengeluaran a left join accmasterpengeluarannilai b on a.outid=b.outid and b.locid = '$locid' and 
                now() between b.startdate and b.enddate
                left join accmasterpengeluarangroupnilai c on a.costid=c.costid and c.locid = '$locid' and 
                now() between c.startdate and c.enddate
                left join accmasterpengeluarangroup d on c.costid=d.costid
                inner join masterlokasi e on c.locid=e.locid
                where c.costid like '%$group%'
                order by d.costid asc, outid asc";
        $query = $this->db->query($sql,false);
        return $query->result();
    }
}