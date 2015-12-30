<?php

class FeedbackModel extends CI_Model {
	
	//Constructor for loading database.
	public function __construct() {
		$this->load->database();
	}


	/**
	*	Inserts key value pairs to the feedback table.
	*
	*	@param	$data	key-value pairs to be inserted to the database.
	*/
	public function insertFeedback($data) {
		$this->db->insert('feedback', $data);
		
	}
	
	/**
	*	Deletes feedback from table
	*
	*	@param	$feedback_id	To select, which feedback to be deleted. 
	*/
	public function deleteFeedback($feedback_id) {
		$this->db->where('id', $feedback_id);
		$this->db->delete('feedback');
	}
	
	
}

?>