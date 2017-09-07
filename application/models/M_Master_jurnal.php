<?php

class M_Master_jurnal extends MY_Master_Model {

    function __construct() {
        parent::__construct();
        $this->table_name = 'accmasterjurnal'; // nama tabel
        $this->id_field = 'jenisid'; // nama id primary key dari tabel tsb
    }

    public function getJenisPenerimaan() {
        $sql = "select * from accmasterpenerimaan a inner join masterlokasi b on a.location=b.locid";
        $query = $this->db->query($sql,false);
        return $query->result();
    }

    public function getJenisPengeluaran() {
        $sql = "select * from accmasterpengeluaran";
        $query = $this->db->query($sql,false);
        return $query->result();
    }

    public function getAllAkun() {
        $sql = "select * from accmasterakun order by noakun asc";
        $query = $this->db->query($sql,false);
        return $query->result();
    }

    public function getAllDataJurnal() {
        $sql = "select a.jurnalid, a.jenisid, b.jenis, a.penerimaan, b.keterangan, a.jurnalno, a.akunid, c.namaakun, a.jurnaldebet
                from accmasterjurnal a inner join accmasterpengeluaran b on a.jenisid=b.outid
                inner join accmasterakun c on a.akunid=c.akunid";
        $query = $this->db->query($sql,false);
        return $query->result();
    }

    public function getJenis($jenisid) {
        $sql = "select * 
                from accmasterjurnal a inner join accmasterpengeluaran b on a.jenisid=b.outid
                where a.jenisid='$jenisid'";
        $query = $this->db->query($sql,false);
        return $query->result('array')[0]['jenis'];
    }

    public function getDataByJenisId($jenisid) {
        $sql = "select *
                from accmasterjurnal a inner join accmasterpengeluaran b on a.jenisid=b.outid
                inner join accmasterakun c on a.akunid=c.akunid
                where a.jenisid='$jenisid'";
        $query = $this->db->query($sql,false);
        return $query->result();
    }

    public function simpanHeaderDetil($userid) {
        $jurnalno = $this->input->post('jurnalno');
        if ($jurnalno > 0) {
            $penerimaan     =   $this->input->post('penerimaan');
            $jenisid        =   $this->input->post('jenisid');
            if ($this->cekJenisId($jenisid) == 1) {
                log_message('debug', 'tes');
                $this->session->set_flashdata('caution', 'Jenis Sudah Ada!!');
            } else {
                $this->db->trans_begin();
                foreach ($jurnalno as $no) {
                    $nrcid          = $this->input->post('nrcid_'.$no);
                    $jurnaldebet    = $this->input->post('jurnaldk_'.$no);
                    $ledgerdebet    = $this->input->post('ledgerdk_'.$no);
                    $labarugidebet  = $this->input->post('lrdk_'.$no);
                    $data = array(
                        'penerimaan'        =>      $penerimaan,
                        'jenisid'           =>      $jenisid,
                        'jurnalno'          =>      $no,
                        'akunid'             =>      $nrcid,
                        'jurnaldebet'       =>      $jurnaldebet,
                        'ledgerdebet'       =>      $ledgerdebet,
                        'labarugidebet'     =>      $labarugidebet,
                        'createdby'          =>      $userid,
                    );
                    $this->db->insert('accmasterjurnal', $data);

                }
                if ($this->db->trans_status() === FALSE)
                {
                    $this->db->trans_rollback();
                    $this->session->set_flashdata('err_message', 'Gagal Menyimpan Data');
                }
                else
                {
                    $this->db->trans_commit();
                    $this->session->set_flashdata('err_message', 'Data Berhasil Disimpan!');
                }
            }
        }
    }

    public function cekJenisId($jenisid) {
        $sql = "select jenisid from accmasterjurnal where jenisid='$jenisid'";
        $query = $this->db->query($sql,false);
        $result = $query->result();
        log_message('debug',$result[0]->jenisid);
        return $result[0]->jenisid;

//        if ($result->num_rows == 0) {
//            log_message('debug', $result->num_rows);
//            return false;
//        } else {
//            return true;
//        }
    }

}