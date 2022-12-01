<?php
//accept any request from any where
header('Content-type: application/json');

header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-with');
//allow only POST method for any request to this file
header('Access-Control-Allow-Methods : DELETE');


$info = json_decode(file_get_contents("php://input"), true);
$id = $info['id'];

//Database connection configuration 
$DB_USER  = "u508226309_masah_store";
$DB_PASSWORD = "PASSword?q=masah_store_1";
$DB_DATABASE = "u508226309_masah_store";
$DB_SERVER = "sql780.main-hosting.eu";

$con = mysqli_connect($DB_SERVER, $DB_USER, $DB_PASSWORD ,$DB_DATABASE) or die(mysqli_connect_error());

$result = mysqli_query($con,"DELETE FROM  products WHERE id = {$id}");



//Close connection
mysqli_close($con);    

//The Response
if ($result)   
    {
    header($_SERVER['SERVER_PROTOCOL'].' 200 OK');

    echo json_encode(array('massage' => 'products record delete.', 'products' => true));
    
    }
else 
    {
    header($_SERVER['SERVER_PROTOCOL'].' 400 Bad Request');

    echo json_encode(array('massage' => 'products record not delete', 'products' => false));
    }
