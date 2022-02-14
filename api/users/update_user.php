<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

include_once "../../library/function.php";
include_once "../../library/create_image.php";



if (
    isset($_POST["phone"])
    && isset($_POST["pizzeria_name"])
    && isset($_POST["address"])
   
    && isset($_POST["type_pizzeria"])


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

    $cat_name = $_POST["pizzeria_name"];
    $cat_address = $_POST["address"];
    $type_piz = $_POST["type_pizzeria"];

    $phone = $_POST["phone"];

    $updateArray = array();
    array_push($updateArray, htmlspecialchars(strip_tags($cat_name)));
    array_push($updateArray, htmlspecialchars(strip_tags($cat_address)));
    array_push($updateArray, htmlspecialchars(strip_tags($type_piz)));

    if($img_image != "")
    {
        array_push($updateArray, htmlspecialchars(strip_tags($img_image)));
        array_push($updateArray, htmlspecialchars(strip_tags($img_thumbnail)));
    }
    array_push($updateArray, htmlspecialchars(strip_tags($phone)));

    if($img_image != "")
    {
        $sql = "update re_pizzeria 
		set pizzeria_name=?,address=?,
        type_pizzeria=?,
        piz_image = ? , piz_thumbnail = ?
		
		where phone=?";
    }
    else
    {
        $sql = "update re_pizzeria 
		set pizzeria_name=?,address=?,
        type_pizzeria=?
		
		where phone=?";
    }
    $result = dbExec($sql, $updateArray);


    $resJson = array("result" => "success", "code" => "200", "message" => "done");
    echo json_encode($resJson, JSON_UNESCAPED_UNICODE);
} else {
    //bad request
    $resJson = array("result" => "fail", "code" => "400", "message" => "error");
    echo json_encode($resJson, JSON_UNESCAPED_UNICODE);
}