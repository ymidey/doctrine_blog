<?php
include("header.php");


if (
    isset($_GET["requete"])
    &&
    $_SESSION['admin'] == 1
) {
    if (
        $_GET["requete"] == "insert" && isset($_GET['titreBillet']) &&
        isset($_GET['contenu'])
    ) {
        $titre = ($_GET['titreBillet']);

        $checkStmt = $entityManager->getRepository('Billets')->findBy(array('titre' => $titre));

        if ($checkStmt) {
            header("location: add-billet.php?erreur=titreExiste");
        } else {
            $contenu = ($_GET['contenu']);
            $contenu = nl2br($contenu);
            $date_publi = new DateTime('now', new DateTimeZone('Europe/Paris'));
            $id_user = $_SESSION['id_user'];

            $billet = new Billets();
            $billet->setUtilisateur($entityManager->find('Utilisateur', $id_user));
            $billet->setTitre($titre);
            $billet->setContenu($contenu);
            $billet->setDatePublication($date_publi);
            $entityManager->persist($billet);
            $entityManager->flush();
            header("Location: accueil.php?validation=insert");
        }
    } elseif ($_GET["requete"] == "delete" && isset($_GET['idBillet']) && isset($_SESSION['admin']) && $_SESSION['admin'] == 1) {
        $id_billet = $_GET['idBillet'];
        $billet = $entityManager->find('Billets', $id_billet);
        $entityManager->remove($billet);
        $entityManager->flush();
        header("location: accueil.php");
    } elseif ($_GET["requete"] == "update" && isset($_GET['idBillet'])) {
        $id_billet = $_GET['idBillet'];
        $nouveauTitre = $_GET['titre'];
        $nouveauContenu = $_GET['contenu'];
        $nouveauContenu = nl2br($nouveauContenu);

        $billet = $entityManager->find('Billets', $id_billet);
        $billet->setTitre($nouveauTitre);
        $billet->setContenu($nouveauContenu);
        $entityManager->flush();
        header("location: accueil.php");
    }
} else {
    header("Location: accueil.php");
}
