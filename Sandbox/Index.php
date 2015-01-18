<?php 

require "vendor/autoload.php";
require 'Model/loginValidator.php';
require 'Model/SignInValidator.php';
require 'Model/fonctionNewNote.php';
require 'Controller/logout.php';
session_start();


//chargement slim
$app = new \Slim\Slim([
  'templates.path' => 'view',
  'view' => '\Slim\LayoutView',
  'layout' => 'layouts/main.php'
  ]);	

  // Hook
  $app->hook('slim.before.router', function () use ($app) {
    $app->view()->setData('app', $app);
  });
  
  // routes
  $app->get('/',function() use ($app){
    if(!isset($_SESSION['id']))
    {
      $app->render('index.php');
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
	if(!isset($_SESSION['id']))
	{
		$app->render('login.php');
	}
	else
	{
		 $app->redirect($app->urlFor('profil'));
	}
})->name('login');

	$app->get('/editor',function() use ($app){	
		$app->render('editor.php');
})->name('editor');
	
	$app->get('/logout',function() use ($app){
    logout::function_logout();
    $app->redirect($app->urlFor('index'));
  })->name('logout');

	 $app->post('/editor',function() use ($app)
{

	
    NewNote::save_text($_POST['title'],$_POST['my-edit-area']);
	$app->redirect($app->urlFor('profil'));

});

	$app->get('/documents',function() use ($app){
	if(isset($_SESSION['id']))
	{
		
		 $app->render('documents.php');
	}
})->name('documents');

$app->post('/documents',function() use ($app){
	if(isset($_POST['document']))
	{
		
		$id = $_POST['document'];
		$app->render('opendocument.php');
		
		
}
});

$app->get('/opendocument',function() use ($app){
	if(isset($_POST['document']))
	{
		var_dump($_POST);die;
		 $app->render('opendocument.php');
	}
})->name('opendocument');

	$app->run();



?>

