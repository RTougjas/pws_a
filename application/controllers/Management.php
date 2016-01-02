<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Management extends CI_Controller {
	
	function __construct() {
		parent::__construct();
		$this->load->database();
		$this->load->model(array('MenuModel', 'ManagementModel', 'PhotoModel'));
		$this->load->library(array('ion_auth','form_validation'));
		$this->load->helper(array('url','language'));
		$this->lang->load('tekst_lang', 'estonian');
		$this->lang->load('form_validation_lang');

		$this->form_validation->set_error_delimiters('<div class="alert alert-danger" role="alert">', '</div>');
	}
	
	public function index() {
		
	}
	
	public function displayMenuItems($location_id) {
		
		$this->data['location_details'] = $this->ManagementModel->getLocationDetails($location_id);
		$this->data['categories'] = $this->MenuModel->getCategories($location_id);
		$this->data['menu_items'] = $this->MenuModel->getAllMenuItems($location_id);
		$this->data['title'] = "Menüü";
		
		$this->load->view('templates/header');
		$this->load->view('v_menu_items', $this->data);
		$this->load->view('templates/footer');
	}
	
	public function displayCategories($location_id) {
		
		$this->data['location_details'] = $this->ManagementModel->getLocationDetails($location_id);
		$this->data['categories'] = $this->MenuModel->getCategories($location_id);
		$this->data['general_categories'] = $this->MenuModel->getGeneralCategories($location_id);
		$this->data['title'] = "Kategooriad";
		
		$this->load->view('templates/header');
		$this->load->view('v_categories', $this->data);
		$this->load->view('templates/footer');
	}
	
	public function displayRoom($location_id, $room_id) {
		
		$this->data['location_details'] = $this->ManagementModel->getLocationDetails($location_id);
		$this->data['room_details'] = $this->MenuModel->getMenuItem($room_id);
		$this->data['categories'] = $this->MenuModel->getSpecificCategories($location_id, 3);
		$this->data['photos'] = $this->PhotoModel->getMenuItemPhotos($location_id, $room_id);
		$this->data['title'] = $this->data['room_details'][0]->menuItem_name;
		
		$this->load->view('templates/header');
		$this->load->view('templates/v_room_template', $this->data);
		$this->load->view('templates/footer');
		 
		
	}
	
	public function displayAllRooms($location_id) {
		
		$this->data['location_details'] = $this->ManagementModel->getLocationDetails($location_id);
		$this->data['categories'] = $this->MenuModel->getSpecificCategories($location_id, 3);
		$this->data['rooms'] = $this->MenuModel->getAllRooms($location_id);
		$this->data['title'] = "Toad";
		
		$this->load->view('templates/header');
		$this->load->view('v_rooms', $this->data);
		$this->load->view('templates/footer');
		
	}
	
	public function displayCreateRoom($location_id) {
		
		$this->data['location_details'] = $this->ManagementModel->getLocationDetails($location_id);
		$this->data['categories'] = $this->MenuModel->getSpecificCategories($location_id, 3);
		$this->data['title'] = "Lisa uus tuba";
		
		$this->load->view('templates/header');
		$this->load->view('v_create_room', $this->data);
		$this->load->view('templates/footer');
	}
	
	public function displayGalleryUpload($location_id) {
		
		// code for previous photos.
		$this->data['photos'] = $this->PhotoModel->getAllGalleryPhotos($location_id);
		$this->data['title'] = "Galerii";
		$this->data['location_details'] = $this->ManagementModel->getLocationDetails($location_id);
		
		$this->load->view('templates/header');
		$this->load->view('v_gallery_upload', $this->data);
		$this->load->view('templates/footer');
		
	}
	
	public function doUpload($location_id) {
		
        $config['upload_path']          = 'uploads/';
        $config['allowed_types']        = 'gif|jpg|png|tiff|tif';
        $config['max_size']             = 100000;
        $config['max_width']            = 102400;
        $config['max_height']           = 76800;

        $this->load->library('upload', $config);
		
		if( $this->upload->do_upload('userfile')) {

			$data = array('upload_data' => $this->upload->data());
			
			if(!empty($this->input->post('item_photo'))) {
				$values = array(
					'menuItem' => $this->input->post('item_photo'),
					'url' => base_url().$config['upload_path'].$data['upload_data']['file_name'],
					'public' => 1,
					'location' => $location_id,
					'filename' => $config['upload_path'].$data['upload_data']['file_name']
				);
			} else {
				$values = array(
					'url' => base_url().$config['upload_path'].$data['upload_data']['file_name'],
					'public' => 1,
					'location' => $location_id,
					'filename' => $config['upload_path'].$data['upload_data']['file_name']
				);
			}
			
			$this->PhotoModel->upload($values);
		
			$message = 'Pilt edukalt laetud galeriisse';
			$this->session->set_flashdata('success', $message);
			
			redirect('Management/displayGalleryUpload/'.$location_id, 'refresh');
			
		}
		else {
			$this->session->set_flashdata('error', $this->upload->display_errors());
			redirect('Management/displayGalleryUpload/'.$location_id);
		}
	}
	
	public function insertMenuItem($location_id) {
		
		$menuItem_category = $this->input->post('selected_category');
		$menuItem_name = $this->input->post('menuItem_name');
		$menuItem_price = $this->input->post('menuItem_price');
		
		$values = array(
			'name' => $menuItem_name,
			'price' => $menuItem_price,
			'category' => $menuItem_category,
			'location' => $location_id
		);
		
		$this->MenuModel->insertMenuItem($values);
		
		$message = '<b>'.$menuItem_name.'</b> edukalt lisatud.';
		
		$this->session->set_flashdata('success', $message);
		
		redirect('Management/displayMenuItems/'.$location_id);
	}
	
	public function insertCategory($location_id) {
		
		$general_category = $this->input->post('selected_general_category');
		$category_name = $this->input->post('category_name');

		$values = array(
			'name' => $category_name,
			'location' => $location_id,
			'general' => $general_category
		);
		
		$this->MenuModel->insertCategory($values);
		
		$message = '<b>'.$category_name.'</b> edukalt lisatud.';
		$this->session->set_flashdata('success', $message);
		
		redirect('Management/displayCategories/'.$location_id);
		
	}
	
	public function insertRoom($location_id) {
		
		$room_id = $this->input->post('room_id');
		
		if(!empty($room_id)) {
			$this->data['room_details'] = $this->MenuModel->getMenuItem($room_id);
			
			$room_name = $this->input->post('room_name');
			$room_price = $this->input->post('room_price');
			$room_description = $this->input->post('room_description');
			$room_category = $this->input->post('selected_room_category');
			
			if ($room_name === $this->data['room_details'][0]->menuItem_name &&
				$room_price === $this->data['room_details'][0]->menuItem_price &&
				$room_description === $this->data['room_details'][0]->menuItem_description &&
				$room_category === $this->data['room_details'][0]->category_id ) {
					
			    	$config['upload_path']          = 'uploads/';
			    	$config['allowed_types']        = 'gif|jpg|png|tiff|tif';
			   	 	$config['max_size']             = 100000;
			    	$config['max_width']            = 102400;
			    	$config['max_height']           = 76800;

			    	$this->load->library('upload', $config);
		
					if( $this->upload->do_upload('userfile')) {

						$data = array('upload_data' => $this->upload->data());
				
						if(!empty($this->input->post('item_photo'))) {
							$values = array(
								'menuItem' => $room_id,
								'url' => base_url().$config['upload_path'].$data['upload_data']['file_name'],
								'public' => 0,
								'location' => $location_id,
								'filename' => $config['upload_path'].$data['upload_data']['file_name']
							);
						} else {
							$values = array(
								'url' => base_url().$config['upload_path'].$data['upload_data']['file_name'],
								'public' => 0,
								'location' => $location_id,
								'filename' => $config['upload_path'].$data['upload_data']['file_name']
							);
						}
			
						$this->PhotoModel->upload($values);
						
						$message = 'Pilt laeti edukalt üles';
						$this->session->set_flashdata('success', $message);
					
					} else {
						
					}
					$message = 'Ühtegi muutust ei toimunud';
					$this->session->set_flashdata('error', $message);
					
					redirect('Management/displayRoom/'.$location_id.'/'.$room_id);
				
			} else {
				
				$values = array (
					'name' => $room_name,
					'price' => $room_price,
					'category' => $room_category,
					'location' => $location_id,
					'description' => $room_description	
				);
				
				$this->MenuModel->updateMenuItem($room_id, $values);
				
				$message = '<b>'.$room_name.'</b> edukalt muudetud';
				$this->session->set_flashdata('success', $message);
			
				redirect('Management/displayRoom/'.$location_id.'/'.$room_id, 'refresh');

			}
			
		}
		else {
			
			$room_name = $this->input->post('room_name');
			$room_price = $this->input->post('room_price');
			$room_description = $this->input->post('room_description');
			$room_category = $this->input->post('selected_room_category');
		
			$values = array (
				'name' => $room_name,
				'price' => $room_price,
				'category' => $room_category,
				'location' => $location_id,
				'description' => $room_description	
			);
		
			$room_id = $this->MenuModel->insertRoom($values);
				
	        $config['upload_path']          = 'uploads/';
	        $config['allowed_types']        = 'gif|jpg|png|tiff|tif';
	        $config['max_size']             = 100000;
	        $config['max_width']            = 102400;
	        $config['max_height']           = 76800;

	        $this->load->library('upload', $config);
		
			if( $this->upload->do_upload('userfile')) {

				$data = array('upload_data' => $this->upload->data());
				
				if(!empty($this->input->post('item_photo'))) {
					$values = array(
						'menuItem' => $room_id[0]->last_id,
						'url' => base_url().$config['upload_path'].$data['upload_data']['file_name'],
						'public' => 0,
						'location' => $location_id,
						'filename' => $config['upload_path'].$data['upload_data']['file_name']
					);
				} else {
					$values = array(
						'url' => base_url().$config['upload_path'].$data['upload_data']['file_name'],
						'public' => 0,
						'location' => $location_id,
						'filename' => $config['upload_path'].$data['upload_data']['file_name']
					);
				}
			
				$this->PhotoModel->upload($values);
		
				$message = '<b>'.$room_name.'</b> edukalt loodud';
				$this->session->set_flashdata('success', $message);
			
				redirect('Management/displayAllRooms/'.$location_id, 'refresh');
			
			}
			else {
				$this->session->set_flashdata('error', $this->upload->display_errors());
				redirect('Management/displayAllRooms/'.$location_id);
			}
			
		}
		
	}
	
	public function updateMenuItem($location_id) {
		
		$menuItem_id = $this->input->post('menuItem_id');
		$menuItem_category = $this->input->post('selected_category');
		$menuItem_name = $this->input->post('menuItem_name');
		$menuItem_price = $this->input->post('menuItem_price');
		
		$values = array(
			'name' => $menuItem_name,
			'price' => $menuItem_price,
			'category' => $menuItem_category
		);
			
		$this->MenuModel->updateMenuItem($menuItem_id, $values);
		
		$message = '<b>'.$menuItem_name.'</b> edukalt muudetud.';
		
		$this->session->set_flashdata('success', $message);
		
		redirect('Management/displayMenuItems/'.$location_id);
	}
	
	public function updateCategory($location_id) {
		
		$category_id = $this->input->post('category_id');
		$general_category = $this->input->post('selected_general_category');
		$category_name = $this->input->post('category_name');
		
		$values = array(
			'name' => $category_name,
			'location' => $location_id,
			'general' => $general_category
		);
		
		$this->MenuModel->updateCategory($category_id, $values);
		
		$message = '<b>'.$category_name.'</b> edukalt muudetud.';
		$this->session->set_flashdata('success', $message);
		
		redirect('Management/displayCategories/'.$location_id);
		
	}
	
	public function updateRoom($location_id) {
		
	}
	
	public function deleteMenuItem($location_id) {
		
		$menuItem_id = $this->input->post('menuItem_id');
		$menuItem_name = $this->input->post('menuItem_name');
		
		$this->MenuModel->deleteMenuItem($menuItem_id);
		
		$message = '<b>'.$menuItem_name.'</b> edukalt kustutatud.';
		
		$this->session->set_flashdata('success', $message);
		
		redirect('Management/displayMenuItems/'.$location_id);
	}
	
	
	public function deleteCategory($location_id) {
		
		$category_id = $this->input->post('category_id');
		$category_name = $this->input->post('category_name');
		
		$this->MenuModel->deleteCategory($category_id);
		
		$message = '<b>'.$category_name.'</b> edukalt kustutatud.';
		
		$this->session->set_flashdata('success', $message);
		
		redirect('Management/displayCategories/'.$location_id);
	}
	
	public function deleteRoom($location_id) {
		
	}
	
	public function deletePhoto($location_id, $uri) {
		
		$photo_id = $this->input->post('selected_photo');
		$filename = $this->input->post('filename');
		
		$this->PhotoModel->deletePhoto($photo_id, $filename);
		
		$message = 'Pilt edukalt kustutatud';
		$this->session->set_flashdata('success', $message);
		
		//redirect('Management/displayMenuItems/'.$location_id);
		redirect($uri);
		
		//redirect('Management/displayGalleryUpload/'.$location_id, 'refresh');
	}
	
	public function buttonSelector($location_id, $uri) {
		
		if ( $this->input->post('action') == 'update_menu_item' ) {
			
			$this->updateMenuitem($location_id);
			
		} else if( $this->input->post('action') == 'delete_menu_item' ) {
			
			$this->deleteMenuItem($location_id);
			
		} else if( $this->input->post('action') == 'update_category' ) {
			
			$this->updateCategory($location_id);
			
		} else if( $this->input->post('action') == 'delete_category' ) {
			
			$this->deleteCategory($location_id);
		} else if( $this->input->post('action') == 'delete_photo' ) {
			
			$this->deletePhoto($location_id, $uri);
			
		} else if ( $this->input->post('action') == 'delete_room' ) { 
			
			$this->deleteMenuitem($location_id);
			
		} else { }
	}
	
}


?>