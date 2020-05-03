<?php
defined('BASEPATH') or exit('No direct script access allowed');

require APPPATH . 'libraries/REST_Controller.php';

class Incidents extends REST_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

	public function index_get()
	{
		//request_headers
		//head
		$page = $this->query('page') ? $this->query('page') : 1;
		$limit = $this->query('limit') ? $this->query('limit') : 5;

		$count = (($this->db->select('count(*) AS count')->from('incidents')->get())->row())->count;

		$incidents = $this->db->select('incidents.*, ongs.name, ongs.email, ongs.whatsapp, ongs.city, ongs.uf')
			->from('incidents')
			->join('ongs', 'ongs.id = incidents.ong_id', 'left')
			->limit($limit)
			->offset(($page - 1) * $limit)
			->get();

		$this->output->set_header('X-TOTAL-Count:' . $count);
		$this->set_response($incidents->result_array(), REST_Controller::HTTP_OK);
	}

	public function index_post()
	{
		$headers = $this->input->request_headers();
		$ong_id = $headers['Authorization'];

		header('Access-Control-Allow-Origin: *');
		$_POST = $this->security->xss_clean($_POST);

		//$data = json_decode(file_get_contents("php://input"));
		$this->form_validation->set_rules('ong_ig', 'Ong', 'trim|required');
		$this->form_validation->set_rules('title', 'Title', 'trim|required');
		$this->form_validation->set_rules('value', 'Value', 'trim|required');


		if ($this->form_validation->run() == FALSE) {
			// Form Validation Errors
			$message = array(
				'status' => REST_Controller::HTTP_BAD_REQUEST,
				'error' => $this->form_validation->error_array(),
				'message' => validation_errors()
			);
			$this->response($message, REST_Controller::HTTP_BAD_REQUEST);
		} else {
			$title = $this->input->post('title');
			$description = $this->input->post('description');
			$value = $this->input->post('value');
			$this->set_response([
				'title' => $title,
				'value' => $value,
				'description' => $description,
				'ong_id' => $ong_id,
			], REST_Controller::HTTP_OK);
		}
	}

	public function index_delete()
	{
		$headers = $this->input->request_headers();

		$id = $this->query('id') ? $this->query('id') : $this->uri->segment(3);

		$ong_id = $headers['Authorization'];
		
		$incident = ($this->db->select('ong_id')->from('incidents')->where('id', $id)->get())->row();

		if (!isset($incident)) {
			$this->response([
				'error' => 'Incident not found.'
			], REST_Controller::HTTP_NOT_FOUND);
		}

		if ($incident->ong_id !== $ong_id) {
			$this->response([
				'error' => 'Operation not permitted.'
			], REST_Controller::HTTP_UNAUTHORIZED);
		}
		$this->db->where('id', $id)->delete('incidents');
		$this->response(NULL, REST_Controller::HTTP_NO_CONTENT);
	}
}
