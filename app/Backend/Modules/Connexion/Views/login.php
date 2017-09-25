 <h2 class="text-center"><?= $titre; ?></h2>

<?php if (isset($erreurs)) : ?>
    <div class="row">
        <div class="alert alert-danger">
            <strong>Login failed</strong> <?= $erreurs ?>
        </div>
    </div>
<?php endif; ?>

    <form action="" method="post" class="form-horizontal">
       
        <?= $form ?>
        
        <div class="form-group">
            <div class="col-sm-9 col-sm-offset-3">
                <button type="submit" class="btn btn-success btn-block">Connexion</button>
            </div>
        </div>
    </form>
