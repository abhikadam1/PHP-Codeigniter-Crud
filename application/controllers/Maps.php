<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Maps extends CI_Controller {
    public function index() {
        $this->config->load('google_maps');
        $data['apiKey'] = $this->config->item('google_maps_api_key');

        // Pass coordinates (Example: Mumbai)
        $data['latitude'] = '19.0760';
        $data['longitude'] = '72.8777';

        $this->load->view('maps_view_new', $data);
    }
}
