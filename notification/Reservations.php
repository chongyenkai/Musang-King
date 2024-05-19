<?php
class Reservations extends CI_Controller {
    public function index() {
        $this->load->model('Reservation_model');
        $data['reservations'] = $this->Reservation_model->get_reservations();
        $this->load->view('reservations/index', $data);
    }
}
