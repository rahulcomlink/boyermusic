<?php


function getUrlAsset(){
    $url = "../public";
    return $url;
}


function getBaseUrl() {
    // Get the protocol
    // $protocol = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https://" : "http://";

    // // Get the host
    // $host = $_SERVER['SERVER_NAME'];

    // // Concatenate protocol and host to form the base URL
    // $base_url = $protocol . $host;


    //$base_url = "https://pratigharesushason.tripura.gov.in";
    $base_url = "..";

    return $base_url;
}

?>