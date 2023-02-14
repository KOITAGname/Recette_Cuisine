<?php
session_start() ;
require "lib/base-de-donne.php";
//http://localhost/php-initiation/recettes_cuisine/index.php
 ?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>recettes_cuisine</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css">
</head>
<body>

<header class="bg-success">
        <nav class="navbar navbar-expand navbar-dark container">
            <span class="navbar-brand">👩‍🍳</span>
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a href="index.php" class="nav-link">Accueil</a>
                </li>
                <li class="nav-item">
                    <a href="index.php?page=recette" class="nav-link">Recette</a>
                </li>
                <li class="nav-item">
                    <a href="index.php?page=contact" class="nav-link">Contact</a>
                </li>

            </ul>
            <ul class="navbar-nav ms-auto">
            <?php if( isset($_SESSION["user"]) ) :?>
                    <li class="nav-item">
                        <a href="index.php?page=accueil&partie=privee" class="nav-link">Tableau de Bord</a>
                    </li>
                    <li class="nav-item">
                        <a href="index.php?page=logout" class="nav-link">Déconnexion</a>
                    </li>
                <?php else : ?>
                    <li class="nav-item">
                        <a href="index.php?page=login" class="nav-link">Login</a>
                    </li>
                <?php endif ?>
            </ul>
            
        </nav>
    </header> 

    <!-- on va gerer tous ce qui est front-office -->
    <!------------- la partie front_office -------->
    <div class="container">
          <!-- routing => url => page -->

        <!-- -------------- la partie public---------------- -->
        <?php if (empty($_GET)) :?>
            <?php require "vue/public/accueil.php" ?>
        <?php elseif(!empty($_GET["page"]) && $_GET["page"] === "Recette") : ?>
            <?php require "vue/public/Recette.php" ?>
            <!-------------- routing => vers la page contact ------------->
        <?php elseif(!empty($_GET["page"]) && $_GET["page"] === "Contact") : ?>
            <?php require "vue/public/Contact.php" ?>
             <!-------------- routing => vers la page login ------------->
        <?php elseif(!empty($_GET["page"]) && $_GET["page"] === "login") : ?>
            <?php require "vue/public/login.php" ?> 
         <!-------------- routing => vers la page Mention_legale ---------------->
        <?php elseif(!empty($_GET["page"]) && $_GET["page"] === "mention") : ?>
            <?php require "vue/public/mention-legale.php" ?>
       <!-------------- routing => vers la page deconnexion ------------------>
            <?php elseif( !empty($_GET["page"]) && $_GET["page"] === "logout" ) : ?>
            <!-- gérer l'onglet déconnexion  sur la navbar--> 
            <?php 
                unset($_SESSION["user"]) ;
                $_SESSION["message"] = [
                    "alert" => "success",
                    "info" => "vous avez été déconnecté avec succès"
                ];
                header("Location: http://localhost/php-initiation/projet/index.php?page=login");
                exit; // direction et stop 
            ?>
                <!--    ---------------la partie privee -----------------   -->
            <!--------------------------tableau-bord-------------------------->
        <?php elseif( !empty($_GET["page"]) && 
                      !empty($_GET["partie"]) &&
                      $_GET["page"] === "accueil" && 
                      $_GET["partie"] === "privee"): ?>
                <?php require "vue/privee/tableau-bord.php" ?>
----------------------- else  -------------------------- -->
        <?php else : ?>
                <?php require "vue/public/404.php" ?>
        <?php endif ?> 
    </div>
    
</body>
</html>