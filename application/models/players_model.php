<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Players_Model extends CI_Model {

	public function __construct() {
		parent::__construct();
	} # __construct
	
	public function get_stats() {
		$sql = "select p.player_name, t.team_name, ifnull(sum(md.goals), 0) as goals ";
		$sql .= "from tbl_match_detail md, tbl_players p, tbl_teams t ";
		$sql .= "where md.player_id = p.row_id ";
		$sql .= "and p.team_id = t.row_id ";
		$sql .= "group by p.player_name, t.team_name ";
		$sql .= "order by sum(md.goals) desc, p.player_name ";
		$sql .= "limit 0, 10";
		$query = $this->db->query($sql);
		return $query->result_array();
	} # get_summary_by_team
	
	public function get_players($conditions = NULL) {
		$this->db->select('row_id as player_id, player_name, (select tbl_teams.team_name from tbl_teams where tbl_teams.row_id = tbl_players.team_id) as team_name, (select sum(goals) from tbl_match_detail where tbl_match_detail.player_id = tbl_players.row_id) as goals');
		$this->db->from('tbl_players');
		if (!is_null($conditions)) {
			foreach ($conditions as $column_name => $column_value) {
				$this->db->where($column_name, $column_value);
			}
		}
		$this->db->where('active_flag', 'y');
		$this->db->order_by('player_name');
		$query = $this->db->get();
		return $query->result_array();
	} # get_players
	
	public function get_players_by_team($team_id = NULL) {
		$sql = "select p.row_id as player_id, p.player_name, p.team_id, ifnull((select sum(md.goals) from tbl_match_detail md where md.player_id = p.row_id),0) as goals ";
		$sql .= "from tbl_players p ";
		$sql .= "where p.team_id = ? ";
		$sql .= "order by p.player_name";
		$query = $this->db->query($sql, $team_id);
		return $query->result_array();
	} # method : get_players_by_team
	
	public function insert($team) {
		try {
			$this->db->insert('tbl_players', $team);
		} catch (Exception $e) {
			echo 'Caught Exception : ' , $e->getMessage();
		}
		return $this->db->affected_rows();
	} # insert
	
	public function update($team, $conditions) {
		try {
			$this->db->update('tbl_players', $team, $conditions);
		} catch (Exception $e) {
			echo 'Caught Exception : ' , $e->getMessage();
		}
		return $this->db->affected_rows();
	} # update
	
	public function delete($conditions) {
		try {
			$this->db->delete('tbl_players', $conditions);
		} catch (Exception $e) {
			echo 'Caught Exception : ' , $e->getMessage();
		}
		return $this->db->affected_rows();
	} # delete
} # players_model

/* End of file players_model.php */
/* Location: ./application/models/players_model.php */