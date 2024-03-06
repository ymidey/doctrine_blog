<?php

require_once "bootstrap.php";

$message = new Message();
$productRepository = $entityManager->getRepository('Message');
$products = $productRepository->findAll();

foreach ($products as $product) {
    echo sprintf("%s\n", $product->getUtilisateur()->getLogin() . " a écrit : " . $product->getTexte());
    echo "<br>";
}
