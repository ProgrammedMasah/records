<?php
//accept any request from any where
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept');
//allow only POST method for any request to this file
header('Access-Control-Allow-Methods : GET');

//Database connection configuration 
$DB_USER  = "u508226309_masah_store";
$DB_PASSWORD = "PASSword?q=masah_store_1";
$DB_DATABASE = "u508226309_masah_store";
$DB_SERVER = "sql780.main-hosting.eu";

$con = mysqli_connect($DB_SERVER, $DB_USER, $DB_PASSWORD ,$DB_DATABASE) or die(mysqli_connect_error());

$result = mysqli_query($con,"SELECT * FROM products");

//Close connection
mysqli_close($con);    

//The Response
if ($result)   
    {
    header($_SERVER['SERVER_PROTOCOL'].' 200 OK');
    
    $data = mysqli_fetch_all($result, MYSQLI_ASSOC);

    echo'<pre>';
    echo json_encode($data, JSON_PRETTY_PRINT);
    echo'</pre>';
    
    }
else 
    {
    header($_SERVER['SERVER_PROTOCOL'].' 400 Bad Request');
    echo'<p>Oops! error</p>';
    }
