<?php 
require 'commun_services.php';
try {
    $orders = $db->getOrders();
    if($orders){
        produceResult(clearDataArray($orders));
    }else{
        produceError("Problème de récupération des commandes");
    }
    
} catch (Exception $th) {
    produceError("2- Echec de récuperation des commandes");
}
?>