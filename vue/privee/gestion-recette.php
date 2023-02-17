<!-- gestion des recettes de cuisines -->

<!-- TABLE recettes 7
id clé primaire 
nom texte avec un maximum de 255 lettres 
preparation texte avec un maximum de 65 milles lettres 
prix chiffre entier maximum de 65 000 
categorie 3 valeurs possibles entree / plat / dessert 
image avec un maximum de 255 lettres 
auteur texte avec un maximum de 255 lettres 
dt_creation date et l'heure   -->
<?php 
//pour faire appel a la fonction
    $sth = $connexion->prepare("
    SELECT id, nom , preparation,prix,categorie, image, auteur, DATE_FORMAT(dt_creation , '%d/%m/%Y') AS `dt_creation`  FROM recettes ;
    ");
    $sth->execute();
    $recette = $sth->fetchAll();
?>
<h1>Gestion des Recettes</h1>
<section class="row">
    <div class="col-3">
        <?php require "lib/menu-privee.php" ?>
    </div>
    <div class="col">
        <div class="text-end mb-3">
            <a href=" http://localhost/recettes_cuisine/index.php?page=recette&partie=privee&action=add" class="button">ajouter une nouvelle recette</a>
        </div>
       <!-- <//?php require "lib/message-flash.php" ?> -->
        <table class="table table-striped">
            <thead>
        <tr>
            <th>id</th>
            <th>nom</th>
            <th>preparation</th>
            <th>prix</th>
            <th>categorie</th>
            <th>image</th>
            <th>auteur</th>
            <th>dt_creation</th>
        </tr>
            </thead>
            <tbody>
<!-- on fait appel a la variable recette declarer plus haut -->
            <?php foreach ($recette as $p) : ?>
        <tr>
            <td><?php echo htmlentities($p["id"]) ?></td>
            <td><?php echo htmlentities($p["nom"]) ?></td>
            <td><?php echo htmlentities($p["preparation"]) ?></td>
            <td><?php echo htmlentities($p["prix"]) ?></td>
            <td><?php echo htmlentities($p["categorie"]) ?></td>
            <td><img src="<?php echo htmlentities($p["image"]) ?>" alt="" class="width:100%"></td>
            <td><?php echo htmlentities($p["auteur"]) ?></td>
            <td><?php echo htmlentities($p["dt_creation"]) ?></td>
            <td>
                <!-- ajout des liens de modifications et suppression -->
            <a href="http://localhost/recettes_cuisine/index.php?page=recette&partie=privee&action=update&id=<?php echo htmlentities($p["id"]) ?>" class="btn btn-warning me-2">modifier</a>
            <a href="http://localhost/recettes_cuisine/index.php?page=recette&partie=privee&action=delete&id=<?php echo htmlentities($p["id"]) ?>" class="btn btn-danger" onclick="return confirm('voulez vous vraiment supprimer cette page ??')">supprimer</a>
            </td>
        </tr>
                <?php endforeach ?>


            </tbody>
        </table>
    </div>
</section>