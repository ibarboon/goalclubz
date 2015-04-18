<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Teams_Model extends CI_Model {

	public function __construct() {
		parent::__construct();
	} # __construct
	
	public function get_teams($conditions = NULL) {
		$this->db->select('row_id as team_id, team_name, (select count(*) from tbl_players where tbl_players.team_id = tbl_teams.row_id) as players');
		$this->db->from('tbl_teams');
		if (!is_null($conditions)) {
			foreach ($conditions as $column_name => $column_value) {
				$this->db->where($column_name, $column_value);
			}
		}
		$this->db->where('active_flag', 'y');
		$this->db->order_by('team_name');
		$query = $this->db->get();
		return $query->result_array();
	} # get_teams
	
	public function insert($team) {
		try {
			$this->db->insert('tbl_teams', $team); 
		} catch (Exception $e) {
			echo 'Caught Exception : ' , $e->getMessage();
		}
		return $this->db->affected_rows();
	} # insert
	
	public function update($team, $conditions) {
		try {
			$this->db->update('tbl_teams', $team, $conditions); 
		} catch (Exception $e) {
			echo 'Caught Exception : ' , $e->getMessage();
		}
		return $this->db->affected_rows();
	} # update
	
	public function delete($conditions) {
		try {
			$this->db->delete('tbl_teams', $conditions);
		} catch (Exception $e) {
			echo 'Caught Exception : ' , $e->getMessage();
		}
		return $this->db->affected_rows();
	} # delete
} # teams_model

/* End of file teams_model.php */
/* Location: ./application/models/teams_model.php */