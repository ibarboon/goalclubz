<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Teams extends CI_Controller {

	public $data = array();
	
	function __construct() {
		parent::__construct();
		$this->load->library('session');
	}
	
	public function do_insert() {
		$this->load->library('form_validation');
		$rules = array(
			array(
				'field'   => 'input-team-name',
				'label'   => 'Team Name',
				'rules'   => 'trim|required|xss_clean'
			)
		);
		$this->form_validation->set_rules($rules);
		if ($this->form_validation->run() === TRUE) {
			$this->load->model('teams_model');
			$team['created'] = date('Y-m-d H:i:s');
			$team['created_by'] = $this->session->userdata('user_signin');
			$team['last_updated'] = date('Y-m-d H:i:s');
			$team['last_updated_by'] = $this->session->userdata('user_signin');
			$team['team_name'] = $this->input->post('input-team-name');
			$affected_rows = $this->teams_model->insert($team);
			$resp_msg = '<div role="alert" class="alert alert-success"><strong>Success !!!</strong> '.$affected_rows.' row(s) affected.</div>';
			$this->session->set_flashdata('resp_msg', $resp_msg);
			redirect('admin/teams', 'refresh');
// 			$affected_rows = $this->teams_model->update($team, $conditions);
// 			$affected_rows = $this->teams_model->delete($conditions);
		} else {
			redirect('admin/teams/new-team', 'refresh');
		}
	}
	
	public function do_update() {
		$this->load->library('form_validation');
		$rules = array(
				array(
						'field'   => 'input-team-name',
						'label'   => 'Team Name',
						'rules'   => 'trim|required|xss_clean'
				)
		);
		$this->form_validation->set_rules($rules);
		if ($this->form_validation->run() === TRUE) {
			$this->load->model('teams_model');
			$team['last_updated'] = date('Y-m-d H:i:s');
			$team['last_updated_by'] = $this->session->userdata('user_signin');
			$team['team_name'] = $this->input->post('input-team-name');
			$conditions['row_id'] = $this->uri->segment(3);
			$affected_rows = $this->teams_model->update($team, $conditions);
			$resp_msg = '<div role="alert" class="alert alert-success"><strong>Success !!!</strong> '.$affected_rows.' row(s) affected.</div>';
			$this->session->set_flashdata('resp_msg', $resp_msg);
			redirect('admin/teams', 'refresh');
		} else {
			redirect('admin/teams/do_update/'.$this->uri->segment(3), 'refresh');
		}
	} # do_update
	
	public function do_delete() {
		$this->load->model('teams_model');
		$team['last_updated'] = date('Y-m-d H:i:s');
		$team['last_updated_by'] = $this->session->userdata('user_signin');
		$team['active_flag'] = 'n';
		$conditions['row_id'] = $this->uri->segment(3);
		$affected_rows = $this->teams_model->update($team, $conditions);
		$resp_msg = '<div role="alert" class="alert alert-success"><strong>Success !!!</strong> '.$affected_rows.' row(s) affected.</div>';
		$this->session->set_flashdata('resp_msg', $resp_msg);
		redirect('admin/teams', 'refresh');
	} # do_delete
	
	public function _to_string($data) {
		echo '<pre>';
		print_r($data);
		echo '</pre>';
	}
}

/* End of file teams.php */
/* Location: ./application/controllers/teams.php */