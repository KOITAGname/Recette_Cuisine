<!-- //nous permet de modifier un profil utilisateur -->
<?php if(isset($contact)) :?>
    <h1 class="mb-4">Mettre à jour un profil contact</h1>
<?php else : ?>
    <h1 class="mb-4">Ajouter un nouveau profil contact</h1>
<?php endif ?>

<section class="row">
    <div class="col-3">
        <?php require "lib/menu-privee.php" ?>
    </div>
    <div class="col">
       <form action="lib/traitement-contact.php" method="POST">
    <!---------------- le champ nom  ----------------->
    <!-- on na ajouter un value pour garde les information saisi precedenment pour la modification des profils utilisateurs -->
        <div class="mb-3">
        <label for="nom"> saisir le nom</label>
        <input type="text" id="nom"  class="form-control" name="nom" placeholder="le nom"   value="<?php echo isset($contact) ? $contact["nom"] : "" ?>">
 <!---------------- le champ email  ----------------->
        </div>
        <div class="mb-3">
        <label for="email"> saisir le email</label>
        <input type="email" id="email"  class="form-control" 
        name="email" placeholder="votre@email.fr"  value="<?php echo isset($contact) ? $contact["email"] : "" ?>">
        </div>
 <!-------------------- le champ commentaire  ------------------->
 <div class="mb-3">
                <label for="commentaire">commentaire sur le menu </label>
                <textarea name="commentaire" id="commentaire" class="form-control" rows="5" 
                placeholder="commentaire article"><?php echo isset($page) ? $page["commentaire"] : "" ?></textarea>
            </div>
        
    <!-- nous permet de faire la difference entre modifier et inserer des profil utilisateurs  -->
    <?php if(isset($contact)) : ?>
<!-- champ qui permet de distinguer entre INSERT et l'UPDATE -->
<!--<input type="hidden" name="id" value="<//?php echo $user["status"] ?>"> -->
<!--------- creation du boutton soumettre dans la page ----------->
<input type="hidden" name="id" value="<?php echo $contact["id"] ?>">
            <?php endif ?>

            <div class="mb-3">
                <input type="submit" class="button">
            </div>
       </form>
       <php require "lib/message-flash.php" ?>
    </div>
</section>

