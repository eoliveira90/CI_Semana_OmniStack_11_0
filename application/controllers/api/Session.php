<?php
defined('BASEPATH') or exit('No direct script access allowed');

require APPPATH . 'libraries/REST_Controller.php';

class Session extends REST_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

	public function index_post()
	{
		header('Access-Control-Allow-Origin: *');

		$_POST = $this->security->xss_clean($_POST);

		$this->form_validation->set_rules('id', 'Id', 'trim|required');


		if ($this->form_validation->run() == FALSE) {
			// Form Validation Errors
			$message = array(
				'status' => REST_Controller::HTTP_BAD_REQUEST,
				'error' => $this->form_validation->error_array(),
				'message' => validation_errors()
			);
			$this->response($message, REST_Controller::HTTP_BAD_REQUEST);
		} else {
			$id = $this->input->post('id');
			$ong = ($this->db->select('name')->from('ongs')->where('id', $id)->get())->row();
			if (!$ong) {
				$this->response(['error' => 'No ONG found with this ID'], REST_Controller::HTTP_BAD_REQUEST);
			}
			$this->response($ong, REST_Controller::HTTP_OK);
		}
	}
}
