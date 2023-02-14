<?php

// on essayer de se connecter à la base de données 
// la variable (l'objet) $connexion va être partagée entre plusieurs fichiers 
try{
    $connexion = new PDO("mysql:host=localhost;dnname=recette" , "root" ,"");
    //nous permet d'affiche le tableau depuis MySQL (la base de donne)
    $connexion = new PDO("mysql:host=localhost;dbname=recette;charset=utf8mb4" , "root", "");
}
catch(Exception $e){
    echo "impossible de se connecter a la base de donnees";
    var_dump($e);
    exit;
}