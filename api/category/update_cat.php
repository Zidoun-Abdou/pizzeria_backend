<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

include_once "../../library/function.php";
include_once "../../library/create_image.php";
if (
    isset($_POST["id_type"])
    && is_numeric($_POST["id_type"])
    && isset($_POST["nom"])
   
    && isset($_POST["nomE"])
) {

    $nom = $_POST["nom"];
    $nomE = $_POST["nomE"];

    $id = $_POST["id_type"];

    $updateArray = array();
    array_push($updateArray, htmlspecialchars(strip_tags($nom)));
    array_push($updateArray, htmlspecialchars(strip_tags($nomE)));
    array_push($updateArray, htmlspecialchars(strip_tags($id)));

   
 
    $sql = "update re_type 
    set nom=?,nomE=? where id_type=?";
    $result = dbExec($sql, $updateArray);
    $resJson = array("result" => "success", "code" => "200", "message" => "done");
    echo json_encode($resJson, JSON_UNESCAPED_UNICODE);

} else {
    //bad request
    $resJson = array("result" => "fail", "code" => "400", "message" => "error");
    echo json_encode($resJson, JSON_UNESCAPED_UNICODE);
}