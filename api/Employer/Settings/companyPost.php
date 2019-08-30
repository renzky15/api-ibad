<?php
    if (isset($_SERVER['HTTP_ORIGIN'])) {
        // Decide if the origin in $_SERVER['HTTP_ORIGIN'] is one
        // you want to allow, and if so:
        header('Access-Control-Allow-Origin: *');
        header('Access-Control-Allow-Credentials: true');
        header('Access-Control-Max-Age: 1000');
    }
    if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
        if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_METHOD'])) {
            // may also be using PUT, PATCH, HEAD etc
            header("Access-Control-Allow-Methods: POST, GET, OPTIONS, PUT, DELETE");
        }
    
        if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS'])) {
            header("Access-Control-Allow-Headers: Accept, Content-Type, Content-Length, Accept-Encoding, X-CSRF-Token, Authorization");
        }
        exit(0);
    }


    include_once '../../../config/Database.php';
    include_once '../../../models/Settings.php';

    
    
    $database = new Database();
    $db = $database->connect();

    // Instantiate POSt

    $settings = new Settings($db);

    $data = json_decode(file_get_contents("php://input"));

    $settings->company_name = $data->company_name;
    $settings->business_num = $data->business_num;
    $settings->mission = $data->mission;
    $settings->vision = $data->vision;
    $settings->address = $data->address;

    if($settings->insert()) {
        
        echo json_encode(
            array('message' => 'Post created.')
        );
    }else {
        echo json_encode(
            array('message' => 'Post not created.')
        );
    }



