  <div class="container">
        <div>
            <!-- Affichage des erreurs si il y en a-->
            <?php if (isset($erreurs)) : ?>
            <div class="row">
                <div class="alert alert-danger text-center">
                    <strong><?= $erreurs ?></strong>
                </div>
            </div>
        <?php endif; ?>
        </div>


    <h2 class="text-center"><?= $titre ?></h2>


    <form action="" method="post" class="form-horizontal well">

        <div class="row">

           <?= $form ?>

           <div class="form-group">
                <div class="col-sm-5 col-sm-offset-5">
                    <input type="submit" class="btn btn-success btn-block" value="Valider" />
                </div>
            </div>
        </div>
        
    </form>

</div>