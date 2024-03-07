<?php
include("header.php");

$idBillet = $_GET["id_billet"];

$billet = $entityManager->getRepository('Billets')->find($idBillet);
$comment = $entityManager->getRepository('Commentaires')->findBy(array('billets' => $idBillet));

?>

<div class="showBillet">
    <a href="accueil.php" class="returnproject"><svg width=" 25px" height="25px" viewBox="0 0 25 25">
            <path d=" M24 12.001H2.914l5.294-5.295-.707-.707L1 12.501l6.5 6.5.707-.707-5.293-5.293H24v-1z"></path>
        </svg>Retour à la page d'accueil</a>
    <?php if ($billet) { ?>
        <article class="billet">
            <div class="billet-header">
                <h1><?php echo $billet->getTitre() ?></h1>

                <?php

                $formattedDate = $billet->getDatePublication()->format('Y-m-d H:i:s');
                ?>

                <h2>Publié le <?php echo $formattedDate; ?> par
                    <?php echo $billet->getUtilisateur()->getPseudo() ?></h2>
                <?php if (isset($_SESSION["admin"]) && $_SESSION["admin"] == 1) { ?>
                    </a>
                    <div class="billet-admin">
                        <a href="traitebillet.php?requete=delete&idBillet=<?php echo $billet->getId() ?>" onclick="return confirm('Voulez-vous vraiment supprimer ce billet?')">Supprimer le billet</a>
                        <a href="modif-billet.php?idBillet=<?php echo $billet->getId() ?>">Modifier le
                            billet</a>
                    </div>
                <?php }; ?>
            </div>

            <div class="billet-content">
                <p><?php echo $billet->getContenu() ?></p>
            </div>
        </article>
    <?php } else { ?>
        <p>Aucun résultat trouvé.</p>
    <?php } ?>
    <button id="showComment">Voir les commentaires</button>
    <div id="commentaire">
        <?php
        echo "<p>" . count($comment) . " Commentaire(s) : </p>";

        if (count($comment) > 0) {
            foreach ($comment as $row) {
                $formattedDateTime = $row->getDatePublication()->format('d M, Y \à H:i');

                echo "<div class='comments'>";
                echo "<p class='comments-header'>";
                echo "Publié par " . $row->getBillets()->getUtilisateur()->getPseudo() . " le " . $formattedDateTime;
                echo "</p>";

                if (isset($_SESSION["id_user"]) && ($_SESSION["id_user"] == $row->getBillets()->getUtilisateur()->getId())) {
                    echo "<div id='commentContent{$row->getId()}'>";
                    echo "<p>" . $row->getContenu() . "</p>";
                    echo "</div>";

                    echo "<form id='commentForm{$row->getId()}' action='traitecom.php' method='get' style='display:none;'>";
                    echo "<textarea name='nouveau_contenu' required>" . $row->getContenu() . "</textarea>";
                    echo "<input type='hidden' name='id_commentaire' value='" . $row->getId() . "'>";
                    echo "<input type='hidden' name='requete' value='update'>";
                    echo "<input type='hidden' name='id_billet' value='" . $row->getBillets()->getId() . "'>";

                    echo "<input type='submit' value='Modifier'>";
                    echo "</form>";

                    echo "<button id='toggleFormButton{$row->getId()}' onclick='toggleCommentForm({$row->getId()})'>Modifier le commentaire</button>";

                    echo "<script>
    function toggleCommentForm(commentId) {
        var commentContent = document.getElementById('commentContent' + commentId);
        var commentForm = document.getElementById('commentForm' + commentId);
        var button = document.getElementById('toggleFormButton' + commentId);

        if (commentContent.style.display === 'none') {
            // Si la div est cachée, la rendre visible et changer le texte du bouton
            commentContent.style.display = 'block';
            commentForm.style.display = 'none';
            button.innerHTML = 'Modifier le commentaire';
        } else {
            // Si la div est visible, la cacher et changer le texte du bouton
            commentContent.style.display = 'none';
            commentForm.style.display = 'block';
            button.innerHTML = 'Annuler la modification';
        }
    }
</script>";
                } else {
                    echo "<p>" . $row->getId() . "</p>";
                }

                if (isset($_SESSION["admin"]) && $_SESSION["admin"] == 1) {
                    echo "<a href='traitecom.php?id_billet=" . $idBillet . "&requete=delete&idcom=" . $row->getId() . "' onclick=\"return confirm('Êtes-vous sûr de vouloir supprimer ce commentaire ?');\">Supprimer le commentaire</a>";
                }

                echo "</div>";
            }
        } else {
            echo "<p>Il n'y a aucun commentaire d'écrit pour ce billet</p>";
        }

        ?>

        <?php if (isset($_SESSION["id_user"])) { ?>
            <form action="traitecom.php" method="get" class="requete form-com">
                <label for="com">Ajoutez un nouveau commentaire : </label>
                <textarea name="com" id="com" required></textarea>
                <input type="hidden" name="id_billet" value="<?php echo $billet->getId(); ?>">
                <input type="hidden" name="requete" id="requete" value="insert">
                <button type="submit" id="btn_post_com">Postez</button>
            </form>
        <?php } else {
            echo "<br><div><p>Pour pouvoir ajouter un commentaire, vous devez être connecter</p><a href='login.php'>Me connecter</a></div>";
        } ?>
    </div>
</div>

<?php include("footer.php"); ?>