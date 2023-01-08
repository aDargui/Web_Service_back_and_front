<?php

require 'config/config.php';
require 'entity/categoryEntity.php';
require 'entity/productEntity.php';
require 'entity/userEntity.php';
require 'entity/ordersEntity.php';
require 'model/DataLayer.class.php';

$db = new DataLayer();

// $users = $db->getUsers();
// var_dump($users);

// $category = $db->getCategory();
// var_dump($category);

// $product = $db->getproduct();
// var_dump($product);

// $orders = $db->getorders();
// var_dump($orders);

$user = new userEntity();

// $user->setPseudo("motivation");
$user->setEmail("motivation4@gmail.com");
// $user->setFirstname("Abdel");
// $user->setLastname('Dargui');
// $user->setSexe(1);
// $user->setAdressefacturation('adresse facturation');
// $user->setAdresselivraison("adresse livraison");
// $user->setTel('0754545454');
// $user->setDescription('test');
$user->setPassword('123456789');
//$user->setIdUser(45);

//$var = $db->updateUsers($user);
//$var = $db->createUser($user);
//$var = $db->deleteUsers($user);

$var = $db->authentifier($user);
var_dump($var);

?>