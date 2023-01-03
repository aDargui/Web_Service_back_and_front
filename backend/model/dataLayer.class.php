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
}

?>