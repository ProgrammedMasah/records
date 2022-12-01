<?php
//accept any request from any where
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept');
//allow only POST method for any request to this file
header('Access-Control-Allow-Methods : POST');

// get the data from the body of the post request 
// then convert it to json 
$post = json_decode(file_get_contents('php://input', false, $context));

$title = $_POST['title'];
$price = $_POST['price'];
$date = date('y-m-d');

$image_name = $_FILES['picture']['name'];
$image_tmp_name = ($_FILES['picture']['tmp_name']);
$folder = "./img/" . $image_name;
move_uploaded_file($image_tmp_name, $folder);

//Database connection configuration 
$DB_USER  = "u508226309_masah_store";
$DB_PASSWORD = "PASSword?q=masah_store_1";
$DB_DATABASE = "u508226309_masah_store";
$DB_SERVER = "sql780.main-hosting.eu";

$con = mysqli_connect($DB_SERVER, $DB_USER, $DB_PASSWORD ,$DB_DATABASE) or die(mysqli_connect_error());

$result = mysqli_query($con,"INSERT INTO products (title, picture, price, deta) 
                             VALUES('$title', '$folder', '$price', '$date')");

//Close connection
mysqli_close($con);    

//The Response
if ($result)   
    {
    header($_SERVER['SERVER_PROTOCOL'].' 200 OK');

    echo json_encode(array('massage' => 'products record inserted', 'products' => true));
    
    }
else 
    {
    header($_SERVER['SERVER_PROTOCOL'].' 400 Bad Request');

    echo json_encode(array('massage' => 'products record not inserted', 'products' => false));
    }
