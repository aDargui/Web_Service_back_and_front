<?php

/**
 * userEntity.php
 * @author aDargui
 * site Web : adargui.fr
 */
class userEntity{
    protected ?int $idUser;
    protected ?string $pseudo;
    protected string $email;
    protected ?string $sexe;
    protected string $password;
    protected ?string $firstname;
    protected ?string $lastname;
    protected ?string $description;
    protected ?string $adresse_facturation;
    protected ?string $adresse_livraison;
    protected ?string $tel;
    protected string $createdAt;

    function getIdUser() { 
        return $this->idUser;
    }
    
    function setIdUser($idUser) {  
        $this->idUser = $idUser; 
    } 
    
    function getPseudo() { 
            return $this->pseudo; 
    } 
    
    function setPseudo($pseudo) {  
        $this->pseudo = $pseudo; 
    } 
    
    function getEmail() { 
            return $this->email; 
    } 
    
    function setEmail($email) {  
        $this->email = $email; 
    } 

    function getTel() { 
        return $this->tel; 
    } 

    function setTel($tel) {  
        $this->tel = $tel; 
    }

    
    function getCreatedAt() { 
            return $this->createdAt; 
    } 
    
    function setCreatedAt($createdAt) {  
        $this->createdAt = $createdAt; 
    } 
    function getSexe() { 
            return $this->sexe; 
    } 

    function getPassword() { 
            return $this->password; 
    } 
    
    function setPassword($password) {  
        $this->password = $password; 
    } 
    

    function getFirstname() { 
            return $this->firstname; 
    } 

    function setFirstname($firstname) {  
        $this->firstname = $firstname; 
    } 

    function getLastname() { 
            return $this->lastname; 
    } 

    function setLastname($lastname) {  
        $this->lastname = $lastname; 
    } 

    function getDescription() { 
            return $this->description; 
    } 

    function setDescription($description) {  
        $this->description = $description; 
    }

    function getAdressefacturation() { 
        return $this->adresse_facturation; 
    } 

    function setAdressefacturation($adressefacturation) {  
        $this->adresse_facturation = $adressefacturation; 
    } 

    function getAdresselivraison() { 
            return $this->adresse_livraison; 
    } 

    function setAdresselivraison($adresselivraison) {  
        $this->adresse_livraison = $adresselivraison; 
    } 

}


	 
?>