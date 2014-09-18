<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class home extends CI_Controller {

	public function index() {
		$this->login();
	}

	public function login()  {
		$this->load->view('view_login');
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
		$this->load->view('view_restricted');
	}

	public function logout()  {
		$this->session->sess_destroy();
		redirect('home/login');
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