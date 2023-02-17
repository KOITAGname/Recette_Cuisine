<h1>Créer une page</h1>
<section class="row">
<div class="col-3">
        <?php require "lib/menu-privee.php" ?>
    </div>
    <div class="col"> 
    <form action="lib/traitement-page.php" method="POST">
            <div class="mb-3">
                <!-- récupération des valeurs dans le formulaire  avec value-->
                <label for="titre">titre de l'article</label>
                <input type="text" class="form-control" 
                    name="titre" placeholder="titre article" id="titre"
                    value="<?php echo isset($page) ? $page["titre"] : "" ?>">
            </div>
            
            <div class="mb-3">
                <label for="contenu">contenu article</label>
                <textarea name="contenu" id="contenu" class="form-control" rows="5" 
                    placeholder="contenu article"><?php echo isset($page) ? $page["contenu"] : "" ?></textarea>
            </div>
            
            <!-- ajout du champ hidden -->
            <?php if(isset($page)) : ?>
                <!-- champ qui permet de distinguer entre INSERT et l'UPDATE -->
                <input type="hidden" name="id" value="<?php echo $page["id"] ?>">
            <?php endif ?>
<!--------- creation du boutton soumettre dans la page ----------->
            <div class="mb-3">
                <input type="submit" class="btn btn-success">
            </div>
        </form>
        <?php require "lib/message-flash.php" ?>
    </div>
</section>
<!-- ajouter un peu de js pour transformer le textarea en textarea enrichit => avec des boutons en dessus qui vont permettre de mettre du html dans le champ ! 
librairie javascript => TinyMCE (Wordpress)
https://www.tiny.cloud/docs/tinymce/6/jquery-cloud/
--> 
<script
      src="https://code.jquery.com/jquery-3.6.0.min.js"
      integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4="
      crossorigin="anonymous"
    ></script>
    <script
      src="https://cdn.tiny.cloud/1/no-api-key/tinymce/6/tinymce.min.js"
      referrerpolicy="origin"
    ></script>
    <script src="https://cdn.jsdelivr.net/npm/@tinymce/tinymce-jquery@2/dist/tinymce-jquery.min.js"></script>
<script>
    $('textarea#contenu').tinymce({
        height: 200,
        menubar: false,
        toolbar: 'undo redo | blocks | bold italic backcolor | ' +
          'alignleft aligncenter alignright alignjustify | ' +
          'bullist numlist outdent indent | removeformat | help'
      });
</script>