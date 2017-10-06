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

      <div class="row">
            <div class="col-md-offset-2 col-md-8">
                <h1 class="text-center"><?= $titre ?> . <br/><small> Merci de renseigner vos informations </small>
                </h1>
            </div>
        </div>

        <br/>
    <form action="" method="post" class="form-horizontal">

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