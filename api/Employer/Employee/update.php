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
    include_once '../../../models/Employee.php';

    
    
    $database = new Database();
    $db = $database->connect();

    // Instantiate POSt

    $employee = new Employee($db);

    $data = json_decode(file_get_contents("php://input"));

    $employee->e_id = $data->e_id;

    // $job->job_title = $data->job_title;
    // $job->job_desc = $data->job_desc;
    $employee->firstName = $data->firstName;
    $employee->lastName = $data->lastName;
    $employee->postion = $data->postion;
    $employee->address = $data->address;
    $employee->email = $data->email;


    if($job->update()) {
        
        echo json_encode(
            array('message' => 'Post updated.')
        );
    }else {
        echo json_encode(
            array('message' => 'Post not updated.')
        );
    }



