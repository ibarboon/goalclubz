<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Match_Detail extends CI_Controller {

	public $data = array();
	public $rules = array(
			array(
					'field'   => 'select-player-id',
					'label'   => 'Player',
					'rules'   => 'trim|required|xss_clean'
			),
			array(
					'field'   => 'input-goals',
					'label'   => 'Goal(s)',
					'rules'   => 'trim|required|xss_clean'
			)
	);
	
	function __construct() {
		parent::__construct();
		$this->load->library('session');
		$this->load->library('form_validation');
		$this->load->model('matches_model');
		$this->load->model('match_detail_model');
		$this->load->model('teams_model');
	}
	
	public function do_insert() {
		$this->form_validation->set_rules($this->rules);
		if ($this->form_validation->run() === TRUE) {
			$matches['created'] = date('Y-m-d H:i:s');
			$matches['created_by'] = $this->session->userdata('user_signin');
			$matches['last_updated'] = date('Y-m-d H:i:s');
			$matches['last_updated_by'] = $this->session->userdata('user_signin');
			$matches['match_id'] = $this->uri->segment(3);
			$matches['player_id'] = $this->input->post('select-player-id');
			$matches['goals'] = $this->input->post('input-goals');
			$affected_rows = $this->match_detail_model->insert($matches);
			$resp_msg = '<div role="alert" class="alert alert-success"><strong>Success !!!</strong> '.$affected_rows.' row(s) affected.</div>';
			$this->session->set_flashdata('resp_msg', $resp_msg);
		}
		redirect('admin/matches/'.$this->uri->segment(3), 'refresh');
	}
	
	public function do_update() {
		$this->form_validation->set_rules($this->rules);
		if ($this->form_validation->run() === TRUE) {
			$matches['last_updated'] = date('Y-m-d H:i:s');
			$matches['last_updated_by'] = $this->session->userdata('user_signin');
			$matches['match_date'] = $this->input->post('input-match-date');
			$matches['match_time'] = $this->input->post('input-match-time');
			$matches['home_id'] = $this->input->post('input-home-id');
			$matches['away_id'] = $this->input->post('input-away-id');
			$matches['match_remarks'] = $this->input->post('input-match-remarks');
			$conditions['row_id'] = $this->uri->segment(3);
			$affected_rows = $this->match_detail_model->update($matches, $conditions);
			$resp_msg = '<div role="alert" class="alert alert-success"><strong>Success !!!</strong> '.$affected_rows.' row(s) affected.</div>';
			$this->session->set_flashdata('resp_msg', $resp_msg);
			redirect('admin/matches', 'refresh');
		} else {
			redirect('admin/matches/do_update/'.$this->uri->segment(3), 'refresh');
		}
	} # do_update
	
	public function do_delete() {
		$conditions['row_id'] = $this->uri->segment(3);
		$affected_rows = $this->match_detail_model->delete($conditions);
		$resp_msg = '<div role="alert" class="alert alert-success"><strong>Success !!!</strong> '.$affected_rows.' row(s) affected.</div>';
		$this->session->set_flashdata('resp_msg', $resp_msg);
		redirect('admin/matches', 'refresh');
	} # do_delete
}

/* End of file match_detail.php */
/* Location: ./application/controllers/match_detail.php */