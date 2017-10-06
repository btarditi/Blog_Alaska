
<h2 class="text-center" style="margin-top: 85px;margin-bottom: 30px;">Administration</h2>

    <!-- NAV TABS  -->
<div class="row">
    <div class="col-sm-6 col-sm-offset-3 col-md-10 col-md-offset-1">
        <ul class="nav nav-tabs nav-justified">

            <li><a href="#chapters" data-toggle="tab">Chapitres</a></li>

            <li><a href="#comments" data-toggle="tab">Commentaires</a></li>

            <li><a href="#users" data-toggle="tab">Utilisateurs</a></li>

        </ul>
    </div>
</div>

<?php if(isset($chaptersList)): ?>
    <div class="tab-content">
        <div class="tab-pane fade in active adminTable" id="chapters">
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr class="table">
                            <th class="text-center">Id</th>
                            <th class="text-center">Titre</th>
                            <th class="text-center">Contenu</th>
                            <th class="text-center">Auteur</th>
                            <th class="text-center">Créer le</th>
                            <th class="text-center">Modifié</th>
                            <th></th>  <!-- Actions column -->
                        </tr>
                    </thead>

                    <p style="text-align: center; margin-top: 30px; margin-bottom: 30px;">Il y a actuellement <?= $nbChapters ?> chapitre(s). En voici la liste :</p>

                    <?php foreach($chaptersList as $chapter): ?>
                    <tr>
                        <td class="text-center"><?= $chapter->id() ?></td>
                        <td><a href="../chapters/chapter-<?= $chapter->id() ?>.html"><?= htmlspecialchars($chapter['title']) ?></a></td>
                        <td><?= substr(nl2br($chapter->content()), 0, 25) ?></td>
                        <td class="text-center"><?= htmlspecialchars($chapter->author()) ?></td>
                        <td><?= $chapter->dateCreate()->format('d/m/Y à H\hi') ?></td>
                        <td><?php if($chapter->dateCreate() != $chapter->lastModif()) { echo $chapter->lastModif()->format('d/m/Y à H\hi'); } ?></td>
                        <td>
                            <a href="/admin/chapter-update-<?= $chapter->id() ?>.html" class="btn btn-info" title="Modifier le chapitre d\'id = <?= $chapter->id() ?>"><span class="glyphicon glyphicon-edit"></span></a>

                            <a href="/admin/chapter-delete-<?= $chapter->id() ?>.html" class="btn btn-danger" title="Supprimer le chapitre d\'id = <?= $chapter->id() ?>"><span class="glyphicon glyphicon-edit"></span></a>

                        </td>
                    </tr>

                    <?php endforeach; ?>
                </table>
            </div>
            <?php else: ?>
                <div class="alert alert-warning">Aucun chapitre n'a été trouvée.</div>
            <?php endif; ?>
                <a  href="/admin/chapter-insert.html" class="btn btn-success center-block"><span class="glyphicon glyphicon-plus"></span> Ajouter un chapitre</a>
        </div>
        <div class="tab-pane fade adminTable" id="comments">
            <?php if(isset($commentsList)): ?>
                <div class="table-responsive">
                    <table class="table table-hover table-condensed">
                        <thead>
                        <tr  class="text-center">
                            <th>Identifiant</th>
                            <th>Chapitre</th>
                            <th>Auteur</th>
                            <th>Contenu</th>
                            <th>Nombre de signalement</th>
                            <th>Action</th>  <!-- Actions column -->
                        </tr>
                        </thead>

                        <p style="text-align: center; margin-top: 30px; margin-bottom: 30px;">Il y a actuellement <?= $nbComments ?> commentaire(s), dont <?= $nbCommentsSignaled ?> commentaire(s) qui ont été signalé. En voici la liste :</p>

                        <?php foreach ($commentsList as $comment): ?>

                        <tr <?php if($comment->flag() != 0) { ?> style="background-color: darkred;" <?php } ?> >
                            <td class="text-center"><?= $comment->id(); ?></td>
                            <td class="text-center"><?= $comment->chapter(); ?></td>
                            <td><?= $comment->author(); ?></td>
                            <td><?= substr($comment->content(), 0, 20) . ' ...'; ?></td>
                            <td class="text-center"><?= $comment->flag(); ?></td>
                            <td>
                                <a href="/admin/comment-update-<?= $comment->id() ?>.html" class="btn btn-info" title="Modifier le commentaire d\'id = <?= $comment->id() ?>"><span class="glyphicon glyphicon-edit"></span></a>

                                <a href="/admin/comment-delete-<?= $comment->id() ?>.html" class="btn btn-danger" title="Supprimer le comment d\'id = <?= $comment->id() ?>"><span class="glyphicon glyphicon-edit"></span></a>
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

            <?php if(isset($usersList)): ?>

                <div class="table-responsive">

                    <table class="table table-hover ">
                        <thead>
                            <tr>
                                <th>Identifiant</th>
                                <th>Username</th>
                                <th>E-Mail</th>
                                <th>Rôle</th>
                                <th>Salage</th>
                                <th>Mot de passe</th>
                                <th>Date inscription</th>
                                <th></th>  <!-- Actions column -->
                            </tr>
                        </thead>

                        <p style="text-align: center; margin-bottom: 30px; margin-top: 30px;">Il y a actuellement <?= $nbUsers ?> utilisateur(s). En voici la liste :</p>

                        <?php foreach ($usersList as $users): ?>
                        <tr>
                            <td class="text-center"><?= $users->id() ?></td>
                            <td class="text-center"><?= $users->username() ?></td>
                            <td class="text-center"><?= $users->email() ?></td>
                            <td class="text-center">
                                <a href="/admin/switch-role-<?= $users->id() ?>.html" class="btn btn-default"><span class="glyphicon glyphicon-adjust" title="Intervertit le rôle utilisateur entre USER & ADMIN"> <?= $users->role() ?></span></a></td>
                            <td><?= $users->salt() ?></td>
                            <td><?= substr($users->password(), 0, 15 ).'...'?></td>
                            <td><?= $users->inscription()->format('d/m/Y à H\hi') ?></td>
                            <td>
                                <a href="/admin/user-update-<?= $users->id() ?>.html " class="btn btn-info" title="Modifier l\'utilisateur d\'id = <?= $users->id() ?>"><span class="glyphicon glyphicon-edit"></span></a>
                                <a href="admin/user-delete-<?= $users->id()?>.html" class="btn btn-danger" title="Supprimer l\'utilisateur d\'id<?= $users->id(); ?>"><span class="glyphicon glyphicon-remove"></span></a>

                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </table>
                </div>
            <?php else: ?>
                <div class="alert alert-warning">Aucun utilisateur n'a été trouvée.</div>
            <?php endif; ?>

            <a class="btn btn-success center-block" href="/admin/user-insert.html"><span class="glyphicon glyphicon-plus"></span> Ajouter un utilisateur</a>

        </div>

</div>