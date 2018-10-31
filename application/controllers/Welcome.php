<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

	function __construct(){
        parent::__construct();
         $this->load->model('m_cars');
      $this->load->helper(array('form', 'url'));
	}


	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	public function index()
	{
		$this->load->view('welcome_message');
	}


		function manufacture(){
		
		$data = array();
		
		
		 $manufacture = $this->input->post('Name');
         if($manufacture != ""){
         	$this->m_cars->post_manufacture($manufacture);
         }
		 
		$this->load->view('view_car',$data);

	
}


/*function for displaying the lists of cars*/	


function cars(){
		
		$data = array();
		
		$this->load->helper('form');
		$cars = $this->m_cars->getcars();
		/*die(print_r($cars));*/
		$data['cars']= $cars;
		$this->load->view('view_cartable',$data);

	
}


/*function for displaying the details of car*/	

function details($id){
		
		$data = array();
		
		$this->load->helper('form');
		$details = $this->m_cars->getdetails($id);
	/*	die(print_r($details));*/
		$data['details']=$details ;
		$this->load->view('view_details',$data);

	
}


/*sold our car*/	


function remove($id){
		
		$data = array();
		
		$this->load->helper('form');
		$details = $this->m_cars->getremoved($id);
	
		$this->load->view('view_remove',$data);

	
}


/*function for uploading the detail of car*/	

      public function do_upload()
        {

        	
                $config['upload_path']          = './uploads/';
                $config['allowed_types']        = 'gif|jpg|png';
                $config['max_size']             = 100000;
                $config['max_width']            = 1024999;
                $config['max_height']           = 768777;

                $this->load->library('upload', $config);
                $filename = '';
               /*  die(print_r($this->upload->do_upload('userfile')));*/
                   
                   /* die(print_r($filename));*/
                if ($this->upload->do_upload('userfile'))
                {
                     $filename = $this->upload->data()['file_name'];
                     $filename ="/uploads/".$filename;
                   $data = array('upload_data' => $this->upload->data());
                     
                }
                else
                {
                       
                         $error = array('error' => $this->upload->display_errors());

                       
                }

              

                $data = array();

         $this->load->helper('form');
         if($this->input->post('Name') != ""){
		 $model = $this->input->post('Name');
		 $color = $this->input->post('Color');
		 $year = $this->input->post('Year');
		 $reg = $this->input->post('Reg');
		 $image1 = $this->input->post('Image1');
		 $image = $this->input->post('Image');
		 $notes = $this->input->post('Notes');
		 $manufact = $this->input->post('manufact');
		 $this->m_cars->post_model($model,$color,$year,$reg,$image,$image1,$notes,$manufact);
	
	}
		$image1 = $filename;
	   $manufactures = $this->m_cars->getmanufactures();
		$data['manufactures'] = $manufactures;


		
		 // validate the variables ======================================================
		
		 
         $this->load->view('view_model',$data);
        }


}
