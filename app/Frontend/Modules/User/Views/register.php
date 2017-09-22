<h2 class="text-center" style="margin-bottom: 25px;"><?= $title ?></h2>

<?php if(isset($erreurs)): ?>
    <div class="alert alert-danger">
        <strong>Login failed</strong> <?= $erreurs ?>
    </div>
<?php endif; ?>

<div class="well">
    <form class="form-horizontal" action="" method="post">

            <?= $form; ?>


            <!-- Hidden Field for  -->
        <div class="form-group">
            <div class="col-sm-9">
                <input type="hidden" name="salt" value="<?= substr(md5(time()), 0, 23); ?>" required disabled /><br />
                <input type="hidden" name="role" value="ROLE_USER" required disabled /><br />
            </div>
        </div>

        <input class="center-block btn btn-success" type="submit" value="Valider">
    </form>
</div>