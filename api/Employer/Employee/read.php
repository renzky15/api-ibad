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

    // Blog post query
    $result =$employee->read();

    // get row count
    $num = $result->rowCount();

    if($num > 0) {
        // POst array
        $posts_arr = array();
        $posts_arr['response_array'] = array();

        while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
            extract($row);
            // $formatted_date = date('Y-m-d',strtotime($date_created));
            $post_item = array(
                'e_id' => $e_id,
                'firstName' => $firstName,
                'lastName' => $lastName,
                'employee_name'=>$firstName.' '.$lastName,
                'position' => $position,
                'email' => $email,
                'address' =>$address
               
                
            );

            // Push array to 'data'
            array_push($posts_arr['response_array'], $post_item);
        }

         echo json_encode($posts_arr);
    } 
    else {
        echo json_encode(
            array('message' => 'No data found.')
        );
    }

    
?>