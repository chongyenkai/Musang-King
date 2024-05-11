<?php
defined ('BASEPATH') OR exit ('No directscript access allowed');

class Reservation extends CI_Controller{
    function __construct() {
		parent::__construct();
		$this->load->database();
		$this->load->model('');
    }

    function index() {
        $this->load->view('swe/reservation_page_v');
    }
}
?>