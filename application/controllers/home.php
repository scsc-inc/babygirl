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
			$this->load->view("view_header");
			$this->load->view('view_login');
		}

	}
	
	public function register()  {
		$this->load->view("view_header");
		$this->load->view("view_nav");
		$this->load->view('view_register');
		$this->load->view("view_footer");
	}
	
	public function register_validation()  {
		$this->load->helper(array('form', 'url','html'));
		$this->load->library('form_validation');	
		$this->load->model('model_db');
		
		$this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email|is_unique[users.email]');
		$this->form_validation->set_rules('pw1', 'Password', 'required|trim');
		$this->form_validation->set_rules('pw2', 'Confirm Password', 'required|trim|matches[pw1]');

		$this->form_validation->set_message( 'is_unique','That email address already exist');
		
		if ($this->form_validation->run()) {

			$key = md5(uniqid());
			
			$this->load->library('email',  array('mailtype' => 'html'));
			
			$this->email->from('barryyuille@gmail.com', 'Barry');
			//$this->email->to($this->input->post('new_email'));
			$this->email->to('byuille@scsc-inc.com');
			$this->email->subject('Confirm your account');			
			
			$message = '</p> Thank you for registering!';
			$message .=  '</p> ' .  anchor(base_url() . 'home/register_user/'. $key  . 'Click here') . ' to confirm your account';
			
			$this->email->message($message);
			
			if ($this->model_db->create_temp_user($key)){  
				
				if ($this->email->send()) {			
					echo  'The email has successfully been sent!';

					$this->email->print_debugger();
					
					$this->load->view("view_header");
					$this->load->view("view_nav");
					$this->load->view("view_login");
					$this->load->view("view_footer");	
						
				}else {	
					$this->email->print_debugger();
					echo "The email has Failed!";
				}			
			}			
						
		} else {
			$this->load->view("view_header");
			$this->load->view('view_register');
		}
	}

	public function members()  {
		if ($this->session->userdata('is_logged_in')) {		
			$this->load->view("view_header");
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
		
	public function validate_crendetials()  {
		
		$this->load->model('model_db');
		
		if ($this->model_db->can_log_in()) {
			return true;		
		} else {
			$this->form_validation->set_message('validate_crendetials', 'Incorrect username/password.');
			return false;
		}
	}

	public function sponsors () {

		$this->load->model('get_content');

		$data["results"] = $this->get_content->getsponsors();
		$this->load->view("view_header");
		$this->load->view("view_nav");
		$this->load->view("view_sponsors",$data);
		$this->load->view("view_footer");			
	}

	public function sponsors_form()  {
		$this->load->view("view_header");
		$this->load->view("view_nav");
		$this->load->view('view_sponsors_form');
		$this->load->view("view_footer");	
	}

	public function say_thankyou() {
	
		$this->load->model('get_content');

		$data["results"] = $this->get_content->getsponsors();

		$this->load->view("view_header");
		$this->load->view("view_nav");
		$this->load->view("view_say_thankyou",$data);
		$this->load->view("view_footer");			
		
	}

	public function insert_sponsor() {
		
		$this->load->helper(array('form', 'url','html'));
		$this->load->library('form_validation');		
		$this->load->model('add_content');

		$this->form_validation->set_rules('sponsor_name', 'Sponsor', 'required|trim');		

		if ($this->form_validation->run()) {		
			$data["results"] = $this->add_content->add_sponsor();

			$this->load->view("view_header");
			$this->load->view("view_nav");
		
			if ($data["results"]) {
				redirect('home/sponsors');
			} else {
				echo "Error, Sponsor not added";
			}
		
			$this->load->view("view_footer");			
		} else {
			$this->load->view("view_header");
			$this->load->view("view_nav");
			echo "No sponsor entered";
			$this->load->view("view_footer");			
		}
	}
public function insert_thankyou() {
	
		$this->load->model('add_content');

		$data["results"] = $this->add_content->add_thankyou();

		$this->load->view("view_header");
		$this->load->view("view_nav");
		
		if ($data["results"]) {
			echo "New Thank You note added";
		} else {
			echo "Error, Thank You note not added";
		}
		
		$this->load->view("view_footer");			
		
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */