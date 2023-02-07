<?php

/**
 * ordersEntity.php
 * @author aDargui
 * site Web : adargui.fr
 */
class OrdersEntity{
    
    protected ?int $idOrder;
    protected int $idUser;
    protected int $idProduct;
    protected int $quantity;
    protected float $price;
    protected ?string $created_at;

    function getIdOrder() { 
        return $this->idOrder; 
   } 
   
   function setIdOrder($idOrder) {  
       $this->idOrder = $idOrder; 
   } 
   
   function getIdUser() { 
        return $this->idUser; 
   } 
   
   function setIdUser($idUser) {  
       $this->idUser = $idUser; 
   } 
   
   function getIdProduct() { 
        return $this->idProduct; 
   } 
   
   function setIdProduct($idProduct) {  
       $this->idProduct = $idProduct; 
   } 
   
   function getQuantity() { 
        return $this->quantity; 
   } 
   
   function setQuantity($quantity) {  
       $this->quantity = $quantity; 
   } 
   
   function getPrice() { 
        return $this->price; 
   } 
   
   function setPrice($price) {  
       $this->price = $price; 
   } 
   
   function getCreated_at() { 
        return $this->created_at; 
   } 
   
   function setCreated_at($created_at) {  
       $this->created_at = $created_at; 
   } 


}

?>