<?php

class PhotoModel extends CI_Model {

	public function __construct() {
		$this->load->database();
	}
	/**
	*	@param	values for inserting into photo table.	
	*
	*	
	*/
	public function upload($values) {
		
		$this->db->insert('photo', $values);

	}
	
	/**
	*	@param	$location_id	specifies location
	*	
	*	@return	all public(gallery) photos of specified location.
	*/
	public function getAllGalleryPhotos($location_id) {
		
		$this->db->select('*');
		$this->db->from('photo');
		$this->db->where('location', $location_id);
		$this->db->where('public', 1);
		$query = $this->db->get();
		
		return $query->result();
	}
	
	/**
	*
	*
	*
	*/
	public function getMenuItemPhotos($location_id, $menuItem_id) {
		
		$this->db->select('*');
		$this->db->from('photo');
		$this->db->where('menuItem', $menuItem_id);
		$this->db->where('location', $location_id);
		$this->db->where('public', 0);
		$query = $this->db->get();
		
		return $query->result();
	}
	
	/**
	*
	*
	*
	*/
	public function deletePhoto($photo_id, $filename) {
		
		unlink($filename);
		
		$this->db->where('id', $photo_id);
		$this->db->delete('photo');
		
		
	}


}?>
