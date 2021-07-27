<?php
//TODO: responder com cabeçalho
include_once "connection.php";

switch ($_SERVER["REQUEST_METHOD"]) {
    case "GET":
        if (isset($_REQUEST["GET"])) {
            // header("HTTP/1.1 200 OK");
            http_response_code(200);

            $get = $_REQUEST["GET"];

            echo $get;
        } else {
            echo "GET";
        }

        break;
    case "POST":
        if ($input = file_get_contents("php://input")) {
            header("HTTP/1.1 201 Created");
            // http_response_code(201);
            header("Content-Type: application/json", false);
            
            $post = json_decode($input, true);
  
            $sql =
            'INSERT INTO
            `tb_usuario` (`nome`, `tel`, `cpf`, `login`, `senha`, `email`, `tipo`)
            VALUES
            (
                "_nome",
                "_tel",
                "_cpf",
                "_login",
                "_senha",
                "_email",
                "_tipo"
            )';

            // $sql = mysqli_real_escape_string($conn, strtr($sql, $post));

            echo mysqli_query($conn, strtr($sql, $post));

            // echo mysqli_error($conn); || mysqli_errono($conn);
    
            mysqli_close($conn);

            // echo json_encode($post);
            // echo $input;
        } else {
            echo "POST";
        }
        
        break;
    case "PUT":
        if ($input = file_get_contents("php://input")) {
            // header("HTTP/1.1 202 Accepted");
            http_response_code(202);

            $put = json_decode($input);
            echo $put->PUT;
        } else {
            echo "PUT";
        }
            
        break;
    case "DELETE":
        if (isset($_REQUEST["DELETE"])) {
            // header("HTTP/1.1 202 Accepted");
            http_response_code(202);

            $del = $_REQUEST["DELETE"];

            echo $del;
        } else {
            echo "DELETE";
        }
        
        break;
    default:
        # code...
        break;
}
