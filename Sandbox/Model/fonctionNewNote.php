<?php 
session_start();
		try{
			$bdd= new PDO('mysql:host=localhost;dbname=power-of-science','root','');
			}
		catch (Exception $e){
				die("Erreur:".$e->getMessage());
								}
		
		$q = array('Character_ID'=>$_SESSION['Character-ID'], 'Opponent_ID'=>$_POST['Opponent'], 'User_ID'=>$_SESSION['ID'], 'Name'=>$_POST['Name'], 'Note'=>$_POST['Note']);
		$sql = 'INSERT INTO notes (`Character_ID`, `Opponent_ID`, `User_ID`, `Name`, `Note`) VALUES (:Character_ID, :Opponent_ID, :User_ID, :Name, :Note)';
		$req = $bdd->prepare($sql);
		$req->execute($q);
		
		header("location:Notebook.php");
		

 ?>