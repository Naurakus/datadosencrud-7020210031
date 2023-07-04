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
    $item = new Dtdosen($db);
    $data = json_decode(file_get_contents("php://input"));
    $item->nama = $data->nama;
    $item->Ttl = $data->Ttl;
    $item->alamat = $data->alamat;
    $item->nohp = $data->nohp;
    $item->email = $data->email;
    
    if($item->createDtdosen()){
        echo json_encode(['message'=>'Dtdosen created successfully.']);
    } else{
        echo json_encode(['message'=>'DTdosen could not be created.']);
    }
?>
