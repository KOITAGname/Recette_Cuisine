<?php
session_start() ;
require "lib/base-de-donne.php";
//http://localhost/recettes_cuisine/index.php
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

<header class="bg-primary">
        <nav class="navbar navbar-expand navbar-dark container">
            <span class="navbar-brand">👩‍🍳</span>
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a href="index.php" class="nav-link">Accueil</a>
                </li>
                <li class="nav-item">
                    <a href="index.php?page=recettes" class="nav-link">Recette</a>
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

<!---------------------------- la partie public------------------------------>
        <!-- si il nya rien affiche la page d'accueil -->
<!--------------------------------- if ---------------------------------------------->
        <?php if (empty($_GET)) :?> 
            <?php require "vue/public/accueil.php" ?>
        <?php elseif(!empty($_GET["page"]) && $_GET["page"] === "recettes") : ?>
            <?php require "vue/public/recette.php" ?>
            <!-------------- routing => vers la page contact ------------->
        <?php elseif(!empty($_GET["page"]) && $_GET["page"] === "contact") : ?>
            <?php require "vue/public/contact.php" ?>
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
                header("Location: http://localhost/recettes_cuisine/index.php?page=login");
                exit; // direction et stop 
            ?>
                <!--    ---------------la partie privee -----------------   -->
            <!--------------------------tableau-bord-------------------------->
        <?php elseif( !empty($_GET["page"]) && 
                      !empty($_GET["partie"]) &&
                      $_GET["page"] === "accueil" && 
                      $_GET["partie"] === "privee"): ?>
                <?php require "vue/privee/tableau-bord.php" ?>

    <!-- --------------------gestion_user  --------------------------- -->

        <?php elseif(!empty($_GET["page"]) && !empty($_GET["partie"]) &&
             $_GET["page"] === "user" && $_GET["partie"] === "privee"): ?>

<!----------------- //pour creer un profil utilisateur  pour le ADD --------------------->
            <?php if(!empty($_GET["action"]) && $_GET["action"] == "add" ) : ?>
            <!-- nous  permet d'afficher la page ajout d'un nouveau profil -->
                <?php require "vue/privee/gestion-user-form.php" ?>

<!------//pour supprime un profil utilisateur  pour le DELETE----------------->
            <?php elseif(!empty($_GET["action"]) && $_GET["action"] == "delete" ) : ?>
<!---------------- nous permet de supprime un profil utilisateur ---------------->

        <?php 
            $sth = $connexion->prepare("
                DELETE FROM users WHERE id = :id
            ");
            $sth->execute(["id" => $_GET["id"]]);
            header("Location: http://localhost/recettes_cuisine/index.php?page=user&partie=privee");
            exit ; 
        ?>

<!------------- //pour mettre a jour  un profil utilisateur  pour le  update------------>
                <?php elseif(!empty($_GET["action"]) && $_GET["action"] ==  "update" ) : ?>
<!--------- nous permet de faire la mise a jour (modifier) des profil utilisateur  ----------------->
            <?php 
            $sth = $connexion->prepare("
                SELECT * FROM users WHERE id = :id
            ");
            $sth->execute(["id" => $_GET["id"]]);
            $user = $sth->fetch();
            //pour teste 
            //var_dump($user);
        ?>
        <?php require "vue/privee/gestion-user-form.php" ?>

        <?php else : ?>
                <?php require "vue/privee/gestion-user.php" ?>
        <?php endif ?> 
    
<!-------------------------gestion_page  ---------------------------->

            <?php elseif(!empty($_GET["page"]) && !empty($_GET["partie"]) &&
            $_GET["page"] === "page" &&
            $_GET["partie"] === "privee"): ?>

<!-------------------- gérer le CRUD des pages ajout -------------------------->

<?php if(!empty($_GET["action"]) && $_GET["action"] == "add" ) : ?>
                <?php require "vue/privee/gestion-page-form.php" ?>

            <?php elseif(!empty($_GET["action"]) && $_GET["action"] == "delete" ) : ?>
                <!-- suppression -->
    <!-- suppresion du profil d'utilisateur dans la page -->
                <?php 
                    $sth = $connexion->prepare("
                        DELETE FROM pages WHERE id = :id
                    ");
                    $sth->execute(["id" => $_GET["id"]]);
                    header("Location: http://localhost/recettes_cuisine/index.php?page=page&partie=privee");
                    exit ; 
                ?>
<!------------------ mise a jour des utilisateurs ------------------->
            <?php elseif(!empty($_GET["action"]) && $_GET["action"] == "update" ) : ?>

                <?php 
                    $sth = $connexion->prepare("
                        SELECT * FROM pages WHERE id = :id
                    ");
                    $sth->execute(["id" => $_GET["id"]]);
                    $page = $sth->fetch();
                ?>
                <?php require "vue/privee/gestion-page-form.php" ?>

            <?php else : ?>
                <?php require "vue/privee/gestion-page.php" ?>
            <?php endif ?>
            
    <!-- --------------------gestion_recette  --------------------------- -->

        <?php elseif(!empty($_GET["page"]) && !empty($_GET["partie"]) &&
             $_GET["page"] === "recette" && $_GET["partie"] === "privee"): ?>
             
              <!------- //pour creer un profil utilisateur  pour le ADD -------->
            <?php if(!empty($_GET["action"]) && $_GET["action"] == "add" ) : ?>
            <!-- nous  permet d'afficher la page ajout d'un nouveau profil -->
                <?php require "vue/privee/gestion-recette-form.php" ?>

<!------------- //pour supprime un profil utilisateur  pour le DELETE----------------->
            <?php elseif(!empty($_GET["action"]) && $_GET["action"] == "delete" ) : ?>
<!---------------- nous permet de supprime un profil utilisateur ---------------->
                <?php 
                    $sth = $connexion->prepare("
                        DELETE FROM recettes WHERE id = :id
                    ");
                    $sth->execute(["id" => $_GET["id"]]);
                    header("Location: http://localhost/recettes_cuisine/index.php?page=recette&partie=privee");
                    exit ; 
                ?>

<!------------- //pour mettre a jour  un profil utilisateur  pour le  update------------>
                <?php elseif(!empty($_GET["action"]) && $_GET["action"] ==  "update" ) : ?>
<!--------- nous permet de faire la mise a jour (modifier) des profil utilisateur  ----------------->
            <?php 
            $sth = $connexion->prepare("
                SELECT * FROM recettes WHERE id = :id
            ");
            $sth->execute(["id" => $_GET["id"]]);
            $user = $sth->fetch();
            //pour teste 
            //var_dump($user);
        ?>
        <?php require "vue/privee/gestion-recette-form.php" ?>

        <?php else : ?>
                <?php require "vue/privee/gestion-recette.php" ?>
        <?php endif ?> 
          

<!---------------------------- fin partie privee -------------------------- -->

<!---------------------------- else  -------------------------------------------- -->
        <?php else : ?>
                <?php require "vue/public/404.php" ?>
        <?php endif ?>    
    </div>
    <footer class="my-3 text-center">
        <a href="http://localhost/recettes_cuisine/index.php?page=mention" class="text-decoration-none">mentions légales</a>
    </footer>
</body>
</html>