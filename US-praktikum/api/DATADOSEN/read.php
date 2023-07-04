<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Methods: POST");
    header("Access-Control-Max-Age: 3600");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
    
    include_once '../../config/database.php';
    include_once '../../models/employees.php';
    
    
    $database = new Database();
    $db = $database->getConnection();
    if(isset($_GET['id'])){
        $item = new dtdosen($db);
        $item->id = isset($_GET['id']) ? $_GET['id'] : die();
    
        $item->getSingledtdosen();
        if($item->nama != null){
            // create array
            $emp_arr = array(
                "id" =>  $item->id,
                "nama" => $item->nama,
                "Ttl" => $item->Ttl,
                "alamat" => $item->alamat,
                "nohp" => $item->nohp,
                "email" => $item->email,
            );
        
            http_response_code(200);
            echo json_encode($emp_arr);
        }
        else{
            http_response_code(404);
            echo json_encode("dtdosen not found.");
        }
    }
    else {
        $items = new dtdosen($db);
        $stmt = $items->getEmployees();
        $itemCount = $stmt->rowCount();

        // echo json_encode($itemCount);
        if($itemCount > 0){
            
            $dtdosenArr = array();
            $dtdosenArr["body"] = array();
            $dtdosenArr["itemCount"] = $itemCount;
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                extract($row);
                $e = array(
                    "id" => $id,
                    "nama" => $nama,
                    "Ttl" => $Ttl,
                    "alamat" => $alamat,
                    "nohp" => $nohp,
                    "email" => $email,
                );
                array_push($dtdosenArr["body"], $e);
            }
            echo json_encode($dtdosenArr);
        }
        else{
            http_response_code(404);
            echo json_encode(
                array("message" => "No record found.")
            );
        }
    }