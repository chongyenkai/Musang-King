<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller{
    function __construct() {
		parent::__construct();
        $this->load->model('swe/Login_m');
        $this->load->library('form_validation');
        $this->load->library('session');
    }
    
    function index() {
        if ($this->input->post()) {
            $email = $this->input->post('email');
            $password = $this->input->post('password');

            // Validate the user
            $this->form_validation->set_rules('email', 'Email', 'required|valid_email');
            $this->form_validation->set_rules('password', 'Password', 'required');

            if ($this->form_validation->run() == FALSE) {
                // Set validation errors to flashdata
                $this->session->set_flashdata('error', validation_errors());
                $this->load->view('swe/login_v');
            } else {
                $user = $this->Login_m->validate_user($email, $password);

                if ($user) {
                    // Create a session for the user
                    $this->Login_m->create_session($user);

                    // Redirect based on user role
                    if ($user->role == 'admin') {
                        redirect('swe/admin');
                    } else {
                        redirect('swe/reservation');
                    }
                } else {
                    $this->session->set_flashdata('error', 'Invalid email or password');
                    redirect('swe/login/index');
                }
            }
        } else {
            $this->load->view('swe/login_v');
        }
    }

    // Signup function
    function signup() {
        if ($this->input->post()) {
            $name = $this->input->post('name');
            $email = $this->input->post('email');
            $password = $this->input->post('password');
            $confirm_password = $this->input->post('confirm_password');
            $ic_no = $this->input->post('ic');
            $phone_no = $this->input->post('phone');

            // Set validation rules for all fields
            $this->form_validation->set_rules('name', 'Full Name', 'required');
            $this->form_validation->set_rules('email', 'Email', 'required|valid_email');
            $this->form_validation->set_rules('ic', 'IC Number', 'required');
            $this->form_validation->set_rules('phone', 'Phone Number', 'required');
            $this->form_validation->set_rules('password', 'Password', 'required|min_length[6]');
            $this->form_validation->set_rules('confirm_password', 'Confirm Password', 'required|matches[password]');

            // Validate the form data
            if ($this->form_validation->run() == FALSE) {
                // Set validation errors to flashdata
                $this->session->set_flashdata('error', validation_errors());
                $this->load->view('swe/signup_v');
            } else {
                $duplicate_errors = array();

                // Form validation passed, check for duplicate values
                if ($this->Signup_m->check_duplicate('email', $email)) {
                    $duplicate_errors[] = 'Email already existed!';
                }
                if ($this->Signup_m->check_duplicate('ic_no', $ic_no)) {
                    $duplicate_errors[] = 'IC number already existed!';
                }
                if ($this->Signup_m->check_duplicate('phone_no', $phone_no)) {
                    $duplicate_errors[] = 'Phone number already existed!';
                }
                if ($this->Signup_m->check_duplicate('password', $password)) {
                    $duplicate_errors[] = 'Password already existed!';
                }

                // if there are duplicate errors, set the error message
                if (!empty($duplicate_errors)) {
                    $this->session->set_flashdata('error', implode('<br>', $duplicate_errors));
                    $this->load->view('swe/signup_v', compact('name', 'email', 'ic_no', 'phone_no'));
                } else {
                    // Register user if no duplicates are found
                    $registration_result = $this->Signup_m->register($name, $email, $ic_no, $phone_no, $password, $confirm_password);
                    
                    if ($registration_result == true) {
                        $this->session->set_flashdata('success', 'Signup successful');
                        redirect('swe/login/index');
                    } else {
                        $this->session->set_flashdata('error', 'There was a problem with your registration');
                        redirect('swe/login/signup');
                    }
                }
            }
        } else {
            $this->load->view('swe/signup_v');
        }
    }
    
    // Logout
    function logout() {
        $sess_data = array('id', 'name', 'email', 'ic_no', 'phone_no', 'login_status');
        $this->session->unset_userdata($sess_data);
        $this->session->sess_destroy();

        redirect('swe/login');
    }
}
?>
