<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login_m extends CI_Model{
    function __construct(){
        parent::__construct();
        $this->load->database();
        $this->load->library('session');
    }

    function validate_user($email, $password){
        $sql = "SELECT * FROM `users` WHERE `email` = ? LIMIT 1";
        $query = $this->db->query($sql, array($email));

        if($query->num_rows() == 1){
            $user = $query->row();

            //check if the password match
            if ($user->password == $password) {
                return $user;
            } else {
                return false;
            }
        }
        else{
            return false;
        }
    }

    function create_session($user) {
        $session_data = array(
            'id' => $user->id,
            'name' => $user->name,
            'email' => $user->email,
            'role' => $user->role,
            'logged_in' => TRUE
        );
        $this->session->set_userdata($session_data);
    }

    function is_login() {
		return $this->session->userdata('login_status') === true;
	}
}