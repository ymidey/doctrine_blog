<?php
include("header.php");

$pseudo = $_GET["pseudo"];
$login = $_GET["email"];

$mdp = $_GET["password"];
$mdp2 = $_GET["password2"];

if ($mdp == $mdp2) {

    // $users = getUserWithSpecificPseudo($pseudo);
    $users = $entityManager->getRepository('Utilisateur')->findBy(array('pseudo' => $pseudo));

    if (count($users) > 0) {
        header("location: register.php?erreur=pseudoExiste");
    } else {
        $user = new Utilisateur();
        $user->setPseudo($pseudo);
        $user->setLogin($login);
        $user->setAdmin(1);
        $user->setPasswd($mdp);
        $entityManager->persist($user);
        $entityManager->flush();
        header("location: login.php");
    }
} else {
    header("location: register.php?erreur=mdp");
}
