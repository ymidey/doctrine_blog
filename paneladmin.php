 <?php
    include("header.php");

    if ($_SESSION['admin'] == 1) {

        $resultShowUtilisateurs = $entityManager->getRepository('Utilisateur')->findAll();

        $resultShowAllComments = $entityManager->getRepository('Commentaires')->findAll();
    ?>

 <div class="header">
     <h1 class="titre">🧰 Pannel admin 🧰</h1>
 </div>

 <div class="pannel-content">
     <h2>Liste de tout les utilisateurs inscrit sur le forum : </h2>

     <table>
         <thead>
             <tr id="header">
                 <th>Login</th>
                 <th>Pseudo</th>
                 <th></th>
             </tr>
         </thead>
         <tbody>
             <?php foreach ($resultShowUtilisateurs as $showUtilisateurs) : ?>
             <tr>
                 <td data-title="login"><?php echo $showUtilisateurs->getLogin() ?></td>
                 <td data-title="pseudo"><?php echo $showUtilisateurs->getPseudo() ?> </td>
                 <td data-title="Supprimer"><a
                         href="traiteadmin.php?requete=deluser&delete=<?php echo $showUtilisateurs->getId() ?>"
                         onclick="return confirm('Voulez-vous vraiment supprimer cette utilisateur')">Supprimer</a>
                 </td>
             </tr>
             <?php endforeach; ?>
         </tbody>
     </table>

     <h2>Liste de tout les commentaires sur le forum : </h2>
     <table>
         <thead>
             <tr id="header">
                 <th>Pseudo</th>
                 <th>Publié sur</th>
                 <th>Contenu</th>
                 <th>Date de publication</th>
                 <th></th>
             </tr>
         </thead>
         <tbody>
             <?php foreach ($resultShowAllComments as $comments) : ?>
             <tr>
                 <td data-title="pseudo"><?php echo $comments->getUtilisateur()->getPseudo() ?></td>
                 <td data-title="billet"><a
                         href="billet.php?id_billet=<?php echo $comments->getId() ?>"><?php echo $comments->getBillets()->getTitre() ?></a>
                 </td>
                 <td data-title="contenu"><?php echo $comments->getContenu() ?> </td>
                 <td data-title="datePublication"><?php echo $comments->getDatePublication()->format('Y-m-d H:i:s') ?>
                 </td>
                 <td data-title="Supprimer"><a
                         href="traiteadmin.php?requete=delcom&delete=<?php echo $comments->getId() ?>"
                         onclick="return confirm('Voulez-vous vraiment supprimer ce commentaire')">Supprimer</a>
                 </td>
             </tr>
             <?php endforeach; ?>
         </tbody>
     </table>
 </div>

 <?php
        include("footer.php");
    } else {
        header("Location: accueil.php");
    } ?>