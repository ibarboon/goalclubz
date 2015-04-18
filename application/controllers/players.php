<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Players extends CI_Controller {

	public $data = array();
	
	function __construct() {
		parent::__construct();
		$this->load->library('session');
		$this->load->model('players_model');
	}
	
	public function do_insert() {
		$this->load->library('form_validation');
		$rules = array(
			array(
				'field'   => 'input-player-name',
				'label'   => 'Player Name',
				'rules'   => 'trim|required|xss_clean'
			),
			array(
					'field'   => 'input-team-name',
					'label'   => 'Team Name',
					'rules'   => 'trim|required|xss_clean'
			)
		);
		$this->form_validation->set_rules($rules);
		if ($this->form_validation->run() === TRUE) {
			$data['created'] = date('Y-m-d H:i:s');
			$data['created_by'] = $this->session->userdata('user_signin');
			$data['last_updated'] = date('Y-m-d H:i:s');
			$data['last_updated_by'] = $this->session->userdata('user_signin');
			$data['team_id'] = $this->input->post('input-team-name');
			$data['player_name'] = $this->input->post('input-player-name');
			$affected_rows = $this->players_model->insert($data);
			$resp_msg = '<div role="alert" class="alert alert-success"><strong>Success !!!</strong> '.$affected_rows.' row(s) affected.</div>';
			$this->session->set_flashdata('resp_msg', $resp_msg);
			redirect('admin/players', 'refresh');
		} else {
			redirect('admin/players/new-player', 'refresh');
		}
	}
	
	public function do_update() {
	$this->load->library('form_validation');
		$rules = array(
			array(
				'field'   => 'input-player-name',
				'label'   => 'Player Name',
				'rules'   => 'trim|required|xss_clean'
			),
			array(
				'field'   => 'input-team-name',
				'label'   => 'Team Name',
				'rules'   => 'trim|required|xss_clean'
			)
		);
		$this->form_validation->set_rules($rules);
		if ($this->form_validation->run() === TRUE) {
			$data['last_updated'] = date('Y-m-d H:i:s');
			$data['last_updated_by'] = $this->session->userdata('user_signin');
			$data['team_id'] = $this->input->post('input-team-name');
			$data['player_name'] = $this->input->post('input-player-name');
			$conditions['row_id'] = $this->uri->segment(3);
			$affected_rows = $this->players_model->update($data, $conditions);
			$resp_msg = '<div role="alert" class="alert alert-success"><strong>Success !!!</strong> '.$affected_rows.' row(s) affected.</div>';
			$this->session->set_flashdata('resp_msg', $resp_msg);
			redirect('admin/players', 'refresh');
		} else {
			redirect('admin/players/'.$this->uri->segment(3), 'refresh');
		}
	} # do_update
	
	public function do_delete() {
		$data['last_updated'] = date('Y-m-d H:i:s');
		$data['last_updated_by'] = $this->session->userdata('user_signin');
		$data['active_flag'] = 'n';
		$conditions['row_id'] = $this->uri->segment(3);
		$affected_rows = $this->players_model->update($data, $conditions);
		$resp_msg = '<div role="alert" class="alert alert-success"><strong>Success !!!</strong> '.$affected_rows.' row(s) affected.</div>';
		$this->session->set_flashdata('resp_msg', $resp_msg);
		redirect('admin/players', 'refresh');
	} # do_delete
	
	public function _to_string($data) {
		echo '<pre>';
		print_r($data);
		echo '</pre>';
	}
}

/* End of file players.php */
/* Location: ./application/controllers/players.php */