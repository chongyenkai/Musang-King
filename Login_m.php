<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login_m extends CI_Model{
    function __construct(){
        parent::__construct();
        $this->load->database();
        $this->load->library('session');
    }

    function validate_data($name,$password){
        $error_msg = '';

        if(empty($name)){
            $error_msg = 'Name is required';
        }
        else{
            if(!preg_match('/^[a-zA-Z0-9\s]+$/', $name)){
                $error_msg = "Name can only contain alphabets and numbers.";
            }
        }

        if(empty($password)){
            $error_msg = 'Password is required';
        }

        return $error_msg;
    }
    
    function authenticate_user($name, $password){
        // $sql = "SELECT * FROM login WHERE name =". $this->db->escape($name). "AND password = ". $this->db->escape($password);

        // $query = $this->db->query($sql);

        // if($query->num_rows() > 0){
        //     return $query->row_array();
        // }
        // else{
        //     return null;
        // }

        $this->db->where('name', $name);
        $query = $this->db->get('users');
        $user = $query->row_array();

        if($user && password_verify($password, $user['password'])){
            return $user;
        }
        else{
            return null;
        }
    }
    
    function login_user($name,$password){
        $login_result = $this->validate_data($name,$password);

        if($login_result !=''){
            return array(
                'status' => false,
                'errors' => $login_result
            );
        }

        $user = $this->authenticate_user($name,$password);

        if($user){
            $this->session->set_userdata('login_status', true);
            $this->session->set_userdata('user_id',$user['id']);
            return array('status' => true);
        }
        else{
            return array(
                'status' => false,
                'errors' => 'Invalid name or password'
            );
        }
    }

    function is_login(){
        return $this->session->userdata('login_status') == true;
    }

    function register($data){
        $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);
        return $this->db->insert('users', $data);
    }
}