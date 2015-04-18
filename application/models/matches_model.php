<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Matches_Model extends CI_Model {

	public $th_month = array('มกราคม', 'กุมภาพันธ์', 'มีนาคม', 'เมษายน', 'พฤษภาคม','มิถุนายน' ,'กรกฎาคม' ,'สิงหาคม' ,'กันยายน' ,'ตุลาคม' ,'พฤศจิกายน' ,'ธันวาคม');
	
	public function __construct() {
		parent::__construct();
	} # __construct
	
	public function get_match_date($conditions = NULL) {
		$sql = "select distinct match_date ";
		$sql .= "from tbl_matches ";
		$sql .= "order by match_date desc";
		$query = $this->db->query($sql);
		return $query->result_array();
	} # method : get_match_date
	
	public function get_matches($match_date = NULL) {
		$sql = "select m.row_id as match_id, match_date, match_time, h.row_id as home_id, h.team_name as home, ifnull((select sum(md.goals) from tbl_match_detail md, tbl_players p where md.player_id = p.row_id and md.match_id = m.row_id and p.team_id = m.home_id),0) as home_goals, a.row_id as away_id, a.team_name as away, ifnull((select sum(md.goals) from tbl_match_detail md, tbl_players p where md.player_id = p.row_id and md.match_id = m.row_id and p.team_id = m.away_id),0) as away_goals, m.match_remarks ";
		$sql .= "from tbl_matches m, tbl_teams h, tbl_teams a ";
		$sql .= "where m.home_id = h.row_id ";
		$sql .= "and m.away_id = a.row_id ";
		if (!is_null($match_date)) {
			$sql .= "and match_date = ? ";
		}
		$sql .= "order by match_time";
		$query = $this->db->query($sql, $match_date);
		return $query->result_array();
	} # method : get_match_date
	
	public function get_match_by_id($row_id = NULL) {
		$sql = "select m.row_id as match_id, match_date, match_time, h.row_id as home_id, h.team_name as home, ifnull((select sum(md.goals) from tbl_match_detail md, tbl_players p where md.player_id = p.row_id and md.match_id = m.row_id and p.team_id = m.home_id),0) as home_goals, a.row_id as away_id, a.team_name as away, ifnull((select sum(md.goals) from tbl_match_detail md, tbl_players p where md.player_id = p.row_id and md.match_id = m.row_id and p.team_id = m.away_id),0) as away_goals, m.match_remarks ";
		$sql .= "from tbl_matches m, tbl_teams h, tbl_teams a ";
		$sql .= "where m.home_id = h.row_id ";
		$sql .= "and m.away_id = a.row_id ";
		if (!is_null($row_id)) {
			$sql .= "and m.row_id = ? ";
		}
		$query = $this->db->query($sql, $row_id);
		return $query->row_array();
	} # method : get_match_date
	
	public function get_games_played($team_id) {
		$sql = "select * ";
		$sql .= "from tbl_matches m ";
		$sql .= "where (m.home_id = ? ";
		$sql .= "or m.away_id = ?)";
		$query = $this->db->query($sql, array($team_id, $team_id));
		return $query->num_rows();
	} # get_played
	
	public function get_games_won($team_id) {
		$sql = "select * ";
		$sql .= "from (select (select sum(md.goals) from tbl_match_detail md, tbl_players p where md.match_id = m.row_id and md.player_id = p.row_id and p.team_id = m.home_id) as home_scores, (select sum(md.goals) from tbl_match_detail md, tbl_players p where md.match_id = m.row_id and md.player_id = p.row_id and p.team_id = m.away_id) as away_scores ";
		$sql .= "from tbl_matches m ";
		$sql .= "where m.home_id = ?) temp ";
		$sql .= "where temp.home_scores > temp.away_scores";
		$query = $this->db->query($sql, $team_id);
		$home_won = $query->num_rows();

		$sql = "select * ";
		$sql .= "from (select (select sum(md.goals) from tbl_match_detail md, tbl_players p where md.match_id = m.row_id and md.player_id = p.row_id and p.team_id = m.home_id) as home_scores, (select sum(md.goals) from tbl_match_detail md, tbl_players p where md.match_id = m.row_id and md.player_id = p.row_id and p.team_id = m.away_id) as away_scores ";
		$sql .= "from tbl_matches m ";
		$sql .= "where m.away_id = ?) temp ";
		$sql .= "where temp.home_scores < temp.away_scores";
		$query = $this->db->query($sql, $team_id);
		$away_won = $query->num_rows();
		
		return (int) $home_won + $away_won;
	} # get_won
	
	public function get_games_drawn($team_id) {
		$sql = "select * ";
		$sql .= "from (select (select sum(md.goals) from tbl_match_detail md, tbl_players p where md.match_id = m.row_id and md.player_id = p.row_id and p.team_id = m.home_id) as home_scores, (select sum(md.goals) from tbl_match_detail md, tbl_players p where md.match_id = m.row_id and md.player_id = p.row_id and p.team_id = m.away_id) as away_scores ";
		$sql .= "from tbl_matches m ";
		$sql .= "where (m.home_id = ? ";
		$sql .= "or m.away_id = ?)) temp ";
		$sql .= "where temp.home_scores = temp.away_scores";
		$query = $this->db->query($sql, array($team_id, $team_id));
		return $query->num_rows();
	} # get_drawn

	public function get_games_lost($team_id) {
		$sql = "select * ";
		$sql .= "from (select (select sum(md.goals) from tbl_match_detail md, tbl_players p where md.match_id = m.row_id and md.player_id = p.row_id and p.team_id = m.home_id) as home_scores, (select sum(md.goals) from tbl_match_detail md, tbl_players p where md.match_id = m.row_id and md.player_id = p.row_id and p.team_id = m.away_id) as away_scores ";
		$sql .= "from tbl_matches m ";
		$sql .= "where m.home_id = ?) temp ";
		$sql .= "where temp.home_scores < temp.away_scores";
		$query = $this->db->query($sql, $team_id);
		$home_lost = $query->num_rows();

		$sql = "select * ";
		$sql .= "from (select (select sum(md.goals) from tbl_match_detail md, tbl_players p where md.match_id = m.row_id and md.player_id = p.row_id and p.team_id = m.home_id) as home_scores, (select sum(md.goals) from tbl_match_detail md, tbl_players p where md.match_id = m.row_id and md.player_id = p.row_id and p.team_id = m.away_id) as away_scores ";
		$sql .= "from tbl_matches m ";
		$sql .= "where m.away_id = ?) temp ";
		$sql .= "where temp.home_scores > temp.away_scores";
		$query = $this->db->query($sql, $team_id);
		$away_lost = $query->num_rows();
		
		return (int) $home_lost + $away_lost;
	} # get_drawn
	
	public function get_gf($team_id) {
		$sql = "select sum(md.goals) as goals ";
		$sql .= "from tbl_matches m, tbl_match_detail md, tbl_players p ";
		$sql .= "where m.row_id = md.match_id ";
		$sql .= "and m.home_id = p.team_id ";
		$sql .= "and m.home_id = ? ";
		$sql .= "and md.player_id = p.row_id ";
		$query = $this->db->query($sql, $team_id);
		$row = $query->row_array();
		$home_gf = $row['goals'];
	
		$sql = "select sum(md.goals) as goals ";
		$sql .= "from tbl_matches m, tbl_match_detail md, tbl_players p ";
		$sql .= "where m.row_id = md.match_id ";
		$sql .= "and m.away_id = p.team_id ";
		$sql .= "and m.away_id = ? ";
		$sql .= "and md.player_id = p.row_id ";
		$query = $this->db->query($sql, $team_id);
		$row = $query->row_array();
		$away_gf = $row['goals'];
	
		return (int) $home_gf + $away_gf;
	} # get_gf
	
	public function get_ga($team_id) {
		$sql = "select sum(md.goals) as goals ";
		$sql .= "from tbl_matches m, tbl_match_detail md, tbl_players p ";
		$sql .= "where m.row_id = md.match_id ";
		$sql .= "and m.away_id = p.team_id ";
		$sql .= "and m.home_id = ? ";
		$sql .= "and md.player_id = p.row_id ";
		$query = $this->db->query($sql, $team_id);
		$row = $query->row_array();
		$home_ga = $row['goals'];
	
		$sql = "select sum(md.goals) as goals ";
		$sql .= "from tbl_matches m, tbl_match_detail md, tbl_players p ";
		$sql .= "where m.row_id = md.match_id ";
		$sql .= "and m.home_id = p.team_id ";
		$sql .= "and m.away_id = ? ";
		$sql .= "and md.player_id = p.row_id ";
		$query = $this->db->query($sql, $team_id);
		$row = $query->row_array();
		$away_ga = $row['goals'];
	
		return (int) $home_ga + $away_ga;
	} # get_ga
	
	public function insert($matches) {
		try {
			$this->db->insert('tbl_matches', $matches);
		} catch (Exception $e) {
			echo 'Caught Exception : ' , $e->getMessage();
		}
		return $this->db->affected_rows();
	} # insert
	
	public function update($matches, $conditions) {
		try {
			$this->db->update('tbl_matches', $matches, $conditions);
		} catch (Exception $e) {
			echo 'Caught Exception : ' , $e->getMessage();
		}
		return $this->db->affected_rows();
	} # update
	
	public function delete($conditions) {
		try {
			$this->db->delete('tbl_matches', $conditions);
		} catch (Exception $e) {
			echo 'Caught Exception : ' , $e->getMessage();
		}
		return $this->db->affected_rows();
	} # delete
} # matches_model

/* End of file matches_model.php */
/* Location: ./application/models/matches_model.php */