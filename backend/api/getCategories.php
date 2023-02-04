<?php 
require 'commun_services.php';
try {
    $categories = $db->getCategory();
    if($categories){
        produceResult(clearDataArray($categories));
    }else{
        produceError("Problème de récupération des catégories");
    }
    
} catch (Exception $th) {
    produceError("2- Echec de récuperation des catégories");
}


?>