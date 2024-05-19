<?php
class Reservation_model extends CI_Model {
    public function get_reservations() {
        $query = $this->db->get('reservations');
        return $query->result_array();
    }
}