<?php
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
            `tb_atendimento` (`descricao`, `tempo_previsto`, `data_marcada`, `data_iniciada`, `data_finalizada`, `cod_motivo`, `cod_atendido`, `cod_atendente`)
            VALUES
            (
                "_descricao",
                _tempo_previsto,
                "_data_marcada",
                "_data_iniciada",
                "_data_finalizada",
                _cod_motivo,
                _cod_atendido,
                _cod_atendente
            )';

            // $sql = mysqli_real_escape_string($conn, strtr($sql, $post));

            // echo strtr($sql, $post);

            echo mysqli_query($conn, strtr($sql, $post));

            echo mysqli_error($conn); // || mysqli_errono($conn);
    
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
