<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class home extends CI_Controller {

	public function index() {
		$this->view_home();
	}
	public function view_home() {
		$this->load->model("model_db");
		$data["results"] = $this->model_db->getData("Home");

		$this->load->view("view_header");
		$this->load->view("view_nav");
		$this->load->view("view_content_home", $data);
		$this->load->view("view_footer");
	}
	public function login()  {
		$this->load->view("view_header");
		$this->load->view("view_nav");
		$this->load->view('view_login');
		$this->load->view("view_footer");
	}
	
	public function register()  {
		$this->load->view("view_header");
		$this->load->view("view_nav");
		$this->load->view('view_register');
		$this->load->view("view_footer");
	}
	
	public function members()  {
		if ($this->session->userdata('is_logged_in')) {		
			$this->load->view('view_members');
		} else
		{
			redirect('home/restricted');			
		}		
	}

	public function restricted()  {
		$this->load->view("view_header");
		$this->load->view("view_nav");
		$this->load->view('view_restricted');
		$this->load->view("view_footer");	
	}

	public function logout()  {
		$this->session->sess_destroy();
		redirect('home/login');
	}

	public function about() {
		$this->load->model("model_db");
		$data["results"] = $this->model_db->getData("About");
	
		$this->load->view("view_header");
		$this->load->view("view_nav");
		$this->load->view("view_about", $data);
		$this->load->view("view_footer");	
	}
	public function contact() {
		$this->load->model("model_db");
		$data["results"] = $this->model_db->getData("Contact");
		$data["message"] = "";

		$this->load->view("view_header");
		$this->load->view("view_nav");
		$this->load->view("view_contact", $data);
		$this->load->view("view_footer");	
	}
	public function send_email() {
		$this->load->library("form_validation");
		$data["message"] = "";
		
		$this->form_validation->set_rules("FullName","Full Name", "required|alpha|xss_clean");
		$this->form_validation->set_rules("Email","Email", "required|valid_email|xss_clean");
		$this->form_validation->set_rules("Message","Message", "required|xss_clean");
		
		if ($this->form_validation->run() == FALSE) {
			$data["message"] = "Error!";
		
			$this->load->view("view_header");
			$this->load->view("view_nav");
			$this->load->view("view_contact", $data);
			$this->load->view("view_footer");	
		
		} else {
			$data["message"] = "The email has successfully been sent!";

			$this->load->library("email");
			
			$this->email->from(set_value("Email"), set_value("FullName"));
			$this->email->to("byuille@scsc-inc.com");
			$this->email->subject("Test Message");
			$this->email->message(set_value("Message"));
			
			$this->email->send();			
			
			$this->email->print_debugger();
			
			$this->load->view("view_header");
			$this->load->view("view_nav");
			$this->load->view("view_contact", $data);
			$this->load->view("view_footer");	
			}
	}
	public function addstuff() 
	{
		$this->load->model("math");
		echo $this->math->add(2,2);
	}
	
	public function getvalues(){
		$this->load->model("get_content");
		$data["results"] = $this->get_content->getall();
		$this->load->view("view_content",$data);
	}
	
	public function register_validation()  {

		$this->load->library('form_validation');	
		
		$this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email|xss_clean|is_uniqe[users.email]');
		$this->form_validation->set_rules('password1', 'Password', 'required|trim|xss_clean');
		$this->form_validation->set_rules('password2', 'Confirm Password', 'required|trim|xss_clean|matches[password1]');
		
		if ($this->form_validation->run()) {

			echo "Pass";
		
		} else {
			echo "Fail";
		}
	}
		
	public function login_validation() {
	
		$this->load->library('form_validation');	
		
		$this->form_validation->set_rules('email', 'Email', 'required|trim|xss_clean|callback_validate_crendetials');
		$this->form_validation->set_rules('password', 'Password', 'required|md5|trim|xss_clean');
		
		if ($this->form_validation->run()) {

			$data = array(
				'email' => $this->input->post('email'), 
				'is_logged_in' => 1
			);
			$this->session->set_userdata($data);
			redirect('home/members');
		} else {
			$this->load->view('view_login');
		}

	}

	public function validate_crendetials()  {
		
		$this->load->model('model_db');
		
		if ($this->model_db->can_log_in()) {
			return true;		
		} else {
			$this->form_validation->set_message('validate_crendetials', 'Incorrect username/password.');
			return false;
		}
	}
	
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */