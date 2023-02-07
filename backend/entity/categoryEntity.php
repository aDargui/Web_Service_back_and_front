<?php
//Faut installer l'extention Getter Setter ..
//(Ctrl+p) .. (>) .. (Extention getter et setter ...) 


/**
 * categoryEntity.php
 * @author aDargui
 * site Web : adargui.fr
 */
class CategoryEntity{
    // avec '?' peux prendre la valeur null

    /**
     * Identifiant de la categorie
     */
    protected ?int $idCategory;

    /**
     * Le nom de la categorie
     */
    protected string $name;

    /**
     * Getter et Setter
     */
    function getIdCategory() { 
        return $this->idCategory; 
    } 

    function setIdCategory($idCategory) {  
        $this->idCategory = $idCategory; 
    } 

    function getName() { 
        return $this->name; 
    } 

    function setName($name) {  
        $this->name = $name; 
    } 

}


	
?>