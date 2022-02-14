<?php



header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

include_once "../../library/function.php";
include_once "../../library/create_image.php";

if (
    isset($_POST["nom"])
    && isset($_POST["nomE"])
    && isset($_POST["id_pizz"])

) {
    
    $cat_name = $_POST["nom"];
    $cat_name_en = $_POST["nomE"];
    $id_piz = $_POST["id_pizz"];
    





    $insertArray = array();
    array_push($insertArray, htmlspecialchars(strip_tags($cat_name)));
    array_push($insertArray, htmlspecialchars(strip_tags($cat_name_en)));

    array_push($insertArray, htmlspecialchars(strip_tags($id_piz)));


    $sql = "insert into re_type
        (nom , nomE ,id_pizz )
            values(? ,?,?)";
    $result = dbExec($sql, $insertArray);


    $resJson = array("result" => "success", "code" => "200", "message" => "done");
    echo json_encode($resJson, JSON_UNESCAPED_UNICODE);
} else {
    //bad request
    $resJson = array("result" => "fail", "code" => "400", "message" => "error");
    echo json_encode($resJson, JSON_UNESCAPED_UNICODE);
}

?>