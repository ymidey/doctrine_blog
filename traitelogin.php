<?php
include("header.php");

$login = $_GET["login"];
$mdp = $_GET["password"];
$url = $_GET["urlPrecedente"];
if (strpos($url, "http://localhost/Blog_YannickMidey/register.php") !== false || strpos($url, "http://localhost/Blog_YannickMidey/login.php") !== false) {
    // Si elle le contient, on change la veleur de $url
    $url = "accueil.php";
}

// $users = getLogin($login);
$users = $entityManager->getRepository('Utilisateur')->findBy(array('login' => $login));

if (count($users) == 1) {
    $result = $users[0];
    var_dump($result);
    var_dump($result->getPasswd());
    if (password_verify($mdp, $result->getPasswd())) {
        $_SESSION['login'] = $result->getLogin();
        $_SESSION['pseudo'] = $result->getPseudo();
        $_SESSION['id_user'] = $result->getId();
        $_SESSION["admin"] = $result->getAdmin();
        header('location: accueil.php');
    }
}
// } else {
//     header('location: login.php?erreur');
// }