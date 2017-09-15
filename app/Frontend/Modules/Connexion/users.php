<h2 class="text-center"><?= $titre; ?></h2>

<?php if (isset($erreurs)) : ?>
    <div class="alert alert-danger">
        <strong>Login failed</strong> <?= $erreurs ?>
    </div>
<?php endif; ?>

<div class="well">
    <form action="" method="post" class="form-horizontal">
       

        <?= $form ?>
        


        
        <div class="form-group">
            <div class="col-sm-9 col-sm-offset-3">
                <button type="submit" class="btn btn-success btn-block">Connexion</button>
            </div>
        </div>
    </form>
</div>