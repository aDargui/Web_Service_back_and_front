<?php
date_default_timezone_set("Europe/Paris");
header("Content-type: application/json; charset=UTF-8");

define("API", dirname(__FILE__));
define("ROOT", dirname(API));
define("SP",DIRECTORY_SEPARATOR);
define("CONFIG", ROOT.SP."config"); 
define("MODEL", ROOT.SP."model");
define("ENTITY", ROOT.SP."entity");

require CONFIG.SP."config.php";
require MODEL.SP."DataLayer.class.php";
require ENTITY.SP."userEntity.php";
require ENTITY.SP."categoryEntity.php";
require ENTITY.SP."productEntity.php";
require ENTITY.SP."ordersEntity.php";

$db = new DataLayer();

function answer($response){
    global $_REQUEST;
    $response['args'] = $_REQUEST;
    unset($response['args']['password']);
    $response['time'] = date('d/m/Y H:i:s');
    echo json_encode($response);
}

function produceError($message){
    answer(['status'=>404,'message'=>$message]);
}

function produceErrorAuth(){
    answer(['status'=>401,'message'=>'Erreur d\'authentification !']);
}

function produceErrorRequest(){
    answer(['status'=>400,'message'=>'Requête mal formulée']);
}

function produceResult($result){
    //$result = clearData($result);
    answer(['status'=>200,'result'=>$result]);
}

function clearData($objetMetier){
    $objetMetier = (array)$objetMetier;

    $result=[];

    foreach ($objetMetier as $key => $value) {
        $result[substr($key,3)]= $value;
    }
    return $result;
}

function clearDataArray($array_objetMetier){
    
    $result = [];
    foreach($array_objetMetier as $key => $value){
        $result[$key] = clearData($value);
    }
    return $result;
}

?>