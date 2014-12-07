<?php



function erreur($err='')
{
   $mess=($err!='')? $err:'Error';
   exit('<p>'.$mess.'</p>
   <p>Cliquez <a href="index.php">ici</a> page d\'accueil</p></div></body></html>');
}




function move_avatar($picture)
{
    $extension_upload = strtolower(substr(  strrchr($picture['name'], '.')  ,1));
    $name = time();
    $nomavatar = str_replace(' ','',$name).".".$extension_upload;
    $name = "./images/avatars/".str_replace(' ','',$name).".".$extension_upload;
    move_uploaded_file($avatar['tmp_name'],$name);
    return $nomavatar;
}
?>
