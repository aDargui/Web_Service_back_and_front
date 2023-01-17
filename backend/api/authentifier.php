<?php
session_start();
require 'commun_services.php';

//Cas ou l'utilisateur est déja connecté
if(isset($_SESSION['ident'])){
    produceError("Utilisateur déjà connecté !");
    return;
}

//Cas ou la requête est mal formulée
if(!isset($_REQUEST['email']) || !isset($_REQUEST['password'])){
    produceErrorRequest();
    return;
}

try {
    $user = new userEntity;
    $user->setEmail($_REQUEST['email']);
    $user->setPassword($_REQUEST['password']);
    $dataAuth = $db->authentifier($user);
    if($dataAuth){
        $_SESSION['ident'] = $dataAuth;
        //Authentification réussie
        produceResult(clearData($dataAuth));
    }else{
        //Echec d'authentification
        produceError("Email ou password incorrecte? Merci de rér-essayer !");
    }
} catch (Exception $th) {
    produceError($th ->getMessage());
}


?>