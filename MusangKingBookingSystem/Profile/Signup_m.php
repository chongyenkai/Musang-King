<?php
defined('BASEPATH') OR exit ('No direct script access allowed');
class Signup_m extends CI_Model {
    function __construct() {
        parent::__construct();
    }

    function register($name, $email, $password, $confirm_password, $role) {
        if ($password !== $confirm_password) {
            return['success' => false, 'message' => 'Password does not match'];
        }

        $data = array(
            'name' => $name,
            'email' => $email,
            'password' => $password,
            'confirm_password' => $confirm_password,
            'role' => $role
        );
        // Construct the SQL query
        $sql = "INSERT INTO `signup` (`name`, `email`, `password`, `confirm_password`, `role`) VALUES ('$name', '$email', '$password', '$confirm_password', '$role')";

        // Execute the SQL query
        $query = $this->db->query($sql);

        // Check if insertion was successful
        if ($query) {
            return ['success' => true, 'message' => 'Registration successful'];
        } else {
            return ['success' => false, 'message' => 'Registration failed'];
        }
    }
}
?>