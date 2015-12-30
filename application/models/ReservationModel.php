<?php

class ReservationModel extends CI_Model {
	
	//Constructor for loading database.
	public function __construct() {
		$this->load->database();
	}
	

	/**
	*	Inserts all the data, which is represented by an array to the reservation table. 
	*
	*	@param	$values		An array of key-value pairs. 
	*	@return	id of inserted reservation.
	*/
	public function insertReservation($values) {
		
		$this->db->insert('reservation', $values);
		$this->db->select('LAST_INSERT_ID() AS last_id');
		$query = $this->db->get();
		return $query->result();
	}
	
	/**
	*	Allows to insert items to the reservation
	*
	*	@param	$reservation_id	Distinguishes, which reservation is being used.
	*	@param	$menuItem_id	Distinguishes, which item is added to the reservation.
	*	@param	$amount			Describes the amount of items added to the reservation.
	*/
	public function insertItemToReservation($reservation_id, $menuItem_id) {
		
		$this->db->set('reservation', $reservation_id);
		$this->db->set('menuItem', $menuItem_id);
		$this->db->insert('reservationItems');
		
	}
	
	/**
	*	Deletes reservation from table.
	*
	*	@param $reservation_id	distinguishes, which reservation to be deleted. 
	*/
	public function deleteReservation($reservation_id) {
		$this->db->where('id', $reservation_id);
		$this->db->delete('reservation');

	}
	
	/**
	*	Returns details of specific reservation
	*
	*	@param	$reservation_id	
	*	@return	array of rows. 
	*/
	public function getReservation($reservation_id) {
		$this->db->select('*');
		$this->db->from('v_reservation_details');
		$this->db->where('reservation_id', $reservation_id);
		$query = $this->db->get();
		
		return $query->result();
	}
	
}

?>