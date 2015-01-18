<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="shortcut icon" href="../../assets/ico/favicon.ico">
    <title>Starter Template for Bootstrap</title>
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="starter-template.css" rel="stylesheet">
	
  </head>

  <body>

    <div class="navbar navbar-inverse navbar-fixed-top" role="navigation">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="#">MDEditor</a>
        </div>
        <div class="collapse navbar-collapse">
          <ul class="nav navbar-nav">
		  <?php if(isset($_SESSION["id"])){ ?>
            <li><a href="<?php echo $app->urlFor('index');?>">Home</a></li>
			<li><a href="<?php echo $app->urlFor('logout');?>">log out</a></li>
			<li><a href="<?php echo $app->urlFor('editor');?>">EpicEditor</a></li>
			<li><a href="<?php echo $app->urlFor('documents');?>">Documents</a></li>
            <li class="active"><a href="<?php echo $app->urlFor('profil');?>"><?php echo $_SESSION["pseudo"]?></a></li>
            <?php }
			else
			{?>
			<li><a href="<?php echo $app->urlFor('index');?>">Home</a></li>
            <li><a href="<?php echo $app->urlFor('signin');?>">Inscription</a></li>
			<li><a href="<?php echo $app->urlFor('login');?>">Connexion</a></li>
			<?php }?>
            
			       
                    
					
                </ul>
             
        </div><!--/.nav-collapse -->
      </div>
    </div>    <div class="content">
    <?php echo $yield ?>
  </body>
</html>