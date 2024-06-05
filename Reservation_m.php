<?php
defined ('BASEPATH') OR exit ('No directscript access allowed');

class Reservation_m extends CI_Model{
    function __construct() {
		  parent::__construct();
    }

    function get_reservation_by_id($reservation_id) {
        $sql = "SELECT * FROM `reservations` WHERE `id` = ?";
        $query = $this->db->query($sql, array($reservation_id));

        return $query->row_array();
    }

    //create new reservation
    function create_reservation($data) {
        $sql = "INSERT INTO `reservations` (`table_id`, `user_id`, `name`, `email`, `phone`, `date`, `table_no`, `time`, `package`, `status`) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $this->db->query($sql, array($data['table_id'], $data['user_id'], $data['name'], $data['email'], $data['phone'], $data['date'], $data['table_no'], $data['time'], $data['package'], $data['status']));
     
        return $this->db->insert_id();
    }

    //get the user booking history
    function get_booking_history($user_id) {
        $sql = "SELECT `id`, `table_id`, `name`, `email`, `phone`, `date`, `table_no`, `time`, `package`, `status`, `active` FROM `reservations` WHERE `user_id` = ? AND `active` = 'active'";
        $query = $this->db->query($sql, array($user_id));

        if($query) {
            return $query->result_array();
        } else {
            return array();
        }
    }

    //get booking id
    function get_id($id) {
        $sql = "SELECT * FROM `reservations` WHERE id = ?";
        $query = $this->db->query($sql, array($id));

        return $query->row_array();
    }

    //edit the booking
    function update_booking($id, $data) {
        $sql = "UPDATE `reservations` SET `time` = ?, `package` = ?, `table_no` = ? WHERE id = ?";
        $params = [$data['time'], $data['package'], $data['table_no'], $id];

        return  $this->db->query($sql, $params);
    }

    //delete the booking
    function delete_booking($id) {
        $sql = "UPDATE `reservations` SET `status` = 'cancelled' WHERE `id` = ?";
        $this->db->query($sql, array($id));

        if ($this->db->affected_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }

    // get reservation 
    function get_reservations_by_week($start_date, $end_date, $user_id) {
        $sql = "SELECT * FROM `reservations` WHERE `user_id` = ? AND `date` >= ? AND `date` <= ? AND `status` NOT IN('cancelled') AND `active` NOT IN ('inactive')";
        $query = $this->db->query($sql, array($user_id, $start_date, $end_date));
        
        return $query->result();
    }
}
?>