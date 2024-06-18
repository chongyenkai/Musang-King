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
        $this->load->library('form_validation');
        
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

    // Booking form page
    function booking() {
        // Check if the user is logged in, and make sure it is customer
        if (!$this->session->userdata('login_status') || $this->session->userdata('role') != 'customer') {
            redirect('swe/login');
        }

        $this->load->view('swe/reservation_page_v');
    }

    // Handle form submission and display the table selection page
    public function process_booking() {
        // Check if the user is logged in and is a customer
        if (!$this->session->userdata('login_status') || $this->session->userdata('role') != 'customer') {
            redirect('swe/login');
        }
    
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // If the form is submitted
            $name = $this->input->post('name');
            $email = $this->input->post('email');
            $phone = $this->input->post('phone');
            $date = $this->input->post('date');
            $time = $this->input->post('time');
            $package = $this->input->post('package');
            $num_table = $this->input->post('num_table');
    
            $data['name'] = $name;
            $data['email'] = $email;
            $data['phone'] = $phone;
            $data['date'] = $date;
            $data['time'] = $time;
            $data['package'] = $package;
            $data['num_table'] = $num_table;
    
            // Check available tables
            $available_data = array();
            for ($i = 1; $i <= 17; $i++) {
                $availability = $this->Reservation_m->check_availability($i, $date, $time);
                if ($availability == 'available') {
                    $available_data[] = $i;
                }
            }
            $data['available_data'] = $available_data;
    
            // Load the table selection view with available tables
            $this->load->view('swe/table_selection_v', $data);
        } else {
            // If the form is not submitted, load the reservation form view
            $this->load->view('swe/reservation_form_v');
        }
    }

    // Review booking
    function review_booking() {
        // Check if the user is logged in, and make sure it is customer
        if (!$this->session->userdata('login_status') || $this->session->userdata('role') != 'customer') {
            redirect('swe/login');
        }

        $tables = $this->input->post('tables');
        $name = $this->input->post('name');
        $email = $this->input->post('email');
        $phone = $this->input->post('phone');
        $package = $this->input->post('package');
        $date = $this->input->post('date');
        $time = $this->input->post('time');
        $table_no = $this->input->post('num_table');

        $data = array(
            'tables' => $tables,
            'name' => $name,
            'email' => $email,
            'phone' => $phone,
            'date' => $date,
            'package' => $package,
            'table_no' => $table_no,
            'time' => $time
        );

        $this->load->view('swe/review_reservation_v', $data);
    }

    function confirm_booking() {
        // Check if the user is logged in, and make sure it is customer
        if (!$this->session->userdata('login_status') || $this->session->userdata('role') != 'customer') {
            redirect('swe/login');
        }
    
        $user_id = $this->session->userdata('id');
        $name = $this->input->post('name');
        $email = $this->input->post('email');
        $phone = $this->input->post('phone');
        $date = $this->input->post('date');
        $package = $this->input->post('package');
        $time = $this->input->post('time');
        $table_no = $this->input->post('num_table');
        $tables = $this->input->post('tables'); // Array of selected table IDs
    
        // Ensure tables are booked as unavailable
        foreach ($tables as $table_id) {
            $table_data = array(
                'table_id' => $table_id,
                'date' => $date,
                'time' => $time,
                'status' => 'unavailable'
            );
            $this->Reservation_m->reserve_table($table_data);
        }
    
        // Convert table IDs array to a comma-separated string
        $table_id_str = implode(',', $tables);
    
        $reservation_data = array(
            'user_id' => $user_id,
            'table_id' => $table_id_str, // Use joined table IDs
            'name' => $name,
            'email' => $email,
            'phone' => $phone,
            'date' => $date,
            'time' => $time,
            'package' => $package,
            'table_no' => count($tables), // Count of tables booked
            'status' => 'booked'
        );
    
        $reservation_id = $this->Reservation_m->create_reservation($reservation_data);
    
        redirect('swe/reservation/confirmation/' . $reservation_id);
    }
    

    //confirmation page
    function confirmation($reservation_id) {
        // Check if the user is logged in, and make sure it is customer
        if (!$this->session->userdata('login_status') || $this->session->userdata('role') != 'customer') {
            redirect('swe/login');
        }

        $data['reservation'] = $this->Reservation_m->get_reservation_by_id($reservation_id);
        $this->load->view('swe/confirmation_v', $data);
    }

    //schedule page
    function schedule() {
        // Check if the user is logged in, and make sure it is customer
        if (!$this->session->userdata('login_status') || $this->session->userdata('role') != 'customer') {
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
        // Check if the user is logged in, and make sure it is customer
        if (!$this->session->userdata('login_status') || $this->session->userdata('role') != 'customer') {
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

    function feedback() {
        //retrieve the session
        $user_id = $this->session->userdata('id');

        $data = array(
            'name' => '',
            'email' => '',
            'feedback' => ''
        );

        if ($this->input->post()) {
            $this->form_validation->set_rules('name', 'Name', 'required');
            $this->form_validation->set_rules('email', 'Email', 'required|valid_email');
            $this->form_validation->set_rules('feedback', 'Feedback', 'required');

            if ($this->form_validation->run() == TRUE) {
                $data = array(
                    'name' => $this->input->post('name'),
                    'email' => $this->input->post('email'),
                    'feedback' => $this->input->post('feedback')
                );

                $feedback = $this->Reservation_m->feedback($data);

                if ($feedback) {
                    $this->session->set_flashdata('success', 'Feedback submitted successfully');
                } else {
                    $this->session->set_flashdata('failed', 'Feedback submit error');
                }

                redirect('swe/reservation/feedback');
            } else {
                $data['name'] = $this->input->post('name');
                $data['email'] = $this->input->post('email');
                $data['feedback'] = $this->input->post('feedback');
            }
        }
        $this->load->view('swe/feedback_v', $data);
    }
}
?>
