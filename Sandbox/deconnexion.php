<?php
session_start();
session_destroy();
$titre="Déconnexion";
include("includes/all.php");

if ($id==0) erreur(ERR_IS_NOT_CO);

echo '<p>Déconnecté avec succès <br />';
echo'Cliquez <a href="index.php">ici</a> pour revenir à la page principale</p>';
echo '</div></body></html>';
?>