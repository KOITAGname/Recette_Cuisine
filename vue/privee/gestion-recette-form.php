<?php if(isset($recette)) :?>
<!-- $recette est une variable -->
<!-- mettre à jour une nouvelle recette -->
<h1>mettre à jour une nouvelle recette</h1>
<?php else : ?>
    <h1>Créer une nouvelle recette</h1>
<?php endif ?>
<section class="row">
<div class="col-3">
        <?php require "lib/menu-privee.php" ?>
    </div>
    <div class="col"> 
    <form action="lib/traitement-recette.php" method="POST">
        <!--------------- creation du champ nom ------------->
    <div class="mb-3">
        <!-- récupération des valeurs dans le formulaire  avec value-->
    <label for="nom">nom du menu</label>
    <input type="text" class="form-control" 
    name="nom" placeholder="nom article" id="nom"
    value="<?php echo isset($recette) ? $recette["nom"] : "" ?>">
    </div>
<!--------- creation du champ preparation ------------>
    <div class="mb-3">
        <label for="preparation">preparation du menu</label>
        <input type="text" class="form-control" 
            name="preparation" placeholder="preparation article" id="preparation"
            value="<?php echo isset($recette) ? $recette["preparation"] : "" ?>">
    </div>
<!--------------- creation du champ prix ------------->
    <div class="mb-3">
        <label for="prix">prix du menu</label>
    <input type="number" class="form-control" 
    name="prix" placeholder="prix article" id="prix"
     value="<?php echo isset($recette) ? $recette["prix"] : "" ?>">
    </div>
<!-- creation du champ categorie 3 valeurs possibles entree / plat / dessert  -->
<div class="mb-3">
<label for="categorie">Votre categorie</label>
<select name="categorie" id="categorie" class="form-control">
    <option value="">Veuillez choisir un categorie</option>
    <option value="entree" <?php echo !empty($_SESSION["form"]["categorie"]) && $_SESSION["form"]["categorie"] === "entree" ? 'selected' : '' ?>>entree</option>
    <option value="plat" <?php echo !empty($_SESSION["form"]["categorie"]) && $_SESSION["form"]["categorie"] === "plat" ? 'selected' : '' ?>>plat</option>
    <option value="dessert"  <?php echo !empty($_SESSION["form"]["categorie"]) && $_SESSION["form"]["categorie"] === "dessert" ? 'selected' : '' ?>>dessert</option>
</select>
    

</div>
<!--------------- creation du champ image -------------------->
            <div class="mb-3">
                <label for="image">image</label>
                <input type="url" class="form-control" 
                    name="image" placeholder="url de l'image" id="image" 
                    value="<?php echo isset($recette) ? $recette["image"] : "" ?>">
            </div>
<!--------------- creation du champ auteur ------------------>
            <div class="mb-3">
                <label for="auteur">auteur</label>
                <input type="text" class="form-control" 
                    name="auteur" placeholder="auteur" id="auteur"  value="<?php echo isset($recette) ? $recette["auteur"] : "" ?>">
            </div>
<!--------------- creation du champ dt_creation ---------------------->
            <div class="mb-3">
                <label for="dt_creation">dt_creation du menu</label>
                <input type="date" class="form-control" 
                    name="dt_creation" placeholder="dt_creation article" id="dt_creation"
                    value="<?php echo isset($recette) ? $recette["dt_creation"] : "" ?>">
            </div>

            <!-- ajout du champ hidden -->
            <?php if(isset($recette)) : ?>
                <!-- champ qui permet de distinguer entre INSERT et l'UPDATE -->
                <input type="hidden" name="id" value="<?php echo $recette["id"] ?>">
            <?php endif ?>
<!--------- creation du boutton soumettre dans la page ----------->
            <div class="mb-3">
                <input type="submit" class="btn btn-success">
            </div>
        </form>
         <?php require "lib/message-flash.php" ?>
    </div>
</section>



 
