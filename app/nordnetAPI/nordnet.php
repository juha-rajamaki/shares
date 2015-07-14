<?php

// This function could be more dynamic, but it works great when you want to login
function api_call($url, $data)
{
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_POST, true);

    curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);

    $result = curl_exec($ch);
    curl_close($ch);

    return simplexml_load_string($result);
}

// Init variables
$username        = 'YOUR_USERNAME';
$password        = 'YOUR_PASSWORD';
$service        = 'NEXTAPI';
$base_url        = 'api.test.nordnet.se/next';
$api_version    = '1';

// Documentation: https://api.test.nordnet.se/projects/api/wiki/REST_API_documentation#Login

// Step 1: First Base64-encode the username, password and timestamp (UNIX timestamp in milliseconds) and combine them with the character ‘:’.
$login_string = base64_encode($username) . ':' . base64_encode($password) . ':' . base64_encode(microtime());

// Step 2: Use the public key for the application and encrypt the string.

// Loads the public key - available at: https://api.test.nordnet.se/projects/api/files | Note (use the .pem file)
$public_key = openssl_get_publickey(file_get_contents('publickey.pem'));
// This part encrypts our login string with the public key and return the encrypted string to the $login variable
$rsa_encrypt = openssl_public_encrypt($login_string, $login, $public_key);

// Step 3: Base64 encode the encrypted string.
$auth = base64_encode($login);

// Now we wrap up our fields in array
$fields = array(
    'auth'    => $auth,
    'service' => $service
);

// We then build a URL-encoded query string
$post_data = http_build_query($fields);

// Finally we post our login to https://BASE_URL/API_VERSION/login
$login_result = api_call('https://'.$base_url.'/'.$api_version.'/login', $post_data);

// This prints out our result
print_r($login_result);

