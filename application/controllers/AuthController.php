<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class AuthController extends CI_Controller {

    public function __construct() {
        parent::__construct();
        // $this->load->database();
        $this->load->model('Assignment/User_model');
    }

    public function login() {
        // $email = $this->input->post('email');
        // $password = $this->input->post('password');

        $json = file_get_contents("php://input");
        $data = json_decode($json, true);
        
        $email = $data['email'];
        $password = $data['password'];
       
        if (empty($email) || empty($password)) {
            return $this->output->set_content_type('application/json')->set_output(json_encode(['status' => 'error', 'message' => 'Email and password are required.']));
        }

        // Fetch user from DB
        $user = $this->db->get_where('users', ['email' => $email])->row_array();
        if (!$user || !password_verify($password, $user['password'])) {
            return $this->output->set_content_type('application/json')->set_status_header(401)->set_output(json_encode(['status' => 'error', 'message' => 'Invalid credentials.']));
        }

        // Generate JWT Token
        $token = generate_jwt([
            'user_id' => $user['id'],
            'email'   => $user['email']
        ]);

        return $this->output->set_content_type('application/json')->set_output(json_encode([
            'status' => 'success',
            'token'  => $token
        ]));
    }

    // Login and Generate JWT Token
    public function login1() {
        $json = file_get_contents("php://input");
        $data = json_decode($json, true);
        
        $email = $data['email'];
        $password = $data['password'];
        echo "<pre>"; 
        print_r($email);
        die();
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


    public function register() {
        $postData = json_decode(file_get_contents('php://input'), true);

        // Validate input
        if (empty($postData['email']) || empty($postData['password']) || empty($postData['name'])) {
            return $this->output->set_content_type('application/json')->set_output(json_encode([
                'status' => 'error',
                'message' => 'Name, Email, and Password are required.'
            ]));
        }

        $name = $postData['name'];
        $email = $postData['email'];
        $password = password_hash($postData['password'], PASSWORD_BCRYPT);
        // pr($password);
        // Check if user already exists
        $existingUser = $this->db->get_where('users', ['email' => $email])->row_array();
        if ($existingUser) {
            return $this->output->set_content_type('application/json')->set_output(json_encode([
                'status' => 'error',
                'message' => 'User already exists.'
            ]));
        }

        // Insert new user
        $this->db->insert('users', [
            'name' => $name,
            'email' => $email,
            'password' => $password
        ]);

        $userId = $this->db->insert_id();

        // Generate JWT Token
        $token = generate_jwt(['user_id' => $userId, 'email' => $email]);

        return $this->output->set_content_type('application/json')->set_output(json_encode([
            'status' => 'success',
            'message' => 'User registered successfully.',
            'token' => $token
        ]));
    }

    /**
     * Get User Profile (Protected)
     */
    public function profile1() {
        $token = get_jwt_from_request();
        // pr($token);
        if (!$token) {
            return $this->output->set_content_type('application/json')->set_output(json_encode([
                'status' => 'error',
                'message' => 'Token missing.'
            ]));
        }

        $decoded = decode_jwt($token);
        // pr($decoded);
        if (!$decoded) {
            return $this->output->set_content_type('application/json')->set_output(json_encode([
                'status' => 'error',
                'message' => 'Invalid token.'
            ]));
        }

        $user = $this->db->get_where('users', ['id' => $decoded->data->user_id])->row_array();

        return $this->output->set_content_type('application/json')->set_output(json_encode([
            'status' => 'success',
            'user' => $user
        ]));
    }

    // Protected Route (JWT Validation)
    public function profile() {
        $headers = $this->input->get_request_header('Authorization');
        if (!$headers) {
            // show_error('Unauthorized', 401);
            return $this->output->set_content_type('application/json')->set_status_header(401)->set_output(json_encode(['status' => 'error', 'message' => 'Unauthorized']));
        }

        $token = str_replace('Bearer ', '', $headers);
        $decoded = validate_jwt($token);

        if (!$decoded) {
            // show_error('Unauthorized', 401);
            return $this->output->set_content_type('application/json')->set_status_header(401)->set_output(json_encode(['status' => 'error', 'message' => 'Unauthorized']));
       
        }
        // pr($decoded);

        $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode(['user' => $decoded->data]));
    }
}
