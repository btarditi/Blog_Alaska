<h2 class="text-center"><?= $titre ?></h2>

<!-- Affichage des erreurs si il y en a-->
<?php if (isset($erreurs)) : ?>
    <div class="row">
        <div class="alert alert-danger text-center">
            <strong><?= $erreurs ?></strong>
        </div>
    </div>
<?php endif; ?>

<div class="well">
        <form action="" method="post" class="form-horizontal" >

            <?= $form ?>

            <br>

            <div class="form-group">
                <div class="col-sm-9 col-sm-offset-3">
                    <input type="submit" class="btn btn-primary btn-block" value="Valider" />
                </div>
            </div>
        </form>
    </div>

