<?php

    require "vendor/autoload.php";
    use \Firebase\JWT\JWT;
     $token= apache_request_headers()['Authorization'];
    $key= "mysecret123";


    try {
        $ss= JWT::decode($token,$key,array('HS256'));
        print_r($ss);
    }catch (Exception $ex){
        print_r($ex->getMessage());
    }


    //var_dump(apache_request_headers());
//    var_dump(apache_request_headers()['Authorization']);





