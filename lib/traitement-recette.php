<?php 
///////traitement sur tableau_recettes dans la base de donnees//////
//le fichier traitement-recette.php 

// dans ce fichier 
// ouverture  d'une session start
session_start(); 
// créer une variable erreurs tableau vide 
$erreurs = [];
// connexion à la base de données
//appel de la fonction creer dans le fichier fonctions.php
//appel de la variable const creer dans le fichier const.php
require "base-de-donne.php" ;
 

// vérifier que tous les champs sont remplis => erreur 
if(
    empty($_POST["nom"]) || empty($_POST["preparation"]) || empty($_POST["prix"]) || empty($_POST["categorie"]) || empty($_POST["image"]) || empty($_POST["auteur"]) 
){
        array_push($erreurs , "veuillez compléter tous les champs");
}   
// verifier que nom / categorie /  auteur contiennent entre 4 et 255 lettres
$champs = ["nom", "categorie" , "auteur"];
foreach($champs as $c){
    if(strlen($_POST[$c]) <= 3 ||  strlen($_POST[$c]) >= 255){
        array_push($erreurs , "le {$c} nom doit contenir entre 3 et 255 lettres");
    }
}
// verifier que preparation contient 4 et 65 000 lettres 
if(strlen($_POST["preparation"]) <= 4 ||  strlen($_POST["preparation"]) >= 65000){
    array_push($erreurs , "le preparation doit contenir entre 4 et 65000 lettres");
}

// verifier que prix contient  65 000 chiffre entier au maximun
if((int)$_POST["prix"] >= 65000){
    array_push($erreurs , "le prix  doit etre inferieur à 65000");
}

//verifier si l'url de l'image est valide img url valide filter_var FILTER_VALIDATE_URL
if(filter_var($_POST["image"] , FILTER_VALIDATE_URL)){
    array_push($erreurs , "l'url du champ image n'est pas correct");
}


$_SESSION["form"] = $_POST ;

// si tout est ok 
 if(count($erreurs) === 0){
//     $sth = $connexion->prepare("
//         INSERT INTO pages
//        ( nom , preparation ,prix, categorie , image , auteur  , dt_creation)
//         VALUES 
//        ( :nom, :preparation , :prix , :categorie , :image , :auteur , NOW())
//     $sth->execute($_POST);
//     $_SESSION["message"] = [
//         "alert" => "success" ,
//         "info" => "la page a bien été insérée en base de données"
//     ];
if(!isset($_POST["id"])){
    $sth = $connexion->prepare("
        INSERT INTO recettes
        ( nom , preparation ,prix, categorie , image , auteur  , dt_creation)
        VALUES 
        ( :nom, :preparation , :prix , :categorie , :image , :auteur , :dt_creation)
    ");
    $sth->execute($_POST);
    $_SESSION["message"] = [
        "alert" => "success" ,
        "info" => "la page a bien été insérée en base de données"
    ];
} else {
    $sth = $connexion->prepare("
        UPDATE recettes SET
                        nom = :nom , 
                        preparation = :preparation  , 
                        prix = :prix  , 
                        categorie = :categorie  , 
                        image = :image , 
                        auteur = :auteur
        WHERE id = :id
    ");
    $sth->execute($_POST);
    $_SESSION["message"] = [
        "alert" => "success" ,
        "info" => "la page a bien été mise à jour en base de donne "
    ];
   }
}else 
{
    $_SESSION["message"] = [
        "alert" => "danger" ,
        "info" => $erreurs
    ];
}
 header("Location: http://localhost/recettes_cuisine/index.php?page=recette&partie=privee");

// INSERT en base de données 
exit ;
// sinon message d'erreur sous le formulaire 