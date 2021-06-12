<?php

header('Access-Control-Allow-Origin: *');
header('Content-Type: applecation/json');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Headers, Authorization, X-Requested-Width');

include_once '../../database/Database.php';
include_once '../../models/Post.php';


//instantiate DB & Connect
$database   =   new Database();
$db         =   $database->connect();

//instantiate Blog Post Object
$post       =   new Post($db);

//Get raw posted data
$data   =   json_decode(file_get_contents("php://input"));

$post->title = $data->title;
$post->body = $data->body;
$post->author = $data->author;
$post->category_id = $data->category_id;

//Create post

if($post->create()){
    echo json_encode(
        array('message' => 'Post Created')
    );
    
}else{
    echo json_encode(
        array('message' => 'Post Not Created')
    );
}

