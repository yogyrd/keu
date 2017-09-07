<?php

class M_Rpt_kaskeluar extends MY_Master_Model {

    function __construct() {
        parent::__construct();
        $this->table_name = 'acctranskas';
        $this->id_field = 'transoutid';
        date_default_timezone_set('Asia/Jakarta');
        $sql = "";
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

    public function getDataKasKecilNoReal($locid, $tgloption, $tgl1, $tgl2) {
        if ($tgl1 == $tgl2) {
            $sql = "";
        } else {

        }
        $query = $this->db->query($sql,false);
        return $query->result();
    }

    public function getAllDataKasKecilRealized($locid,$tgloption,$tgl1,$tgl2) {
        if ($tgloption == 1) {
            if ($tgl1 == $tgl2) {
                $sql = "select a.transoutid, a.createddate, a.notrans, a.keterangan, a.nomorfaktur, a.transtgl, a.bebantgl, c.jenis, a.nilaiuang, a.realisasi, a.realisasidate, a.realisasiket,
                        d.suppliernama, d.supplierbank, d.supplierbanknorek
                        from acctranskas a inner join accmasterpengeluarannilai b on a.nilaidetailid=b.nilaidetailid
                        inner join accmasterpengeluaran c on b.outid=c.outid
                        inner join mastersupplier d on a.supplierid=d.supplierid
                        where a.loc='$locid' and c.pengajuan=0 and a.realisasistatus=1 and a.closed<>0 and (a.createddate like '$tgl1 %')
                        order by a.createddate asc";
            } else {
                $sql = "select a.transoutid, a.createddate, a.notrans, a.keterangan, a.nomorfaktur, a.transtgl, a.bebantgl, c.jenis, a.nilaiuang, a.realisasi, a.realisasidate, a.realisasiket,
                        d.suppliernama, d.supplierbank, d.supplierbanknorek
                        from acctranskas a inner join accmasterpengeluarannilai b on a.nilaidetailid=b.nilaidetailid
                        inner join accmasterpengeluaran c on b.outid=c.outid
                        inner join mastersupplier d on a.supplierid=d.supplierid
                        where a.loc='$locid' and c.pengajuan=0 and a.realisasistatus=1 and a.closed<>0 and (a.createddate between '$tgl1' and '$tgl2 23:59:59')
                        order by a.createddate asc";
            }
        } elseif ($tgloption == 2) {
            if ($tgl1 == $tgl2) {
                $sql = "select a.transoutid, a.createddate, a.notrans, a.keterangan, a.nomorfaktur, a.transtgl, a.bebantgl, c.jenis, a.nilaiuang, a.realisasi, a.realisasidate, a.realisasiket,
                    d.suppliernama, d.supplierbank, d.supplierbanknorek
                        from acctranskas a inner join accmasterpengeluarannilai b on a.nilaidetailid=b.nilaidetailid
                        inner join accmasterpengeluaran c on b.outid=c.outid
                        inner join mastersupplier d on a.supplierid=d.supplierid
                        where a.loc='$locid' and c.pengajuan=0 and a.realisasistatus=1 and a.closed<>0 and (a.transtgl like '$tgl1 %')
                        order by a.transtgl asc";
            } else {
                $sql = "select a.transoutid, a.createddate, a.notrans, a.keterangan, a.nomorfaktur, a.transtgl, a.bebantgl, c.jenis, a.nilaiuang, a.realisasi, a.realisasidate, a.realisasiket,
                        d.suppliernama, d.supplierbank, d.supplierbanknorek
                        from acctranskas a inner join accmasterpengeluarannilai b on a.nilaidetailid=b.nilaidetailid
                        inner join accmasterpengeluaran c on b.outid=c.outid
                        inner join mastersupplier d on a.supplierid=d.supplierid
                        where a.loc='$locid' and c.pengajuan=0 and a.realisasistatus=1 and a.closed<>0 and (a.transtgl between '$tgl1' and '$tgl2 23:59:59')
                        order by a.transtgl asc";
            }
        } elseif ($tgloption ==3) {
            if ($tgl1 == $tgl2) {
                $sql = "select a.transoutid, a.createddate, a.notrans, a.keterangan, a.nomorfaktur, a.transtgl, a.bebantgl, c.jenis, a.nilaiuang, a.realisasi, a.realisasidate, a.realisasiket,
                        d.suppliernama, d.supplierbank, d.supplierbanknorek
                        from acctranskas a inner join accmasterpengeluarannilai b on a.nilaidetailid=b.nilaidetailid
                        inner join accmasterpengeluaran c on b.outid=c.outid
                        inner join mastersupplier d on a.supplierid=d.supplierid
                        where a.loc='$locid' and c.pengajuan=0 and a.realisasistatus=1 and a.closed<>0 and (a.realisasidate like '$tgl1 %')
                        order by a.realisasidate asc";
            } else {
                $sql = "select a.transoutid, a.createddate, a.notrans, a.keterangan, a.nomorfaktur, a.transtgl, a.bebantgl, c.jenis, a.nilaiuang, a.realisasi, a.realisasidate, a.realisasiket,
                        d.suppliernama, d.supplierbank, d.supplierbanknorek
                        from acctranskas a inner join accmasterpengeluarannilai b on a.nilaidetailid=b.nilaidetailid
                        inner join accmasterpengeluaran c on b.outid=c.outid
                        inner join mastersupplier d on a.supplierid=d.supplierid
                        where a.loc='$locid' and c.pengajuan=0 and a.realisasistatus=1 and a.closed<>0 and (a.realisasidate between '$tgl1' and '$tgl2 23:59:59')
                        order by a.realisasidate asc";
            }
        }
        $query = $this->db->query($sql,false);
        return $query->result();
    }

    public function getAllDataPengajuanNotRealized($locid,$tgloption,$tgl1,$tgl2) {
        if ($tgloption == 1) {
            if ($tgl1 == $tgl2) {
                $sql = "select a.transoutid, a.notrans, a.createddate, c.jenis, a.keterangan, a.transtgl, a.bebantgl, a.nomorfaktur, a.nilaiuang, a.accuserby, a.accuserdate,
                        a.supplierid, d.suppliernama, d.supplierbank, d.supplierbanknorek
                        from acctranskas a inner join accmasterpengeluarannilai b on a.nilaidetailid=b.nilaidetailid
                        inner join accmasterpengeluaran c on b.outid=c.outid and c.pengajuan=1
                        inner join mastersupplier d on a.supplierid=d.supplierid
                        where a.loc='$locid' and a.reject1id=0 and a.reject2id=0 and a.reject3id=0  and a.realisasistatus=0 and closed=0  and (a.createddate like '$tgl1 %')
                        order by a.createddate asc";
            } else {
                $sql = "select a.transoutid, a.notrans, a.createddate, c.jenis, a.keterangan, a.transtgl, a.bebantgl, a.nomorfaktur, a.nilaiuang, a.accuserby, a.accuserdate,
                        a.supplierid, d.suppliernama, d.supplierbank, d.supplierbanknorek
                        from acctranskas a inner join accmasterpengeluarannilai b on a.nilaidetailid=b.nilaidetailid
                        inner join accmasterpengeluaran c on b.outid=c.outid and c.pengajuan=1
                        inner join mastersupplier d on a.supplierid=d.supplierid
                        where a.loc='$locid' and a.reject1id=0 and a.reject2id=0 and a.reject3id=0  and a.realisasistatus=0 and closed=0  and (a.createddate between '$tgl1' and '$tgl2 23:59:59')
                        order by a.createddate asc";
            }
        } elseif ($tgloption == 2) {
            if ($tgl1 == $tgl2) {
                $sql = "select a.transoutid, a.notrans, a.createddate, c.jenis, a.keterangan, a.transtgl, a.bebantgl, a.nomorfaktur, a.nilaiuang, a.accuserby, a.accuserdate,
                        a.supplierid, d.suppliernama, d.supplierbank, d.supplierbanknorek
                        from acctranskas a inner join accmasterpengeluarannilai b on a.nilaidetailid=b.nilaidetailid
                        inner join accmasterpengeluaran c on b.outid=c.outid and c.pengajuan=1
                        inner join mastersupplier d on a.supplierid=d.supplierid
                        where a.loc='$locid' and a.reject1id=0 and a.reject2id=0 and a.reject3id=0  and a.realisasistatus=0 and closed=0  and (a.transtgl like '$tgl1 %')
                        order by a.transtgl asc";
            } else {
                $sql = "select a.transoutid, a.notrans, a.createddate, c.jenis, a.keterangan, a.transtgl, a.bebantgl, a.nomorfaktur, a.nilaiuang, a.accuserby, a.accuserdate,
                        a.supplierid, d.suppliernama, d.supplierbank, d.supplierbanknorek
                        from acctranskas a inner join accmasterpengeluarannilai b on a.nilaidetailid=b.nilaidetailid
                        inner join accmasterpengeluaran c on b.outid=c.outid and c.pengajuan=1
                        inner join mastersupplier d on a.supplierid=d.supplierid
                        where a.loc='$locid' and a.reject1id=0 and a.reject2id=0 and a.reject3id=0  and a.realisasistatus=0 and closed=0  and (a.transtgl between '$tgl1' and '$tgl2 23:59:59')
                        order by a.transtgl asc";
            }
        } elseif ($tgloption ==3) {
            if ($tgl1 == $tgl2) {
                $sql = "select a.transoutid, a.notrans, a.createddate, c.jenis, a.keterangan, a.transtgl, a.bebantgl, a.nomorfaktur, a.nilaiuang, a.accuserby, a.accuserdate,
                        a.supplierid, d.suppliernama, d.supplierbank, d.supplierbanknorek
                        from acctranskas a inner join accmasterpengeluarannilai b on a.nilaidetailid=b.nilaidetailid
                        inner join accmasterpengeluaran c on b.outid=c.outid and c.pengajuan=1
                        inner join mastersupplier d on a.supplierid=d.supplierid
                        where a.loc='$locid' and a.reject1id=0 and a.reject2id=0 and a.reject3id=0  and a.realisasistatus=0 and closed=0  and (a.realisasidate like '$tgl1 %')
                        order by a.realisasidate asc";
            } else {
                $sql = "select a.transoutid, a.notrans, a.createddate, c.jenis, a.keterangan, a.transtgl, a.bebantgl, a.nomorfaktur, a.nilaiuang, a.accuserby, a.accuserdate,
                        a.supplierid, d.suppliernama, d.supplierbank, d.supplierbanknorek
                        from acctranskas a inner join accmasterpengeluarannilai b on a.nilaidetailid=b.nilaidetailid
                        inner join accmasterpengeluaran c on b.outid=c.outid and c.pengajuan=1
                        inner join mastersupplier d on a.supplierid=d.supplierid
                        where a.loc='$locid' and a.reject1id=0 and a.reject2id=0 and a.reject3id=0  and a.realisasistatus=0 and closed=0  and (a.realisasidate between '$tgl1' and '$tgl2 23:59:59')
                        order by a.realisasidate asc";
            }
        }
        $query = $this->db->query($sql,false);
        return $query->result();
    }

    public function getAllDataPengajuanRealized($locid,$tgloption,$tgl1,$tgl2) {
        if ($tgloption == 1) {
            if ($tgl1 == $tgl2) {
                $sql = "select a.transoutid, a.notrans, a.createddate, c.jenis, a.keterangan, a.transtgl, a.bebantgl, a.realisasidate, a.nomorfaktur, a.nilaiuang, a.realisasi, a.realisasiket,
                        a.supplierid, d.suppliernama, d.supplierbank, d.supplierbanknorek
                        from acctranskas a inner join accmasterpengeluarannilai b on a.nilaidetailid=b.nilaidetailid
                        inner join accmasterpengeluaran c on b.outid=c.outid and c.pengajuan=1
                        inner join mastersupplier d on a.supplierid=d.supplierid
                        where a.loc='$locid' and a.accuserstatus=1 and a.acc1status=1 and a.acc2status=1 and a.acc3status=1 and a.realisasistatus=1 and closed<>0  and (a.createddate like '$tgl1 %')
                        order by a.createddate asc";
            } else {
                $sql = "select a.transoutid, a.notrans, a.createddate, c.jenis, a.keterangan, a.transtgl, a.bebantgl, a.realisasidate, a.nomorfaktur, a.nilaiuang, a.realisasi, a.realisasiket,
                        a.supplierid, d.suppliernama, d.supplierbank, d.supplierbanknorek
                        from acctranskas a inner join accmasterpengeluarannilai b on a.nilaidetailid=b.nilaidetailid
                        inner join accmasterpengeluaran c on b.outid=c.outid and c.pengajuan=1
                        inner join mastersupplier d on a.supplierid=d.supplierid
                        where a.loc='$locid' and a.accuserstatus=1 and a.acc1status=1 and a.acc2status=1 and a.acc3status=1 and a.realisasistatus=1 and closed<>0  and (a.createddate between '$tgl1' and '$tgl2 23:59:59')
                        order by a.createddate asc";
            }
        } elseif ($tgloption == 2) {
            if ($tgl1 == $tgl2) {
                $sql = "select a.transoutid, a.notrans, a.createddate, c.jenis, a.keterangan, a.transtgl, a.bebantgl, a.realisasidate, a.nomorfaktur, a.nilaiuang, a.realisasi, a.realisasiket,
                        a.supplierid, d.suppliernama, d.supplierbank, d.supplierbanknorek
                        from acctranskas a inner join accmasterpengeluarannilai b on a.nilaidetailid=b.nilaidetailid
                        inner join accmasterpengeluaran c on b.outid=c.outid and c.pengajuan=1
                        inner join mastersupplier d on a.supplierid=d.supplierid
                        where a.loc='$locid' and a.accuserstatus=1 and a.acc1status=1 and a.acc2status=1 and a.acc3status=1 and a.realisasistatus=1 and closed<>0  and (a.transtgl like '$tgl1 %')
                        order by a.transtgl asc";
            } else {
                $sql = "select a.transoutid, a.notrans, a.createddate, c.jenis, a.keterangan, a.transtgl, a.bebantgl, a.realisasidate, a.nomorfaktur, a.nilaiuang, a.realisasi, a.realisasiket,
                        a.supplierid, d.suppliernama, d.supplierbank, d.supplierbanknorek
                        from acctranskas a inner join accmasterpengeluarannilai b on a.nilaidetailid=b.nilaidetailid
                        inner join accmasterpengeluaran c on b.outid=c.outid and c.pengajuan=1
                        inner join mastersupplier d on a.supplierid=d.supplierid
                        where a.loc='$locid' and a.accuserstatus=1 and a.acc1status=1 and a.acc2status=1 and a.acc3status=1 and a.realisasistatus=1 and closed<>0  and (a.transtgl between '$tgl1' and '$tgl2 23:59:59')
                        order by a.transtgl asc";
            }
        } elseif ($tgloption ==3) {
            if ($tgl1 == $tgl2) {
                $sql = "select a.transoutid, a.notrans, a.createddate, c.jenis, a.keterangan, a.transtgl, a.bebantgl, a.realisasidate, a.nomorfaktur, a.nilaiuang, a.realisasi, a.realisasiket,
                        a.supplierid, d.suppliernama, d.supplierbank, d.supplierbanknorek
                        from acctranskas a inner join accmasterpengeluarannilai b on a.nilaidetailid=b.nilaidetailid
                        inner join accmasterpengeluaran c on b.outid=c.outid and c.pengajuan=1
                        inner join mastersupplier d on a.supplierid=d.supplierid
                        where a.loc='$locid' and a.accuserstatus=1 and a.acc1status=1 and a.acc2status=1 and a.acc3status=1 and a.realisasistatus=1 and closed<>0  and (a.realisasidate like '$tgl1 %')
                        order by a.realisasidate asc";
            } else {
                $sql = "select a.transoutid, a.notrans, a.createddate, c.jenis, a.keterangan, a.transtgl, a.bebantgl, a.realisasidate, a.nomorfaktur, a.nilaiuang, a.realisasi, a.realisasiket,
                        a.supplierid, d.suppliernama, d.supplierbank, d.supplierbanknorek
                        from acctranskas a inner join accmasterpengeluarannilai b on a.nilaidetailid=b.nilaidetailid
                        inner join accmasterpengeluaran c on b.outid=c.outid and c.pengajuan=1
                        inner join mastersupplier d on a.supplierid=d.supplierid
                        where a.loc='$locid' and a.accuserstatus=1 and a.acc1status=1 and a.acc2status=1 and a.acc3status=1 and a.realisasistatus=1 and closed<>0  and (a.realisasidate between '$tgl1' and '$tgl2 23:59:59')
                        order by a.realisasidate asc";
            }
        }
        $query = $this->db->query($sql,false);
        return $query->result();
    }

    public function getAllDataRejected($locid,$tgloption,$tgl1,$tgl2) {
        if ($tgloption == 1) {
            if ($tgl1 == $tgl2) {
                $sql = "select a.transoutid, a.notrans, a.keterangan, a.transtgl, a.bebantgl, a.nilaiuang, a.nomorfaktur, c.jenis, d.rejectid, d.rejecteddate, d.keterangan as alasan
                        from acctranskas a inner join accmasterpengeluarannilai b on a.nilaidetailid=b.nilaidetailid
                        inner join accmasterpengeluaran c on b.outid=c.outid
                        inner join accrejecttranskas d on a.reject1id=d.rejectid or a.reject2id=d.rejectid or a.reject3id=d.rejectid
                        where a.loc='$locid' 
                        and (reject1id or reject2id or reject3id in (select rejectid from accrejecttranskas)) and a.createddate like '$tgl1 %'
                        order by a.createddate asc";
            } else {
                $sql = "select a.transoutid, a.notrans, a.keterangan, a.transtgl, a.bebantgl, a.nilaiuang, a.nomorfaktur, c.jenis, d.rejectid, d.rejecteddate, d.keterangan as alasan
                        from acctranskas a inner join accmasterpengeluarannilai b on a.nilaidetailid=b.nilaidetailid
                        inner join accmasterpengeluaran c on b.outid=c.outid
                        inner join accrejecttranskas d on a.reject1id=d.rejectid or a.reject2id=d.rejectid or a.reject3id=d.rejectid
                        where a.loc='$locid' 
                        and (reject1id or reject2id or reject3id in (select rejectid from accrejecttranskas)) and a.createddate between '$tgl1' and'$tgl2 23:59:59'
                        order by a.createddate asc";
            }
        } elseif ($tgloption == 2) {
            if ($tgl1 == $tgl2) {
                $sql = "select a.transoutid, a.notrans, a.keterangan, a.transtgl, a.bebantgl, a.nilaiuang, a.nomorfaktur, c.jenis, d.rejectid, d.rejecteddate, d.keterangan as alasan
                        from acctranskas a inner join accmasterpengeluarannilai b on a.nilaidetailid=b.nilaidetailid
                        inner join accmasterpengeluaran c on b.outid=c.outid
                        inner join accrejecttranskas d on a.reject1id=d.rejectid or a.reject2id=d.rejectid or a.reject3id=d.rejectid
                        where a.loc='$locid' 
                        and (reject1id or reject2id or reject3id in (select rejectid from accrejecttranskas)) and a.transtgl like '$tgl1 %'
                        order by a.transtgl asc";
            } else {
                $sql = "select a.transoutid, a.notrans, a.keterangan, a.transtgl, a.bebantgl, a.nilaiuang, a.nomorfaktur, c.jenis, d.rejectid, d.rejecteddate, d.keterangan as alasan
                        from acctranskas a inner join accmasterpengeluarannilai b on a.nilaidetailid=b.nilaidetailid
                        inner join accmasterpengeluaran c on b.outid=c.outid
                        inner join accrejecttranskas d on a.reject1id=d.rejectid or a.reject2id=d.rejectid or a.reject3id=d.rejectid
                        where a.loc='$locid' 
                        and (reject1id or reject2id or reject3id in (select rejectid from accrejecttranskas)) and a.transtgl between '$tgl1' and'$tgl2 23:59:59'
                        order by a.transtgl asc";
            }
        } elseif ($tgloption == 4) {
            if ($tgl1 == $tgl2) {
                $sql = "select a.transoutid, a.notrans, a.keterangan, a.transtgl, a.bebantgl, a.nilaiuang, a.nomorfaktur, c.jenis, d.rejectid, d.rejecteddate, d.keterangan as alasan
                        from acctranskas a inner join accmasterpengeluarannilai b on a.nilaidetailid=b.nilaidetailid
                        inner join accmasterpengeluaran c on b.outid=c.outid
                        inner join accrejecttranskas d on a.reject1id=d.rejectid or a.reject2id=d.rejectid or a.reject3id=d.rejectid
                        where a.loc='$locid' 
                        and (reject1id or reject2id or reject3id in (select rejectid from accrejecttranskas)) and d.rejecteddate like '$tgl1 %'
                        order by a.createddate asc";
            } else {
                $sql = "select a.transoutid, a.notrans, a.keterangan, a.transtgl, a.bebantgl, a.nilaiuang, a.nomorfaktur, c.jenis, d.rejectid, d.rejecteddate, d.keterangan as alasan
                        from acctranskas a inner join accmasterpengeluarannilai b on a.nilaidetailid=b.nilaidetailid
                        inner join accmasterpengeluaran c on b.outid=c.outid
                        inner join accrejecttranskas d on a.reject1id=d.rejectid or a.reject2id=d.rejectid or a.reject3id=d.rejectid
                        where a.loc='$locid' 
                        and (reject1id or reject2id or reject3id in (select rejectid from accrejecttranskas)) and  d.rejecteddate between '$tgl1' and'$tgl2 23:59:59'
                        order by a.createddate asc";
            }
        }
        $query = $this->db->query($sql,false);
        return $query->result();
    }


}