<?php
defined ('BASEPATH') OR exit ('No directscript access allowed');

class Reservation extends CI_Controller {
    function __construct() {
        parent::__construct();
        $this->load->database();
        $this->load->model('swe/Table_m');
        $this->load->model('swe/Reservation_m');
        $this->load->library('email');
        $this->load->library('session');
        
        // Configure email
        $config['protocol'] = 'smtp';
        $config['smtp_host'] = 'ssl://smtp.gmail.com'; // Use SSL
        $config['smtp_port'] = 465; // SSL port for Gmail
        $config['smtp_user'] = 'yenkaichong1333@gmail.com';
        $config['smtp_pass'] = '030907031065';
        $config['mailtype'] = 'html'; // Changed to 'html' to format message as HTML
        $config['charset'] = 'utf-8';
        $config['wordwrap'] = TRUE;
        $config['newline'] = "\r\n"; // Required for some email servers

        $this->email->initialize($config);
    }

    // Reservation home page
    function index() {
        $this->load->view('swe/home_v');
    }

    // Select table page
    function table() {
        // Check if the user is logged in
        if (!$this->session->userdata('login_status')) {
            redirect('swe/login');
        }

        $data['tables'] = $this->Table_m->get_tables();
        $this->load->view('swe/table_selection_v', $data);
    }

    // Booking form page
    function booking($table_id) {
        // Check if the user is logged in
        if (!$this->session->userdata('login_status')) {
            redirect('swe/login');
        }

        $data['table_id'] = $table_id;  // Pass table_id to the view
        $this->load->view('swe/reservation_page_v', $data);
    }

    // Review booking
    function review_booking() {
        // Check if the user is logged in
        if (!$this->session->userdata('login_status')) {
            redirect('swe/login');
        }

        $table_id = $this->input->post('table_id');
        $name = $this->input->post('name');
        $email = $this->input->post('email');
        $phone = $this->input->post('phone');
        $package = $this->input->post('package');
        $date = $this->input->post('date');
        $time = $this->input->post('time');
        $table_no = $this->input->post('num_table');

        // Combine date and time into a single string
        $booking_datetime = $date . ' ' . $time;

        $data = array(
            'table_id' => $table_id,
            'name' => $name,
            'email' => $email,
            'phone' => $phone,
            'date' => $date,
            'package' => $package,
            'table_no' => $table_no,
            'time' => $time
        );

        $data['table'] = $this->Table_m->get_tables_by_id($table_id);
        $this->load->view('swe/review_reservation_v', $data);
    }

    // Submit booking form
    function confirm_booking() {
        // Check if the user is logged in
        if (!$this->session->userdata('login_status')) {
            redirect('swe/login');
        }

        $user_id = $this->input->post('user_id');
        $table_id = $this->input->post('table_id');
        $name = $this->input->post('name');
        $email = $this->input->post('email');
        $phone = $this->input->post('phone');
        $date = $this->input->post('date');
        $package = $this->input->post('package');
        $time = $this->input->post('time');
        $table_no = $this->input->post('num_table');

        $user_id = $this->session->userdata('id');

        $data = array(
            'user_id' => $user_id,
            'table_id' => $table_id,
            'name' => $name,
            'email' => $email,
            'phone' => $phone,
            'date' => $date,
            'time' => $time,
            'package' => $package,
            'table_no' => $table_no,
            'status' => 'booked'
        );

        $reservation_id = $this->Reservation_m->create_reservation($data);
        $this->Table_m->update_status($table_id, 'unavailable');

        // Send email
        $this->send_email($email, $name, $reservation_id, $time);

        redirect('swe/reservation/confirmation/' . $reservation_id);
    }

    private function send_email($email, $name, $reservation_id, $booking_datetime) {
        $this->email->from('yenkaichong1333@gmail.com', 'Musang King Restaurant');
        $this->email->to($email); // Send to the customer's email

        $subject = 'Reservation Confirmation';
        $message = "Dear $name,<br><br>
                    Your reservation (ID: $reservation_id) has been confirmed.<br>
                    Reservation Date and Time: $booking_datetime<br><br>
                    Thank you!";

        $this->email->subject($subject);
        $this->email->message($message);

        if ($this->email->send()) {
            log_message('info', 'Confirmation email sent to ' . $email);
        } else {
            log_message('error', 'Failed to send confirmation email to ' . $email);
        }
    }

    //confirmation page
    function confirmation($reservation_id) {
        // Check if the user is logged in
        if (!$this->session->userdata('login_status')) {
            redirect('swe/login');
        }

        $data['reservation'] = $this->Reservation_m->get_reservation_by_id($reservation_id);
        $this->load->view('swe/confirmation_v', $data);
    }

    //schedule page
    function schedule() {
        // Check if the user is logged in
        if (!$this->session->userdata('login_status')) {
            redirect('swe/login');
        }

        $user_id = $this->session->userdata('id');

        // get the selected week 
        $selected_week = $this->input->get('week');

        if (!$selected_week) {
            $selected_week = date('Y-\WW');
        }

        //calculate the start and end week
        $start_date = date('Y-m-d', strtotime($selected_week . ' +0 days'));
        $end_date = date('Y-m-d', strtotime($start_date . '+6 days'));

        //get reservation for the selected week
        $data['reservations'] = $this->Reservation_m->get_reservations_by_week($start_date, $end_date, $user_id );
        $data['start_date'] = $start_date;
        $data['end_date'] = $end_date;

        $this->load->view('swe/schedule_v', $data);
    }

    //booking history page
    function booking_history() {
        // Check if the user is logged in
        if (!$this->session->userdata('login_status')) {
            redirect('swe/login');
        }

        //retrieve the session
        $user_id = $this->session->userdata('id');
        
        $booking_history = $this->Reservation_m->get_booking_history($user_id);

        // var_dump($booking_history);

        //pass booking history data to view
        $data['booking_history'] = $booking_history;
        $this->load->view('swe/booking_history_v', $data);
    }

    function edit_booking($id) {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $data = [
                'time' => $this->input->post('time'),
                'package' => $this->input->post('package'),
                'table_no' => $this->input->post('num_table')
            ];
            $result = $this->Reservation_m->update_booking($id, $data);

            if ($result) {
                redirect('swe/reservation/booking_history/');
            } else {
                echo "There are some problem to update!";
            }
        } else {
            $booking = $this->Reservation_m->get_id($id);

            if ($booking) {
                $data['booking'] = $booking;
                $this->load->view('swe/edit_booking_v', $data);
            } else {
                echo "Booking not found";
            }
        }
    }

    function delete_booking($id) {
        $result = $this->Reservation_m->delete_booking($id);

        if ($result) {
            redirect('swe/reservation/booking_history');
        } else {
            echo "Failed to delete!";
        }
    }
}
?>
