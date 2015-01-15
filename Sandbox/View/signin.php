<section id="career" class="container">
    <div class="center">
    <div class="row">
      <div class="col-sm-100">
        <div class="panel-group" id="accordion1">
				<div class="panel panel-default">
				<div class="panel-heading">
				<div class="form-group">
						<center>
							<a href="<?php echo $app->urlFor('signin');?>"><h3>Vous n'avez pas de compte ?</h3></a><br/>
						</center>
						<div class="panel panel-default">
            <div class="panel-heading">
              <h4 class="panel-title">
                  Formulaire d'inscription :
                </a>
              </h4>
            </div>
            <div>
              <div class="panel-body">
				<form action="signin" method="POST" >
					<div class="form-group">
						<input type="text" name="mail" class="form-control" required="required" placeholder="Email">
							<br/>
						<input type="text" name="pseudo" class="form-control" required="required" placeholder="Pseudo">
							<br/>	
						<input type="password" name="passwd" class="form-control" required="required" placeholder="Password">
							<br/>
						<input type="password" name="passwdverif" class="form-control" required="required" placeholder="Vérfication Password">
							<br/>
						<input type="submit" value="S'inscrire"/>
							</div>
					</form>
              </div>
            </div>
          </div>
		
				</div>
				</div>
				</div>

        </div>
      </div>
    </div>
  </section>

