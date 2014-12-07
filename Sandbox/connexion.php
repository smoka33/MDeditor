<?php
session_start();
$titre="Connexion";
include("includes/connexionbdd.php");
include("includes/all.php");


?>

<?php
echo '<h1>Connexion</h1>';
if ($id!=0) erreur(ERR_IS_CO);
?>

<?php
if (!isset($_POST['pseudo']))
{
	echo '<form method="post" action="connexion.php">
	<legend>Connexion</legend>
	<p>
	<label for="pseudo">Pseudo :</label><input name="pseudo" type="text" id="pseudo" /><br />
	<label for="password">Mot de Passe :</label><input type="password" name="password" id="password" />
	</p>
	<p><input type="submit" value="Connexion" /></p></form>
	<a href="./inscription.php">Pas encore inscrit ?</a>
	 
	</div>';
}

else
{
    $message='';
    if (empty($_POST['pseudo']) || empty($_POST['password']) ) 
    {
        $message = '<p>une erreur s\'est produite pendant votre identification.
	Vous devez remplir tous les champs</p>
	<p>Cliquez <a href="./connexion.php">ici</a> pour revenir</p>';
    }
    else 
    {
        $query=$db->prepare('SELECT membre_mdp, membre_id, membre_rang, membre_pseudo
        FROM mdeditor_membres WHERE membre_pseudo = :pseudo');
        $query->bindValue(':pseudo',$_POST['pseudo'], PDO::PARAM_STR);
        $query->execute();
        $data=$query->fetch();
	if ($data['membre_mdp'] == md5($_POST['password'])) 
	{
	    $_SESSION['pseudo'] = $data['membre_pseudo'];
	    $_SESSION['level'] = $data['membre_rang'];
	    $_SESSION['id'] = $data['membre_id'];
	    $message = '<p>Bienvenue '.$data['membre_pseudo'].', 
			vous êtes maintenant connecté!</p>
			<p>Cliquez <a href="./index.php">ici</a> 
			pour revenir à la page d accueil</p>';  
	}
	else 
	{
	    $message = '<p>Une erreur s\'est produite 
	    pendant votre identification.<br /> Le mot de passe ou le pseudo 
            entré n\'est pas correct.</p><p>Cliquez <a href="./connexion.php">ici</a> 
	    pour revenir à la page précédente
	    <br /><br />Cliquez <a href="../index.php">ici</a> 
	    pour revenir à la page d accueil</p>';
	}
    $query->CloseCursor();
    }
    echo $message.'</div></body></html>';

}
?>