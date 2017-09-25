<div class="well" style="margin-top: 70px;">
    <div class="panel panel-default">
        <div class="panel-heading">
            <h2 class="text-center"><?= $episode['titre'] ?></h2>
        </div>
        <div class="panel-body">
            <p><?= htmlspecialchars(nl2br($episode['contenu'])) ?></p>
        </div>
        <div style="min-height: 40px;" class="panel-footer">
            Par <em><?= htmlspecialchars($episode['auteur']) ?></em>, le <?= $episode['dateAjout']->format('d/m/Y à H\hi') ?>
            <?php if ($episode['dateAjout'] != $episode['dateModif']) { ?>
                <p style="text-align: right;" class="pull-right"><small><em>Modifiée le <?= $episode['dateModif']->format('d/m/Y à H\hi') ?></em></small></p>
            <?php } ?>
        </div>
    </div>
</div>

<div class="flashMessage">
    <?php if ($user->hasFlash()) { echo '<p class="text-center">', $user->getFlash(), '</p>'; } ?>
</div>


<?php if ($user->isAuthenticated() && $user->isUser()): ?>
    <p><a class="btn btn-success center-block" href="/comment/insert-comment.html">Ajouter un commentaire</a></p>
<?php endif; ?>


<?php if (empty($commentaire)) { ?>
    <p>Aucun commentaire n'a encore été posté. Soyez le premier à en laisser un !</p>
<?php } else 
{ ?>

<!--    Si l'utilisateur est conecter alors on affiche le formulaire -->
<?php if ($user->isAuthenticated() && $user->isUser()): ?>    
    <div class="well">
        <form action="" method="post" class="form-horizontal">
            <div class="form-group">
                <label for="username" class="control-label col-sm-3">Votre pseudo :</label>
                <div class="col-sm-9">
                    <input class="form-control" type="text" name="username" required  />
                </div>
            </div>

            <div class="form-group">
                <label for="content" class="control-label col-sm-3">Votre commentaire :</label>
                <div class="col-sm-9">
                    <textarea name="contenu" cols="30" rows="10"></textarea>
                </div>
            </div>

            <div class="form-group">
                <label class="control-label col-sm-3"></label>
                <div class="col-sm-9">
                    <input class="btn btn-success center-block col-md-12 col-md-offset-1 " type="submit" value="Commenter" />
                </div>
            </div>
        </form>    
    </div>
<?php endif; ?>


<div class="well">
    
        <?php foreach ($commentaire as $comment) : ?>
            <div class="panel panel-default episode">

                <div class="panel-heading">
                    Posté par <strong><?= htmlspecialchars($comment['auteur']) ?></strong>
                </div>

                <div class="panel-body">
                    <p>
                        <?= nl2br(htmlspecialchars($comment['contenu'])) ?>
                        <?php if ($user->isAuthenticated() && $user->isUser()) : ?>
                            <p class="pull-right">
                                <a class="btn btn-warning" title="Signaler le commentaire" href="/commentaire/flag-comment-<?= $comment['id'] ?>.html"><span class="glyphicon glyphicon-flag"> </span> </a>
                            </p>
                        <?php endif; ?>
                    </p>
                </div>

                <div class="panel-footer" style="min-height: 60px;">
                    <?php if ($user->isAUthenticated()): ?>
                        <p class="pull-left">
                            <a class="btn btn-info" title="Modifier le commentaire" href="/commentaire/comment-update-<?= $comment['id'] ?>.html"><span class="glyphicon glyphicon-pencil"></span> </a>
                            <a class="btn bn-danger" title="Supprimer le commentaire" href="/commentaire/comment-delete-<?= $comment['id'] ?>.html"><span class="glyphicon glyphicon-remove"></span> </a>
                        </p>
                    <?php  else : ?>
                        <p class="text-center"><a href="/connexion/user.html" >Connectez-vous</a> ou <a href="/user/register.html" >Inscrivez-vous</a> pour ajouter un commentaire</p>
                    <?php endif; ?>

                </div>
            </div>
        <?php endforeach; ?>

    <?php
}




    
