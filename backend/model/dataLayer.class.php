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
    /**
     * Methode permetant d'authentifier un utilisateur
     *
     * @param userEntity $user //Objet metier décrivant un utilisateur
     * @return Array UserEntity $user Objet métier décrivant l'utilisateur authentifié
     * @return FALSE En cas d'échec d'authentification
     * @return NULL Exception déclenchée
     */
    function authentifier(userEntity $user){
        $sql = 'SELECT * FROM `'.DB_NAME.'`.`user` WHERE email= :email';

        try {
            $result = $this->connexion->prepare($sql);
            $var = $result->execute(array(
                ':email' => $user->getEmail()
            ));

            $data = $result->fetch(PDO::FETCH_OBJ);
            if($data && ($data->password == sha1($user->getPassword()))){
                // Authentification reussie
                $user->setIdUser($data->id);
                $user->setSexe($data->sexe);
                $user->setFirstname($data->firstname);
                $user->setLastname($data->lastname);
                $user->setPassword('');
                $user->setAdressefacturation($data->adresse_facturation);
                $user->setAdresselivraison($data->adresse_livraison);
                $user->setDescription($data->description);
                $user->setTel($data->tel);

                return $user;
                

            }else{
                //authentification échouée
                return FALSE;
            }
        } catch (PDOException $th) {
            return NULL;
            // throw $th;
        }
    }

    /*fonctions CRUD (CREATE, READ, UPDATE , DELETE)*/

    /* functions CREATE*/

    /**
     * Methode permetant de créer un utilisateur en DB
     *
     * @param UserEntity $user //Objet métier décrivant un utilisateur
     * @return TRUE Mise à jour réussie
     * @return FALSE Echec de la mise à jour
     * @return NULL exception déclenchée
     */
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

    /**
     * Methode permetant de créer une categorie en DB
     *
     * @param UserEntity $user //Objet métier décrivant une categorie
     * @return TRUE Mise à jour réussie
     * @return FALSE Echec de la mise à jour
     * @return NULL exception déclenchée
     */
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

    /**
     * Methode permetant de créer un produit en DB
     *
     * @param UserEntity $user //Objet métier décrivant un produit
     * @return TRUE Mise à jour réussie
     * @return FALSE Echec de la mise à jour
     * @return NULL exception déclenchée
     */
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

    /**
     * Methode permetant de créer une commande en DB
     *
     * @param UserEntity $user //Objet métier décrivant une commande
     * @return TRUE Mise à jour réussie
     * @return FALSE Echec de la mise à jour
     * @return NULL exception déclenchée
     */
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

    /**
     * Methode permettant de récupérer les utilisateur dans BD 
     * 
     * @param VOID ne prend pas de paramètre
     * @return ARRAY Tableau contenant les données utilisateurs
     * @return FALSE Echec de la persistance
     * @return NULL Exception déclenchée
     */
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

    /**
     * Methode permettant de récupérer les catégories dans BD 
     * 
     * @param VOID ne prend pas de paramètre
     * @return ARRAY Tableau contenant les catégories
     * @return FALSE Echec de la persistance
     * @return NULL Exception déclenchée
     */
    function getCategory(){
        $sql = 'SELECT * FROM `'.DB_NAME.'`.`category`';
        
        try {
            $result = $this->connexion->prepare($sql);
            $var = $result->execute();
            // $data = $result->fetchAll();
            $categories = [];
            while($data = $result->fetch(PDO::FETCH_OBJ)){
                $category = new CategoryEntity();
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

    /**
     * Methode permettant de récupérer les produits dans BD 
     * @param VOID ne prend pas de paramètre
     * @return ARRAY Tableau contenant les produits
     * @return FALSE Echec de la persistance
     * @return NULL Exception déclenchée
     */
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

    /**
     * Methode permettant de récupérer les commandes dans BD 
     * @param VOID ne prend pas de paramètre
     * @return ARRAY Tableau contenant les commande
     * @return FALSE Echec de la persistance
     * @return NULL Exception déclenchée
     */
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
    /**
     * Methode permettant de mettre à jour une utilisateur dans DB
     *
     * @param UserEntity $user //Objet métier décrivant un utilisateur
     * @return TRUE Mise à jour réussie
     * @return FALSE Echec de la mise à jour
     * @return NULL exception déclenchée
     */
    function updateUsers(UserEntity $user){
        $sql = "UPDATE `".DB_NAME."`.`user` SET ";
        try {
            $sql .=" pseudo = '".$user->getPseudo()."',";
            $sql .=" email = '".$user->getEmail()."',";
            $sql .=" sexe = '".$user->getSexe()."',";
            $sql .=" lastname = '".$user->getLastname()."',";
            $sql .=" firstname = '".$user->getFirstname()."',";
            $sql .=" tel= '".$user->getTel()."',";
            $sql .=" adresse_facturation= '".$user->getAdressefacturation()."',";
            $sql .=" adresse_livraison= '".$user->getAdresseLivraison()."'";            
            $sql .=" WHERE id=".$user->getIdUser();
            // print_r($sql);exit();
            $result = $this->connexion->prepare($sql);
            $var = $result->execute();
            
            // print_r($var);
            if($var){
                return TRUE;
            }else{
                return FALSE;
            }
        } catch (PDOException $th) {
            //return NULL;
            return $th;
        }

    }

    /**
     * Methode permettant de mettre à jour une catégorie dans DB
     *
     * @param CategoryEntity $category //Objet métier décrivant une categorie
     * @return TRUE Mise à jour réussie
     * @return FALSE Echec de la mise à jour
     * @return NULL exception déclenchée
     */
    function updateCategory(CategoryEntity $category){
        $sql = "UPDATE `".DB_NAME."`.`category` SET ";
        try {
            $sql .=" name = '".$category->getName()."'";            
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

    /**
     * Methode permettant de mettre à jour un produit dans DB
     *
     * @param ProductEntity $product //Objet métier décrivant un produit
     * @return TRUE Mise à jour réussie
     * @return FALSE Echec de la mise à jour
     * @return NULL exception déclenchée
     */
    function updateProduct(ProductEntity $product){
        $sql = "UPDATE `".DB_NAME."`.`product` SET ";

        //Methode 2
        /*
        $sql = "UPDATE `".DB_NAME."`.`product` SET `name`=:name,`description`=:description,`price`=:price,
        `stock`=:stock,`category`=:category,`image`=:image WHERE id=:id";
        */
        try {
            $sql .=" name = '".$product->getName()."',";
            $sql .=" description = '".$product->getDescription()."',";
            $sql .=" category = '".$product->getCategory()."',";
            $sql .=" image = '".$product->getImage()."'";
            $sql .=" WHERE id=".$product->getIdProduit();
            $result = $this->connexion->prepare($sql);
            $var = $result->execute();
            // print_r($var);
            /*
            Methode 2:
            $result = $this->connexion->prepare($sql);
            $var = $result->execute(array(
                ':id' => $product->getIdproduct(),
                ':name' => $product->getName(),
                ':description' => $product->getDescription(),
                ':price' => $product->getPrice(),
                ':stock' => $product->getStock(),
                ':category' => $product->getCategory(),
                ':image'=>$product->getImage()
               
            ));
            */
            if($var){
                return TRUE;
            }else{
                return FALSE;
            }
        } catch (PDOException $th) {
            return NULL;
        }
    }

    /**
     * Methode permettant de mettre à jour une commande dans DB
     *
     * @param ordersEntity $order //Objet métier décrivant une commande
     * @return TRUE Mise à jour réussie
     * @return FALSE Echec de la mise à jour
     * @return NULL exception déclenchée
     */
    function updateOrders(ordersEntity $order){
        $sql = "UPDATE `".DB_NAME."`.`product` SET ";
        try {
            $sql .=" idUser = '".$order->getIdUser()."',";
            $sql .=" idProduct = '".$order->getIdProduct()."',";
            $sql .=" quantity = '".$order->getQuantity()."',";
            $sql .=" price = '".$order->getPrice()."'";
            $sql .=" WHERE id=".$order->getIdOrder();
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
    /**
     * Methode permettant de supprimer un utilisateur dans DB
     *
     * @param ProductEntity $product //Objet métier décrivant un utilisateur
     * @return TRUE Mise à jour réussie
     * @return FALSE Echec de la mise à jour
     * @return NULL exception déclenchée
     */
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

    /**
     * Methode permettant de supprimer une categorie dans DB
     *
     * @param ProductEntity $product //Objet métier décrivant une categorie
     * @return TRUE Mise à jour réussie
     * @return FALSE Echec de la mise à jour
     * @return NULL exception déclenchée
     */
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

    /**
     * Methode permettant de supprimer un produit dans DB
     *
     * @param ProductEntity $product //Objet métier décrivant un produit
     * @return TRUE Mise à jour réussie
     * @return FALSE Echec de la mise à jour
     * @return NULL exception déclenchée
     */
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

    /**
     * Methode permettant de supprimer une commande dans DB
     *
     * @param ProductEntity $product //Objet métier décrivant une commande
     * @return TRUE Mise à jour réussie
     * @return FALSE Echec de la mise à jour
     * @return NULL exception déclenchée
     */
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