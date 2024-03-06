<?php

require_once "bootstrap.php";


$message = new Message();

$newText = "Bonjour, c'est mon premier message";
$dateTime = new DateTime('now');
$message->setUtilisateur($entityManager->find('Utilisateur', 1));

$message->setTexte($newText);
$message->setDatepost($dateTime);

$entityManager->persist($message);
$entityManager->flush();
