<?php
//fichier traitement-page.php 

// dans ce fichier 
// ouverture d'une session
session_start(); 
// créer une variable erreurs tableau vide 
$erreurs = [];
// connexion à la base de données
//appel de la fonction creer dans le fichier fonctions.php
//appel de la variable const creer dans le fichier const.php
require "base-de-donne.php" ;

// vérifier que tous les champs sont remplis => erreur 
if(
    empty($_POST["titre"]) || empty($_POST["contenu"]) 
){
        array_push($erreurs , "veuillez compléter tous les champs");
}   
// verifier que titre / contenu /   contiennent entre 4 et 255 lettres
$champs = ["titre"];
foreach($champs as $c){
    if(strlen($_POST[$c]) <= 4 ||  strlen($_POST[$c]) >= 255){
        array_push($erreurs , "le {$c} titre doit contenir entre 4 et 255 lettres");
    }
}
// verifier que contenu contient 4 et 65000 lettres 
if(strlen($_POST["contenu"]) <= 4 ||  strlen($_POST["contenu"]) >= 65000){
    array_push($erreurs , "le contenu titre doit contenir entre 4 et 65000 lettres");
}
//var_dump($_POST);
//var_dump($_erreurs);
//exit;
$_SESSION["form"] = $_POST ;

// si tout est ok 
 if(count($erreurs) === 0){
//     $sth = $connexion->prepare("
//         INSERT INTO pages
//         ( titre , slug , contenu , image , auteur  , dt_creation)
//         VALUES 
//         ( :titre , :slug , :contenu , :image , :auteur , NOW())
//     ");
//     $sth->execute($_POST);
//     $_SESSION["message"] = [
//         "alert" => "success" ,
//         "info" => "la page a bien été insérée en base de données"
//     ];
if(!isset($_POST["id"])){
    $sth = $connexion->prepare("
        INSERT INTO pages
        ( titre , contenu, dt_creation)
        VALUES 
        ( :titre , :contenu, NOW())
    ");
    $sth->execute($_POST);
    $_SESSION["message"] = [
        "alert" => "success" ,
        "info" => "la page a bien été insérée en base de données"
    ];
} else {
    $sth = $connexion->prepare("
        UPDATE pages SET
                        titre = :titre , 
                        slug = :slug  , 
                        contenu = :contenu  , 
                        image = :image , 
                        auteur = :auteur
        WHERE id = :id
    ");
    $sth->execute($_POST);
    $_SESSION["message"] = [
        "alert" => "success" ,
        "info" => "la page a bien été mise à jour en bdd "
    ];
   }
}else {
    $_SESSION["message"] = [
        "alert" => "danger" ,
        "info" => $erreurs
    ];
}
header("Location: http://localhost/recettes_cuisine/index.php?page=page&partie=privee");

// INSERT en base de données 
exit ;
// sinon message d'erreur sous le formulaire 