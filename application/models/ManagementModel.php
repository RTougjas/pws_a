<?php

class ManagementModel extends CI_Model {
	
	//Constructor for loading database.
	public function __construct() {
		$this->load->database();
	}

	
	/**
	*	@return		all locations id and name stored in database.
	*/
	public function getGroups() {
		$this->db->select('*');
		$this->db->from('groups');
		$query = $this->db->get();
		
		return $query->result();
	}
	/**
	*	@return 	all users. 
	*/
	
	public function getUsers() {
		$this->db->select('*');
		$this->db->from('v_users');
		$query = $this->db->get();
		
		return $query->result();
	}
	
	public function getLocationDetails($location_id) {
		$this->db->select('*');
		$this->db->from('location');
		$this->db->where('id', $location_id);
		$query = $this->db->get();
		
		return $query->result();
	}
	
	public function deleteUser($user_id) {
		
		$this->db->where('id', $user_id);
		$this->db->delete('users');
	}
	
	public function getUserLocations($user_id) {
		$this->db->select('location_id');
		$this->db->from('v_users_locations');
		$this->db->where('user_id', $user_id);
		$query = $this->db->get();
		
		return $query->result();
	}

	public function isUserPermitted($user_id, $location_id) {
		
		$this->db->select('*');
		$this->db->from('v_users_locations');
		$this->db->where('user_id', $user_id);
		$this->db->where('location_id', $location_id);
		$query = $this->db->get();
		
		if ( sizeof($query->result()) == 1 ) {
			return true;
		}
		else {
			return false;
		}
		
	}
}
?>