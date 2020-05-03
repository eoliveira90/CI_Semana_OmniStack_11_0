<?php
defined('BASEPATH') or exit('No direct script access allowed');

require APPPATH . 'libraries/REST_Controller.php';

class Profile extends REST_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

	public function index_get()
	{
		$headers = $this->input->request_headers();
		$ong_id = $headers['Authorization'];

		$incidents = $this->db->select('*')
			->from('incidents')
			->where('ong_id', $ong_id)
			->get();
		$this->set_response($incidents->result_array(), REST_Controller::HTTP_OK);
	}
}
