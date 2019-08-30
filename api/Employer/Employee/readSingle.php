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
    
    $employee->e_id = isset($_GET['e_id']) ? $_GET['e_id'] : die();

    // Get single post

    $employee->read_single();
    $posts_arr = array();
    $posts_arr['response_array'] = array();

    $post_item = array(
        'e_id' => $employee->e_id,
        'firstName' => $employee->firstName,
        'lastName' => $employee->lastName,
        'position' => $employee->position,
        'email' => $employee->email,
        'address' => $employee->address,
    );
    array_push($posts_arr['response_array'], $post_item);
    echo json_encode($posts_arr);
