<?php


use Firebase\JWT\JWT;
use Firebase\JWT\Key;

defined('BASEPATH') or exit('No direct script access allowed');

if (!defined('JWT_SECRET_KEY')) {
    define('JWT_SECRET_KEY', 'secrete_key');
}

/**
 * Generate JWT Token
 */
function generate_jwt($data)
{
    $issuedAt = time();
    $expireAt = $issuedAt + 3600; // Token valid for 1 hour

    $payload = [
        'iat' => $issuedAt,
        'exp' => $expireAt,
        'data' => $data
    ];

    return JWT::encode($payload, JWT_SECRET_KEY, 'HS256');
}

/**
 * Decode JWT Token
 */
function decode_jwt($token)
{
    try {
        // return JWT::decode($token, [JWT_SECRET_KEY], ['HS256']);
        return JWT::decode($token, JWT_SECRET_KEY, ['HS256']);
    } catch (Exception $e) {
        return false; // Invalid token
    }
}   

/**
 * Get JWT from Request Headers
 */
function get_jwt_from_request()
{
    $headers = getallheaders();
    if (!empty($headers['Authorization'])) {
        return trim(str_replace('Bearer', '', $headers['Authorization']));
    }
    return null;
}


// require_once APPPATH . 'libraries/JWT.php';
// use \Firebase\JWT\JWT;

// // Generate JWT Token
// function generate_jwt($data) {
//     $CI =& get_instance();
//     $key = $CI->config->item('jwt_key');
//     $iat = time(); // Issued at time
//     $exp = $iat + $CI->config->item('jwt_expiration'); // Expiration time

//     $payload = array(
//         'iss' => base_url(), // Issuer
//         'iat' => $iat,       // Issued at
//         'exp' => $exp,       // Expiration time
//         'data' => $data      // User data
//     );

//     return JWT::encode($payload, $key, $CI->config->item('jwt_algorithm'));
// }

// Decode and Verify JWT Token
function validate_jwt($token) {
    $CI =& get_instance();
    $key = $CI->config->item('jwt_key');
    // $algorithm = $CI->config->item('jwt_algorithm');
    // pr([$key, $algorithm]);
    try {
        return JWT::decode($token, $key, array($CI->config->item('jwt_algorithm')));
    } catch (Exception $e) {
        return false; // Invalid token
    }
}
