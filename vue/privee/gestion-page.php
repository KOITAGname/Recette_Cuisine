 <!-- TABLE pages 4 elements dans le tableau
id clé primaire 
titre texte avec un maximum de 255 lettres 
contenu texte avec un maximum de 65 milles lettres 
dt_creation date et l'heure  -->
<?php 
    $sth = $connexion->prepare("
    SELECT id, titre , contenu, DATE_FORMAT(dt_creation , '%d/%m/%Y') AS `dt_creation`  FROM pages ;
    ");
    $sth->execute();
    $pages = $sth->fetchAll();
?>
<h1>Gestion des pages du site</h1>
<section class="row">
    <div class="col-3">
        <?php require "lib/menu-privee.php" ?>
    </div>
<div class="col">
<div class="text-end mb-3">
    <a href=" http://localhost/recettes_cuisine/index.php?page=page&partie=privee&action=add" class="btn btn-primary">ajouter une nouvelle page</a>
</div>
<!-- <//?php require "lib/message-flash.php" ?> -->
<table class="table table-striped">
    <thead>
        <tr>
            <th>id</th>
            <th>titre</th>
            <th>contenu</th>
            <th>date de création</th>
            <th>actions</th>
        </tr>
    </thead>
    <tbody>

    <?php foreach ($pages as $p) : ?>
            <tr>
    <td><?php echo htmlentities($p["id"]) ?></td>
    <td><?php echo htmlentities($p["titre"]) ?></td>
    <td><?php echo htmlentities($p["contenu"]) ?></td>
    <td><?php echo htmlentities($p["dt_creation"]) ?></td>
    <td>
        <!-- ajout des liens de modifications et suppression -->
    <a href="http://localhost/recettes_cuisine/index.php?page=page&partie=privee&action=update&id=<?php echo htmlentities($p["id"]) ?>" class="btn btn-warning me-2">modifier</a>
    <a href="http://localhost/recettes_cuisine/index.php?page=page&partie=privee&action=delete&id=<?php echo htmlentities($p["id"]) ?>" class="btn btn-danger" onclick="return confirm('voulez vous vraiment supprimer cette page ??')">supprimer</a>
    </td>
            </tr>
        <?php endforeach ?>


            </tbody>
        </table>
    </div>
</section>
