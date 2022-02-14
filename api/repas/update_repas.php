<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

include_once "../../library/function.php";
include_once "../../library/create_image.php";



if (
    isset($_POST["id_repas"])
    && is_numeric($_POST["id_repas"])
    && isset($_POST["price"])
    && isset($_POST["description"])
   
    && isset($_POST["repas_name"])


) {
    if (!empty($_FILES["file"]['name']) )
    {
        $images = uploadImage("file" , '../../images/category/' , 200 , 600);
        $img_image = $images["image"];
        $img_thumbnail = $images["thumbnail"];

    }
    else
    {
        $img_image = "";
        $img_thumbnail = "";
    }


    $cat_name = $_POST["price"];
    $cat_name_en = $_POST["repas_name"];
    $description = $_POST["description"];

    $cat_id = $_POST["id_repas"];

    $updateArray = array();
    array_push($updateArray, htmlspecialchars(strip_tags($cat_name)));
    array_push($updateArray, htmlspecialchars(strip_tags($cat_name_en)));
    array_push($updateArray, htmlspecialchars(strip_tags($description)));

    if($img_image != "")
    {
        array_push($updateArray, htmlspecialchars(strip_tags($img_image)));
        array_push($updateArray, htmlspecialchars(strip_tags($img_thumbnail)));
    }
    array_push($updateArray, htmlspecialchars(strip_tags($cat_id)));

    if($img_image != "")
    {
        $sql = "update re_repas 
		set price=?,repas_name=?,
        description=?,
		cat_image = ? , cat_thumbnail = ?
		
		where id_repas=?";
    }
    else
    {
        $sql = "update re_repas 
		set price=?,repas_name=?,
        description=?
		
		where id_repas=?";
    }
    $result = dbExec($sql, $updateArray);


    $resJson = array("result" => "success", "code" => "200", "message" => "done");
    echo json_encode($resJson, JSON_UNESCAPED_UNICODE);
} else {
    //bad request
    $resJson = array("result" => "fail", "code" => "400", "message" => "error");
    echo json_encode($resJson, JSON_UNESCAPED_UNICODE);
}