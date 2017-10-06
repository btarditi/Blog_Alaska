<h2 class="text-center"><?= $titre ?></h2>

<!-- Affichage des erreurs si il y en a-->
<?php if (isset($erreurs)) : ?>
    <div class="row">
        <div class="alert alert-danger text-center">
            <strong><?= $erreurs ?></strong>
        </div>
    </div>
<?php endif; ?>

<div class="row">
    <div class="well">

        <form class="form-horizontal" action="" method="post">

            <?= $form ?>

            <div class="form-group">
                <div class="col-sm-9 col-sm-offset-3">
                    <input type="submit" class="btn btn-primary btn-block" value="Valider" />
                </div>
            </div>

            <!-- TinyMCE -->
            <script src='https://cloud.tinymce.com/stable/tinymce.min.js?apiKey=pdrmf4bzda88287gylsko1q67ss9zm95ipd82ta1sw2dgnb2'></script>
            <script>
                tinymce.init({
                    selector: 'textarea'
                });
            </script>
        </form>
    </div>
</div>