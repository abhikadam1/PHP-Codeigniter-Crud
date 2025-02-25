<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('User_model');
    }

    // Login and Generate JWT Token
    public function login() {
        $json = file_get_contents("php://input");
        $data = json_decode($json, true);
        
        $email = $data['email'];
        $password = $data['password'];

        $user = $this->User_model->get_user_by_email($email);

        if ($user && password_verify($password, $user->password)) {
            $token = generate_jwt([
                'user_id' => $user->id,
                'email' => $user->email
            ]);

            $this->output
                ->set_content_type('application/json')
                ->set_output(json_encode(['token' => $token]));
        } else {
            $this->output
                ->set_content_type('application/json')
                ->set_status_header(401)
                ->set_output(json_encode(['message' => 'Invalid credentials']));
        }
    }

    // Protected Route (JWT Validation)
    public function profile() {
        $headers = $this->input->get_request_header('Authorization');
        
        if (!$headers) {
            show_error('Unauthorized', 401);
        }

        $token = str_replace('Bearer ', '', $headers);
        $decoded = validate_jwt($token);

        if (!$decoded) {
            show_error('Unauthorized', 401);
        }

        $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode(['user' => $decoded->data]));
    }
}
