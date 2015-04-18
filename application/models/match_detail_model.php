<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Match_Detail_Model extends CI_Model {

	public function __construct() {
		parent::__construct();
	} # method : __construct

	public function get_match_detail($match_id, $team_id) {
		$sql = "select p.player_name, ifnull(sum(md.goals), 0) player_goals ";
		$sql .= "from tbl_match_detail md, tbl_players p ";
		$sql .= "where md.player_id = p.row_id ";
		$sql .= "and md.match_id = ? ";
		$sql .= "and p.team_id = ? ";
		$sql .= "group by p.player_name ";
		$sql .= "order by p.player_name";
		$query = $this->db->query($sql, array($match_id, $team_id));
		return $query->result_array();
	} # method : get_match_date
	
	public function insert($match_detail) {
		try {
			$this->db->insert('tbl_match_detail', $match_detail);
		} catch (Exception $e) {
			echo 'Caught Exception : ' , $e->getMessage();
		}
		return $this->db->affected_rows();
	} # insert
	
	public function update($match_detail, $conditions) {
		try {
			$this->db->update('tbl_match_detail', $matches, $conditions);
		} catch (Exception $e) {
			echo 'Caught Exception : ' , $e->getMessage();
		}
		return $this->db->affected_rows();
	} # method : update
	
	public function delete($conditions) {
		try {
			$this->db->delete('tbl_match_detail', $conditions);
		} catch (Exception $e) {
			echo 'Caught Exception : ' , $e->getMessage();
		}
		return $this->db->affected_rows();
	} # method : delete
} # class : match_detail_model

/* End of file match_detail_model.php */
/* Location: ./application/models/match_detail_model.php */