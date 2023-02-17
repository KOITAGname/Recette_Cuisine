<?php 
//on na creer ce fichier (traitement-user.php)  pour pouvoir ajouter un nouveau profil dans le formulaire
// traitement sur le ADD  (  Ajouter un nouveau profil )
session_start();
$erreurs = [];
require "base-de-donne.php";

if(
    empty($_POST["email"]) ||
    empty($_POST["commentaire"]) 
   
){
    array_push($erreurs , "veuillez compléter les champs");
}
// traitement sur email
if(!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)){
    array_push($erreurs , "l'email n'est pas conforme");
}
// verifier que commentaire contient 4 et 65000 lettres 
if(strlen($_POST["commentaire"]) <= 4 ||  strlen($_POST["commentaire"]) >= 65000){
    array_push($erreurs , "le commentaire doit contenir entre 4 et 65000 lettres");
}

// autre test => il ne faut pas qu'il y ait 2 utilisateurs qui disposent du même email
// ///////////////////

//nous permet d'affiche un seul profil utilisateur 
//$resultat = $sth->fetchALl();
// traitements 
$_SESSION["form"] = $_POST ;

if(count($erreurs) === 0){
$_SESSION["form"] = [];

    // on inserer un profil d'utilisateur quant on na pas id dans le formulaire
    // quant-on n'a un id => update (modification)
    //quant-on n'a pas id=> insert (insertion)
    // // ------------ajouter le profil en base données 
    // //-------------------creation de la table //insertion 
    // //la fonction ne dispose pas de fonction inverse
    // $sth-> execute($_POST);

//---------------le formulaire est vide--------------
//---------------------creation----------------------
      // si le formulaire ne contient pas de champ id 
   
        $sth = $connexion->prepare("
            INSERT INTO contacts 
            (email , commentaire , dt_creation )
            VALUES
            ( :email , :commentaire, NOW() )
        ");
        $_SESSION["message"] = [
            "alert" => "success" ,
            "info" => "merci"
        ];
       

}else {
    $_SESSION["message"] = [
        "alert" => "danger" ,
        "info" => $erreurs
    ];
}
    header("Location: http://localhost/recettes_cuisine/index.php?page=contact&partie=privee&action=add");

exit ;