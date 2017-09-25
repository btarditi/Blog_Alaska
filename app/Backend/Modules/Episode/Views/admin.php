<h2 class="text-center" style="margin-top: 85px;margin-bottom: 30px;">Administration</h2>

<!-- NAV TABS  -->
    <div class="row">
        <div class="col-sm-6 col-sm-offset-3 col-md-10 col-md-offset-1">
            <ul class="nav nav-tabs nav-justified">
                <li><a href="#episode" data-toggle="tab">Episodes</a></li>
                <li><a href="#commentaire" data-toggle="tab">Commentaires</a></li>
                <li><a href="#users" data-toggle="tab">Utilisateurs</a></li>
            </ul>
        </div>
    </div>

<?php if(isset($listEpisode)): ?>
    <div class="tab-content">
        <div class="tab-pane fade in active adminTable" id="episode">
            <div class="table-responsive">
                <table class="table table-hover table-condensed">
                    <thead>
                        <tr>
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
<?php var_dump($listEpisode); ?>
                    <?php foreach($listEpisode as $episode): ?>
                    <tr>
                        <td class="text-center"><?= $episode['id'] ?></td>
                        <td><a href="../episode/episode-<?= $episode['id'] ?>.html"><?= htmlspecialchars($episode['titre']) ?></a></td>
                        <td><?= substr(htmlspecialchars(nl2br($episode['contenu'])), 0, 120) ?></td>
                        <td class="text-center"><?= $episode['auteur'] ?></td>
                        <td><?= $episode['dateAjout']->format('d/m/Y à H\hi') ?></td>
                        <td><?php if($episode['dateAjout'] != $episode['dateModif']) { echo $episode['dateModif']->format('d/m/Y à H\hi'); } ?></td>
                        <td>
                            <a href="/admin/episode-update-<?= $episode->id() ?>.html" class="btn btn-info" title="Modifier l\'épisode"><span class="glyphicon glyphicon-edit"></span></a>
                            <button type="button" class="btn btn-danger" title="Delete" data-toggle="modal" data-target="#episodeDialog"><span class="glyphicon glyphicon-remove"></span>
                            </button>
                            <div class="modal fade" id="episodeDialog" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                            <h4 class="modal-title" id="myModalLabel">Confirmation nécessaire</h4>
                                        </div>
                                        <div class="modal-body">
                                            Voulez vous vraiment supprimmer cet épisode ?
                                        </div>
                                        <div class="modal-footer">
                                            <a href="../episode-<?= $episode['id'] ?>" class="btn btn-default">Annuler</a>
                                            <a href="/admin/episode-delete-<?= $episode['id'] ?>.html" class="btn btn-danger">Confirmer</a>
                                        </div>
                                    </div><!-- /.modal-content -->
                                </div><!-- /.modal-dialog -->
                            </div><!-- /.modal -->
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </table>
            </div>
            <?php else: ?>
                <div class="alert alert-warning">Aucun épisode n'a été trouvé.</div>
            <?php endif; ?>
                <a  href="/admin/episode-insert-<?= $episode['id'] ?>.html" class="btn btn-success center-block"><span class="glyphicon glyphicon-plus"></span> Ajouter un épisode</a>
        </div>
        <div class="tab-pane fade adminTable" id="comments">
            <?php if(isset($listCommentaire)): ?>
                <div class="table-responsive">
                    <table class="table table-hover table-condensed">
                        <thead>
                        <tr>
                            <th>Identifiant</th>
                            <th>Chapitre</th>
                            <th>Auteur</th>
                            <th>Contenu</th>
                            <th>Nombre de signalement</th>
                            <th>Action</th>  <!-- Actions column -->
                        </tr>
                        </thead>

                        <p style="text-align: center; margin-top: 30px; margin-bottom: 30px;">Il y a actuellement <?= $nbCommentaire ?> commentaire(s), dont <?= $nbCommentsFlag ?> commentaire(s) qui ont été signalé. En voici la liste :</p>

                        <?php foreach ($listCommentaire as $commentaire): ?>

                        <tr <?php if($commentaire['flag'] != 0) { ?> style="background-color: darkred;" <?php } ?> >
                            <td class="text-center"><?= $commentaire['id'] ?></td>
                            <td><?= 'Episode '.$commentaire['episode']; ?></td>
                            <td><?= $commentaire['auteur']; ?></td>
                            <td><?= substr($commentaire['contenu'], 0, 20); ?></td>
                            <td class="text-center"><?= $commentaire['flag']; ?></td>
                            <td>
                                <a href="/admin/commentaire-update-<?= $commentaire['id'] ?>.html" class="btn btn-info" title="Modifier le commentaire"><span class="glyphicon glyphicon-edit"></span></a>
                                <button type="button" class="btn btn-danger" title="Supprimer le commentaire" data-toggle="modal" data-target="#commentDialog"><span class="glyphicon glyphicon-remove"></span>
                                </button>
                                <div class="modal fade" id="commentDialog" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                                <h4 class="modal-title" id="myModalLabel">Confirmation nécessaire</h4>
                                            </div>
                                            <div class="modal-body">
                                                Etes-vous sûr de vouloir supprimer ce commentaire  ?
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-default" data-dismiss="modal">Annuler</button>
                                                <a href="/admin/commentaire-delete-<?= $commentaire['id'] ?>.html" class="btn btn-danger">Confirmer</a>
                                            </div>
                                        </div><!-- /.modal-content -->
                                    </div><!-- /.modal-dialog -->
                                </div><!-- /.modal -->
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </table>
                </div>
            <?php else:  ?>
                <div class="alert alert-warning">Aucun commentaire n'a été trouvée.</div>
            <?php endif; ?>
        </div>
        <div class="tab-pane fade adminTable" id="users">
            <?php if(isset($listUser)): ?>
                <div class="table-responsive">
                    <table class="table table-hover table-condensed">
                        <thead>
                        <tr>
                            <th>Identifiant</th>
                            <th>Username</th>
                            <th>Rôle</th>
                            <th>Salage</th>
                            <th>Mot de passe</th>
                            <th></th>  <!-- Actions column -->
                        </tr>
                        </thead>

                        <p style="text-align: center; margin-bottom: 30px; margin-top: 30px;">Il y a actuellement <?= $nbUsers ?> utilisateur(s). En voici la liste :</p>

                        <?php foreach ($listUser as $user): ?>
                        <tr>
                            <td class="text-center"><?= $user['id'] ?></td>
                            <td class="text-center"><?= $user['username'] ?></td>
                            <td class="text-center"><?= $user['role'] ?></td>
                            <td><?= $user['salt'] ?></td>
                            <td><?= $user['password'] ?></td>
                            <td>
                                <a href="/admin/user-update-<?= $user['id'] ?>.html " class="btn btn-info" title="Modifier l\'utilisateur"><span class="glyphicon glyphicon-edit"></span></a>
                                <button type="button" class="btn btn-danger" title="Supprimer l\'utilisateur" data-toggle="modal" data-target="#userDialog"><span class="glyphicon glyphicon-remove"></span>
                                </button>
                                <div class="modal fade" id="userDialog" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                                <h4 class="modal-title" id="myModalLabel">Confirmation nécessaire</h4>
                                            </div>
                                            <div class="modal-body">
                                                Souhaitez vous vraiment supprimer cette utilisateur ?
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-default" data-dismiss="modal">Annuler</button>
                                                <a href="/admin/user-delete-<?= $user['id'] ?>.html" class="btn btn-danger">Confirmer</a>
                                            </div>
                                        </div><!-- /.modal-content -->
                                    </div><!-- /.modal-dialog -->
                                </div><!-- /.modal -->
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </table>
                </div>
            <?php else: ?>
                <div class="alert alert-warning">Aucun utilisateur n'a été trouvée.</div>
            <?php endif; ?>
            <a class="btn btn-success center-block" href="/users/user-insert.html"><span class="glyphicon glyphicon-plus"></span> Ajouter un utilisateur</a>

        </div>
    </div>