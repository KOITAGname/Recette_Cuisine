<?php if(!empty($_SESSION["message"])) : ?>
    <?php if($_SESSION["message"]["alert"] === "success") : ?> 
        <p class="alert alert-success" >
            <?php echo $_SESSION["message"]["info"]  ?>
        </p>
    <?php elseif($_SESSION["message"]["alert"] === "danger") : ?> 
        <p class="bg-danger">
            <?php foreach($_SESSION["message"]["info"] as $i) : ?>
                <?php echo $i  ?><br>
            <?php endforeach ?>
        </p>
    <?php endif ?>
    <?php unset($_SESSION["message"]); 
    // supprimer une variable 
    ?>
<?php endif ?>
