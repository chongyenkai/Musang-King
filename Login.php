<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller{
    function __construct() {
		parent::__construct();
        $this->load->model('Login_m');
		
    }

    function index() {

        if($this->Login_m->is_login()){
            redirect('reservation');
        }

        if($this->input->post()){
            $name = $this->input->post('name');
            $password = $this->input->post('password');
        }

        $this->load->view('login_v');
    }

    function signup() {
        $this->load->view('signup_v');
    }
}
?>