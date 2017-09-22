<h2 class="text-center"><?= $title ?></h2>

    <div class="well">
        <form action="" method="post" class="form-horizontal">

                <?= $form ?>


            <!-- Hidden Field for  -->
            <div class="form-group">
                <div class="col-sm-9">
                    <input type="hidden" name="salt" value="<?= substr(md5(time()), 0, 23); ?>" required disabled /><br />
                </div>
            </div>

            <input class="center-block btn btn-success" type="submit" value="Valider" />
        </form>
    </div>