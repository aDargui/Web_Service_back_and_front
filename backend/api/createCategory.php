<?php
require 'commun_services.php';
if(!isset($_REQUEST['name']) || empty($_REQUEST['name'])){
    produceErrorRequest();
    return;
}
    
try {
    $category = new categoryEntity();
    
    $category->setName($_REQUEST['name']);
    
    $result = $db->createCategory($category);
    //print($result);exit();
    if($result){
        produceResult("Categorie créée avec succès");
    }else{
        produceError('Echec de la création de la categorie');
    }
} catch (Exception $th) {
    produceError($th->getMessage());
}
    



?>