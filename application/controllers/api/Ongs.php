<?php
defined('BASEPATH') or exit('No direct script access allowed');

require APPPATH . 'libraries/REST_Controller.php';

class Ongs extends REST_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

	public function index_get()
	{
		$ongs = $this->db->select('*')->from('ongs')->get();
		$this->response($ongs->result_array(), REST_Controller::HTTP_OK);
	}

	public function index_post()
	{
		header('Access-Control-Allow-Origin: *');

		# XSS Filtering (https://www.codeigniter.com/user_guide/libraries/security.html)
		$_POST = $this->security->xss_clean($_POST);

		//$data = json_decode(file_get_contents("php://input"));
		$this->form_validation->set_rules('name', 'Name', 'trim|required');
		$this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
		$this->form_validation->set_rules('uf', 'UF', 'trim|exact_length[2]');

		if ($this->form_validation->run() == FALSE) {
			// Form Validation Errors
			$message = array(
				'status' => REST_Controller::HTTP_BAD_REQUEST,
				'error' => $this->form_validation->error_array(),
				'message' => validation_errors()
			);
			$this->response($message, REST_Controller::HTTP_BAD_REQUEST);
		} else {
			$id = bin2hex(random_bytes(4)); // Gerando o ID de Forma dinâmica
			$name = $this->input->post('name');
			$email = $this->input->post('email');
			$whatsapp = $this->input->post('whatsapp');
			$city = $this->input->post('city');
			$uf = $this->input->post('uf');
			$this->response([
				'id' => $id,
				'name' => $name,
				'email' => $email,
				'whatsapp' => $whatsapp,
				'city' => $city,
				'uf' => $uf,
			], REST_Controller::HTTP_OK);
		}
	}
}
