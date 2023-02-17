<!-- TABLE users
id clé primaire 
nom texte avec un maximum de 255 lettres 
email texte avec un maximum de 255 lettres 
password texte avec un maximum de 255 lettres 
dt_creation date et l'heure  -->
<?php
$sth = $connexion->prepare("
    SELECT id, nom, email, password, DATE_FORMAT(dt_creation , '%d/%m/%Y') AS `dt_creation`
    FROM users
");
//nous permet de recuperer les profils dans la base de donnees
$sth->execute();
$resultat = $sth->fetchAll();
?>
<h1>Gestion des utilisateurs</h1>
<section class="row">
    <div class="col-3">
    <?php require "lib/menu-privee.php" ?>
    </div>
    <div class="col">
        <div class="text-end mb-3">
        <a href="http://localhost/recettes_cuisine/index.php?page=user&partie=privee&action=add" class="button">ajouter un nouveau profil</a> 
        </div>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>id</th>
                    <th>nom</th>
                    <th>email</th>
                    <th>password</th>
                    <th>date de création</th>
                   
                </tr>
            </thead>
            <?php foreach($resultat as $user) : ?>
            <td><?php echo htmlentities($user["id"]) ?></td>
            <td><?php echo htmlentities($user["nom"]) ?></td>
            <td><?php echo htmlentities($user["email"]) ?></td>
            <td><?php echo htmlentities($user["password"]) ?></td>
            <td><?php echo htmlentities($user["dt_creation"]) ?></td>
            <td>
<!-- le php dans le lien cliquable nous permet de modifier un profil utlisateur -->
<a href="http://localhost/recettes_cuisine/index.php?page=user&partie=privee&action=update&id=<?php echo htmlentities($user["id"]) ?>" class="btn btn-warning me-2" > modifier</a>

<!-- le php dans le lien cliquable nous permet de suppimmer un profil utlisateur -->
<a href="<?php echo "http://localhost/recettes_cuisine/index.php"?>?page=user&partie=privee&action=delete&id=<?php echo htmlentities($user["id"]) ?> class="btn btn-danger" onclick="return confirm('etes vous sur de vouloir supprimer ce profil')"> supprimer</a>
                    </td>
                </tr>
                <?php endforeach ?>



        </table>
    </div>

    </table>
</section>