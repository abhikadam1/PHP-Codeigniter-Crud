<?php
require_once APPPATH . 'libraries/JWT.php';
use \Firebase\JWT\JWT;

// Generate JWT Token
function generate_jwt($data) {
    $CI =& get_instance();
    $key = $CI->config->item('jwt_key');
    $iat = time(); // Issued at time
    $exp = $iat + $CI->config->item('jwt_expiration'); // Expiration time
    
    $payload = array(
        'iss' => base_url(), // Issuer
        'iat' => $iat,       // Issued at
        'exp' => $exp,       // Expiration time
        'data' => $data      // User data
    );

    return JWT::encode($payload, $key, $CI->config->item('jwt_algorithm'));
}

// Decode and Verify JWT Token
function validate_jwt($token) {
    $CI =& get_instance();
    $key = $CI->config->item('jwt_key');
    try {
        return JWT::decode($token, $key, array($CI->config->item('jwt_algorithm')));
    } catch (Exception $e) {
        return false; // Invalid token
    }
}
