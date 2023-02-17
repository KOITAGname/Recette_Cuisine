
<!-- TABLE users
id clé primaire 
nom texte avec un maximum de 255 lettres 
email texte avec un maximum de 255 lettres 
password texte avec un maximum de 255 lettres 
dt_creation date et l'heure  -->
<?php
$sth = $connexion->prepare("
    SELECT id, email, commentaire, DATE_FORMAT(dt_creation , '%d/%m/%Y') AS `dt_creation`
    FROM contacts
");
//nous permet de recuperer les profils dans la base de donnees
$sth->execute();
$contact = $sth->fetchAll();
?>
<h1>Gestion des contacts</h1>
<section class="row">
    <div class="col-3">
    <?php require "lib/menu-privee.php" ?>
    </div>
    <div class="col">
        <!-- <div class="text-end mb-3"> -->
         <a href="http://localhost/recettes_cuisine/index.php?page=contact&partie=privee&action=add" class="btn btn-primary">ajouter un nouveau contact</a> 
        </div> 
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>id</th>
                    <th>email</th>
                    <th>commentaire</th>
                    <th>date de création</th>
                   
                </tr>
            </thead>
<!------ on fait appel a la variable contact declarer plus haut -------->
            <?php foreach($contact as $c) : ?>
            <td><?php echo htmlentities($c["id"]) ?></td>
            <td><?php echo htmlentities($c["email"]) ?></td>
            <td><?php echo htmlentities($c["commentaire"]) ?></td>
            <td><?php echo htmlentities($c["dt_creation"]) ?></td>
            <td>
<!-- le php dans le lien cliquable nous permet de modifier un profil utlisateur -->
<a href="http://localhost/recettes_cuisine/index.php?page=contact&partie=privee&action=update&id=<?php echo htmlentities($c["id"]) ?>" class="btn btn-warning me-2" > modifier</a>

<!-- le php dans le lien cliquable nous permet de suppimmer un profil utlisateur -->
<a href="<?php echo "http://localhost/recettes_cuisine/index.php"?>?page=contact&partie=privee&action=delete&id=<?php echo htmlentities($c["id"]) ?> class="btn btn-danger" onclick="return confirm('etes vous sur de vouloir supprimer ce profil')"> supprimer</a>
                    </td>
                </tr>
                <?php endforeach ?>



        </table>
    </div>

    </table>
</section>