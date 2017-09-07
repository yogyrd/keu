<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MY_Controller extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        date_default_timezone_set('Asia/Jakarta');
    }
}

class MY_Base_Controller extends MY_Controller
{
    private $caller_model_name; 
    protected $caller_model_alias;
    private $view_data;
    protected $this_controller;
    protected $use_paging = false,$paging,$paging_config;
    protected $this_model;
    protected $upload_dir = 'files'; // default ke 'files'

    function __construct()
    {
        parent::__construct();
        $caller_model_name = $this->getCallingClassName();
        $this->caller_model_name = $caller_model_name;
        $model_name = 'M_' . $caller_model_name;

        $this->load->library('session');
        
        //if((trim($caller_model_name) !== '')&&(file_exists(APPPATH."models/$model_name.php"))){
        if(trim($caller_model_name) !== ''){
            $caller_model_alias = 'm'.$caller_model_name;
            $this->load->model($model_name, $caller_model_alias);
            $this->caller_model_alias = $caller_model_alias;
            $this->this_model = $this->$caller_model_alias;
        }
        
        $this->load->helper('url');
        $this->this_controller = base_url() . $this->uri->segment(1);
        
        $this->view_data['this_controller'] = $this->this_controller;
        $this->view_data['submit_url'] = $this->this_controller . '/add';
        $this->view_data['load_url'] = $this->this_controller . '/load';
        $this->view_data['edit_url'] = $this->this_controller . '/edit';
        $this->view_data['del_url'] = $this->this_controller . '/delete';
        $this->view_data['search_url'] = $this->this_controller . '/search';
    }
   
    private function getCallingFunction() {
        $caller = debug_backtrace();
        $caller = $caller[2];
        return $caller['function'];
    }
    
    private function getCallingClassName() {
        $caller = debug_backtrace();
        $caller = $caller[2];
        return $caller['class'];
    }
    
    public function setViewData($view_data){
        
        if(empty($this->view_data) && !is_array($this->view_data)){
            $this->view_data = [];
        }
        
    	$this->view_data = array_merge($this->view_data,$view_data);
    }
    
    public function index(){

        $model = $this->caller_model_alias;
        $this->view_data['model'] = $this->$model;

        if($this->use_paging){
            $this->load->library('pagination');

            $url = $this->this_controller;
            //$url = base_url() .  $this->uri->uri_string;
            if((strpos($this->uri->uri_string,'search') !== false) && (trim($this->session->search_text) !== '')){
                $url .= '/search/' . $this->session->search_text;
            } else {
                $this->session->search_text = '';
            }

            $this->paging_config['base_url'] = $url . '/page';
            $this->paging_config['total_rows'] = $this->masterGetPagingTotalRows();
            $this->paging_config['per_page'] = $this->masterGetPagingRowsPerPage();

            $this->pagination->initialize($this->paging_config);
            $this->paging = $this->pagination->create_links();
            $this->view_data['paging'] = $this->paging;
        }
    	
    	if(!isset($this->view_data['html_head'])){
    		$this->view_data['html_head'] = '';
    	}
    	
    	if(!isset($this->view_data['header'])){
    		$this->view_data['header'] = '';
    	}
    	
    	if(!isset($this->view_data['content'])){
    		$this->view_data['content'] = '';
    	}
    	
    	if(!isset($this->view_data['footer'])){
    		$this->view_data['footer'] = '';
    	}

        $this->view_data['search_text'] = $this->session->search_text;

        $this->load->view(strtolower($this->caller_model_name),$this->view_data); 
    }


    // .................................
    // MASTER
    // .................................

    // paging di master
    public function page(){
        $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
        $this->this_model->page = $page;
        $this->index();
    }

    // searching di master
    public function search(){
        $search_text = ($this->uri->segment(3)) ? $this->uri->segment(3) : '';

        // jika hasil search masih perlu di paging
        $page = ($this->uri->segment(5)) ? $this->uri->segment(5) : 0;
        $this->this_model->page = $page;

        $this->this_model->search_text = $search_text;
        $this->session->search_text = $search_text;
        $this->index();
    }

    public function add(){
        $form_values = $this->input->post();
        $userid = $this->session->userdata('id');
        $data_user = ['createdby' => $userid];
        $form_values = array_merge($data_user, $form_values);
        $form_values = $this->handleFileUpload($form_values);
        $model = $this->caller_model_alias;
        $this->$model->add($form_values);
        $this->goToIndex();
    }

    public function add_old(){
        $form_values = $this->input->post();
        $form_values = $this->handleFileUpload($form_values);
        $model = $this->caller_model_alias;
        $this->$model->add($form_values);
        $this->goToIndex();
    }

    public function load(){
        $id = $this->input->get('id');
        $model = $this->caller_model_alias;
        $data = $this->$model->load($id);
        $this->view_data['data'] = (array)$data;
        $this->view_data['submit_url'] = $this->this_controller . '/edit?id=' . $id;
        $this->index();
    }

    public function edit() {
        $form_values = $this->input->post();
        $userid = $this->session->userdata('id');
        $time = date('Y-m-d H:i:s');
        $data_user = [  'updatedby'     =>  $userid,
                        'updateddate'   =>  $time];
        $form_values = array_merge($data_user, $form_values);
        $model = $this->caller_model_alias;
        $this->$model->updateEdit($form_values);
        $this->goToIndex();
    }

    public function edit_old(){
        $form_values = $this->input->post();
        $form_values = $this->handleFileUpload($form_values);

        $model = $this->caller_model_alias;
        $this->$model->edit($form_values);
        $this->goToIndex();
    }

    public function delete_new() {
        $id = $this->input->get('id');
        $userid = $this->session->userdata('id');
        $time = date('Y-m-d H:i:s');
        $data_user = [  'deletedby'     =>  $userid,
                        'deleteddate'   =>  $time];
        $model = $this->caller_model_alias;
        $this->$model->updateDelete($data_user,$id);
        $this->goToIndex();
    }


    public function delete(){
        $id = $this->input->get('id');
        $model = $this->caller_model_alias;
        $this->$model->delete($id);
        $this->goToIndex();
    }

    private function handleFileUpload($form_values){
        foreach($_FILES as $field_id => $file_upload){
            if($file_upload['error'] == 0){
                $base_path = FCPATH;
                $rel_path = $this->upload_dir.$file_upload['name'];
                $file_saved_path = $base_path.$rel_path;
                move_uploaded_file($file_upload['tmp_name'],$file_saved_path);
                $form_values[$field_id] = $rel_path;
            } else {
                unset($form_values[$field_id]);
            }
        }

        return $form_values;
    }
    
    public function goToIndex(){
        header('Location: ' . $this->this_controller);
    }
    
    public function masterGetList(){
        $model = $this->caller_model_alias;
        $data = ['list'=>$this->$model->getList()];
        $this->addViewData($data);
    }

    public function masterGetPagingTotalRows(){
        $model = $this->caller_model_alias;
        return $this->$model->getPagingTotalRows();
    }

    public function masterGetPagingRowsPerPage(){
        $model = $this->caller_model_alias;
        return $this->$model->getPagingRowsPerPage();
    }
    
    // bentuk $data harus ['key'=> 'datanya']
    public function addViewData($data){
        $this->view_data = array_merge($this->view_data, $data);
    }

    // autocomplete groupjenis
    public function ac_groupjenis(){
        $term = $this->input->post_get('term');
        $result = $this->this_model->searchGroup($term);
        echo json_encode($result);
    }

    // autocomplete supplier
    public function ac_supplier(){
        $term = $this->input->post_get('term');
        $result = $this->this_model->searchSupplier($term);
        echo json_encode($result);
    }
    
    // autocomplete bank
    public function ac_bank(){
        $term = $this->input->post_get('term');
        $result = $this->this_model->searchBank($term);
        echo json_encode($result);
    }

    // autocomplete teater
    public function ac_teater(){
        $term = $this->input->post_get('term');
        $result = $this->this_model->searchTeater($term);
        echo json_encode($result);
    }

    // autocomplete film
    public function ac_film(){
        $term = $this->input->post_get('term');
        $result = $this->this_model->searchFilm($term);
        echo json_encode($result);
    }

    // autocomplete bioskop
    public function ac_bioskop(){
        log_message('debug','JN::ac_bioskop');
        $term = $this->input->post_get('term');
        $result = $this->this_model->searchBioskop($term);
        echo json_encode($result);
    }
    
}
