	public function home() {
		$this->load->model("model_db");
		$data["results"] = $this->model_db->getData("Login Page");

		$this->load->view("view_header");
		$this->load->view("view_nav");
		$this->load->view("view_login", $data);
		$this->load->view("view_footer");
	}	
	public function about() {
		$this->load->model("model_db");
		$data["results"] = $this->model_db->getData("About");
	
		$this->load->view("view_header");
		$this->load->view("view_nav");
		$this->load->view("view_content_about", $data);
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