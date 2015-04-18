<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Ajax extends CI_Controller {

	public $data = array();
	
	function __construct() {
		parent::__construct();
	}
	
	public function teams($id = NULL) {
		$conditions = array('row_id' => $id);
		switch ( $this->input->post( 'in_action' ) ) {
			case 'add':
				$view = 'ajax/teams_form_view';
				break;
			case 'view':
				$view = 'ajax/teams_view';
				$this->load->model('teams_model');
				$this->data['team'] = $this->teams_model->get_team($conditions);
				$this->load->model('players_model');
				$this->data['players'] = $this->players_model->get_players_by_team($id);
				break;
			case 'edit':
				$this->load->model('teams_model');
				$this->data['team'] = $this->teams_model->get_team($conditions);
				$view = 'ajax/teams_form_view';
				break;
			case 'delete':
				$this->load->model('teams_model');
				$this->data['affected_rows'] = $this->teams_model->delete($id);
				$view = 'ajax/affected_rows_view';
				break;
			default:
				$this->_dashboard();
				break;
		}
		$this->load->view($view, $this->data);
	}
	
	public function _to_string($data) {
		echo '<pre>';
		print_r($data);
		echo '</pre>';
	}
}

/* End of file ajax.php */
/* Location: ./application/controllers/ajax.php */