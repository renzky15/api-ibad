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
    require '../../vendor/autoload.php';
    use \Firebase\JWT\JWT;


    

    $email = '';
    $password = '';

    $db = new Database();
    $conn = $db->connect();


    $data = json_decode(file_get_contents("php://input"));

    $email = $data->email;
    $password = $data->password;

    

    $email = stripcslashes($email);
    $password = stripcslashes($password);
   
    $table_name = 'users';

    $query = "SELECT user_id, email, user_password, user_level FROM " . $table_name . " WHERE email = ? LIMIT 0,1";

    $stmt = $conn->prepare( $query );
    $stmt->bindParam(1, $email);
    $stmt->execute();

    $num = $stmt->rowCount();
    if($num > 0) {
        $posts_arr = array();
        $posts_arr['data_return'] = array();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        
        if ($row['email'] === $email && $row['user_password'] === $password){
            // Array to be post
            $post_item = array(
                'email' => $email,
                'message' => 'Login Success.'
            );
            array_push($posts_arr['data_return'],$post_item);
            echo json_encode($posts_arr);
        }else{
            array_push($posts_arr['data_return'],array('message' => 'Login Failed'));
            echo json_encode($posts_arr);
            // echo json_encode(
            //     );
        }

        
    }

   
    
    
