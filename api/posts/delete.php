<?php

header('Access-Control-Allow-Origin: *');
header('Content-Type: applecation/json');
header('Access-Control-Allow-Method: PUT');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Method, Autorization, X-Request-With');


include_once '../../database/Database.php';
include_once '../../models/Post.php';


//Instantiate DB & connect
$database   =   new Database();
$db         =   $database->connect();

//instantiate blog post object
$post       =   new Post($db);

$data       =   json_decode(file_get_contents("php://input"));

//Set id to delete
$post->id   =   $data->id;

if($post->delete()){
    echo json_encode(
        array(
            "message" => " Post Deleted"
        )
    );
}else{
    echo json_encode(
        array(
            "message" => "Post Not Deleted"
        )
        );
}
