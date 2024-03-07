 <?php
    include("header.php");

    // $resultRequetBillet = getAllBillets();
    $resultRequetBillet = $entityManager->getRepository('Billets')->findBy(array(), array('date_publication' => 'DESC'));

    ?>

 <div class="header">
     <h1 class="titre">🚢 Voyage-Voyage 🚢</h1>
     <h2><?php if (isset($_SESSION["pseudo"])) {

                echo "Bonjour {$_SESSION["pseudo"]}, ";
            } ?>
         bienvenue à toi sur les archives du blog Voyage-Voyage, un blog géré par Yannick</h2>
 </div>

 <div class="billet-container">
     <?php foreach ($resultRequetBillet as $billet) {
        ?>

     <div class="billet billet-hover">
         <a href="billet.php?id_billet=<?php echo $billet->getId() ?>" class="billet-link">

             <div class="billet-header">
                 <?php echo "<h4>" . $billet->getTitre() . "</h4>" ?>
                 <?php
                        $formattedDate = $billet->getDatePublication()->format('Y-m-d H:i:s');

                        echo "<p>Publié le {$formattedDate} par {$billet->getUtilisateur()->getPseudo()}</p>";
                        ?>
             </div>

             <div class="billet-content">
                 <?php
                        $contenuBillet = $billet->getContenu();

                        if (strlen($contenuBillet) > 100) {
                            $contenuTronque = substr($contenuBillet, 0, 100) . '...';
                            echo "<p>" . $contenuTronque . "</p>";
                        } else {
                            echo "<p>" . $contenuBillet . "</p>";
                        }
                        ?>
             </div>
         </a>
         <?php if (isset($_SESSION["admin"]) && $_SESSION["admin"] == 1) { ?>
         <div class="billet-admin">
             <a href="traitebillet.php?requete=delete&idBillet=<?php echo $billet->getId() ?>"
                 onclick="return confirm('Voulez-vous vraiment supprimer ce billet?')">Supprimer le billet</a>
             <a href="modif-billet.php?idBillet=<?php echo $billet->getId() ?>">Modifier le billet</a>
         </div>
         <?php }; ?>
         </a>
     </div>
     <?php } ?>
 </div>
 <?php include("footer.php"); ?>