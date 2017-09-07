<?php

class M_Home extends MY_Base_Model {
    
    function __construct() {
        parent::__construct();
    }

    public function getAllTransByLocid($locid) {
        $sql = "select a.transoutid, a.createddate, a.notrans, a.keterangan, a.nomorfaktur, a.transtgl, c.jenis, a.nilaiuang, a.supplierid, d.suppliernama, d.supplierbank, d.supplierbanknorek, 
                a.accuserdate, a.acc1date, a.acc2date, a.acc3date, a.realisasidate
                from acctranskas a inner join accmasterpengeluarannilai b on a.nilaidetailid=b.nilaidetailid
                inner join accmasterpengeluaran c on b.outid=c.outid
                inner join mastersupplier d on a.supplierid=d.supplierid
                where a.loc='$locid' and a.createddate between DATE_FORMAT(NOW() ,'%Y-%m-01') AND last_day(now())
                order by a.createddate desc";
        $query = $this->db->query($sql,false);
        return $query->result();
    }

    public function getAllTransRejected($locid) {
        $sql = "select a.transoutid, a.keterangan, a.transtgl, a.bebantgl, a.nilaiuang, a.nomorfaktur, c.jenis, d.rejectid, d.keterangan as alasan
                from acctranskas a inner join accmasterpengeluarannilai b on a.nilaidetailid=b.nilaidetailid
                inner join accmasterpengeluaran c on b.outid=c.outid
                inner join accrejecttranskas d on a.reject1id=d.rejectid or a.reject2id=d.rejectid or a.reject3id=d.rejectid
                where a.loc='$locid' 
                and (reject1id or reject2id or reject3id in (select rejectid from accrejecttranskas))
                order by a.createddate desc";
        $query = $this->db->query($sql,false);
        return $query->result();
    }

    public function getAllTransRealized($locid) {
        $sql = "select *, a.keterangan as transket  
                from acctranskas a inner join accmasterpengeluarannilai b on a.nilaidetailid=b.nilaidetailid
                inner join accmasterpengeluaran c on b.outid=c.outid and c.pengajuan=1
                where a.realisasistatus=1 and a.closed=0 and a.incomeid=0 and a.loc='$locid'
                order by realisasidate desc";
        $query = $this->db->query($sql, false);
        return $query->result();
    }
   
    public function getDataKasKecilRealisasiPerBulan($locid,$bulan) {
        $sql = "select ifnull(sum(realisasi),0) as total 
                from acctranskas a inner join accmasterpengeluarannilai b on a.nilaidetailid=b.nilaidetailid
                inner join accmasterpengeluaran c on b.outid=c.outid
                where loc=$locid and realisasidate<>0 
                and c.pengajuan=0
                and month(realisasidate)=$bulan and year(realisasidate)=date_format(now(),'%Y');";
        $query = $this->db->query($sql,false);
        if ($query->num_rows() > 0) {
            return $query->result('array')[0]['total'];
        }
    }

    public function getDataKasKecilRealisasiPerBulanByLoc($locid) {
        for ($i=0;$i<=11;$i++) {
            $result[$i] = (int)$this->getDataKasKecilRealisasiPerBulan($locid,$i+1);
        }

        return $result;
    }
}