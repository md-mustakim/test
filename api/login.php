<?php
    require "vendor/autoload.php";
    use \Firebase\JWT\JWT;

    header("Access-Control-Allow-Origin: *");
    header("Access-Control-Allow-Method: POST");
    header("Content-Type: application/json; charset: UTF-8");
    header("Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Method,Access-Control-Allow-Origin");

    if($_SERVER['REQUEST_METHOD'] === 'POST')
    {
        $got_data = json_decode(file_get_contents("php://input"));
        if(!empty($got_data->user) && !empty($got_data->pass))
        {
            require "../model/user.php";
            $con = new config();
            $user = new user($con->dbconnect());
            $user->user = $got_data->user;
            $user->pass = $got_data->pass;

            if($user->login_api() != false)
            {
                $ldata = $user->login_api();
                $iss = "localhost";
                $iat = time();
                $nbf = $iat + 10;
                $exp = $iat + (60*60);
                $aud = "myusers";
                
                $datas = array(
                    'id' => $ldata['id'],
                    'phone' => $ldata['number'],
                    'pass' => $ldata['pass'],

                );
                $payload = array(
                    'iss' => $iss,
                    'iat' => $iat,
                    'nbf' => $nbf,
                    'exp' => $exp,
                    'aud' => $aud,
                    'data' => $datas
                );


                $jwt = JWT::encode($payload,$user->connect_id);




                http_response_code(200);
                echo json_encode(array(
                    'status' => 1,
                    'code' => $jwt,
                    'message' => 'Login Success'
                ));
            }else
            {
                http_response_code(404);
                echo json_encode(array(
                    'status' => 0,
                    'message' => 'Invalid Login Information'
                ));
            }









        }
        else
        {
            http_response_code(500);
            echo json_encode(array(
                'status' => 0,
                'message' => 'All data needed'
            ));
        }

    }
    else
    {
        http_response_code(503);
        echo json_encode(array(
            'status' => 0,
            'message' => 'Access Denied'
        ));

    }
	//cs_fa6bd15af9d12eec944218cabf5f3d744403d907
	//ck_fb21f2f1fea856da69e50a35fd72d4182155f407
	
	//ck_ba464d6da834a68f20495d634181ee4a00536480
	//cs_8b8d32ec1af776c370ae25f0240671f86aff1953

	
	



