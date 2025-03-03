<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ApiController extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    public function profile() {
        $token = get_jwt_from_request();
        
        if (!$token) {
            return $this->output->set_content_type('application/json')->set_output(json_encode(['status' => 'error', 'message' => 'Token missing.']));
        }

        $decoded = decode_jwt($token);
        
        if (!$decoded) {
            return $this->output->set_content_type('application/json')->set_output(json_encode(['status' => 'error', 'message' => 'Invalid token.']));
        }

        $user = $this->db->get_where('users', ['id' => $decoded->data->user_id])->row_array();

        return $this->output->set_content_type('application/json')->set_output(json_encode([
            'status' => 'success',
            'user'   => $user
        ]));
    }
}
