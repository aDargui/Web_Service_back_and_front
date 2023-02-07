<?php

/**
 * productEntity.php
 * @author aDargui
 * site Web : adargui.fr
 */
class ProductEntity{
    protected ?int $idProduit;
    protected string $name;
    protected string $description;
    protected string $price;
    protected string $stock;
    protected string $category;
    protected string $image;
    protected string $createdAt;

    function getIdProduit() { 
        return $this->idProduit; 
   } 
   
   function setIdProduit($idProduit) {  
       $this->idProduit = $idProduit; 
   } 
   
   function getName() { 
        return $this->name; 
   } 
   
   function setName($name) {  
       $this->name = $name; 
   } 
   
   function getDescription() { 
        return $this->description; 
   } 
   
   function setDescription($description) {  
       $this->description = $description; 
   } 
   
   function getPrice() { 
        return $this->price; 
   } 
   
   function setPrice($price) {  
       $this->price = $price; 
   } 
   
   function getStock() { 
        return $this->stock; 
   } 
   
   function setStock($stock) {  
       $this->stock = $stock; 
   } 
   
   function getCategory() { 
        return $this->category; 
   } 
   
   function setCategory($category) {  
       $this->category = $category; 
   } 
   
   function getImage() { 
        return $this->image; 
   } 
   
   function setImage($image) {  
       $this->image = $image; 
   } 
   
   function getCreatedAt() { 
        return $this->createdAt; 
   } 
   
   function setCreatedAt($createdAt) {  
       $this->createdAt = $createdAt; 
   } 

}

?>