<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Utility_Model extends CI_Model {

	public function __construct() {
		parent::__construct();
	} # __construct
	
	public function get_option($conditions) {
		$sql = "select row_id as option_id, option_type, option_key, option_value ";
		$sql .= "from tbl_options ";
		if (count($conditions) > 0) {
			foreach($conditions as $column_name => $column_value) {
				if (strpos($sql, 'where') === FALSE) {
					$sql .= "where $column_name = ? ";
				} else {
					$sql .= "and $column_name = ? ";
				}
			}
		}
		$sql .= "order by option_sequence asc";
		$query = $this->db->query($sql, $conditions);
		return $query->result_array();
	} # get_option
	
	public function get_side_nav_list($conditions) {
		$sql = "select o.option_key as a_href, substr(o.option_value, 1, instr(o.option_value, '|') - 1) as i_class, substr(o.option_value, instr(o.option_value, '|') + 1) as display_value, acl.create_flag, acl.update_flag, acl.read_flag, acl.delete_flag ";
		$sql .= "from tbl_access_control_list acl, tbl_options o, tbl_users u ";
		$sql .= "where acl.group_id = u.group_id ";
		$sql .= "and acl.reference_id = o.row_id ";
		$sql .= "and acl.active_flag = 'y' ";
		$sql .= "and o.option_type = 'side-nav' ";
		$sql .= "and o.active_flag = 'y' ";
		$sql .= "and u.row_id = ? ";
		$sql .= "order by o.option_sequence asc";
		$query = $this->db->query($sql, $conditions);
		return $query->result_array();
	} # get_side_nav_list
} # utility_model

/* End of file utility_model.php */
/* Location: ./application/models/utility_model.php */