<?php 

require "vendor/autoload.php";
require 'Controler/auth.class.php';
require 'Controler/config.php';
require 'Controler/lang.php';


$app = new \Slim\Slim();
  $app->get('/',function() use ($app){
    if(!isset($_SESSION['id']))
    {
      $app->render('login.php');
    }
    else
    {
      $app->redirect($app->urlFor('match'));
    }
  })->name('index');

  $app->get('/register',function() use ($app){
    $app->render('register.php');
  })->name('contact');

  $app->get('/login',function() use ($app){
    $app->render('login.php');
  })->name('login');


  $app->post('/login',function() use ($app){

    $is_logged = auth::login($_POST['username'],$_POST['password']);
    if(!isset($_SESSION['id']))
    {
      $app->render('auth.class.php');
    }
    else
    {
      $app->redirect($app->urlFor('index'));
    }
  });


  $app->get('/logout',function() use ($app){
    auth::deletesession();
    $app->redirect($app->urlFor('index'));
  })->name('logout');


  $app->get('/signin',function() use ($app){
    $app->render('auth.class.php');
  })->name('signin');

  $app->post('/signin',function() use ($app){
    $is_registered = auth::register($_POST['username'],$_POST['password'],$_POST['verifypassword'],$_POST['email']);
     {
      $app->render('auth.class.php');
    }
    });

echo'<i>Vous êtes ici : </i><a href ="index.php">Accueil</a>';

?>

