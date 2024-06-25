<?php
require 'db.data.php';

function login($email, $password) {
    $user = get_user_by_email($email);
    
    if ($user && password_verify($password, $user['password'])) {
        return generateJwt($user['id']);
    } else {
        return false;
    }
}

function sign_up(string $name, string $email, string $password) {
    create_user($name, $email, $password);
    $user = get_user_by_email($email);
    return generateJwt($user['id']);
}

function generateJwt($user_id) {
    $key = "khreedlay_secret_key"; // Replace with your secret key
    $header = json_encode(['typ' => 'JWT', 'alg' => 'HS256']);
    $payload = json_encode([
        'iat' => time(), // Issued at
        'exp' => time() + (60 * 60 * 24), // Expiration time (24 hour)
        'data' => [
            'user_id' => $user_id
        ]
    ]);

    $base64UrlHeader = base64UrlEncode($header);
    $base64UrlPayload = base64UrlEncode($payload);
    $signature = hash_hmac('sha256', $base64UrlHeader . "." . $base64UrlPayload, $key, true);
    $base64UrlSignature = base64UrlEncode($signature);

    $jwt = $base64UrlHeader . "." . $base64UrlPayload . "." . $base64UrlSignature;
    return $jwt;
}

function check_authentication($jwt) {
    $key = "khreedlay_secret_key";
    list($headerEncoded, $payloadEncoded, $signatureEncoded) = explode('.', $jwt);

    $header = json_decode(base64UrlDecode($headerEncoded), true);
    $payload = json_decode(base64UrlDecode($payloadEncoded), true);
    $signature = base64UrlDecode($signatureEncoded);

    $valid = hash_hmac('sha256', $headerEncoded . "." . $payloadEncoded, $key, true);
    if (hash_equals($signature, $valid) && $payload['exp'] > time()) {
        return $payload['data'];
    } else {
        return false;
    }
}

function check_authorization(string $jwt, array $in_role_ids) {
    $user_data = check_authentication($jwt);
    if ($user_data) {
        $user_id = $user_data['user_id'];
        $user = get_user_by_id($user_id);
        return in_array($user['role_id'], $in_role_ids);
    } else {
        return false;
    }
}

function is_authenticated() {
    if (isset($_COOKIE['jwt'])) {
        $user_data = check_authentication($_COOKIE['jwt']);
        if ($user_data) {
            return $user_data;
        }
    }
    return false;
    // header('HTTP/1.1 401 Unauthorized');
    // exit(json_encode(['error' => 'Unauthorized']));
}

function is_authorized(array $in_role_ids) {
    if (isset($_COOKIE['jwt'])) {
        if (check_authorization($_COOKIE['jwt'], $in_role_ids)) {
            return true;
        }
    }
    return false;
    // header('HTTP/1.1 403 Forbidden');
    // exit(json_encode(['error' => 'Forbidden']));
}

function check_role() {
    //
}

function base64UrlEncode($data) {
    return rtrim(strtr(base64_encode($data), '+/', '-_'), '=');
}

function base64UrlDecode($data) {
    return base64_decode(strtr($data, '-_', '+/'));
}


?>