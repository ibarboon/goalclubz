<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin extends CI_Controller {

	public $data = array();
	
	function __construct() {
		parent::__construct();
		$this->load->library('session');
		$this->load->library('form_validation');
		$exception_uri_string = array('admin/signin', 'admin/signout');
		if (in_array(uri_string(), $exception_uri_string) === FALSE) {
			if ((bool)$this->session->userdata('signin') === FALSE) {
				redirect('admin/signin', 'refresh');
			}
		}
		$conditions = array('option_type' => 'html_meta', 'option_key' => 'title');
		$option = $this->utility_model->get_option($conditions);
		$this->data['title'] = $option[0]['option_value'];
	}
	
	public function index() {
		$this->data['current_page'] = ((bool)$this->uri->segment(2)) ? $this->uri->segment(2): 'dashboard';
		$conditions['user_id'] = $this->session->userdata('user_id');
		$this->data['user_signin'] = $this->session->userdata('user_signin');
		$this->data['side_nav_list'] = $this->utility_model->get_side_nav_list($conditions);
		switch ($this->data['current_page']) {
			case 'dashboard':
				$this->_dashboard();
				break;
			case 'teams':
				$this->_teams();
				break;
			case 'players':
				$this->_players();
				break;
			case 'matches':
				$this->_matches();
				break;
			default:
				$this->_dashboard();
				break;
		}
		$this->data['resp_msg'] = ($this->session->flashdata('resp_msg')) ? $this->session->flashdata('resp_msg') : NULL;
		$this->parser->parse('admin_view', $this->data);
// 		$this->_to_string($this->data);
	}
	
	public function _dashboard() {
		$this->data['view'] = 'dashboard_view';
		$this->load->model('teams_model');
		$teams = $this->teams_model->get_teams();
		$this->load->model('matches_model');
		foreach ($teams as $key => $value) {
			$teams[$key]['played'] = $this->matches_model->get_games_played($value['team_id']);
			$teams[$key]['won'] = $this->matches_model->get_games_won($value['team_id']);
			$teams[$key]['drawn'] = $this->matches_model->get_games_drawn($value['team_id']);
			$teams[$key]['lost'] = $this->matches_model->get_games_lost($value['team_id']);
			$teams[$key]['gf'] = $this->matches_model->get_gf($value['team_id']);
			$teams[$key]['ga'] = $this->matches_model->get_ga($value['team_id']);
			$teams[$key]['gd'] = (int) $teams[$key]['gf'] - $teams[$key]['ga'];
			$gd[$key] = $teams[$key]['gd'];
			$teams[$key]['points'] = (int) ($teams[$key]['won'] * 3) + $teams[$key]['drawn'];
			$points[$key] = $teams[$key]['points'];
		}
		array_multisort($points, SORT_DESC, $gd, SORT_DESC, $teams);
		$this->data['teams'] = $teams;
		$this->load->model('players_model');
		$this->data['players'] = $this->players_model->get_stats();
	}
	
	public function _teams() {
		$conditions = array();
		$this->data['view'] = 'teams_view';
		if ($this->uri->segment(3)) {
			$this->data['view'] = 'teams_form_view';
			$conditions['row_id'] = $this->uri->segment(3);
			if ($this->uri->segment(3) === 'new-team') {
				$this->data['form_action'] = site_url('teams/do_insert');
				$this->data['team_name'] = NULL;
			} else {
				$this->data['form_action'] = site_url('teams/do_update/'.$this->uri->segment(3));
				$this->data['delete_team_url'] = site_url('teams/do_delete/'.$this->uri->segment(3));
			}
		}
		$this->load->model('teams_model');
		$array = $this->teams_model->get_teams($conditions);
		if (count($array) > 0) {
			foreach ($array as $key => $value) {
				$array[$key]['team_url'] = site_url('admin/teams/'.$value['team_id']);
			}
			$this->data['new_team_url'] = site_url('admin/teams/new-team');
			$this->data['teams'] = $array;
			$this->data['team_name'] = $array[0]['team_name'];
		}
	}
	
	public function _players() {
		$conditions = array();
		$this->data['view'] = 'players_view';
		if ($this->uri->segment(3)) {
			$this->data['view'] = 'players_form_view';
			$conditions['row_id'] = $this->uri->segment(3);
			$this->load->model('teams_model');
			$this->data['teams'] = $this->teams_model->get_teams();
			if ($this->uri->segment(3) === 'new-player') {
				$this->data['form_action'] = site_url('players/do_insert');
				$this->data['player_name'] = NULL;
			} else {
				$this->data['form_action'] = site_url('players/do_update/'.$this->uri->segment(3));
				$this->data['delete_team_url'] = site_url('players/do_delete/'.$this->uri->segment(3));
			}
		}
		$this->load->model('players_model');
		$array = $this->players_model->get_players($conditions);
		if (count($array) > 0) {
			foreach ($array as $key => $value) {
				$array[$key]['player_url'] = site_url('admin/players/'.$value['player_id']);
			}
			$this->data['new_player_url'] = site_url('admin/players/new-player');
			$this->data['players'] = $array;
			$this->data['player_name'] = $array[0]['player_name'];
			if (isset($this->data['teams'])) {
				foreach ($this->data['teams'] as $key => $value) {
					$this->data['teams'][$key]['selected'] = ($value['team_name'] === $array[0]['team_name'])? 'selected': NULL;
				}
			}
		}
	}
	
	public function _matches() {
		$this->load->model('matches_model');
		$this->load->model('match_detail_model');
		$this->load->model('teams_model');
		$this->load->model('players_model');
		$this->data['breadcrumb_list'][] = array('breadcrumb' => '<i class="fa fa-fw fa-table"></i> Matches');
		if ($this->uri->segment(3)) {
			$this->data['insert_form_url'] = site_url('admin/matches/new-match-detail/'.$this->uri->segment(3));
			$this->data['view'] = 'matches_form_view';
			$this->data['home_teams'] = $this->teams_model->get_teams();
			$this->data['away_teams'] = $this->data['home_teams'];
			if ($this->uri->segment(3) === 'new-match') {
				$this->data['breadcrumb_list'][] = array('breadcrumb' => 'New');
				$this->data['form_action'] = site_url('matches/do_insert');
				$this->data['match_date'] = NULL;
				$this->data['match_time'] = NULL;
				$this->data['match_remarks'] = NULL;
			} else if ($this->uri->segment(3) === 'new-match-detail') {
				$this->data['view'] = 'match_detail_form_view';
				$match_array = $this->matches_model->get_match_by_id($this->uri->segment(4));
				$this->data['home_id'] = $match_array['home_id'];
				$this->data['away_id'] = $match_array['away_id'];
				$player_home = $this->players_model->get_players_by_team($this->data['home_id']);
				$player_away = $this->players_model->get_players_by_team($this->data['away_id']);
				$this->data['players'] = array_merge($player_home, $player_away);
				$this->data['breadcrumb_list'][] = array('breadcrumb' => 'New Match Detail');
				$this->data['form_action'] = site_url('match_detail/do_insert/'.$this->uri->segment(4));
			}else {
				$this->data['breadcrumb_list'][] = array('breadcrumb' => 'Detail');
				$this->data['form_action'] = site_url('matches/do_update/'.$this->uri->segment(3));
				$this->data['delete_row_url'] = site_url('matches/do_delete/'.$this->uri->segment(3));
				$match_array = $this->matches_model->get_match_by_id($this->uri->segment(3));
				foreach ($match_array as $match_k => $match_v) {
					$this->data[$match_k] = $match_v;
				}
				foreach ($this->data['home_teams'] as $key => $value) {
					$this->data['home_teams'][$key]['selected'] = ($value['team_name'] === $this->data['home'])? 'selected': NULL;
				}
				foreach ($this->data['away_teams'] as $key => $value) {
					$this->data['away_teams'][$key]['selected'] = ($value['team_name'] === $this->data['away'])? 'selected': NULL;
				}
				$this->data['home_match_detail'] = $this->match_detail_model->get_match_detail($this->uri->segment(3), $this->data['home_id']);
				$this->data['away_match_detail'] = $this->match_detail_model->get_match_detail($this->uri->segment(3), $this->data['away_id']);
			}
		} else {
			$this->data['insert_form_url'] = site_url('admin/matches/new-match');
			$this->data['view'] = 'matches_view';
			$all_matches_array = $this->matches_model->get_match_date();
			foreach ($all_matches_array as $all_matches_key => $all_matches_value) {
				$date = explode('-', $all_matches_value['match_date']);
				$th_year = 543;
				$th_month = $this->matches_model->th_month;
				$th_date = $date[2].' '.$th_month[$date[1] - 1].' '.($date[0] + $th_year);
				$all_matches_array[$all_matches_key]['match_date_th'] = $th_date;
				$match_array = $this->matches_model->get_matches($all_matches_value);
				foreach ($match_array as $match_key => $match_value) {
					$match_array[$match_key]['match_url'] = site_url('admin/matches/'.$match_value['match_id']);
				}
				$all_matches_array[$all_matches_key]['matches'] = $match_array;
			}
			$this->data['all_matches'] = $all_matches_array;
		}
	} # method : _matches
	
	public function signin() {
		$rules = array(
			array(
				'field'   => 'input-username',
				'label'   => 'Username',
				'rules'   => 'trim|required|xss_clean'
			),
			array(
				'field'   => 'input-password',
				'label'   => 'Passwrord',
				'rules'   => 'trim|required|xss_clean'
			)
		);
		$this->form_validation->set_rules($rules);
		if ($this->form_validation->run() === TRUE) {
			$conditions = array(
				'user_signin' => $this->input->post('input-username'),
				'user_password' => hash('sha512', $this->input->post('input-password')),
				'active_flag' => 'y'
			);
			$this->load->model('users_model');
			$user = $this->users_model->get_user($conditions);
			if (count($user) > 0) {
				$user[0]['signin'] = TRUE;
				$this->session->set_userdata($user[0]);
				redirect('admin/dashboard', 'refresh');
			}
			$this->session->set_flashdata('error_message', '<div class="alert alert-danger"><strong>Error!</strong> The username or password you entered is incorrect.</div>');
			redirect('admin/signin', 'refresh');
		}
		$this->data['title'] .= ' - เข้าสู่ระบบ';
		$this->data['error_message'] = ($this->session->flashdata('error_message')) ? $this->session->flashdata('error_message') : NULL;
		$this->load->view('signin_view', $this->data);
	}
	
	public function signout() {
		$this->session->sess_destroy();
		redirect('admin/signin', 'refresh');
	}
	
	public function _to_string($data) {
		echo '<pre>';
		print_r($data);
		echo '</pre>';
	}
}

/* End of file admin.php */
/* Location: ./application/controllers/admin.php */