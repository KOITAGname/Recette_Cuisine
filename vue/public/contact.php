<h1>Nous contacter</h1>
<form action="lib/traitement-contact.php" method="POST">
    <div class="mb-3">
        <label for="email">Email</label>
        <!--  placeholder="votre@email.fr"  -->
        <input type="email" class="form-control" placeholder="" name="email" value="<?php echo isset($_SESSION["form"]["email"]) ? $_SESSION["form"]["email"] : ""  ?>">
    </div>
    <div class="mb-3">
        <label for="commentaire">Commentaire</label>
        <textarea name="commentaire" id="commentaire" cols="30" rows="10" class="form-control commentaire"><?php echo isset($_SESSION["form"]["commentaire"]) ? $_SESSION["form"]["commentaire"] : ""  ?></textarea>
    </div>
    <div>
        <input type="submit" class="button">
    </div>

</form>

<?php require "lib/message-flash.php" ?>

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
    $('textarea.commentaire').tinymce({
        height: 200,
        menubar: false,
        toolbar: 'undo redo | blocks | bold italic backcolor | ' +
          'alignleft aligncenter alignright alignjustify | ' +
          'bullist numlist outdent indent | removeformat | help'
      });
</script>