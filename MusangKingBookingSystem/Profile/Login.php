<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller{
    function __construct() {
		parent::__construct();
        $this->load->model('swe/Login_m');
        $this->load->model('swe/Signup_m');
    }

    function index() {

        if ($this->Login_m->is_login()){
            redirect('swe/reservation');
        }

        if ($this->input->post()){
            $email = $this->input->post('email');
            $password = $this->input->post('password');

            //validate the user
            $user = $this->Login_m->validate_user($email, $password);

            if ($user) {
                $this->Login_m->create_session($user);
                redirect('swe/reservation');
            } else {
                $this->load->view('swe/login');
            }
        } else {
            $this->load->view('swe/login_v');
        }
    }

    function signup() {
        if ($this->input->post()) {
            $name = $this->input->post('name');
            $email = $this->input->post('email');
            $password = $this->input->post('password');
            $confirm_password = $this->input->post('confirm_password');
            $role = $this->input->post('role');

            //validate the data
            $registration_result = $this->Signup_m->register($name, $email, $password, $confirm_password, $role);

            if ($registration_result) {
                redirect('swe/login/index');
            } else {
                $this->load->view('swe/signup_v');
            }
        } else {
            $this->load->view('swe/signup_v');
        }
    }
}
?>