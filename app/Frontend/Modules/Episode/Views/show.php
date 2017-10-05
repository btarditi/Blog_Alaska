<div class="row" >
        <article class="col-md-8 col-md-offset-2 col-xs-8 col-xs-offset-2 panel panel-default">
            <h2 class="panel-heading text-center well">
                <?= $episode->titre() ?>
            </h2>

            <div class="panel-body well">
                <?= nl2br($episode->contenu()) ?>
            </div>

            <div class="panel-footer">
                <p class="text-center">
                    <?php if ($episode->dateAjout() != $episode->dateModif()) : ?>
                        <?= 'Modifié le ' . $episode->dateModif()->format(' d/m/Y à H\hi'); ?>
                    <?php  else : ?>
                        <?= 'Publié le ' . $episode->dateAjout()->format(' d/m/Y à H\hi'); ?>
                    <?php endif; ?>
                </p>
            </div>
        </article>
</div>

<div class="row">

        <?php if ($user->isAuthenticated()) : ?>
            <p class="col-md-8 col-md-offset-2 col-xs-8 col-xs-offset-2"><a class="btn btn-success center-block" href="/commentaire/insert-commentaire-<?= $episode->id() ?>.html">Ajouter un commentaire</a></p>
        <?php endif; ?>

</div>

<div class="row">
     <?php if (empty($commentaire)) : ?>
         <div class="row">
             <div class="text-center">
                 <p class=" center-block text-info">Aucun commentaire n'a encore été posté. Soyez le premier à en laisser un !</p>
             </div>
         </div>
         <div class="row">
             <?php if (!$user->isAuthenticated()) : ?>
                 <p class="text-center text-danger"><a href="/admin/connect.html" >Connectez-vous</a> ou <a href="/admin/user-insert.html" >Inscrivez-vous</a> pour ajouter un commentaire</p>
             <?php endif; ?>
         </div>
     <?php  else : ?>

         <?php if (!$user->isAuthenticated()) : ?>
             <p class="text-center text-danger"><a href="/admin/connect.html" >Connectez-vous</a> ou <a href="/admin/user-insert.html" >Inscrivez-vous</a> pour ajouter un commentaire</p>
         <?php endif; ?>

         <?php foreach ($commentaire as $commentaire) : ?>
             <div class="col-md-8 col-md-offset-2 col-xs-8 col-xs-offset-2 panel panel-default comment">
                 <div class="panel-heading">
                     Posté par <strong><?= htmlspecialchars($commentaire->auteur()) ?></strong>
                     <span class="pull-right" >
                         <a class="btn btn-xs btn-warning" title="Signaler le commentaire" href="/commentaire/flag-comment-<?= $commentaire->id() ?>.html"><span class="glyphicon glyphicon-flag"></span></a>
                     </span>
                 </div>

                 <div class="panel-body">
                     <p>
                         <?= nl2br(htmlspecialchars($commentaire->contenu())) ?>
                     </p>
                 </div>

                 <div class="panel-footer" style="min-height: 60px;">
                     <?php if ($user->isAUthenticated() && $user->isAdmin()) : ?>
                         <p class="pull-left">
                             <a class="btn btn-info" title="Modifier le commentaire" href="/admin/commentaire-update-<?= $commentaire->id() ?>.html"><span class="glyphicon glyphicon-pencil"></span> </a>
                             <a class="btn bn-warning" title="Supprimer le commentaire" href="/admin/commentaire-delete-<?= $commentaire->id() ?>.html"><span class="glyphicon glyphicon-remove"></span> </a>
                         </p>
                     <?php endif; ?>

                 </div>
             </div>
         <?php endforeach; ?>

     <?php endif; ?>
 </div>






    
