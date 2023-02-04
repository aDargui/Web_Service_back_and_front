<?php 
require 'commun_services.php';
try {
    $products = $db->getProduct();
    if($products){
        produceResult(clearDataArray($products));
    }else{
        produceError("Problème de récupération des produits");
    }
    
} catch (Exception $th) {
    produceError("2- Echec de récuperation des produits");
}
?>