
<div class="container">
      <div class="starter-template">
      <div class="row clearfix">	
	 <?php	
	 require 'class/bdd.php';
		$sql = 'SELECT title, text, id FROM texts WHERE user_id ='.$_SESSION['id'].'';
		$req=$cnx->prepare($sql);
		$req->execute();
		$data = $req->fetchAll(PDO::FETCH_ASSOC);	
		?>
		<form method="post" class="form-signin" role="form" name="documents">
		<select name="document">
		<?php
		$test = $req->rowCount($sql);
			for($i = 0;$i <$test; $i = ($i + 1)){
		 echo ("<option name='title' value='".$data[$i]['id']."'>".$data[$i]['title']."</option>");
		 };
		// echo ("</select>");
		// ?> 
		</select>
				<button class="btn btn-lg btn-primary btn-block" type="submit">Ouvrir </button>
		</form>

    </div>
</div>

    </div>
</div>