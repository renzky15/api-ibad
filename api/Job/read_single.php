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


    include_once '../../config/Database.php';
    include_once '../../models/Job.php';

    
    
    $database = new Database();
    $db = $database->connect();

    // Instantiate POSt

    $job = new Job($db);
    
    $job->job_id = isset($_GET['job_id']) ? $_GET['job_id'] : die();

    // Get single post

    $job->read_single();

    $post_arr = array(
        'job_id' => $job->job_id,
        'job_title' => $job->job_title,
        'job_desc' => $job->job_desc,
        'job_role' => $job->job_role,
        'email' => $job->email,
        'date_created' => $job->date_created,
    );

    print_r(json_encode($post_arr));
