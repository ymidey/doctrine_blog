<?php
include("header.php");

if ($_GET["delete"] && $_SESSION['admin'] == 1) {
    if ($_GET["requete"] == "deluser") {
        $idUser = $_GET['delete'];
        $user = $entityManager->find('Utilisateur', $idUser);
        $entityManager->remove($user);
        $entityManager->flush();
        header("Location: paneladmin.php");
    } elseif ($_GET["requete"] == "delcom") {
        $idCom = $_GET['delete'];
        $comm = $entityManager->find('Commentaires', $idCom);
        $entityManager->remove($comm);
        $entityManager->flush();
        header("Location: paneladmin.php");
    }
} else {
    header("Location: accueil.php");
}
