
<h2 class="text-center" style="margin-top: 85px;margin-bottom: 30px;">Administration</h2>

<!-- NAV TABS  -->
    <div class="row">
        <div class="col-sm-6 col-sm-offset-3 col-md-10 col-md-offset-1">
            <ul class="nav nav-tabs nav-justified">
                <li><a href="#episode" data-toggle="tab">Episodes</a></li>
                <li><a href="#commentaire" data-toggle="tab">Commentaires</a></li>
                <li><a href="#user" data-toggle="tab">Utilisateurs</a></li>
            </ul>
        </div>
    </div>

<?php if(isset($listEpisode)): ?>
    <div class="tab-content">
        <div class="tab-pane fade in active adminTable" id="episode">
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr class="table">
                            <th>Identifiant</th>
                            <th>Titre</th>
                            <th>Contenu</th>
                            <th>Auteur</th>
                            <th>Ajouté le</th>
                            <th>Modifié</th>
                            <th></th>  <!-- Actions column -->
                        </tr>
                    </thead>
                    
                    <p style="text-align: center; margin-top: 30px; margin-bottom: 30px;">Il y a actuellement <?= $nbEpisode ?> épisode(s). En voici la liste :</p>

                    <?php foreach($listEpisode as $episode): ?>
                    <tr>
                        <td class="text-center"><?= $episode->id() ?></td>
                        <td><a href="../episode/episode-<?= $episode->id() ?>.html"><?= htmlspecialchars($episode->titre()) ?></a></td>
                        <td><?= substr(nl2br($episode->contenu()), 0, 25) ?></td>
                        <td class="text-center"><?= htmlspecialchars($episode->auteur()) ?></td>
                        <td><?= $episode->dateAjout()->format('d/m/Y à H\hi') ?></td>
                        <td><?php if($episode->dateAjout() != $episode->dateModif()) { echo $episode->dateModif()->format('d/m/Y à H\hi'); } ?></td>
                        <td>
                            <a href="/admin/episode-update-<?= $episode->id() ?>.html" class="btn btn-info" title="Modifier l\'épisode = <?= $episode->id() ?>"><span class="glyphicon glyphicon-edit"></span></a>
                            <a href="/admin/episode-delete-<?= $episode->id() ?>.html" class="btn btn-danger" title="Supprimer le chapitre = <?= $episode->id() ?>"><span class="glyphicon glyphicon-edit"></span></a>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </table>
            </div>
            <?php else: ?>
                <div class="alert alert-warning">Aucun épisode n'a été trouvé.</div>
            <?php endif; ?>
                <a  href="/admin/episode-insert.html" class="btn btn-success center-block"><span class="glyphicon glyphicon-plus"></span> Ajouter un épisode</a>
        </div>
        <div class="tab-pane fade adminTable" id="commentaire">
            
            <?php if(isset($listCommentaire)): ?>
                <div class="table-responsive">
                    <table class="table table-hover table-condensed">
                        <thead>
                        <tr class="text-center">
                            <th>Identifiant</th>
                            <th>Episode</th>
                            <th>Auteur</th>
                            <th>Contenu</th>
                            <th>Nombre de signalement</th>
                            <th>Action</th>  <!-- Actions column -->
                        </tr>
                        </thead>
                        
                        <p style="text-align: center; margin-top: 30px; margin-bottom: 30px;">Il y a actuellement <?= $nbCommentaire ?> commentaire(s), dont <?= $nbCommentaireFlag ?> commentaire(s) qui ont été signalé. En voici la liste :</p>

                        <?php foreach ($listCommentaire as $commentaire): ?>

                        <tr <?php if($commentaire->flag() != 0) { ?> style="background-color: red;" <?php } ?> >
                            <td class="text-center"><?= htmlspecialchars($commentaire->id()) ?></td>
                            <td class="text-center"><?= $commentaire->episodeId() ?></td>
                            <td><?= htmlspecialchars($commentaire->auteur()); ?></td>
                            <td><?= substr($commentaire->contenu(), 0, 20) . ' ...'; ?></td>
                            <td class="text-center"><?= $commentaire->flag(); ?></td>
                            
                            <td>
                                <a href="/admin/commentaire-update-<?= $commentaire->id() ?>.html" class="btn btn-info" title="Modifier le commentaire = <?= $commentaire->id() ?>"><span class="glyphicon glyphicon-edit"></span></a>
                                
                                <a href="/admin/commentaire-delete-<?= $commentaire->id() ?>.html" class="btn btn-danger" title="Supprimer le commentaire = <?= $commentaire->id() ?>"><span class="glyphicon glyphicon-edit"></span></a>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </table>
                </div>
            <?php else:  ?>
                <div class="alert alert-warning">Aucun commentaire n'a été trouvé.</div>
            <?php endif; ?>
        </div>
        <div class="tab-pane fade adminTable" id="user">
            
            <?php if(isset($listUser)): ?>
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                        <tr>
                            <th>Identifiant</th>
                            <th>Username</th>
                            <th>E-Mail</th>
                            <th>Rôle</th>
                            <th>Salage</th>
                            <th>Mot de passe</th>
                            <th>Inscription</th>
                            <th></th>  <!-- Actions column -->
                        </tr>
                        </thead>
                        
                        <p style="text-align: center; margin-bottom: 30px; margin-top: 30px;">Il y a actuellement <?= $nbUser ?> utilisateur(s). En voici la liste :</p>
                        
                        <?php foreach ($listUser as $user): ?>
                        <tr>
                            <td class="text-center"><?= $user->id() ?></td>
                            <td class="text-center"><?= htmlspecialchars($user->username()) ?></td>
                            <td class="text-center"><?= $user->email() ?></td>
                            <td class="text-center">
                                <a href="/admin/switch-role-<?= $user->id() ?>.html" class="btn btn-default"><span class="glyphicon glyphicon-adjust" title="Intervertir le rôle utilisateur USER ou ADMIN"> <?= htmlspecialchars($user->role()) ?></span></a></td>
                            <td><?= $user->salt() ?></td>
                            <td><?= substr($user->password(), 0, 15 ).'...' ?></td>
                            <td><?= $user->inscription() ?></td>
                            <td>
                                <a href="/admin/user-update-<?= $user->id() ?>.html " class="btn btn-info" title="Modifier l\'utilisateur <?= $user->id(); ?>"><span class="glyphicon glyphicon-edit"></span></a>
                                <a href="/admin/user-delete-<?= $user->id()?>.html" class="btn btn-danger" title="Supprimer l\'utilisateur <?= $user->id(); ?>"><span class="glyphicon glyphicon-remove"></span></a>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </table>
                </div>
            <?php else: ?>
                <div class="alert alert-warning">Aucun utilisateur n'a été trouvé.</div>
            <?php endif; ?>
            <a class="btn btn-success center-block" href="/admin/user-insert.html"><span class="glyphicon glyphicon-plus"></span> Ajouter un utilisateur</a>

        </div>
</div>