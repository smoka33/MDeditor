<?php


class loginValidator {

  static function verifLogin($pseudo,$passwd)
  {
    require 'class/bdd.php';
    if(!empty($_POST)){
      $tab = array('pseudo'=>$pseudo, 'passwd'=>md5($passwd));
      $sql = 'SELECT pseudo, passwd FROM users WHERE mail = :mail AND passwd = :passwd';
      $req = $cnx->prepare($sql);
      $req->execute($tab);

      $idrep = $req->fetch();
      $count = $req->rowCount($sql);
      if($count == 1){
        $_SESSION['connexion'] = 1;	
        $_SESSION['id'] = $idrep['id'];
		$_SESSION['pseudo'] = $pseudo;
        return True;
      }
      else{
        $_SESSION['connexion'] = 0;
        return False;
      }

    }
  }
}
?>
