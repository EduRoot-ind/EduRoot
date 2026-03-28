<?php
define('BASEPATH', true);

$pub_key = 'ss@pubkey';
$pvt_key = 'ss@pvtkey';
$encrypt_method = "AES-256-CBC";
$key = hash('sha256', $pvt_key);
$iv = substr(hash('sha256', $pub_key), 0, 16);

function dycrypt($string, $key, $iv, $method) {
    return openssl_decrypt(base64_decode($string), $method, $key, 0, $iv);
}

$constants = [
    'DEBUG_SYSTEM'              => 'OE9QNUF1V2pZb21Ta0wwaXJXYkZmS085dDQzbTlXWWRXREtKUGIyQXA2WGlhYXpuL0RTNG42Ui95bk55NW9ENw==',
    'DEBUG_SYSTEM_UPDATE'       => 'OE9QNUF1V2pZb21Ta0wwaXJXYkZmS085dDQzbTlXWWRXREtKUGIyQXA2VyswT0xsZjgwaC94UWMvRkhWRXFBYg==',
    'DEBUG_SYSTEM_CHECK_UPDATE' => 'OE9QNUF1V2pZb21Ta0wwaXJXYkZmS085dDQzbTlXWWRXREtKUGIyQXA2WG9wUERjMWxDUmlQWWhtU3BZOXN5Mw==',
    'DEBUG_SYSTEM_AUTO_UPDATE'  => 'OE9QNUF1V2pZb21Ta0wwaXJXYkZmS085dDQzbTlXWWRXREtKUGIyQXA2VnJpdCtHQ3dhZE16YVRnNXd2MjdYRg==',
    'DEBUG_SYSTEM_APP'          => 'OE9QNUF1V2pZb21Ta0wwaXJXYkZmSFZWeFNCK0dpbGVxbHg5a0I3cGZiazRtVE4xTmI0akxzVXk2QzREQkx6Uw==',
    'DEBUG_SYSTEM_APP_REG'      => 'OE9QNUF1V2pZb21Ta0wwaXJXYkZmSFZWeFNCK0dpbGVxbHg5a0I3cGZibHgrQVpsN2dMMWJQc0V5K3ZMVlZEdnhNRVdYOGhacVJmVEVOODhWZ01vc3c9PQ==',
    'DEBUG_SYSTEM_ADDON'        => 'OE9QNUF1V2pZb21Ta0wwaXJXYkZmSDdjNGFmS1U2ZDFLVHFkeDFKcW1xY2Q4ZHRPWDBwRlY5a0RzVlVRY1Z6Lw==',
    'DEBUG_SYSTEM_MBANCH'       => 'OE9QNUF1V2pZb21Ta0wwaXJXYkZmTWtmYzYxdFM3TDZKRkJDTm9OTmVLcVY2ZVUxVGlkckIwVlJGcCtPT2M0aQ==',
    'DEBUG_SYSTEM_ADD_CK'       => 'OE9QNUF1V2pZb21Ta0wwaXJXYkZmTUl0ZWxvZkFseEZTbGtnaXVuaVp0R3p1K0V1M0VoMkJJVTlnUjFBYTRhbQ==',
];

foreach ($constants as $name => $value) {
    $decrypted = dycrypt($value, $key, $iv, $encrypt_method);
    echo "<b>$name</b> => $decrypted<br><br>";
}
?>