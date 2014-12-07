<?php
session_start();
include("includes/connexionbdd.php");
include("includes/all.php");



if ($id!=0) erreur(ERR_IS_CO);
?>

<?php
if (empty($_POST['pseudo'])) 
{
    echo '<h1>Inscription</h1>';
    echo '<form method="post" action="inscription.php" enctype="multipart/form-data">
    <label for="pseudo">* Pseudo :</label>  <input name="pseudo" type="text" id="pseudo" /> (le pseudo doit contenir entre 3 et 15 caractères)<br />
    <label for="password">* Mot de Passe :</label><input type="password" name="password" id="password" /><br />
    <label for="confirm">* Confirmer le mot de passe :</label><input type="password" name="confirm" id="confirm" /><br />
    <label for="email">* Votre adresse Mail :</label><input type="text" name="email" id="email" /><br />
    <label for="msn">Votre numéro de telephone :</label><input type="text" name="phone" id="phone" /><br />
    <label for="website">Votre site web :</label><input type="text" name="siteweb" id="siteweb" /><br />
    <label for="ville">Localisation :</label><input type="text" name="ville" id="ville" /><br />
    <label for="picture">Ajouter une photo :</label><input type="file" name="picture" id="picture" />(10Ko max)<br />
    <p><input type="submit" value="S\'inscrire" /></p></form>
    </div>
    </body>
    </html>';
    
    
} 

else
{
    $pseudo_erreur1 = NULL;
    $pseudo_erreur2 = NULL;
    $mdp_erreur = NULL;
    $email_erreur1 = NULL;
    $email_erreur2 = NULL;
    $picture_erreur = NULL;
    $picture_erreur1 = NULL;
    $picture_erreur2 = NULL;
    $picture_erreur3 = NULL;

    $i = 0;
    $temps = time(); 
    $pseudo=$_POST['pseudo'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $siteweb = $_POST['siteweb'];
    $ville = $_POST['ville'];
    $pass = md5($_POST['password']);
    $confirm = md5($_POST['confirm']);
    
    //Vérification du pseudo
    $query=$db->prepare('SELECT COUNT(*) AS nbr FROM mdeditor_membres WHERE membre_pseudo =:pseudo');
    $query->bindValue(':pseudo',$pseudo, PDO::PARAM_STR);
    $query->execute();
    $pseudo_free=($query->fetchColumn()==0)?1:0;
    $query->CloseCursor();
    if(!$pseudo_free)
    {
        $pseudo_erreur1 = "Votre pseudo est déjà utilisé";
        $i++;
    }

    if (strlen($pseudo) < 3 || strlen($pseudo) > 15)
    {
        $pseudo_erreur2 = "Votre pseudo ne fait pas la taille demandée";
        $i++;
    }

    //Vérification du mdp
    if ($pass != $confirm || empty($confirm) || empty($pass))
    {
        $mdp_erreur = "Votre mot de passe doit être identique à sa confirmation";
        $i++;
    }


   $query=$db->prepare('SELECT COUNT(*) AS nbr FROM mdeditor_membres WHERE membre_email =:mail');
    $query->bindValue(':mail',$email, PDO::PARAM_STR);
    $query->execute();
    $mail_free=($query->fetchColumn()==0)?1:0;
    $query->CloseCursor();
    
    if(!$mail_free)
    {
        $email_erreur1 = "Votre adresse email est déjà utilisée";
        $i++;
    }
    //On vérifie la forme maintenant
    if (!preg_match("#^[a-zA-Z0-9._-]+@[a-zA-Z0-9._-]{2,}\.[a-z]{2,4}$#", $email) || empty($email))
    {
        $email_erreur2 = "Votre adresse E-Mail n'est pas valide";
        $i++;
    }


   //Vérification de l'avatar :
    if (!empty($_FILES['picture']['size']))
    {
        //On définit les variables :
        $maxsize = 10024; //Poid de l'image
        $maxwidth = 100; //Largeur de l'image
        $maxheight = 100; //Longueur de l'image
        $extensions_valides = array( 'jpg' , 'jpeg' , 'gif' , 'png', 'bmp' ); //Liste des extensions valides
        
        if ($_FILES['picture']['error'] > 0)
        {
                $avatar_picture = "Erreur lors du transfert de la photo : ";
        }
        if ($_FILES['picture']['size'] > $maxsize)
        {
                $i++;
                $avatar_picture = "Le fichier est trop gros : (<strong>".$_FILES['avatar']['size']." Octets</strong>    contre <strong>".$maxsize." Octets</strong>)";
        }

        $image_sizes = getimagesize($_FILES['picture']['tmp_name']);
        if ($image_sizes[0] > $maxwidth OR $image_sizes[1] > $maxheight)
        {
                $i++;
                $picture_erreur2 = "Mauvaises dimensions : 
                (<strong>".$image_sizes[0]."x".$image_sizes[1]."</strong> contre <strong>".$maxwidth."x".$maxheight."</strong>)";
        }
        
        $extension_upload = strtolower(substr(  strrchr($_FILES['picture']['name'], '.')  ,1));
        if (!in_array($extension_upload,$extensions_valides) )
        {
                $i++;
                $picture_erreur3 = "Extension de l'image non prise en charge";
        }
    }

  if ($i==0)
   {
    echo'<h1>Inscription terminée</h1>';
        echo'<p>Bienvenue '.stripslashes(htmlspecialchars($_POST['pseudo'])).' vous êtes maintenant inscrit sur MDeditor</p>
    <p>Cliquez <a href="../index.php">ici</a> pour revenir à l\'accueil</p>';
    
        //La ligne suivante sera commentée plus bas
    $nomavatar=(!empty($_FILES['avatar']['size']))?move_avatar($_FILES['avatar']):''; 
   
        $query=$db->prepare('INSERT INTO mdeditor_membres (membre_pseudo, membre_mdp, membre_email,             
        membre_phone, membre_siteweb, membre_picture, membre_ville, membre_inscrit)
        VALUES (:pseudo, :pass, :email, :phone, :siteweb, :nomavatar, :ville, :temps)');
    $query->bindValue(':pseudo', $pseudo, PDO::PARAM_STR);
    $query->bindValue(':pass', $pass, PDO::PARAM_INT);
    $query->bindValue(':email', $email, PDO::PARAM_STR);
    $query->bindValue(':phone', $phone, PDO::PARAM_STR);
    $query->bindValue(':siteweb', $siteweb, PDO::PARAM_STR);
    $query->bindValue(':nomavatar', $nomavatar, PDO::PARAM_STR);
    $query->bindValue(':ville', $ville, PDO::PARAM_STR);
    $query->bindValue(':temps', $temps, PDO::PARAM_INT);
        $query->execute();

    //Et on définit les variables de sessions
        $_SESSION['pseudo'] = $pseudo;
        $_SESSION['id'] = $db->lastInsertId(); ;
        $_SESSION['level'] = 2;
        $query->CloseCursor();
    }
    else
    {
        echo'<h1>Inscription interrompue</h1>';
        echo'<p>Une ou plusieurs erreurs se sont produites pendant l incription</p>';
        echo'<p>'.$i.' erreur(s)</p>';
        echo'<p>'.$pseudo_erreur1.'</p>';
        echo'<p>'.$pseudo_erreur2.'</p>';
        echo'<p>'.$mdp_erreur.'</p>';
        echo'<p>'.$email_erreur1.'</p>';
        echo'<p>'.$email_erreur2.'</p>';
        echo'<p>'.$avatar_erreur.'</p>';
        echo'<p>'.$avatar_erreur1.'</p>';
        echo'<p>'.$avatar_erreur2.'</p>';
        echo'<p>'.$avatar_erreur3.'</p>';
       
        echo'<p>Cliquez <a href="./inscription.php">ici</a> pour recommencer</p>';
    }
}
?>
</div>
</body>
</html>
