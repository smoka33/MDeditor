<?php
require 'vendor/autoload.php';

class SignInValidator {

  static function verifEmail($email)
  {
    require 'class/bdd.php';
    $req = $cnx->prepare("SELECT mail FROM users");
    $req->execute();
    while($mail = $req->fetch())
    {
      $tabMail[]=$mail['mail'];
    }
    if (!empty($tabMail))
    {
    if(in_array($email,$tabMail ))
    {
       $msgerreur = "email déjà utilisé";
       return $msgerreur;
    }
    else
    {
      return True;

    }
  }
  else
  {
    return True;	
  }
  }
  static function verifSignIn($pseudo,$email,$password,$verifPassword)
  {
    require 'class/bdd.php';
    if(!empty($_POST)){
	
      $q = array('pseudo'=>$pseudo, 'mail'=>$email,'passwd'=>md5($password));
      $req = $cnx->prepare("INSERT INTO users (pseudo, mail, passwd) VALUES (:pseudo, :mail,:passwd)");
      $req->execute($q);

      return True;
    }
    else
    {
      echo "Champs incomplet";
      return False;
    }
  }

}

?>
