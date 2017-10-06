<hr>
<h2 class="text-center"><?= $titre; ?></h2>
<hr>

<!-- Affichage des erreurs si il y en a-->
<?php if (isset($erreurs)) : ?>
    <div class="row">
        <div class="alert alert-danger">
            <strong>Login failed</strong> <?= $erreurs ?>
        </div>
    </div>
<?php endif; ?>

     <form action="" method="post" class="form-horizontal well">
       
        <?= $form ?>
         
 <?= 'MDP = 12345' ?>
        
        <div class="form-group">
            <div class="col-sm-9 col-sm-offset-3">
                <input type="submit" class="btn btn-success btn-block" value="Connexion" />
            </div>
        </div>
    </form>
