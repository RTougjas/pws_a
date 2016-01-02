<?php

class MenuModel extends CI_Model {
	
	//Constructor for loading database.
	public function __construct() {
		$this->load->database();
	}
	
	/**
	*	@param	$item_id	id of item to be returned
	*	
	*	@return	menuItem.
	*/
	public function getMenuItem($item_id) {
			
		$this->db->select('*');
		$this->db->from('v_menu_items');
		$this->db->where('menuitem_id', $item_id);
		$query = $this->db->get();
		
		return $query->result();
	}
	
	/**
	*	returns all menuitems of specified location. 
	*
	*	@param $location_id		describes which location item you want to get.
	*	@return menuItem_id, menuItem_name, menuItem_price, category_id, category_name,
	*			location_id, location_name.
	*
	*/
	public function getAllMenuItems($location_id) {
		
		$this->db->select('*');
		$this->db->from('v_menu_items');
		$this->db->where('location_id', $location_id);
		$query = $this->db->get();
		
		return $query->result();
		
	}
	
	/**
	*
	*
	*
	*/
	public function getRoom($item_id) {
		
		$this->db->select('*');
		$this->db->from('v_menu_items');
		$this->db->where('general_id', 3);
		$query = $this->db->get();
		
		return $query->result();
	}
	
	/**
	*
	*
	*/
	public function getAllRooms($location_id) {
		
		$this->db->select('*');
		$this->db->from('v_menu_items');
		$this->db->where('general_id', 3);
		$this->db->where('location_id', $location_id);
		$query = $this->db->get();
		
		return $query->result();
	}
	
	/**
	*	return all categories of specified location.
	*
	*	@param $location_id	describes which location categories you want. It is so, that the 	*							same item could be in one category in one location, and in other 	*							location, it could be under different category.  
	*	@return category_id, category_name, location_id, location_name, general_id, general_name.
	*/	 
	
	public function getCategories($location_id) {
		$this->db->select('*');
		$this->db->from('v_categories');
		$this->db->where('location_id', $location_id);
		$this->db->order_by('category_name', 'asc');
		$query = $this->db->get();
		
		return $query->result();
		
	}
	
	/**
	*	
	*	@param	$location_id	distinguishing location. 
	*	@return	distinct values of general categories. 
	*/
	public function getGeneralCategories($location_id) {
		$this->db->select('*');
		$this->db->from('generalCategory');
		$query = $this->db->get();
		
		return $query->result();
	}	
	/**
	*	return all categories under specific general categories.
	*	1 - food, 2 - beverages, 3 - rooms, 4 - other. (these can not be edited).
	*	
	*	For example. 	beer would have category "Beer" and generalCategory "beverages".
	*					Coca-Cola would have category "Cold drinks" and generalCategory "beverages".	
	*	@param $location_id 	describes the location.
	*	@param $general_id		describes modifable category general category. 
	*/
	public function getSpecificCategories($location_id, $general_id) {
		$this->db->select('*');
		$this->db->from('v_categories');
		$this->db->where('location_id', $location_id);
		$this->db->where('general_id', $general_id);
		$query = $this->db->get();
		
		return $query->result();
	}
	
	/**
	*	Insert menuitem to the database. 
	*
	*	@param	$data	An array containing key-value pairs.
	*/
	public function insertMenuItem($data) {
		
		$this->db->insert('menuItem', $data);
	}
	
	/**
	*
	*
	*/
	public function insertCategory($data) {
		
		$this->db->insert('category', $data);
	}
	
	/**
	*
	*
	*/
	public function insertRoom($data) {
		
		$this->db->insert('menuItem', $data);
		$this->db->select('LAST_INSERT_ID() AS last_id');
		$query = $this->db->get();
		return $query->result();
	}
	
	/**
	*
	*
	*/
	public function updateCategory($category_id, $data) {
		$this->db->where('id', $category_id);
		$this->db->update('category', $data);
	}
	
	/**
	*	Update menuitem table.
	*
	*	@param	$item_id	ID of menuitem to be updated.
	*	@param	$data		Array of values that need to be updated. 
	*/
	public function updateMenuItem($item_id, $data) {
		
		$this->db->where('id', $item_id);
		$this->db->update('menuItem', $data);
	}
	
	/**
	*
	*
	*/
	public function updateRoom($room_id, $data) {
		
	}
	
	/**
	*
	*
	*/
	public function deleteCategory($category_id) {
		
		$this->db->where('id', $category_id);
		$this->db->delete('category');
	}
	
	/**
	*	Delete item from menu table.
	*	
	*	@param	$item_id	Id of item to be deleted.
	*/
	public function deleteMenuItem($item_id) {
		
		$this->db->where('id', $item_id);
		$this->db->delete('menuItem');
	}
	
	/**
	*
	*
	*/
	public function deleteRoom($room_id) {
		
		
	}
	
	
}

?>