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

$orders = $db->getorders();
var_dump($orders);

?>