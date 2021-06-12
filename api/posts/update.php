<?php

header('Access-Control-Allow-Origin: *');
header('Content-Type: applecation/json');
header('Access-Control-Allow-Method: PUT');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Method, Authorization ,X-Requested-With');

include_once '../../database/Database.php';
include_once '../../models/Post.php';


//instantiate DB & Connect
$database   =   new Database();
$db         =   $database->connect();

//instantiate Blog Post Object
$post       =   new Post($db);

//Get raw posted data
$data   =   json_decode(file_get_contents("php://input"));

//Set id to Update
$post->id = $data->id;

$post->title = $data->title;
$post->body = $data->body;
$post->author = $data->author;
$post->category_id = $data->category_id;

//update post

if($post->update()){
    echo json_encode(
        array('message' => 'Post Updated')
    );
    
}else{
    echo json_encode(
        array('message' => 'Post Not Updated')
    );
}

