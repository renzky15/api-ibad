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
    include_once '../../models/Login.php';

    
    
    $database = new Database();
    $db = $database->connect();

    // Instantiate POSt

    $login = new Login($db);

    // Blog post query
    $result =$login->read();

    // get row count
    $num = $result->rowCount();

    if($num > 0) {
        // POst array
        $posts_arr = array();
        $posts_arr['dataArray'] = array();

        while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
            extract($row);

            $post_item = array(
                'user_id' => $user_id,
                'username' => $username,
                'user_password' => $user_password,
                'user_level' => $user_level,
                
            );

            // Push array to 'data'
            array_push($posts_arr['dataArray'], $post_item);
        }

         echo json_encode($posts_arr);
    } 
    else {
        echo json_encode(
            array('message' => 'No data found.')
        );
    }

    
?>