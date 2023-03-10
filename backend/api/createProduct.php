<?php
require 'commun_services.php';
// protected ?int $idProduit;
// protected string $name;
// protected string $description;
// protected string $price;
// protected string $stock;
// protected string $category;
// protected string $image;
// protected string $createdAt;

if(!isset($_REQUEST['name']) || !isset($_REQUEST['description']) || !isset($_REQUEST['price']) || !isset($_REQUEST['stock']) || !isset($_REQUEST['category'])){
    produceErrorRequest();
    return;
};

if(empty($_REQUEST['name']) || empty($_REQUEST['description']) || empty($_REQUEST['price']) || empty($_REQUEST['stock']) || empty($_REQUEST['category'])){
    produceErrorRequest();
    return;
};

try {
    $product = new ProductEntity();
    
    $product->setName($_REQUEST['name']);
    $product->setDescription($_REQUEST['description']);
    $product->setPrice($_REQUEST['price']);
    $product->setStock($_REQUEST['stock']);
    $product->setCategory($_REQUEST['category']);
    $product->setImage($_REQUEST['image']);
    $result = $db->createProduct($product);

    if($result){
        produceResult("Le produit est créée avec succès");
    }else{
        produceError('Erreur lors de la création de produit.Merci de réessayer !');
    }
} catch (Exception $th) {
    produceError($th->getMessage());
}

?>