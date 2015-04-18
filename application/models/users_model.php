<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Users_Model extends CI_Model {

	public $table_name = 'app_users';
	
	public function __construct() {
		parent::__construct();
	} # __construct
	
	public function get_user($conditions) {
		$sql = "select row_id as user_id, group_id, user_signin, user_email ";
		$sql .= "from tbl_users ";
		if (count($conditions) > 0) {
			foreach($conditions as $column_name => $column_value) {
				if (strpos($sql, 'where') === FALSE) {
					$sql .= "where $column_name = ? ";
				} else {
					$sql .= "and $column_name = ? ";
				}
			}
		}
		$sql .= "order by row_id asc";
		$query = $this->db->query($sql, $conditions);
		return $query->result_array();
	} # get_user
} # users_model

/* End of file users_model.php */
/* Location: ./application/models/users_model.php */