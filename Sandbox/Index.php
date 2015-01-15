<?php 

require 'Slim/Slim.php';
require "vendor/autoload.php";
require 'Model/loginValidator.php';
require 'Model/SignInValidator.php';
require 'Controller/logout.php';
session_start();
\Slim\Slim::registerAutoloader();


//chargement slim
$app = new \Slim\Slim([
  'templates.path' => 'view'
  ]);	

  // routes
  $app->get('/',function() use ($app){
    if(!isset($_SESSION['id']))
    {
      $app->render('login.php');
    }
    else
    {
      $app->redirect($app->urlFor('profil'));
    }
  })->name('index');
  
  $app->post('/login',function() use ($app){
    $is_logged = loginValidator::verifLogin($_POST['pseudo'],$_POST['passwd']);
    if(!isset($_SESSION['id']))
    {
      $app->render('login.php');
	  echo "Login ou Password incorrect";
	 	
    }
    else
    {
      $app->redirect($app->urlFor('profil'));
    }
  });
  
   $app->get('/signin',function() use ($app){
	if(!isset($_SESSION['id']))
	{
		$app->render('signin.php');
	}
	else
	{
		 $app->redirect($app->urlFor('profil'));
	}
})->name('signin');

$app->post('/signin',function() use ($app){
    $is_email = SignInValidator::verifEmail($_POST['mail']);

    if ($is_email==1) {
    $is_signin = SignInValidator::verifSignIn($_POST['pseudo'],$_POST['mail'],$_POST['passwd'],$_POST['passwdverif']);
    if ($is_signin) {
      $app->redirect($app->urlFor('index'));
    }
    else{
      $app->redirect($app->urlFor('signin'));
    } 
  }
  });
  
  $app->get('/profil',function() use ($app){	
	$app->render('profil.php');
})->name('profil');

	$app->get('/login',function() use ($app){	
	$app->render('login.php');
})->name('login');
	
	$app->get('/logout',function() use ($app){
    logout::function_logout();
    $app->redirect($app->urlFor('index'));
  })->name('logout');


	$app->render('header.php', compact('app'));
	$app->run();
#	$app->render('footer.php', compact('app'));


?>

