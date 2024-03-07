<?php
include("header.php");

if (isset($_SERVER['HTTP_REFERER'])) {
    // Récupère l'URL de la page précédente
    $urlPagePrecedente = $_SERVER['HTTP_REFERER'];
}

if (isset($_GET['idBillet']) && $_SESSION['admin'] == 1) {
    $idBillet = $_GET['idBillet'];

    $billet = $entityManager->getRepository('Billets')->find($idBillet);
    if ($billet) {
?>
        <div class="requete">
            <h1 class="titre">Modifier l'article ✏️</h1>
            <form class="requete-form" action="traitebillet.php" method="get">
                <input type="hidden" name="idBillet" value="<?php echo $billet->getId(); ?>">

                <label for="titre">Titre</label>
                <input type="text" name="titre" id="titre" value="<?php echo $billet->getTitre(); ?>" required><br>

                <label for="contenu">Contenu</label>
                <textarea name="contenu" id="contenu" rows="5" required><?php echo $billet->getContenu(); ?></textarea><br>

                <input type="hidden" name="requete" id="requete" value="update">
                <input type="hidden" name="urlPrecedente" value="<?php echo $urlPagePrecedente ?>">

                <button type="submit">Modifier</button>
            </form>
        </div>
<?php
        include("footer.php");
    } else {
        echo "Billet non trouvé.";
    }
} else {
    header("Location: accueil.php");
} ?>