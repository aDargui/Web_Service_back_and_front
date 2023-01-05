<?php

/**
 * DataLayer.php
 * @author aDargui
 * site Web : adargui.fr
 */
class DataLayer{
    private $connexion;

    function __construct(){
        $var = 'mysql:host='.HOST.';dbname='.DB_NAME;
        try{
            $this->connexion = new PDO($var,DB_USER,DB_PASSWORD);
            echo "la connexion à la base de données reussie<br>";
            $this->connexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
        } catch (PDOException $err){
            echo $err->getMessage();
            die('erreur ['.$err->getCode().'] '.$err->getMessage());
        }
    }

    /*fonctions CRUD (CREATE, READ, UPDATE , DELETE)*/

    /* functions CREATE*/

    function createUser(UserEntity $user){
        $sql = "INSERT INTO user (sexe,pseudo,lastname,firstname,tel,email,password,description,adresse_facturation,adresse_livraison) VALUES (:sexe,:pseudo,:firstname,:lastname,:tel,:email,:password,:description,:adresse_facturation,:adresse_livraison)";

        try{
            $result = $this->connexion->prepare($sql);
            $data = $result->execute(array(
                ':sexe' => $user->getSexe(),
                ':pseudo' =>$user->getPseudo(),
                ':lastname'=>$user->getLastname(),
                ':firstname'=>$user->getFirstname(),
                ':tel'=>$user->getTel(),
                ':email'=>$user->getEmail(),
                ':password'=>sha1($user->getPassword()),
                ':description'=>$user->getDescription(),
                ':adresse_facturation'=>$user->getAdressefacturation(),
                ':adresse_livraison'=>$user->getAdresseLivraison()
            ));
            if($data){
                return TRUE;
            }else{
                return FALSE;
            }
        }catch(PDOException $th){
            return $th;
        }
    }

    function createCategory(CategoryEntity $category){
        $sql = "INSERT INTO `category`(`name`) VALUES (:name)";
        $result = $this->connexion->prepare($sql);
            $data = $result->execute(array(
                ':name'=>$category->getName(),                
            ));
            if($data){
                return TRUE;
            }else{
                return FALSE;
            }

        try {
            
        } catch (PDOException $th) {
            return $th;
        }
    }

    function createProduct(ProductEntity $product){
        $sql = "INSERT INTO `product`(`name`, `description`, `price`, `stock`, `category`, `image`) VALUES (:name,:description,:price,:stock,:category,:image)";
        $result = $this->connexion->prepare($sql);
            $data = $result->execute(array(
                ':name'=>$product->getName(),
                ':description'=>$product->getDescription(),
                ':price'=>$product->getPrice(),
                ':stock'=>$product->getStock(),
                ':category'=>$product->getCategory(),
                ':image'=>$product->getImage(),
            ));
            if($data){
                return TRUE;
            }else{
                return FALSE;
            }

        try {
            
        } catch (PDOException $th) {
            return $th;
        }
    }

    function createOrder(OrdersEntity $order){
        $sql = "INSERT INTO `orders`(`idUser`, `idProduct`, `quantity`, `price`) VALUES (:idUser,:idProduct,:quantity,:price)";
        $result = $this->connexion->prepare($sql);
            $data = $result->execute(array(
                ':idUser'=>$order->getIdUser(),
                ':idProduct'=>$order->getIdProduct(),
                ':quantity'=>$order->getQuantity(),
                ':price'=>$order->getPrice()
                ));
            if($data){
                return TRUE;
            }else{
                return FALSE;
            }

        try {
            
        } catch (PDOException $th) {
            return $th;
        }
    }

    /* READ */
    function getUsers(){
        $sql = 'SELECT * FROM `'.DB_NAME.'`.`user`';
        
        try {
            $result = $this->connexion->prepare($sql);
            $var = $result->execute();
            //$data = $result->fetchAll();
            $users = [];
            while($data = $result->fetch(PDO::FETCH_OBJ)){
                $user = new UserEntity();
                $user->setIdUser($data->id);
                $user->setSexe($data->sexe);
                $user->setPseudo($data->pseudo);
                $user->setFirstname($data->firstname);
                $user->setLastname($data->lastname);
                $user->setTel($data->tel);
                $user->setEmail($data->email);
                $users[] = $user;

                

            }
            if($users){
                return $users;
            }else{
                return FALSE;
            }

        } catch (PDOException $th) {
            return FALSE;
        }
        
    }

    function getCategory(){
        $sql = 'SELECT * FROM `'.DB_NAME.'`.`category`';
        
        try {
            $result = $this->connexion->prepare($sql);
            $var = $result->execute();
            // $data = $result->fetchAll();
            $categories = [];
            while($data = $result->fetch(PDO::FETCH_OBJ)){
                $category = new CategoryEntity();
                print_r($data);
                $category->setIdCategory($data->id);
                $category->setName($data->name);
                $categories[] = $category;
            }
            if($categories){
                return $categories;
            }else{
                return FALSE;
            }

        } catch (PDOException $th) {
            return FALSE;
        }
        
    }

    function getProduct(){
        $sql = 'SELECT * FROM `'.DB_NAME.'`.`product`';
        
        try {
            $result = $this->connexion->prepare($sql);
            $var = $result->execute();
            // $data = $result->fetchAll();
            $products = [];
            while($data = $result->fetch(PDO::FETCH_OBJ)){
                // print_r($data);exit();
                $product = new ProductEntity();
                $product->setIdProduit($data->id);
                $product->setName($data->name);
                $product->setDescription($data->description);
                $product->setPrice($data->price);
                $product->setStock($data->stock);
                $product->setCategory($data->category);
                $product->setImage($data->image);
                $product->setCreatedAt($data->createdat);
                
                $products[] = $product;

            }
            if($products){
                return $products;
            }else{
                return FALSE;
            }

        } catch (PDOException $th) {
            return FALSE;
        }
        
    }

    function getOrders(){
        $sql = 'SELECT * FROM `'.DB_NAME.'`.`orders`';
        
        try {
            $result = $this->connexion->prepare($sql);
            $var = $result->execute();
            // $data = $result->fetchAll();
            $orders = [];
            while($data = $result->fetch(PDO::FETCH_OBJ)){
                // print_r($data);exit();
                $order = new ordersEntity();
                $order->setIdOrder($data->id);
                $order->setIdUser($data->id_user);
                $order->setIdProduct($data->id_product);
                $order->setQuantity($data->quantity);
                $order->setPrice($data->price);
                $order->setCreated_at($data->createdat);

                $orders[] = $order;

            }
            if($orders){
                return $orders;
            }else{
                return FALSE;
            }

        } catch (PDOException $th) {
            return FALSE;
        }

    }

    /* UPDATE */

    function updateUsers(UserEntity $user){
        $sql = "UPDATE `'.DB_NAME.'`.`user` SET ";
        try {
            $sql .=" pseudo = '".$user->getPseudo()."',";
            $sql .=" email = '".$user->getEmail()."',";
            $sql .=" sexe = '".$user->getSexe()."',";
            $sql .=" lastname = '".$user->getLastname()."',";
            $sql .=" firstname = '".$user->getFirstname()."',";
            $sql .=" tel= '".$user->getTel()."',";
            $sql .=" adresse_facturation= '".$user->getAdressefacturation()."',";
            $sql .=" adresse_livraison= '".$user->getAdresseLivraison()."',";            
            $sql .=" WHERE id=".$user->getIdUser();
            $result = $this->connexion->prepare($sql);
            $var = $result->execute();
            // print_r($var);
            if($var){
                return TRUE;
            }else{
                return FALSE;
            }
        } catch (PDOException $th) {
            return NULL;
        }

    }

    function updateCategory(CategoryEntity $category){
        $sql = "UPDATE `'.DB_NAME.'`.`category` SET ";
        try {
            $sql .=" name = '".$category->getName()."',";            
            $sql .=" WHERE id=".$category->getIdCategory();
            $result = $this->connexion->prepare($sql);
            $var = $result->execute();
            // print_r($var);
            if($var){
                return TRUE;
            }else{
                return FALSE;
            }
        } catch (PDOException $th) {
            return NULL;
        }

    }

    function updateProduct(ProductEntity $product){
        $sql = "UPDATE `'.DB_NAME.'`.`product` SET ";
        try {
            $sql .=" name = '".$product->getName()."',";
            $sql .=" description = '".$product->getDescription()."',";
            $sql .=" category = '".$product->getCategory()."',";
            $sql .=" image = '".$product->getImage()."',";
            $result = $this->connexion->prepare($sql);
            $var = $result->execute();
            // print_r($var);
            if($var){
                return TRUE;
            }else{
                return FALSE;
            }
        } catch (PDOException $th) {
            return NULL;
        }
    }

    function updateOrders(ordersEntity $order){
        $sql = "UPDATE `'.DB_NAME.'`.`product` SET ";
        try {
            $sql .=" idUser = '".$order->getIdUser()."',";
            $sql .=" idProduct = '".$order->getIdProduct()."',";
            $sql .=" quantity = '".$order->getQuantity()."',";
            $sql .=" price = '".$order->getPrice()."',";
            $result = $this->connexion->prepare($sql);
            $var = $result->execute();
            // print_r($var);
            if($var){
                return TRUE;
            }else{
                return FALSE;
            }
        } catch (PDOException $th) {
            return NULL;
        }

    }

    /* DELETE */

    function deleteUsers(UserEntity $user){
        $sql = "DELETE FROM `user` WHERE id=".$user->getIdUser();
        
        try {
            $result = $this->connexion->prepare($sql);
            $var = $result->execute();
            if($var){
                return TRUE;
            }else{
                return FALSE;
            }
        } catch (PDOException $err) {
            FALSE;
        }

    }

    function deleteCategory(CategoryEntity $category){
        $sql = "DELETE FROM `category` WHERE id=".$category->getIdCategory();
        
        try {
            $result = $this->connexion->prepare($sql);
            $var = $result->execute();
            if($var){
                return TRUE;
            }else{
                return FALSE;
            }
        } catch (PDOException $err) {
            FALSE;
        }

    }

    function deleteProduct(ProductEntity $product){
        $sql = "DELETE FROM `product` WHERE id=".$product->getIdProduit();
        
        try {
            $result = $this->connexion->prepare($sql);
            $var = $result->execute();
            if($var){
                return TRUE;
            }else{
                return FALSE;
            }
        } catch (PDOException $err) {
            FALSE;
        }

    }

    function deleteOrders(ordersEntity $order){
        $sql = "DELETE FROM `orders` WHERE id=".$order->getIdOrder();
        
        try {
            $result = $this->connexion->prepare($sql);
            $var = $result->execute();
            if($var){
                return TRUE;
            }else{
                return FALSE;
            }
        } catch (PDOException $err) {
            FALSE;
        }
    }
}

?>