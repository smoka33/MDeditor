<?php 
class NewNote {
	static function save_text($title,$text){
		require 'class/bdd.php';
		$q = array('user_id'=>$_SESSION['id'], 'title'=>$title, 'text'=>$text);
		$sql = 'INSERT INTO texts (`user_id`, `title`, `text`) VALUES (:user_id, :title, :text)';
		$req = $cnx->prepare($sql);		
		$req->execute($q);

		
	}
		
}
 ?>