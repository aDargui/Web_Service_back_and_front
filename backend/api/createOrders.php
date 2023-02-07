<?php
require 'commun_services.php';


if(!isset($_REQUEST['idUser']) || !isset($_REQUEST['idProduct']) || !isset($_REQUEST['quantity']) || !isset($_REQUEST['price'])){
    produceErrorRequest();
    return;
};

if(empty($_REQUEST['idUser']) || empty($_REQUEST['idProduct']) || empty($_REQUEST['quantity']) || empty($_REQUEST['price'])){
    produceErrorRequest();
    return;
};

try {
    $orders = new OrdersEntity();
    
    $orders->setIdUser($_REQUEST['idUser']);
    $orders->setIdProduct($_REQUEST['idProduct']);
    $orders->setQuantity($_REQUEST['quantity']);
    $orders->setPrice($_REQUEST['price']);
    
    $result = $db->createOrder($orders);

    if($result){
        produceResult("Commande créée avec succès");
    }else{
        produceError('Erreur lors de la création de la commande.Merci de réessayer !');
    }
} catch (Exception $th) {
    produceError($th->getMessage());
}

?>