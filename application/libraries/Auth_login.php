<?php if(! defined('BASEPATH')) exit('Akses tidak diizinkan!!');

class Auth_login {
	var $CI = NULL;

	public function __construct() {
		$this->CI =& get_instance();
	}

	public function login($username, $password) {
            $query = $this->CI->db->get_where('users',array('username' => $username, 'password' => md5($password)));
            if ($query->num_rows() == 1) {
                $row_id = $this->CI->db->query('select id_user from users where username = "'.$username.'"');
                $row_loc = $this->CI->db->query('select b.locationket from users a inner join masterlokasi b on a.location=b.locid where username = "'.$username.'"');
                $row_locid = $this->CI->db->query('select location from users where username = "'.$username.'"');
                $row_group = $this->CI->db->query('select group_user as grup from users where username = "'.$username.'"');
                $id = $row_id->row()->id_user;
                $location = $row_loc->row()->locationket;
                $locid = $row_locid->row()->location;
                $group = $row_group->row()->grup;
                $this->CI->session->set_userdata('username', $username);
                $this->CI->session->set_userdata('id_login', uniqid(rand()));
                $this->CI->session->set_userdata('id', $id);
                $this->CI->session->set_userdata('location', $location);
                $this->CI->session->set_userdata('locid', $locid);
                $this->CI->session->set_userdata('grp', $group);
                redirect(base_url('home'));
		}
		else {
			$this->CI->session->set_flashdata('warning','Username/Password tidak valid');
			redirect(base_url('login'));
		}

		return false;
	}	

	public function cek_login() {
		if($this->CI->session->userdata('username') == '') {
			$this->CI->session->set_flashdata('warning','Silahkan Login Dulu');
 			redirect(base_url('login'));
		}
	}

	public function logout() {
		 $this->CI->session->unset_userdata('username');
		 $this->CI->session->unset_userdata('id_login');
		 $this->CI->session->unset_userdata('id');
		 $this->CI->session->set_flashdata('warning','Anda berhasil logout');
		 redirect(base_url('login'));
 	}
}