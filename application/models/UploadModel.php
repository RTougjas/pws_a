<?php

class UploadModel extends CI_Model {

	public function __construct() {
		$this->load->database();
	}
	
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


}?>
