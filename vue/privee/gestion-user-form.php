<!-- <h1 class="mb-4">Ajouter un nouveau profil user</h1> -->
<!-- //nous permet de modifier un profil utilisateur -->
<?php if(isset($user)) :?>
    <h1 class="mb-4">Mettre à jour un profil user</h1>
<?php else : ?>
    <h1 class="mb-4">Ajouter un nouveau profil user</h1>
<?php endif ?>

<section class="row">
    <div class="col-3">
        <?php require "lib/menu-privee.php" ?>
    </div>
    <div class="col">
       <form action="lib/traitement-user.php" method="POST">
    <!---------------- le champ nom  ----------------->
        <div class="mb-3">
        <label for="nom"> saisir le nom</label>
        <!-- on na ajouter un value pour garde les information saisi precedenment pour la modification des profils utilisateurs -->
        <input type="text" id="nom"  class="form-control" name="nom" placeholder="le nom"   value="<?php echo isset($user) ? $user["nom"] : "" ?>">
 <!---------------- le champ email  ----------------->
        </div>
        <div class="mb-3">
        <label for="email"> saisir le email</label>
        <input type="email" id="email"  class="form-control" 
        name="email" placeholder="votre@email.fr"  value="<?php echo isset($user) ? $user["email"] : "" ?>">
        </div>
 <!-------------------- le champ password  ------------------->
        <div class="mb-3">
<!-- <label for="password"> saisir le password</label> -->
<!-- on n'ajouter du php pour garde les information saisi precedenment pour la modification des profils utilisateurs -->
                <?php if(isset($user)) : ?>
                    <label for="password"> 
                        laisser le champ password vide si vous ne voulez pas le modifier 
                    </label>
                <?php else : ?>
                    <label for="password"> saisir le password</label>
                <?php endif ?>
<!-----------------  modification profil utilisation ------------->

                <input type="text" id="password"  class="form-control" 
                        name="password" placeholder="votre password">
            </div>
            
    <!-- nous permet de faire la difference entre modifier et inserer des profil utilisateurs  -->
    <?php if(isset($user)) : ?>
<!-- champ qui permet de distinguer entre INSERT et l'UPDATE -->
<!--<input type="hidden" name="id" value="<//?php echo $user["status"] ?>"> -->

<input type="hidden" name="id" value="<?php echo $user["id"] ?>">
            <?php endif ?>

            <div class="mb-3">
                <input type="submit" class="btn btn-success">
            </div>
       </form>
    <?php require "lib/message-flash.php" ?> 
    </div>
</section>