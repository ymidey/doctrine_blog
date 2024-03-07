<?php

include("header.php");

if (isset($_GET['id_billet']) && isset($_SESSION['id_user'])) {

    $id_billet = ($_GET['id_billet']);
    $id_user = ($_SESSION['id_user']);

    if (isset($_GET["requete"]) == "insert" && isset($_GET['com'])) {
        $commentaire = ($_GET['com']);
        $commentaire = nl2br($commentaire);
        $datePubli = new DateTime('now', new DateTimeZone('Europe/Paris'));

        $comment = new Commentaires();
        $comment->setContenu($commentaire);
        $comment->setDatePublication($datePubli);
        $comment->setBillets($entityManager->find('Billets', $id_billet));
        $comment->setUtilisateur($entityManager->find('Utilisateur', $id_user));
        $entityManager->persist($comment);
        $entityManager->flush();
        header("Location: billet.php?id_billet=" . $id_billet);
    } elseif (isset($_GET["requete"]) == "delete" && isset($_GET["idcom"])) {
        $id_com = $_GET['idcom'];

        $comment = $entityManager->getRepository('Commentaires')->find($id_com);
        $entityManager->remove($comment);
        $entityManager->flush();

        header("Location: billet.php?id_billet=" . $id_billet);
    } elseif ($_GET["requete"] == "update" && isset($_GET['id_commentaire'])) {
        $idComment = $_GET['id_commentaire'];
        $nouveauContenu = $_GET['nouveau_contenu'];
        $nouveauContenu = nl2br($nouveauContenu);
        $comment = $entityManager->getRepository('Commentaires')->find($idComment);
        $comment->setContenu($nouveauContenu);
        $entityManager->flush();

        header("Location: billet.php?id_billet=" . $id_billet);
    }
} else {
    header("Location: accueil.php");
}
